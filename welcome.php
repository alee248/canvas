<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <div class="wrapper">
        <h2>Welcome to Canvas!</h2>

<?php
    /* Attempt to connect to MySQL database */
    $conn = mysqli_connect("localhost", "cs377", "ma9BcF@Y", "canvas");
 
    // Check connection
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit(1);
    }
    session_start();

    if (isset($_SESSION["userid"]) && isset($_SESSION["lid"])) {
        $uid = $_SESSION["userid"];
        $lid = $_SESSION["lid"];
    }
    else {
        $uid = $_POST['userid'];
        $lid = $_POST['login_id'];

        $_SESSION["userid"] = $uid;
        $_SESSION["lid"] = $lid;
    }

    $query = "SELECT sid, fname, lname, login_id FROM student WHERE sid = '$uid' AND login_id = '$lid'";

    if (!($result = mysqli_query($conn, $query))) {    
        printf("Error1: %s\n", mysqli_error($conn));
        exit(1);
    }

    if (mysqli_num_rows($result)==0) {  
        printf('User ID and login ID do not match, try again!');
        echo "<a href='login.php'> Go back.</a>";
        exit(1);
    }

    $query = "SELECT cnum, cyear, semester, t.cid FROM takes t, class c WHERE sid = '$uid' and t.cid = c.cid";
    # Execute query
    if (!($result = mysqli_query($conn, $query))) {    
        printf("Error2: %s\n", mysqli_error($conn));
        exit(1);
    }

    print('Classes you take: '. "<br>");
    # go through the results of the query
    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($row as $key => $take_value) {
            echo $take_value . ' ';
        } 
        print("<br>");
    }

    $query2 = "SELECT cnum, cyear, semester, t.cid FROM teaches t, class c WHERE sid = '$uid' AND t.cid = c.cid
        union 
        SELECT cnum, cyear, semester, ta.cid FROM ta, class c WHERE sid = '$uid' AND ta.cid = c.cid;";
    # Execute query
    if (!($result = mysqli_query($conn, $query2))) {    
        printf("Error3: %s\n", mysqli_error($conn));
        exit(1);
    }

    print("<br>");
    print('Classes you teach/TA: '. "<br>");
    # go through the results of the query
    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($row as $key => $teach_value) {
            echo $teach_value . ' ';
        } 
        print("<br>");
    }
?>
<br>
<br>
<form action="class.php" method="POST">
  View the class content of the class you take: (Please enter the 5 random characters after your class name)<br>
  <input type="text" name="cid">
  <br>
</form>
<br>
<form action="teach.php" method="POST">
  View the class content of the class you teach/TA: (Please enter the 5 random characters after your class name)<br>
  <input type="text" name="cid">
  <br>
</form>
<br>
<br>
<?php
    echo "<a href='end.php'>End Session</a>";
?>

</body>
</html>