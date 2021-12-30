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
    $aname = $_POST["aname"];
    $uid = $_POST["uid"];
    $numGrade = $_POST["numGrade"];

    $query = "UPDATE ass_grade SET numGrade = '$numGrade' WHERE cid = '$cid' and aname = '$aname' and sid = '$uid'";

    if (!($result = mysqli_query($conn, $query))) {    
        printf("Error1: %s\n", mysqli_error($conn));
        printf('Assignment grade could not be updated, try again.');
        print("<br>");
        echo "<a href='teach.php'> Go back</a>";
        exit(1);
    }
    else {
    	printf('Assignment grade updated successfully!');
        print("<br>");
        echo "<a href='teach.php'> Go back</a>";
    }
?>