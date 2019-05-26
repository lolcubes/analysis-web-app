<!DOCTYPE html>
<html>
    <head>
        <title>Comparison Analytics | Beats in Bytes</title>

        <!-- FOR STYLESHEETS -->
        <!-- ===========================-->
        <link rel="stylesheet" type="text/css" href="style-main.css" />
        <link rel="stylesheet" type="text/css" href="formula-dashboard.css" />

        <!-- FOR FONTS -->
        <!-- ===========================-->
        <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Kelly+Slab|Open+Sans" rel="stylesheet">   

        <!-- FOR FAVICON -->
        <!-- ===========================-->
        <link rel="shortcut icon" type="image/png" href="image-assets/favicon.png"/>

        <!-- FOR AJAX -->
        <!-- ===========================-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

        <!-- FOR CHART.JS -->
        <!-- ===========================-->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
     
        <!-- FOR JQUERY -->
        <!-- ===========================--> 
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <!-- FOR APEXCHARTS ------------->
        <!-- ===========================--> 
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
        <style>
            @font-face {
                font-family: 'Avenir Light'; /*a name to be used later*/
                src: url('fonts/avenir/avenir-light.otf'); /*URL to font*/
            }

        </style>
    
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
        <div></div>

        <style>
            .home{
                background-color: rgb(153, 153, 153);
                box-shadow: 1px 4px 28px  rgb(0, 0, 0);
                color: black;
                outline: 0;
            }
        </style>


        <?php
            $files = $_POST['filesarray'];
            $exploded = explode(",", $files);
            echo "<pre>";
            echo "</pre>";

            foreach ($exploded as $value) {
                $filename = str_replace("Song_Database/", "", $value);
                $removedFileName = strstr($filename, '_');
                $completeFileName = str_replace("_", " ", substr($removedFileName, 1));

                
                // TO CREATE THE NECESSARY DIRS
                //===============================
                $formuladir = $value . "/comparison-outputs";
                mkdir($formuladir);

                $generalDir = $formuladir . "/averages";
                mkdir($generalDir);


                //TO EXECUTE THE SCRIPT
                //=======================
                $files = scandir('Song_Database_Averages/composers/');
                foreach ($files as $file) {
                    if (!file_exists($file)) {
                        $data = 'Song_Database_Averages/composers/' . $file . "/data.txt";
                        $arg1 = $value . "/data/amalgamated.txt";
                        // shell_exec("./formula.sh $arg1 $data");
                    }
                }
                

                //TO GET THE ARRAYS
                //=======================
                $outputdir = $value . "/comparison-outputs/averages";

                $composerNames = array();
                $comparisonValues = array();

                $files = scandir($outputdir);
                foreach ($files as $file) {
                    $dirCur = $outputdir . "/" . $file;
                    if (is_file($dirCur)) {
                        $composerNames[] = substr($file, 0, -4);
                        $comparisonValues[] = file_get_contents($dirCur);
                    }
                }
                echo "<pre>";

                $combined = array_combine($composerNames,$comparisonValues);
                $max = max($combined);
                $max = $max * 100;
                echo "</pre>";

                echo "
                <div class=composer-panel>
                <p>$completeFileName</p>
                    <p>This song is most correlated with " . array_search(max($combined),$combined) . " with a correlation value of " . $max . " percent
                </div>";
            }
            echo "<div class=big-panel>
            </div>"
        ?>

    </body>
</html>