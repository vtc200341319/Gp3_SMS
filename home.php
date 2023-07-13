<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>

            .box {
                padding: 1px;
                height: 500px;
            }

            .box p{
                font-size: 20px;
            }

            .websites-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: flex-start;
                overflow-x: auto;
            }

            .website-link {
                margin: 15px;
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
                width: 75px;
                height: 75px;
                border-radius: 10px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
                margin-bottom: 10px;
            }
            
            .box h2 {
                font-size: 24px;
                color: #333;
                margin-bottom: 10px;
            }

        </style>
    </head>

    <body>
        <div class="inner-div">
            <div class="box">
                <h2>Shortcut:</h2>
                <div class="websites-container">
                    <?php
                    $websites = array(
                        array(
                            'title' => 'School Album',
                            'url' => 'page/campus/album.php',
                            'image' => 'img/icon/album.png'
                        ),
                        array(
                            'title' => 'My Schedule',
                            'url' => 'page/campus/calendar/myschedule.php',
                            'image' => 'img/icon/timetable.png'
                        ),
                        array(
                            'title' => 'Chatroom',
                            'url' => 'chatroom.php',
                            'image' => 'img/icon/chat.png'
                        ),
                        array(
                            'title' => 'VDO Meeting',
                            'url' => 'web/index.html',
                            'image' => 'img/icon/meeting.png'
                        )
                        
                    );

                    foreach ($websites as $website) {
                        echo '<a class="website-link" href="' . $website['url'] . '">';
                        echo '<img src="' . $website['image'] . '" alt="' . $website['title'] . '">';
                        echo $website['title'];
                        echo '</a>';
                    }
                    ?>
                </div>
            </div>
    </body>
</html>
