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
        foreach($_POST['data-choose'] as $selected){
            $analysisname = substr($selected, 0, strpos($selected, "."));
            $directory = $value . "/data/" . "$analysisname";
            mkdir($directory);
            $scriptdirec = "analysis-scripts/bib-scripts/original/" . $selected;

            shell_exec("$scriptdirec $song");


            // selected is the script, song is the file
            //within bash, we can derive the output directory based on the current bash script being run, and the song.txt argument, so no need for an output arg here
            
        }

    }
    foreach ($explodedfiledirs as $value) {
        $datafolder = $value . "/data";
        $keySigPath = $datafolder . "/key-signature/key-signature.txt";
        $keysig = file_get_contents($keySigPath);
        echo '<div class="panels"><p>' . $value . '</p><br><p>' . $keysig . '</p></div>';
    }


?>
</body>
</html>