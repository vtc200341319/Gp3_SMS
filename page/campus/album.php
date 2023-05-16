<!DOCTYPE html>
<html>
    <head>
        <title>Album</title>
        <link href="../../css/album.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        if (isset($_GET['album'])) {
            $album_path = '../../album/' . $_GET['album'];
            echo '<a href="?" class="back-button"><< Back</a>';
            echo '<h2>' . $_GET['album'] . '</h2>';

            if ($handle = opendir($album_path)) {
                echo '<table>';
                $i = 0;
                while (false !== ($file = readdir($handle))) {
                    if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), array('jpg', 'jpeg', 'png', 'gif'))) {                     
                        if ($i % 4 == 0) {
                            echo '<tr>';
                        }
                        echo '<td><img src="' . $album_path . '/' . $file . '" alt="' . $file . '" class="thumbnail" onclick="showPopup(this)" /></td>';
                        if ($i % 4 == 3) {
                            echo '</tr>';
                        }
                        $i++;
                    }
                }
               
                closedir($handle);
                echo '</table>';
            }
        }      
        else {
            $album_path = '../../album/';
            if ($handle = opendir($album_path)) {
                echo '<h1>Album</h1>';
                echo '<ul>';
                while (false !== ($album_dir = readdir($handle))) {
                    if ($album_dir == '.' || $album_dir == '..') {
                        continue;
                    }
                    echo '<li><a href="?album=' . $album_dir . '">' . $album_dir . '</a></li>';
                }
                echo '</ul>';
                closedir($handle);
            }
        }
        ?>       
        <div id="popup" >
            <span class="close" onclick="hidePopup()">&times;</span>
            <img id="popup-img" src="" />
            <div id="popup-buttons">
                <button id="popup-prev" onclick="showPrev()"><</button>
                <button id="popup-next" onclick="showNext()">></button>
            </div>
        </div>
    </body>
    <script src="../../js/album.js" type="text/javascript"></script>
</html>
