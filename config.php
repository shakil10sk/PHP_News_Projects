<?php
$hostname = "http://localhost/PHP_News_projects";

$conn = mysqli_connect("localhost", "root", "", "phpnews") 
    or die("Connection failed : " . mysqli_connect_error());

$conn->set_charset("utf8");