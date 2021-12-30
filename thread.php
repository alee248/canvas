<html>
<head>
    <title>Q&A Threads</title>
</head>
<h2>Q&A Threads</h2>
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
    $pid = $_POST["pid"];

    $query = "SELECT title, ptext as text, pdate as post_date from qa join post_tag using (pid) where cid = '$cid' and pid = '$pid'";

    if (!($result = mysqli_query($conn, $query))) {    
        printf("Error1: %s\n", mysqli_error($conn));
        printf('Something went wrong, try again.');
        print("<br>");
        echo "<a href='qa.php'> Go back</a>";
        exit(1);
    }
  print('Post you selected: ');
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
  print("<br>");

  $query = "SELECT rtime as reply_time, rtext as reply_text from threads where pid = '$pid' order by rtime";

    if (!($result = mysqli_query($conn, $query))) {    
        printf("Error2: %s\n", mysqli_error($conn));
    }

  print('Threads: ');
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

?>

</body>
</html>