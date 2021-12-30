<html>
<head>
    <title>Welcome to your class!</title>
</head>
<h2>Class Overview</h2>
<body>

<?php
    /* Attempt to connect to MySQL database */
    $conn = mysqli_connect("localhost", "cs377", "ma9BcF@Y", "canvas");
 
    // Check connection
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit(1);
    }
    session_start();


    if (isset($_SESSION["cid"]) && $_POST["cid"] == $_SESSION["cid"]) 
    	$cid = $_SESSION["cid"];
    else {
    	$cid = $_POST["cid"];
    	$_SESSION["cid"] = $cid;
    }    
    $uid = $_SESSION["userid"];


    $query = "SELECT * from takes where sid = '$uid' and cid = '$cid'";

    if (!($result = mysqli_query($conn, $query))) {    
        printf("Error1: %s\n", mysqli_error($conn));
        exit(1);
    }
    if (mysqli_num_rows($result) == 0) {
    	print("You don't take this class!");
    	echo "<a href='welcome.php'> Go back</a>";
    	exit(1);
    }


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
    print('class!');
    print("<br>");
    print("<br>");
    
    
    $query = "SELECT aname as assignment, adescription as description, points, due_date FROM assignment WHERE cid = '$cid' order by due_date asc";

    if (!($result = mysqli_query($conn, $query))) {    
        printf("Error2: %s\n", mysqli_error($conn));
        exit(1);
    }

    print('Assignments for this class: '. "<br>");
    print("<br>");
    while ($row = mysqli_fetch_assoc($result)) {
	    foreach ($row as $key => $value) {
	        print ($key . ":  " . $value . "<br>");
	    }
	    print("<br>");
	}
?>
<br>
<br>
<form action="student_grade.php" method="POST">
  Go to assignment... (Enter the assignment name you want to look at. Make sure there is no white space.)<br>
  <input type="text" name="aname">
  <br>

<?php
	print("<br>");
    print("<br>");


    $query = "SELECT final_grade FROM takes where sid = '$uid' and cid = '$cid'";

    if (!($result = mysqli_query($conn, $query))) {    
        printf("Error3: %s\n", mysqli_error($conn));
        exit(1);
    }
    print('Final Grade: ');
    while ($row = mysqli_fetch_assoc($result)) {
	    foreach ($row as $key => $value) {
	        print ($value);
	    }
	}
    print("<br>");
    print("<br>");
    print("<br>");

    echo "<a href='welcome.php'>Home</a>";
    print("<br>");
    echo "<a href='qa.php'>Q & A</a>";
    print("<br>");
    echo "<a href='end.php'>End Session</a>";
?>

</body>
</html>