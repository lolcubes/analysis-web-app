<?php
    $filesrecieved = $_POST['userfilelocations'];
    $explodedfiledirs = explode(",", $filesrecieved);

    foreach ($explodedfiledirs as $value) {
        $song = $value . "/song.txt";
        $datadir = $value . "/data";
        mkdir($datadir);

        echo $value;
        echo "<br>";
        echo "==============";
        echo "<br>";
        foreach($_POST['data-choose'] as $selected){
            $analysisname = substr($selected, 0, strpos($selected, "."));
            $directory = $value . "/data/" . "$analysisname";
            mkdir($directory);

            echo $variable;
            echo "$selected     $song" . "</br>";
            // selected is the script, song is the file
            
        }
        echo "----------------------------";
        echo "<br>";
    }

?>