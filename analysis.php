<!DOCTYPE html>
<html>
    <head>
        <title>Beats in Bytes | Analysis Tools</title>

        <link rel="stylesheet" type="text/css" href="style-main.css" />
        <link rel="stylesheet" type="text/css" href="analysis-dashboard.css" />
        <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="image-assets/favicon.png"/>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>

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
            function showDiv(classVar, contentId) { 
                var x = document.getElementsByClassName(contentId);
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
            function deleteDir($path) {
                if (empty($path)) { 
                    return false;
                }
                return is_file($path) ?
                        @unlink($path) :
                        array_map(__FUNCTION__, glob($path.'/*')) == @rmdir($path);
            }
            $filesrecieved = $_POST['userfilelocations'];
            $explodedfiledirs = explode(",", $filesrecieved);

            foreach ($explodedfiledirs as $value) {
                $song = $value . "/song.txt";
                $datadir = $value . "/data";


                deleteDir($datadir);
                    

                mkdir($datadir);

                $filename = str_replace("Song_Database/", "", $value);
                $removedFileName = strstr($filename, '_');
                $completeFileName = str_replace("_", " ", substr($removedFileName, 1));

                $containernames = "analysis-container_" . $filename;

                // $explodedname = explode("_", $filename);
                // print_r($explodedname);

                echo "<div class=analysis-panel><div class=panelheader><h1>" . $completeFileName . "</h1></div>";

                echo "<div id='largeitem'>";

                echo "
                <div id=shelf>";
                echo "
                    <div id=shelf-item class=general" . "_" . $filename .  " onclick=\"showDiv(this.className, '" . $containernames . "')\">
                        <span>
                            General
                        </span>
                    </div>";

                // EXECUTES SCRIPT, CREATES SHELF (SIDENAV) //
                //=========================================
                foreach($_POST['data-choose'] as $selected){
                    $analysisname = substr($selected, 0, strpos($selected, "."));
                    $directory = $value . "/data/" . "$analysisname";
                    mkdir($directory);
                    $scriptdirec = "analysis-scripts/bib-scripts/original/" . $selected;

                    $output = shell_exec("$scriptdirec $song");
                    echo "
                    <div id=shelf-item class=" . $analysisname . "_" . $filename . " onclick=\"showDiv(this.className, '" . $containernames . "');\">
                        <span>"
                        . $analysisname . "
                        </span>
                    </div>";                    

                    // echo "<button class=" . $analysisname . " onclick='showDiv(this.className)'</button>";
                    // selected is the script, song is the file
                    //within bash, we can derive the output directory based on the current bash script being run, and the song.txt argument, so no need for an output arg here
                    
                }
                echo "
                    </div>";
                echo "
                </div>";


                //=======================================


                // CREATES CONTENT FOR EACH ANALYSIS TYPE//
                echo "
                <div id=largeitem>";
                foreach($_POST['data-choose'] as $selected){
                        $analysisname = substr($selected, 0, strpos($selected, "."));
                        
                        // ECHOES CONTENT OF EACH ANALYSIS TYPE!!!!                        
                        // change it based on type!!
                        //=============================
                        if ($analysisname == "total-time") {
                            $timepath = $value . "/data/total-time/time.txt";
                            $timecontent = file_get_contents($timepath);
                            echo "
                            <div class=analysis-container_" . $filename . " id=" . $analysisname . "_" . $filename . "  style=\"display: none;\">
                                <div class=analysis-content>
                                    <span>" . 
                                        $timecontent
                                    ."
                                    </span>
                                </div>
                            </div>";
                        
                        }
                        if ($analysisname == "key-signature") {
                            $datafolder = $value . "/data";
                            $keySigDir = $datafolder . "/key-signature";

                            $currentKeySigFile = array();
        
                            foreach (new DirectoryIterator($keySigDir) as $fileInfo) {
                                if($fileInfo->isDot()) continue;
                                $currentKeySigFile[] = $fileInfo->getFilename();
                                
                            }
        
                            $keySigsRead = array();

                            foreach ($currentKeySigFile as $readKeySig){
                                $fullKeySigPath = $keySigDir . "/" . $readKeySig;
                                $keySigsReadNotArray = file_get_contents($fullKeySigPath);
                                $keySigsRead[] = trim(preg_replace('/\s\s+/', '', $keySigsReadNotArray));
                            }
                            $keySigValuesDir = $keySigDir . "/occurrences-values.txt";
                            $keySigValues = file_get_contents($keySigValuesDir);
                            $keySigValuesExploded = explode(",", $keySigValues);
                            $keySigValuesEncoded = json_encode($keySigValuesExploded);

                            $keySigPercentsDir = $keySigDir . "/occurrences-percents.txt";
                            $keySigPercents = file_get_contents($keySigPercentsDir);
                            $keySigPercentsExploded = explode(",", $keySigPercents);
                            $keySigPercentsEncoded = json_encode($keySigPercentsExploded);

                            echo "
                            <div class=analysis-container_" . $filename . " id=" . $analysisname . "_" . $filename . "  style=\"display: none;\">
                                <div class=analysis-content>
                                    <span>
                                        Key Signatures:
                                    </span>

                                    <div class='chart-container' style='position: relative; height:20vh; width:24vw'>
                                        <canvas class=graph id=" . $filename . "_keysig_graph>
                                        </canvas>
                                    </div>
                                    " 
                                     . 
                                    "
                                    <script>                                  
                                    let myChart_" . $filename . " = document.getElementById('" . $filename . "_keysig_graph').getContext('2d');
                                    var keySigVals = JSON.parse('" . $keySigValuesEncoded . "');
                                    var keySigPercents = JSON.parse('" . $keySigPercentsEncoded . "');

                                    Chart.defaults.global.defaultFontFamily = 'Nanum Gothic';
                                    Chart.defaults.global.defaultFontSize = 18;
                                    Chart.defaults.global.defaultFontColor = '#777';

                                    let chart_" . $filename . " = new Chart(myChart_" . $filename . ", {
                                    type:'pie', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                                    data:{
                                        labels:JSON.parse('" . $keySigValuesEncoded . "'),
                                        datasets:[{
                                        label:'Population',
                                        data:JSON.parse('" . $keySigPercentsEncoded . "'),

                                        backgroundColor:[
                                            'rgba(255, 99, 132, 0.6)',
                                            'rgba(54, 162, 235, 0.6)',
                                            'rgba(255, 206, 86, 0.6)',
                                            'rgba(75, 192, 192, 0.6)',
                                            'rgba(153, 102, 255, 0.6)',
                                            'rgba(255, 159, 64, 0.6)',
                                            'rgba(255, 99, 132, 0.6)'
                                        ],

                                        borderWidth:1,
                                        borderColor:'#777',
                                        hoverBorderWidth:3,
                                        hoverBorderColor:'#000'
                                        }]
                                    },
                                    options:{
                                        legend:{
                                        display:true,
                                        position:'right',
                                        labels:{
                                            fontColor:'#fff'
                                        }
                                        },
                                        layout:{
                                        padding:{
                                            left:10,
                                            right:10,
                                            bottom:28,
                                            top:10
                                        }
                                        },
                                        tooltips:{
                                        enabled:true
                                        }
                                    }
                                    });
                                    </script>
                                    <br>
                                </div>
                             </div>";
                            
                        }

                        // ========================
                        //  SCALES
                        //=======================\
                        if ($analysisname == "scales") {
                            $scalesDir = $value . "/data/scales";

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
                        
                            echo "
                            <div class=analysis-container_" . $filename . " id=" . $analysisname . "_" . $filename . "  style=\"display: none;\">
                                <div class=analysis-content>
                                    <span>
                                        Scales
                                    </span>
                                    <br>
                                    <span>";
                                    echo $ascSingleArray;
                                    echo "
                                    </span>
                                </div>
                             </div>";
                        
                        }
                    }

                            echo "
                            <div class=analysis-container_" . $filename . " id=general" . "_" . $filename .  ">
                                <div class=analysis-content>
                                    <span>
                                        General
                                    </span>
                                </div>
                            </div>";

                echo "
                </div>";
                echo "
                </div>";

            }
                    

        ?>
        
        <br>
        <br>
        <script>
            
            $(window).bind('beforeunload', function(){
                return 'Your changes will not be saved! Continue?';
            });
        </script>
    </body>
</html>
