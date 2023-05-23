<?php

$host = 'localhost';
$db = 'exam_db';
$user = 'root';
$pass = '';
$dsn = "mysql:host=$host;dbname=$db"; 
try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}


