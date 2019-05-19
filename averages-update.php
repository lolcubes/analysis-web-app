<?php
    $files = scandir('Song_Database/');
    $composers = array();
    foreach($files as $file) {
        
        $filetypes = 'Song_Database/' . $file . "/dataTypes.txt";
        $composer = 'Song_Database/' . $file . "/time-info/composer.txt";
        $period = 'Song_Database/' . $file . "/time-info/period.txt";

        // echo $filetypes;
        // echo nl2br(file_get_contents($filetypes));

        $composer = file_get_contents($composer);
        $composerfile = "Song_Database_Averages/composers/" . $composer;

        if (file_exists($composerfile)) {
            echo "exists";
            echo 'test';
        }
        else {
            mkdir("Song_Database_Averages/composers/" . $composer);
        }

        echo "<br>";
        $composers[] = $composer;

    }

    print_r($composers);

?>