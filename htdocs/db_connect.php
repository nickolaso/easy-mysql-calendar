<?php
$con = mysql_connect("localhost","Database_Username","Database_password");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("Database_name", $con);
?>
