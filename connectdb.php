<?php

$host = 'vtcfyp.cs0ipzza3gtf.us-east-1.rds.amazonaws.com';
$db = 'fyp';
$user = 'root';
$pass = '12345678';
$dsn = "mysql:host=$host;dbname=$db"; 
try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}


