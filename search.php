<?php
header('Content-Type: application/json');


$books = [
    ['title' => 'Book 1', 'author' => 'Author 1'],
    ['title' => 'Book 2', 'author' => 'Author 2'],
    ['title' => 'Book 3', 'author' => 'Author 3'],
];

$search = isset($_POST['search']) ? $_POST['search'] : '';

$results = [];
if ($search !== '') {
    foreach ($books as $book) {
        if (stripos($book['title'], $search) !== false) {
            $results[] = $book;
        }
    }
}

echo json_encode($results);
