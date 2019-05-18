<?php
    $files = scandir('Song_Database/');
    foreach($files as $file) {
        $filetypes = 'Song_Database/' . $file . "/dataTypes.txt";
        $composer = 'Song_Database/' . $file . "/time-info/composer.txt";
        $period = 'Song_Database/' . $file . "/time-info/period.txt";

        // echo $filetypes;
        // echo nl2br(file_get_contents($filetypes));

        echo file_get_contents($composer);
        echo file_get_contents($period);

        echo "<br>";
        
    }
?>