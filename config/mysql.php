<?php
$username = "106139_blog";
$password = "vobfik-nyzPyv-0jyfra";
$host = "mysql-pawolanmwen.alwaysdata.net"; //localhost 
$db = "pawolanmwen_blog";
$port = "3306";

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



