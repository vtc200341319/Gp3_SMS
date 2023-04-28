<?php
require_once 'config.php';

function connect_database() {
    global $db_host, $db_name, $db_user, $db_pass;
    
    $connection = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    return $connection;
}

function search_books($search) {
    $connection = connect_database();
    $search = '%' . $connection->real_escape_string($search) . '%';
    $query = "SELECT * FROM books WHERE title LIKE ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $search);
    $stmt->execute();
    $result = $stmt->get_result();
    $books = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $connection->close();

    return $books;
}
