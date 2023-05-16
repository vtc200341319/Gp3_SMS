<?php
require_once '../../connectdb.php';


$sql = "SELECT MAX(campusNewsID) FROM campus_news";
$result = $pdo->query($sql);
$row = $result->fetch();
$latest_id = intval($row[0]);


$new_id = $latest_id + 1;
$topic = $_POST['topic'];
$content = $_POST['content'];
$today = date("Y-m-d");

$sql = "INSERT INTO campus_news (campusNewsID, topic, content, issueDate, staffCode) VALUES (?, ?, ?, ?, '')";
$stmt= $pdo->prepare($sql);
$stmt->execute([$new_id, $topic, $content, $today]);

if ($stmt->rowCount() > 0) {
  $response = array('success' => true);
} else {
  $response = array('success' => false);
}

// Return a JSON response to the browser
header('Content-Type: application/json');
echo json_encode($response);

exit();
?>
