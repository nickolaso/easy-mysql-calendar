<?php
define("HOST", "localhost"); // The host you want to connect to.
define("USER", "Database_Username"); // The database username.
define("PASSWORD", "Database_password"); // The database password. 
define("DATABASE", "Database_name"); // The database name.
 
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
// If you are connecting via TCP/IP rather than a UNIX socket remember to add the port number as a parameter.
?>
