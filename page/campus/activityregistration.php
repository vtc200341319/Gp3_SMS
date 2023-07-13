<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $name = $_POST['name'];    
    $activity = $_POST['activity'];

    if (empty($activity)) {
        $_SESSION['error'] = 'Please fill in all required fields.';
    } 
        
                
        $_SESSION['success'] = 'Thank you for registering!';
                
        
        header('Location: arsuccess.php');
        exit;
    }


?>
<!DOCTYPE html>
<html>
<head>
    <title>Activity Registration</title>
    <link href="../../css/activityregistration.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="error"><?php echo $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form method="post">
        <label for="name">Student no.</label>
        <p> <?php echo $_SESSION['loginID']?></p>

       

        <label for="activity">Activity:</label>
        <select name="activity" required>
            <option value="">Select activity</option>
            <option value="hiking">Hiking</option>
            <option value="swimming">Swimming</option>
            <option value="yoga">Yoga</option>
        </select>

        <button type="submit">Register</button>
    </form>
        <script src="../../js/activityregistration.js" type="text/javascript"></script>
</body>
</html>
