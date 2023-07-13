<?php
require_once('exam_connectdb.php');

// Retrieve questions from the database
$sql = "SELECT * FROM `questions`";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process each submitted answer
    foreach ($_POST['answers'] as $questionId => $selectedOption) {
        // Validate and process the answer
        if (isset($questions[$questionId]) && validateAnswer($selectedOption)) {
            $question = $questions[$questionId];
            $studentAnswer = $selectedOption;
            
            // Store the student's answer in the database
            $sql = "INSERT INTO `student_answers` (`question_id`, `student_answer`) VALUES (:questionId, :studentAnswer)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':questionId', $questionId);
            $stmt->bindParam(':studentAnswer', $studentAnswer);
            $stmt->execute();
        }
    }
    
    // Redirect or display a success message
    // ...
}

// Function to validate the selected answer
function validateAnswer($selectedOption) {
    // Add your validation logic here
    // Return true if the answer is valid, otherwise return false
    return true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Interface - Answer Exam</title>
    <link href="../../css/answer_exam.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h2>Student Interface - Answer Exam</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php foreach ($questions as $question): ?>
            <div class="question">
                <h3><?php echo $question['question_text']; ?></h3>
                <?php foreach ($question['options'] as $index => $option): ?>
                    <div class="option">
                        <input type="radio" name="answers[<?php echo $question['question_id']; ?>]" value="<?php echo $index; ?>">
                        <label><?php echo $option['option_text']; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
