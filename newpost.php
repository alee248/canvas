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
    $title = $_POST["title"];
    $ptext = $_POST["ptext"];

    $pid = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(4/strlen($x)))),1,4);

    $query = "INSERT INTO qa VALUES ('$pid', '$title', '$uid','$ptext', NOW(), '$cid')";

    if (!($result = mysqli_query($conn, $query))) {    
        printf("Error1: %s\n", mysqli_error($conn));
        printf('Reply could not be posted, try again.');
        print("<br>");
        echo "<a href='qa.php'> Go back</a>";
        exit(1);
    }

    $tags = $_POST['tags[]'];
    foreach ($tags as $value) {
  		$query = "INSERT INTO post_tag VALUES ('$pid', '$value')";

  		if (!($result = mysqli_query($conn, $query))) {    
	        printf("Error2: %s\n", mysqli_error($conn));
	        printf('tags cannot be inserted, try again.');
	        print("<br>");
	        echo "<a href='qa.php'> Go back</a>";
	        exit(1);
	    }
	}

    print("Reply posted successfully!");
    print("<br>");
    echo "<a href='qa.php'> Go back</a>";
    
?>