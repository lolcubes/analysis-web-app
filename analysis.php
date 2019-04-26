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
            echo $selected;
            $analysisname = substr($selected, 0, strpos($selected, "."));
            $directory = $value . "/data/" . "$analysisname";
            mkdir($directory);

            $scriptdirec = "analysis-scripts/bib-scripts/original/" . $selected;

            shell_exec("$scriptdirec $song");
            echo $output;
            echo "<br>";

            // selected is the script, song is the file
            //within bash, we can derive the output directory based on the current bash script being run, and the song.txt argument, so no need for an output arg here
            
        }
        echo "----------------------------";
        echo "<br>";
        echo "<br>";

        echo "<br>";

    }

?>