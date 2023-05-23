<!DOCTYPE html>
<html>
    <head>
        <title>Teacher Interface - Question Creation</title>
        <link href="css/creat_exam.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <h2>Teacher Interface - Question Creation</h2>
        <form method="post" action="process_question.php">
            <label for="grade">Grade:</label>
            <input type="text" name="grade" required>

            <label for="class">Class:</label>
            <input type="text" name="class" required>

            <label for="exam_date">Exam Date:</label>
            <input type="date" name="exam_date" required>
            <P>
                <label for="question_type">Question Type:</label>
                <select name="question_type" required>
                    <option value="mc">Multiple Choice</option>
                    <option value="sa">Short Answer</option>
                </select>       
            <P>
                <label for="question_text">Question:</label>
                <textarea name="question_text" required></textarea>
            <P>

                <label>Options:</label>
            <div id="options-container">
                <div class="option">
                    <input type="text" name="option_text[]" required>
                    <input type="checkbox" name="is_correct[]" value="1"> Correct 
                     <button type="button" onclick="removeOption(this.parentNode)">Remove</button>
                </div>

               
            </div>
        </div>
        <button type="button" onclick="addOption()">Add Option</button>

        <input type="submit" value="Create Question">
    </form>

    <script src="js/creat_exam.js"></script>
</body>
</html>
