<!DOCTYPE html>
<html>
<head>
    <title>Useful Websites</title>
    <style>
        h1 {
            text-align: center;
            color: #333;
        }

        h2 {
            margin-bottom: 10px;
            color: #666;
        }

        .websites-container {
            display: flex;
            justify-content: center;
        }

        .website-link {
            margin: 10px;
            text-align: center;
            text-decoration: none;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .website-link:hover {
            color: #FF0000;
        }

        .website-link img {
            width: 200px;
            height: 200px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <h1>Useful Websites</h1>

    <div class="websites-container">
        <?php
        $websites = array(
            array(
                'title' => 'Education Bureau',
                'url' => 'https://www.edb.gov.hk/en/index.html',
                'image' => 'https://www.edb.gov.hk/images/logo.svg'
            ),
            array(
                'title' => '每日一篇',
                'url' => 'http://www.prof-ho.com/reading/',
                'image' => 'https://s.yimg.com/ny/api/res/1.2/El35et09AN.xPBrhXsMIZw--/YXBwaWQ9aGlnaGxhbmRlcjt3PTcwNTtoPTIxMDtjZj13ZWJw/https://media.zenfs.com/en/homerun/feed_manager_auto_publish_494/2ef2c8c84819155f60eb74a903a3855d'
            ),
            array(
                'title' => 'Cambridge Dictionary',
                'url' => 'https://dictionary.cambridge.org/us/',
                'image' => 'https://dictionary.cambridge.org/us/external/images/og-image.png'
            )
        );

        foreach ($websites as $website) {
            echo '<a class="website-link" href="' . $website['url'] . '" target="_blank">';
            echo '<img src="' . $website['image'] . '" alt="' . $website['title'] . '">';
            echo '<h2>' . $website['title'] . '</h2>';
            echo '</a>';
        }
        ?>
    </div>

</body>
</html>
