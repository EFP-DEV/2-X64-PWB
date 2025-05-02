<?php

$host = 'localhost';
$db   = 'PWB';
$user = 'PWB';
$pass = 'b!8bYV.QiCGB*VUO';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $options);

$stmt = $pdo->query("SELECT * FROM postit");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
