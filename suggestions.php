<?php
require_once 'connectdb.php';

if(isset($_POST['input'])){
    $input = $_POST['input'];

    $query = "SELECT question FROM qa_questions WHERE question LIKE :input";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':input', '%' . $input . '%');
    $stmt->execute();

    $suggestions = '';
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $question = $row['question'];
        $suggestions .= "<div class='suggestion'>$question</div>";
    }
    echo $suggestions;
}
?>
