<?php

// connects the database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "padilla";
$dsn = "mysql:host={$host};dbname={$dbname}";

// creates the PDO database connection
$pdo = new PDO($dsn, $user, $password);

// sets database session time zone
$pdo->exec("SET time_zone = '+08:00';");

// this determines if the database connection was successful
if ($pdo) {
    echo "Successfully connected to the database, " . $dbname;
}
else {
    echo "Connection failed";
}

?>
