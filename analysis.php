<!DOCTYPE html>
<html>
    <head>
        <title>Beats in Bytes | Analysis Tools</title>

        <link rel="stylesheet" type="text/css" href="style-main.css" />
        <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="image-assets/favicon.png"/>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

    </head>
    <body>

        <div id="navbarr">
            <ul id=navbar>
            <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>

                <a href="index.php"><img id="headerbanner" src="image-assets/headerbanner.png" alt="Header logo" height="50px" width="260" align="middle"></a>
                <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                <!-- <li id="Menu" class="logoimage"><img src="headerbanner.png" alt="Header logo" height="60px" width="313px"></img></li> -->
                <li id="Menu" class="home"><a href="index.php">Home</a></li>
                <li id="Menu"><a href="pages/about.html">About</a></li>
                <li id="Menu"><a href="pages/code.html">Code</a></li>
                <li id="Menu"><a href="pages/research.html">Our Research</a></li>
                <li id="Menu"><a href="pages/library.html">Database</a></li>
                <li id="Menu"><a href="pages/analysis-tools.html">Analysis Tools</a></li>
            </ul>
        </div>
        <div id="bumper">
        </div>

        <style>
            .home{
                background-color: rgb(153, 153, 153);
                box-shadow: 1px 4px 28px  rgb(0, 0, 0);
                outline: 0;
            }
        </style>
        <br>
        <br>
        <center>
        <h1>Analysis Dashboard</h1> 
        </center>
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

        $chosentypes = $_POST['data-choose'];

            // for each of the files, echo some divs with data
            foreach ($explodedfiledirs as $value) {

                $datafolder = $value . "/data";

                // KEY SIGNATURE 
                // ======================================
                if (in_array("key-signature.sh", $chosentypes)) {    // if key signature is in the array, echo key sig data
                    $keySigDir = $datafolder . "/key-signature";

                    $currentKeySigFile = array();

                    foreach (new DirectoryIterator($keySigDir) as $fileInfo) {
                        if($fileInfo->isDot()) continue;
                        $currentKeySigFile[] = $fileInfo->getFilename();
                    }

                    echo "<div class=panels>";
                    echo "<p>" . $value . "</p>";
                    foreach ($currentKeySigFile as $readKeySig){
                        $fullKeySigPath = $keySigDir . "/" . $readKeySig;
                        echo file_get_contents($fullKeySigPath);
                        echo "<br>";
                    }
                    echo "</div>";

                }
                // ======================================


                    
            }


        ?>
    </body>
</html>