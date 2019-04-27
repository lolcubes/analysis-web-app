<!DOCTYPE html>
<html>
    <head>
        <title>Beats in Bytes | Analysis Tools</title>

        <link rel="stylesheet" type="text/css" href="style-main.css" />
        <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="image-assets/favicon.png"/>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
        <script src="https://verovio-script.humdrum.org/scripts/verovio-toolkit.js"></script>
        <script src="https://plugin.humdrum.org/scripts/humdrum-notation-plugin.js"></script>
        <script> var vrvToolkit = new verovio.toolkit(); </script>

    </head>
    <body>

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
            shell_exec("$scriptdirec $song");

            $scriptdirec = "analysis-scripts/bib-scripts/original/" . $selected;

            echo "<br>";

            // selected is the script, song is the file
            //within bash, we can derive the output directory based on the current bash script being run, and the song.txt argument, so no need for an output arg here
            
        }
        echo "----------------------------";
        echo "<br>";
        echo "<br>";

        echo "<br>";

    }
    foreach ($explodedfiledirs as $value) {
        $datafolder = $value . "/data";
        $keySigPath = $datafolder . "/key-signature/key-signature.txt";
        $keysig = file_get_contents($keySigPath);
        echo '<div class="panels"><p>' . $value . '</p><br><span>' . $keysig . '</span></div>';
    }


?>
</body>
</html>