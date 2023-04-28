<?php
header('Content-Type: application/json');

require_once 'database.php';

$search = isset($_POST['search']) ? $_POST['search'] : '';
$results = search_books($search);
echo json_encode($results);
