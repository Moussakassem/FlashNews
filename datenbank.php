<?php

//db configuration
$server = "localhost";
$user = "root";
$password = "";
$dbname = "nachrichten";

//connection
$conn = mysqli_connect($server, $user, $password, $dbname) or die("couldn't connect to database");
