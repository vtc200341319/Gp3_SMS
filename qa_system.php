<!DOCTYPE html>
<html>
<head>
    <title>Interactive Q&A</title>
    <link href="css/qa_system.css" rel="stylesheet" type="text/css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#question').on('input', function() {
                var input = $(this).val();

                if (input.length >= 1) {
                    $.ajax({
                        url: 'suggestions.php',
                        method: 'POST',
                        data: {input: input},
                        success: function(response) {
                            $('#suggestions').html(response);
                        }
                    });
                } else {
                    $('#suggestions').empty();
                }
            });

            $(document).on('click', '.suggestion', function() {
                var selectedQuestion = $(this).text();
                $('#question').val(selectedQuestion);
                $('#suggestions').empty();
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Interactive Q&A</h1>

        <form method="post" action="">
            <label for="question">Please enter a question:</label>
            <input type="text" name="question" id="question" required>
            <input type="submit" value="Submit">
        </form>

        <div id="suggestions"></div>

        <?php
        require_once 'connectdb.php';

        if(isset($_POST['question'])){
            $question = $_POST['question'];

            $query = "SELECT qa_answers.answer 
                      FROM qa_questions 
                      INNER JOIN qa_answers 
                      ON qa_questions.id = qa_answers.question_id 
                      WHERE qa_questions.question = :question";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':question', $question);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if($result){
                echo "<div class='answer'><strong>Answer：</strong>" . $result['answer'] . "</div>";
            } else {
                echo "<p class='not-found'>No corresponding answer could be found.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
