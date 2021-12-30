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
    $due_date = $_POST["due_date"];
    $points = $_POST["points"];
    $adescription = $_POST["adescription"];

    $query = "INSERT INTO assignment VALUES ('$aname', 
            '$due_date','$adescription','$points','$cid')";

    if (!($result = mysqli_query($conn, $query))) {    
        printf("Error1: %s\n", mysqli_error($conn));
        printf('Assignment could not created, try again.');
        print("<br>");
        echo "<a href='teach.php'> Go back</a>";
        exit(1);
    }
    else {
    	printf('Assignment successfully created!');
        print("<br>");
        echo "<a href='teach.php'> Go back</a>";
    }
?>