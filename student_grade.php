<html>
<head>
    <title>Assignment Grade (student)</title>
</head>
<body>
<h2>View grade for your assignment</h2>
<br>
<br>

<?php
    /* Attempt to connect to MySQL database */
    $conn = mysqli_connect("localhost", "cs377", "ma9BcF@Y", "canvas");
 
    // Check connection
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit(1);
    }
    session_start();

    $cid = $_SESSION["cid"];
    $uid = $_SESSION["userid"];
    $aname = $_POST["aname"];

    // verify if the person takes the class or not

    $query = "SELECT cnum, semester, cyear, cname FROM class WHERE cid = '$cid'";

    if (!($result = mysqli_query($conn, $query))) {    
        printf("Error1: %s\n", mysqli_error($conn));
        exit(1);
    }

    printf ('This is your ');
    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($row as $key => $value) {
            print ($value . ' ');
        }
    }
    print('Class Assignment ' . $aname);

    print("<br>");
    print("<br>");
    print("<br>");

      # execute the query
      $query = "SELECT aname as Assignment, numGrade as Grade FROM ass_grade
                WHERE cid = '$cid' and aname = '$aname' and sid = '$uid'";

      if (!($result = mysqli_query($conn, $query))) {
         printf("Error2: %s\n", mysqli_error($conn));
         exit(1);
      }

    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($row as $key => $value) {
            print ($key . ":  " . $value . "<br>");
        }
    }

    if (mysqli_num_rows($result)==0) {  
        printf('Grade for this assignment is currently unavailable.');
    }

    print("<br>");
    print("<br>");
    print("<br>");

    echo "<a href='welcome.php'>Home</a>";
    print("<br>");
    echo "<a href='class.php'>Class Overview</a>";
    print("<br>");
    echo "<a href='qa.php'>Q & A</a>";

?>

</body>
</html>