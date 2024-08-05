<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "rentrover_db";

$connection = new mysqli($host, $username, $password, $database) or die("Database connection failed. $connection->connect_error");

$connection->close();