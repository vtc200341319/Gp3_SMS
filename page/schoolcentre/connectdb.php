<?php
session_start();
$host = 'localhost';
$db = 'fyp';
$user = 'root';
$pass = '';
$dsn = "mysql:host=$host;dbname=$db"; 
try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}


