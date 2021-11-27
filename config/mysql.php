<?php
$username = "root";
$password = "root"; 
$host = "localhost"; //localhost 
$db = "blog";
$port = "8889";

$option = [
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ERRMODE_EXCEPTION => TRUE,
];

$dsn = "mysql:host=$host;dbname=$db;charset=utf8;port=$port";

try {
    $connexion = new \PDO($dsn, $username, $password, $option);
} catch (\PDOException $error) {
    $message = $error->getMessage();
    var_dump($message);
    die("Erreur lors de ma connexion PDO");
}



