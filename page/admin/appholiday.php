<!DOCTYPE html>
<html>
<head>
    <link href="../../css/appholiday.css" rel="stylesheet" type="text/css"/>
    <title>Holiday Application</title>
</head>
<body>
    <h2>Holiday Application Form</h2>
    <form method="post" action="process_application.php">
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" value="<?php echo date('Y-m-d'); ?>" required>

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" required>        

        <label for="return_day">Return Day:</label>
        <input type="date" name="return_day" id="return_day" readonly>
        
        <label for="reason">Reason:</label>
        <textarea name="reason" required></textarea>

        <input type="submit" value="Submit">

        <script>
            var startDateInput = document.getElementById('start_date');
            var endDateInput = document.getElementById('end_date');
            var returnDayInput = document.getElementById('return_day');

            endDateInput.value = startDateInput.value;

            function calculateReturnDay() {
                var startDate = new Date(startDateInput.value);
                var endDate = new Date(endDateInput.value);
                var returnDay = new Date(endDate.getTime() + (24 * 60 * 60 * 1000)); 

                if (endDate.getDay() === 5) { 
                    returnDay.setDate(returnDay.getDate() + 3);
                }

                returnDayInput.value = returnDay.toISOString().slice(0, 10);
            }

            startDateInput.addEventListener('change', function() {
                endDateInput.min = this.value;
                if (new Date(endDateInput.value) < new Date(this.value)) {
                    endDateInput.value = this.value;
                    calculateReturnDay();
                }
            });

            endDateInput.addEventListener('change', function() {
                if (new Date(this.value) < new Date(startDateInput.value)) {
                    this.value = startDateInput.value;
                }
                calculateReturnDay();
            });

            calculateReturnDay();
        </script>
    </form>
</body>
</html>
