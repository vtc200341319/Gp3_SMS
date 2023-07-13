<?php
require_once '../../connectdb.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM campus_news WHERE campusNewsID = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$id])) {
        echo "News item deleted.";
    } else {
        http_response_code(500);
        echo "Failed to delete news item.";
    }
} else {
    http_response_code(400);
    echo "Invalid request.";
}
