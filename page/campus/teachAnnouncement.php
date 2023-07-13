<!DOCTYPE html>
<html>
<head>
    <title>Teacher Announcement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        h2 {
            color: #555;
            margin-bottom: 10px;
        }

        p {
            color: #777;
            margin-bottom: 20px;
        }

        .announcement-date {
            font-size: 14px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Teacher Announcement</h1>

        <?php
        $announcements = array(
            array(
                'title' => 'School Event Notice',
                'content' => 'The school event will be held this Friday. All students are requested to prepare in advance.',
                'date' => 'July 1, 2023'
            ),
            array(
                'title' => 'Exam Schedule',
                'content' => 'The midterm math exam will take place next Monday. Students are expected to arrive on time.',
                'date' => 'June 28, 2023'
            ),
            array(
                'title' => 'Summer Vacation Extension Notice',
                'content' => 'Due to the current situation, the summer vacation will be extended by one week. Please adjust your travel plans accordingly.',
                'date' => 'July 3, 2023'
            ),
            array(
                'title' => 'Campus Closure Notice',
                'content' => 'There will be campus maintenance this Saturday, and the campus will be temporarily closed. Please refrain from entering the campus.',
                'date' => 'July 2, 2023'
            ),
            array(
                'title' => 'Course Change Notice',
                'content' => 'The English class tomorrow will be canceled. Students are advised to make necessary adjustments in advance.',
                'date' => 'July 4, 2023'
            ),
        );

        foreach ($announcements as $announcement) {
            echo '<h2>' . $announcement['title'] . '</h2>';
            echo '<p>' . $announcement['content'] . '</p>';
            echo '<p class="announcement-date">Posted on ' . $announcement['date'] . '</p>';
        }
        ?>
    </div>

</body>
</html>
