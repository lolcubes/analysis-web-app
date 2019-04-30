<!DOCTYPE html>
<html>
    <head>
        <title>Beats in Bytes | Analysis Tools</title>

        <link rel="stylesheet" type="text/css" href="style-main.css" />
        <link rel="stylesheet" type="text/css" href="analysis-dashboard.css" />
        <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="image-assets/favicon.png"/>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>


        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/series-label.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>


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
            <ul >
            <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                <a href="index.php"><img id="headerbanner" src="image-assets/headerbanner.png" alt="Header logo" height="50px" width="260" align="middle"></a>
                <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                <li ><a >Home</a></li>
                <li ><a >About</a></li>
                <li ><a >Code</a></li>
                <li ><a >Our Research</a></li>
                <li ><a >Database</a></li>
                <li ><a >Analysis Tools</a></li>
            </ul>
        </div>
        <div></div>

        <style>
            .home{
                background-color: rgb(153, 153, 153);
                box-shadow: 1px 4px 28px  rgb(0, 0, 0);
                color: black;
                outline: 0;
            }
        </style>
        <div id="dashboard-header">
        <br>
        <br>
        <br>
        <center>

                <h1>Analysis Dashboard</h1> 

        </center>
        <br>
        
        <script>
            function showDiv(classVar) { 
                var x = document.getElementsByClassName("analysis-content");

                var i;
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }

                var y = document.getElementById(classVar);
                y.style.display = "inline-block";
            }
        </script>

        <br>
        </div>
        <br>
        <?php
            $filesrecieved = $_POST['userfilelocations'];
            $explodedfiledirs = explode(",", $filesrecieved);

            foreach ($explodedfiledirs as $value) {
                $song = $value . "/song.txt";
                $datadir = $value . "/data";
                mkdir($datadir);

                $filename = str_replace("Song_Database/", "", $value);
                $removedFileName = strstr($filename, '_');
                $completeFileName = str_replace("_", " ", substr($removedFileName, 1));

                // $explodedname = explode("_", $filename);
                // print_r($explodedname);

                echo "<div class=analysis-panel><div class=panelheader><h1>" . $completeFileName . "</h1></div>";

                echo "<div id='largeitem'>";

                echo "<div id=shelf>";
                echo "<div id=shelf-item class=general onclick=\"showDiv(this.className)\"><span>General</span></div>";

                // EXECUTES SCRIPT, CREATES SHELF (SIDENAV) //
                //=========================================
                foreach($_POST['data-choose'] as $selected){
                    $analysisname = substr($selected, 0, strpos($selected, "."));
                    $directory = $value . "/data/" . "$analysisname";
                    mkdir($directory);
                    $scriptdirec = "analysis-scripts/bib-scripts/original/" . $selected;

                    shell_exec("$scriptdirec $song");
                    echo "<div id=shelf-item class=" . $analysisname . "_" . $filename . " onclick=\"showDiv(this.className);\"><span>" . $analysisname . "</span></div>";                    

                    // echo "<button class=" . $analysisname . " onclick='showDiv(this.className)'</button>";
                    // selected is the script, song is the file
                    //within bash, we can derive the output directory based on the current bash script being run, and the song.txt argument, so no need for an output arg here
                    
                }
                echo "</div>";
                echo "</div>";


                //=======================================


                // CREATES CONTENT FOR EACH ANALYSIS TYPE//
                echo "<div id=largeitem>";
                foreach($_POST['data-choose'] as $selected){
                        $analysisname = substr($selected, 0, strpos($selected, "."));
                        
                        // ECHOES CONTENT OF EACH ANALYSIS TYPE!!!!                        
                        // change it based on type!!
                        //=============================
                        if ($analysisname == "total-time") {
                        echo "<div id=" . $analysisname . "_" . $filename . " class=analysis-content><span>" . $analysisname . "</span><span>oof</span></div>";
                        
                        }
                        if ($analysisname == "key-signature") {
                            echo "<div id=" . $analysisname . "_" . $filename . " class=analysis-content><span>" . $analysisname . "</span><span>KEYOBOI</span></div>";
                            
                        }
                        
                        // if the analysis name is such and such, echo a different thing
                    }
                    
                echo "<div id=general class=analysis-content><span>General</span></div>";
                echo "</div>";

                echo "</div>";
                echo "</div>";

            }
            

            $chosentypes = $_POST['data-choose'];

            // for each of the files, echo some divs with data
            foreach ($explodedfiledirs as $value) {

                $keyscapelocation = $value . "/image-assets/keyscape.png";
                // $appendtext = "<img src=\"" . $keyscapelocation . "\" height=90px>";
                // echo $appendtext;

                // $prollLocation = $value . "/image-assets/proll.png";
                // $appendtext2 = "<img src=\"" . $prollLocation . "\" height=90px>";
                // echo $appendtext2;

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

                    // echo "<div class=panels>";
                    // echo "<p>" . $value . "</p>";
                    foreach ($currentKeySigFile as $readKeySig){
                        $fullKeySigPath = $keySigDir . "/" . $readKeySig;
                        // echo file_get_contents($fullKeySigPath);
                        // echo "<br>";
                    }



                }
                // ======================================




                // SCALES
                // ======================================

                if (in_array("scales.sh", $chosentypes)) {    // if key signature is in the array, echo key sig data
                    $scalesDir = $datafolder . "/scales";

                    $ascSingleDir = $scalesDir . "/ascending-single";
                    $ascDoubleDir = $scalesDir . "/ascending-double";
                    $descSingleDir = $scalesDir . "/descending-single";
                    $descDoubleDir = $scalesDir . "/descending-double";

                    $ascSingle1 = file_get_contents("$ascSingleDir" . "/2.txt");
                    $ascSingle2 = file_get_contents("$ascSingleDir" . "/3.txt");
                    $ascSingle3 = file_get_contents("$ascSingleDir" . "/4.txt");
                    $ascSingle4 = file_get_contents("$ascSingleDir" . "/5.txt");
                    $ascSingle5 = file_get_contents("$ascSingleDir" . "/6.txt");
                    
                    $ascDouble1 = file_get_contents("$ascDoubleDir" . "/2.txt");
                    $ascDouble2 = file_get_contents("$ascDoubleDir" . "/3.txt");
                    $ascDouble3 = file_get_contents("$ascDoubleDir" . "/4.txt");
                    $ascDouble4 = file_get_contents("$ascDoubleDir" . "/5.txt");
                    $ascDouble5 = file_get_contents("$ascDoubleDir" . "/6.txt");
                    
                    $descSingle1 = file_get_contents("$descSingleDir" . "/2.txt");
                    $descSingle2 = file_get_contents("$descSingleDir" . "/3.txt");
                    $descSingle3 = file_get_contents("$descSingleDir" . "/4.txt");
                    $descSingle4 = file_get_contents("$descSingleDir" . "/5.txt");
                    $descSingle5 = file_get_contents("$descSingleDir" . "/6.txt");
                    
                    $descDouble1 = file_get_contents("$descDoubleDir" . "/2.txt");
                    $descDouble2 = file_get_contents("$descDoubleDir" . "/3.txt");
                    $descDouble3 = file_get_contents("$descDoubleDir" . "/4.txt");
                    $descDouble4 = file_get_contents("$descDoubleDir" . "/5.txt");
                    $descDouble5 = file_get_contents("$descDoubleDir" . "/6.txt");
 
                    // $insertmehere = preg_replace(" ", "", $insertmehere);

                    $ascSingleArray = "[" . $ascSingle1 . ", " . $ascSingle2 . ", " . $ascSingle3 . ", " . $ascSingle4 . ", " . $ascSingle5 . "]";
                    $ascDoubleArray = "[" . $ascDouble1 . ", " . $ascDouble2 . ", " . $ascDouble3 . ", " . $ascDouble4 . ", " . $ascDouble5 . "]";
                    $descSingleArray = "[" . $descSingle1 . ", " . $descSingle2 . ", " . $descSingle3 . ", " . $descSingle4 . ", " . $descSingle5 . "]";
                    $descDoubleArray = "[" . $descDouble1 . ", " . $descDouble2 . ", " . $descDouble3 . ", " . $descDouble4 . ", " . $descDouble5 . "]";

                }
                // ======================================


                    
            }


        ?>
<br>
<br>

    </body>
</html>
