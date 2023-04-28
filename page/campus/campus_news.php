<!DOCTYPE html>
<html>
    <head>
        <title>School News</title>
        <link href="../../css/campus_news.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <h1>Campus News</h1>

        <div id="news-container">
            <?php
            require_once 'connectdb.php';

            $items_per_page = 5;

            if (!isset($_GET['page'])) {
                $current_page = 1;
            } else {
                $current_page = intval($_GET['page']);
            }

            $offset = ($current_page - 1) * $items_per_page;

            $sql = "SELECT * FROM campus_news ORDER BY issueDate DESC LIMIT {$offset}, {$items_per_page}";
            $result = $pdo->query($sql);

            if ($result->rowCount() > 0) {
                while ($row = $result->fetch()) {
                    echo "<div class='news-item'>";
                    echo "<h2>{$row['topic']}</h2>";
                    echo "<p class='news-date'>{$row['issueDate']}</p>";
                    echo "<p>{$row['content']}</p>";
                    echo "<button class='delete-btn' onclick='confirmDelete(\"{$row['topic']}\", {$row['campusNewsID']})'>Delete</button>";
                    echo "</div>";
                }
            } else {
                echo "<p>No news items found.</p>";
            }

            $sql = "SELECT COUNT(*) FROM campus_news";
            $result = $pdo->query($sql);
            $row = $result->fetch();
            $total_items = intval($row[0]);

            $total_pages = ceil($total_items / $items_per_page);

            if ($total_pages > 1) {
                echo "<div id='page-links'>";
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $current_page) {
                        echo "<span>{$i}</span>";
                    } else {
                        echo "<a href='?page={$i}'>{$i}</a>";
                    }
                }
                echo "</div>";
            }
            ?>
        </div>

        <button id="add-news-btn">Add News</button>

        <div id="popup-box">
            <form method="POST" action="add_news.php">
                <button id="close-btn">X</button>
                <label for="news-topic-input">Enter your news topic:</label>
                <input type="text" id="news-topic-input" name="topic">
                <label for="news-content-input">Enter your news content:</label>
                <input type="text" id="news-content-input" name="content">
                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
        <script src="../../js/campus_news.js" type="text/javascript"></script>
    </body>
</html>
