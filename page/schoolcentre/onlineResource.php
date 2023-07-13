<!DOCTYPE html>
<html>
<head>
    <title>Online Resource</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f7f7f7;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-top: 50px;
            font-size: 36px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .resource-link {
            margin-bottom: 10px;
            background-color: #fff;
            border-radius: 4px;
            padding: 10px;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .resource-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .resource-link a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Online Resource</h1>

    <?php

    $resources = array(
        array(
            'title' => '香港教育城 — 小學數學科園地',
            'url' => 'https://resources.hkedcity.net/'
        ),
        array(
            'title' => 'School Science',
            'url' => 'https://www.schoolscience.co.uk/home'
        ),
        array(
            'title' => '香港電台 - 中華五千年',
            'url' => 'http://rthk9.rthk.hk/chiculture/fivethousandyears/index.htm'
        )
    );

    foreach ($resources as $resource) {
        echo '<div class="resource-link"><a href="' . $resource['url'] . '">' . $resource['title'] . '</a></div>';
    }
    ?>

</body>
</html>
