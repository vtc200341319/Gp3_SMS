<?php

require_once('exam_connectdb.php');

$grade = $_POST['grade'];
$class = $_POST['class'];
$examDate = $_POST['exam_date'];
$questionType = $_POST['question_type'];
$questionText = $_POST['question_text'];
$options = $_POST['option_text'];
$isCorrect = isset($_POST['is_correct']) ? $_POST['is_correct'] : [];

// 创建准备语句
$sql = "INSERT INTO questions (grade, class, exam_date, question_type, question_text) 
        VALUES (:grade, :class, :examDate, :questionType, :questionText)";
$stmt = $pdo->prepare($sql);

// 绑定参数
$stmt->bindParam(':grade', $grade);
$stmt->bindParam(':class', $class);
$stmt->bindParam(':examDate', $examDate);
$stmt->bindParam(':questionType', $questionType);
$stmt->bindParam(':questionText', $questionText);

if ($stmt->execute()) {
    $questionId = $pdo->lastInsertId();

    if (!empty($options)) {
        $optionValues = [];
        $optionSql = "INSERT INTO options (question_id, option_text, is_correct) 
                      VALUES (:questionId, :optionText, :isCorrect)";
        $optionStmt = $pdo->prepare($optionSql);

        $optionStmt->bindParam(':questionId', $questionId);
        $optionStmt->bindParam(':optionText', $optionText);
        $optionStmt->bindParam(':isCorrect', $isCorrectValue);

        foreach ($options as $index => $optionText) {
            $isCorrectValue = in_array($index, $isCorrect) ? 1 : 0;
            $optionStmt->execute();
        }
    }

    echo "Question created successfully";
} else {
    echo "Error creating question";
}
?>
