<html>
<head>
    <title>Teaching Content</title>
</head>
<h2>Welcome to the class you teach!</h2>
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
      echo "entered else";
    } 
    $uid = $_SESSION["userid"];

    echo $cid;

    $query = "SELECT * from teaches where sid = '$uid' and cid = '$cid'";

    if (!($result1 = mysqli_query($conn, $query))) {    
        printf("Error1: %s\n", mysqli_error($conn));
        exit(1);
    }

    $query = "SELECT * from ta where sid = '$uid' and cid = '$cid'";

    if (!($result2 = mysqli_query($conn, $query))) {    
        printf("Error2: %s\n", mysqli_error($conn));
        exit(1);
    }

    if (mysqli_num_rows($result1) == 0 && mysqli_num_rows($result2) == 0) {
      print("You don't teach/TA this class!");
      echo "<a href='welcome.php'> Go back</a>";
      exit(1);
    }

    $query = "SELECT cnum, semester, cyear, cname FROM class WHERE cid = '$cid'";

    if (!($result = mysqli_query($conn, $query))) {    
        printf("Error3: %s\n", mysqli_error($conn));
        exit(1);
    }


    printf ('This is ');
    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($row as $key => $value) {
            print ($value . ' ');
        }
    }
    print('class you teach/TA!');
    print("<br>");
    print("<br>");

    print("Create a new assignment");
    print("<br>");
?>

<form action="newass.php" method="POST">
  Assignment name:<br>
  <input type="text" name="aname">
  <br>
  Assignment points:<br>
  <input type="number" name="points">
  <br>
  Due date:<br>
  <input type="datetime-local" name="due_date">
  <br>
  Assignment description:<br>
  <input type="text" name="adescription">
  <br>
  <br>
  <button type="submit" class="btn btn-primary">Create</button>
</form>
 <br>
 <br>

<?php

  $cid = $_SESSION["cid"];

  $query = "SELECT sid as user_id, fname, lname, aname as assignment, numGrade as grade from ass_grade join student using (sid) where cid = '$cid' order by sid, aname";

  if (!($result = mysqli_query($conn, $query))) {
     printf("Error2: %s<br>", mysqli_error($conn));
     exit(1);
  }
  # print out the number of returned rows
  print('Assignment details of each student');
  printf("<p><br>0: not yet graded<br><P>");
  # create a new paragraph
  print("<p>");
  print("<table>");
  # write the contents of the table
  $header = false;
  while ($row = mysqli_fetch_assoc($result)){
     # print the attribute names once!
     if (!$header) {
        $header = true;
        print("<thead><tr>");
        foreach ($row as $key => $value) {
           print "<th>" . $key . "</th>";             // Print attr. name
        }
        print("</tr></thead>");
     }
     print("<tr>");     # Start row of HTML table
     foreach ($row as $key => $value) {
        print ("<td>" . $value . "</td>"); # One item in row
     }
     print ("</tr>");   # End row of HTML table
  }

  print("</table>");
  print("<p>");
  print("<br>");
  print("Put in a new assignment grade:");
?>

<form action="newgrade.php" method="POST">
  Student's user ID:<br>
  <input type="text" name="uid">
  <br>
  Assignment name:<br>
  <input type="text" name="aname">
  <br>
  Assignment grade:<br>
  <input type="number" name="numGrade">
  <br>
  <br>
  <button type="submit" class="btn btn-primary">Add</button>
</form>
<br>
<br>

<?php
	$query = "SELECT sid as user_id, fname, lname, final_grade from student join takes using (sid) where cid = '$cid'";

  	if (!($result = mysqli_query($conn, $query))) {
     	printf("Error2: %s<br>", mysqli_error($conn));
    	exit(1);
  	}
  # print out the number of returned rows
  print('Student Overview');
  printf("<p><br>0: not yet graded<br><P>");
  # create a new paragraph
  print("<p>");
  print("<table>");
  # write the contents of the table
  $header = false;
  while ($row = mysqli_fetch_assoc($result)){
     # print the attribute names once!
     if (!$header) {
        $header = true;
        print("<thead><tr>");
        foreach ($row as $key => $value) {
           print "<th>" . $key . "</th>";             // Print attr. name
        }
        print("</tr></thead>");
     }
     print("<tr>");     # Start row of HTML table
     foreach ($row as $key => $value) {
        print ("<td>" . $value . "</td>"); # One item in row
     }
     print ("</tr>");   # End row of HTML table
  }
  print("</table>");
  print("<p>");
  print("<br>");
  print("Put in final grade:");
?>
<form action="newfg.php" method="POST">
  Student's user ID:<br>
  <input type="text" name="uid">
  <br>
  Final grade:<br>
  <input type="text" name="final_grade">
  <br>
  <br>
  <button type="submit" class="btn btn-primary">Add</button>
</form>
<br>
<br>

<?php
	echo "<a href='welcome.php'>Home</a>";
    print("<br>");
    echo "<a href='qa.php'>Q & A</a>";
    print("<br>");
    echo "<a href='end.php'>End Session</a>";
?>

</body>
</html>