<html>
<head>
    <title>Q & A</title>
</head>
<h2>Q & A Posts</h2>
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

    $cid = $_SESSION["cid"];
    $uid = $_SESSION["userid"];


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
    print('class Q&A posts!');
    print("<br>");
    print("<br>");
    print('Questions / Answers / Comments / Announcements: ');
    print("<br>");
    print("<br>");

    $query = "SELECT tag FROM post_tag JOIN qa USING (pid) WHERE cid = '$cid'";
    
    if (!($result = mysqli_query($conn, $query))) {    
        printf("Error2: %s\n", mysqli_error($conn));
        exit(1);
    }
    print ('Tags: ');
    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($row as $key => $value) {
            print ($value . ' ');
        }
    }
?>
 <br>
<form action="filter.php" method="POST">
  Filter posts with a tag: (Do not put white space before or after the tag)<br>
  <input type="text" name="tag">
</form>
 <br>
 Create a new post!
 <form action="newpost.php" method="POST">
 	<br>
  Title:<br>
  <input type="text" name="title">
  <br>
  Text: <br>
  <input type="text" name="ptext">
  <br>
  Tag1: (Enter one of the tags above.)<br>
  <input type="text" name="tags[]">
  <br>
  Tag2: (Optional: enter one of the tags above.)<br>
  <input type="text" name="tags[]">
  <br>
  Tag3: (Optional: enter one of the tags above.)<br>
  <input type="text" name="tags[]">
  <br>
  <br>
  <button type="submit" class="btn btn-primary">Create</button>
</form>


<?php
	$query = "SELECT pid, title, sid, ptext, pdate from qa where cid = '$cid' order by pdate desc";

    if (!($result = mysqli_query($conn, $query))) {    
        printf("Error3: %s\n", mysqli_error($conn));
        printf('Something went wrong, try again.');
        print("<br>");
        echo "<a href='qa.php'> Go back</a>";
        exit(1);
    }
  print('Q & A');
  print("<br>");
  if (mysqli_num_rows($result) == 0) print('There are no posts at the moment. Be the first one to post something!');
  print("<p>\n");
  print("<table>\n");
  # write the contents of the table
  $header = false;
  while ($row = mysqli_fetch_assoc($result)){
     # print the attribute names once!
     if (!$header) {
        $header = true;
        print("<thead><tr>\n");
        foreach ($row as $key => $value) {
           print "<th>" . $key . "</th>";             // Print attr. name
        }
        print("</tr></thead>\n");
     }
     print("<tr>\n");     # Start row of HTML table
     foreach ($row as $key => $value) {
        print ("<td>" . $value . "</td>"); # One item in row
     }
     print ("</tr>\n");   # End row of HTML table
  }
  print("</table>\n");
  print("<p>\n");
?>

<form action="thread.php" method="POST">
  Go to a specific post: (Enter the pid, do not leave white space.)<br>
  <input type="text" name="pid">
  <br>
</form>
 <br>
 <br>

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
