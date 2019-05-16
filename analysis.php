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
        
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Kelly+Slab|Open+Sans" rel="stylesheet">   
        <script src="css-element-queries/src/ResizeSensor.js"></script>
        <script src="css-element-queries/src/ElementQueries.js"></script>
    
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
                        // x[i].style.display = "none";
                        $(x[i]).addClass('visuallyhidden');


                        setTimeout(function () {
                        }, 5);
                        $(x[i]).addClass('hidden')

                    }


                    var shelfItem = document.getElementById(contentId).getElementsByClassName(classVar);
                    
                    var shelfActive = document.getElementById(contentId).getElementsByClassName("shelfActive");

                    var k;
                    for (k = 0; k < shelfActive.length; k++) {

                        $(shelfActive[k]).removeClass('shelfActive');
                    }


                    var j;
                    for (j = 0; j < shelfItem.length; j++) {
                        // x[i].style.display = "none";
                        $(shelfItem[j]).addClass('shelfActive');
                    }

                    var box = document.getElementById(classVar);
    
                    $(box).removeClass('hidden');
                    setTimeout(function () {
                        $(box).removeClass('visuallyhidden');
                    }, 5);

                // var y = document.getElementById(classVar);
                // y.style.display = "inline-block";
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
                echo "<div class=analysis-panel id=analysis-panel" . $filename . "><div class=panelheader><h1>" . $completeFileName . "</h1></div>";
                echo "<div id='largeitem' style=\"width: 22%;\">";

                echo "
                <div id=analysis-container" . "_" . $filename . " class=shelf>";
                echo "
                    <div id=shelf-item class='general" . "_" . $filename .  " shelfActive' onclick=\"showDiv(this.className, '" . $containernames . "')\">
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

                    $analysisnamecapitals = str_replace("-", " ", $analysisname);
                    $analysisnamecapitals = ucwords($analysisnamecapitals);

                    $scriptdirec = "analysis-scripts/bib-scripts/original/" . $selected;

                    $output = shell_exec("$scriptdirec $song");

                    if ($analysisname == 'scales'){
                        echo "
                        <div id=shelf-item class=" . $analysisname . "_" . $filename . " onclick=\"showDiv(this.className, '" . $containernames . "');showLegendScales()\">
                            <span>"
                            . $analysisnamecapitals . "
                            </span>
                        </div>";  
                        
                    }
                    else {
                        echo "
                        <div id=shelf-item class=" . $analysisname . "_" . $filename . " onclick=\"showDiv(this.className, '" . $containernames . "');\">
                            <span>"
                            . $analysisnamecapitals . "
                            </span>
                        </div>";  
                    }
                  

                    // echo "<button class=" . $analysisname . " onclick='showDiv(this.className)'</button>";
                    // selected is the script, song is the file
                    //within bash, we can derive the output directory based on the current bash script being run, and the song.txt argument, so no need for an output arg here
                    
                }

                $timedirectory = $value . "/data/total-time";
                mkdir($timedirectory);
                $timeoutput = shell_exec("analysis-scripts/bib-scripts/original/total-time.sh $song");

                shell_exec("cd $value && zip -r assets.zip .");


                echo "
                <div id=shelf-item class=keyscape" . "_" . $filename .  " onclick=\"showDiv(this.className, '" . $containernames . "')\">
                    <span>
                        Keyscape
                    </span>
                </div>";

                echo "
                <div id=shelf-item class=proll" . "_" . $filename .  " onclick=\"showDiv(this.className, '" . $containernames . "')\">
                    <span>
                        Piano Roll
                    </span>
                </div>";

                echo "
                    </div>";
                echo "
                </div>";


                //=======================================


                // CREATES CONTENT FOR EACH ANALYSIS TYPE//
                echo "
                <div id=largeitem style=\"width: 68%;\">";
                foreach($_POST['data-choose'] as $selected){
                        $analysisname = substr($selected, 0, strpos($selected, "."));
                        
                        // ECHOES CONTENT OF EACH ANALYSIS TYPE!!!!                        
                        // change it based on type!!
                        //=============================

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

                            $keySigsListDir = $keySigDir . "/occurrences.txt";
                            $keySigsList = file_get_contents($keySigsListDir);
                            $keySigsList = nl2br($keySigsList);

                            $linecount = -1;
                            $handle = fopen($keySigsListDir, "r");
                            while(!feof($handle)){
                            $line = fgets($handle);
                            $linecount++;
                            }
                            
                            fclose($handle);

                            echo "
                            <div class='analysis-container_" . $filename . " hidden visuallyhidden' id=" . $analysisname . "_" . $filename . " style=\" width: 100%; transition: all .4s ease;\">
                                <div class=testoto style='width:26%; display: inline-block;margin-right:10%;vertical-align:middle;'>
                                    <div class=analysis-content style='width:100%;max-height:150px;overflow:auto;display:block; '>
                                        <div class=keysiglist >
                                            " . $keySigsList
                                            . "
                                        </div>
                                    </div>

                                    <div class=analysis-content style='width:100%;overflow:auto;display:block;'>
                                        <div class=keysiglist  style='font-size:18px;'>
                                        " . $linecount
                                        . " Key Signatures
                                        </div>
                                    
                                    </div>

                                </div>


                                <div class=analysis-content style='width:53%'>
                                        <canvas class='chart-container' height=250px id=" . $filename . "_keysig_graph>
                                        </canvas>

                                    " 
                                     . 
                                    "
                                    <script>                                  
                                    let myChart_" . $filename . " = document.getElementById('" . $filename . "_keysig_graph').getContext('2d');
                                    var keySigVals = JSON.parse('" . $keySigValuesEncoded . "');
                                    var keySigPercents = JSON.parse('" . $keySigPercentsEncoded . "');

                                    Chart.defaults.global.defaultFontFamily = 'Avenir Light';
                                    Chart.defaults.global.defaultFontSize = 14;
                                    Chart.defaults.global.defaultFontColor = '#fff';

                                    let chart_" . $filename . " = new Chart(myChart_" . $filename . ", {
                                    type:'doughnut', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                                    data:{
                                        labels:JSON.parse('" . $keySigValuesEncoded . "'),
                                        datasets:[{
                                        label:'Key Signatures',
                                        data:JSON.parse('" . $keySigPercentsEncoded . "'),

                                        backgroundColor:[
                                            'rgba(255, 99, 132, 0.8)',
                                            'rgba(54, 162, 235, 0.8)',
                                            'rgba(255, 206, 86, 0.8)',
                                            'rgba(75, 192, 192, 0.8)',
                                            'rgba(153, 102, 255, 0.8)',
                                            'rgba(255, 159, 64, 0.8)',
                                            'rgba(255, 99, 132, 0.8)'
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
                                        position:'top',
                                        labels:{
                                            fontSize: 14,

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

                        // ==================
                        /// TIME SIGNATURE
                        //===================
                    
                        
                        if ($analysisname == "time-signature") {
                            $datafolder = $value . "/data";
                            $timeSigDir = $datafolder . "/time-signature";

                            $currentTimeSigFile = array();
        
                            foreach (new DirectoryIterator($timeSigDir) as $fileInfo) {
                                if($fileInfo->isDot()) continue;
                                $currentTimeSigFile[] = $fileInfo->getFilename();
                                
                            }
        
                            $timeSigsRead = array();

                            foreach ($currentTimeSigFile as $readTimeSig){
                                $fullKeySigPath = $timeSigDir . "/" . $readKeySig;
                                $timeSigsReadNotArray = file_get_contents($fullKeySigPath);
                                $timeSigsRead[] = trim(preg_replace('/\s\s+/', '', $timeSigsReadNotArray));
                            }
                            $timeSigValuesDir = $timeSigDir . "/occurrences-values.txt";
                            $timeSigValues = file_get_contents($timeSigValuesDir);
                            $timeSigValuesExploded = explode(",", $timeSigValues);
                            $timeSigValuesEncoded = json_encode($timeSigValuesExploded);

                            $timeSigPercentsDir = $timeSigDir . "/occurrences-percents.txt";
                            $timeSigPercents = file_get_contents($timeSigPercentsDir);
                            $timeSigPercentsExploded = explode(",", $timeSigPercents);
                            $timeSigPercentsEncoded = json_encode($timeSigPercentsExploded);

                            echo "
                            <div class='analysis-container_" . $filename . " hidden visuallyhidden' id=" . $analysisname . "_" . $filename . " style=\" width: 100%; transition: all .4s ease;\">
                                <div class=analysis-content>
                                    <div class='chart-container'>
                                        <canvas class=graph id=" . $filename . "_timesig_graph>
                                        </canvas>
                                    </div>
                                    " 
                                     . 
                                    "
                                    <script>                                  
                                    let myChart_timesig_" . $filename . " = document.getElementById('" . $filename . "_timesig_graph').getContext('2d');
                                    var timeSigVals = JSON.parse('" . $timeSigValuesEncoded . "');
                                    var timeSigPercents = JSON.parse('" . $timeSigPercentsEncoded . "');

                                    Chart.defaults.global.defaultFontFamily = 'Avenir Light';
                                    Chart.defaults.global.defaultFontSize = 14;
                                    Chart.defaults.global.defaultFontColor = '#fff';

                                    let chart_timesig_" . $filename . " = new Chart(myChart_timesig_" . $filename . ", {
                                    type:'doughnut', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                                    data:{
                                        labels:JSON.parse('" . $timeSigValuesEncoded . "'),
                                        datasets:[{
                                        label:'Key Signatures',
                                        data:JSON.parse('" . $timeSigPercentsEncoded . "'),

                                        backgroundColor:[
                                            'rgba(255, 99, 132, 0.9)',
                                            'rgba(54, 162, 235, 0.9)',
                                            'rgba(255, 206, 86, 0.9)',
                                            'rgba(75, 192, 192, 0.9)',
                                            'rgba(153, 102, 255, 0.9)',
                                            'rgba(255, 159, 64, 0.9)',
                                            'rgba(255, 99, 132, 0.9)'
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
                            
                            $ascSingleArray = array($ascSingle1,$ascSingle2,$ascSingle3,$ascSingle4,$ascSingle5);
                            $ascSingleArray = json_encode($ascSingleArray);
                            $ascSingleArray = str_replace('"', "", $ascSingleArray);

                            $ascDouble1 = file_get_contents("$ascDoubleDir" . "/2.txt");
                            $ascDouble2 = file_get_contents("$ascDoubleDir" . "/3.txt");
                            $ascDouble3 = file_get_contents("$ascDoubleDir" . "/4.txt");
                            $ascDouble4 = file_get_contents("$ascDoubleDir" . "/5.txt");
                            $ascDouble5 = file_get_contents("$ascDoubleDir" . "/6.txt");
                            
                            $ascDoubleArray = array($ascDouble1,$ascDouble2,$ascDouble3,$ascDouble4,$ascDouble5);
                            $ascDoubleArray = json_encode($ascDoubleArray);
                            $ascDoubleArray = str_replace('"', "", $ascDoubleArray);

                            $descSingle1 = file_get_contents("$descSingleDir" . "/2.txt");
                            $descSingle2 = file_get_contents("$descSingleDir" . "/3.txt");
                            $descSingle3 = file_get_contents("$descSingleDir" . "/4.txt");
                            $descSingle4 = file_get_contents("$descSingleDir" . "/5.txt");
                            $descSingle5 = file_get_contents("$descSingleDir" . "/6.txt");
                            
                            $descSingleArray = array($descSingle1,$descSingle2,$descSingle3,$descSingle4,$descSingle5);
                            $descSingleArray = json_encode($descSingleArray);
                            $descSingleArray = str_replace('"', "", $descSingleArray);

                            $descDouble1 = file_get_contents("$descDoubleDir" . "/2.txt");
                            $descDouble2 = file_get_contents("$descDoubleDir" . "/3.txt");
                            $descDouble3 = file_get_contents("$descDoubleDir" . "/4.txt");
                            $descDouble4 = file_get_contents("$descDoubleDir" . "/5.txt");
                            $descDouble5 = file_get_contents("$descDoubleDir" . "/6.txt");
            
                            $descDoubleArray = array($descDouble1,$descDouble2,$descDouble3,$descDouble4,$descDouble5);
                            $descDoubleArray = json_encode($descDoubleArray);
                            $descDoubleArray = str_replace('"', "", $descDoubleArray);

                            echo "

                            <script>

                            </script>

                            <div class='analysis-container_" . $filename . " hidden visuallyhidden' id=" . $analysisname . "_" . $filename . "  style=\" width: 100%; transition: all .4s ease;\">
                                <div class=analysis-content>
                                    <div class='chart-container' id='" . $filename . "_scales_graph_container'>
                                        <canvas class=graph id=" . $filename . "_scales_graph>
                                        </canvas>

                                    </div>

                                    <script>                                  
                                    let myChart_scales_" . $filename . " = document.getElementById('" . $filename . "_scales_graph').getContext('2d');

                                    Chart.defaults.global.defaultFontFamily = 'Avenir Light';
                                    Chart.defaults.global.defaultFontSize = 14;
                                    Chart.defaults.global.defaultFontColor = '#fff';

                                    let chart_scales_" . $filename . " = new Chart(myChart_scales_" . $filename . ", {
                                        type: 'line',
                                        data: {
                                            labels: ['2 Note','3 Note','4 Note','5 Note','6 Note'],
                                            datasets: [{ 
                                                    data: " . $ascSingleArray . ",
                                                    label: 'Ascending Single',
                                                    fill: true,
                                                    borderColor: 'rgba(172, 25, 252, 0.8)',
                                                    backgroundColor: 'rgba(172, 25, 252, 0.1)',
                                                    lineTension: '0'
                                                }, { 
                                                    data: " . $ascDoubleArray . ",
                                                    label: 'Ascending Double',
                                                    fill: true,
                                                    borderColor: 'rgba(172, 25, 252, 0.8)',
                                                    backgroundColor: 'rgba(172, 25, 252, 0.1)',
                                                    lineTension: '0'

                                                }, { 
                                                    data: " . $descSingleArray . ",
                                                    label: 'Descending Single',
                                                    fill: true,
                                                    borderColor: 'rgba(172, 25, 252, 0.8)',
                                                    backgroundColor: 'rgba(172, 25, 252, 0.1)',
                                                    lineTension: '0'

                                                }, { 
                                                    data: " . $descDoubleArray . ",
                                                    label: 'Descending Double',
                                                    fill: true,
                                                    borderColor: 'rgba(172, 25, 252, 0.8)',
                                                    backgroundColor: 'rgba(172, 25, 252, 0.1)',
                                                    lineTension: '0'

                                                }
                                            ]
                                        },

                                    options:{
                                        legend:{
                                            display: true,
                                            position:'top',
                                            labels:{
                                                fontSize: 12,
                                                boxWidth: 28,
                                                boxWidth: 12,
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



                                    var resizeIdScales" . $filename  . ";
                                    $(window).resize(function() {
                                        clearTimeout(resizeIdScales" . $filename  . " );
                                        resizeIdScales" . $filename  . " = setTimeout(afterResizingScales" . $filename . ", 100);
                                    });

                                    var resizeIdScales" . $filename  . ";
                                    new ResizeSensor(jQuery('#analysis-panel" . $filename . "'), function(){ 
                                        clearTimeout(resizeIdScales" . $filename  . " );
                                        resizeIdScales" . $filename  . " = setTimeout(afterResizingScales" . $filename . ", 100);
                                    });

                                    var canvasheightScales". $filename . ";
                                    function afterResizingScales" . $filename . "(){
                                        var canvasheightScales" . $filename . " = document.getElementById('" . $filename . "_scales_graph').width;
                                        if(canvasheightScales" . $filename . " <=360) {
                                            chart_scales_" . $filename . ".options.legend.display=false;
                                            chart_scales_" . $filename . ".update();

                                        }
                                        else {
                                            chart_scales_" . $filename . ".options.legend.display=true;
                                            chart_scales_" . $filename . ".update();
                                        }
                                    }

                                    </script>
                                    <script>
                                        function showLegendScales() {
                                            var canvasheightScales" . $filename . " = document.getElementById('" . $filename . "_scales_graph_container').width;
                                            console.log(canvasheightScales" . $filename . ");
                                            if(canvasheightScales" . $filename . " <=360) {
                                                chart_scales_" . $filename . ".options.legend.display=false;
                                                chart_scales_" . $filename . ".update();
    
                                            }
                                            else {
                                                chart_scales_" . $filename . ".options.legend.display=true;
                                                chart_scales_" . $filename . ".update();
                                            }
                                        }

                                    </script>

                                </div>
                             </div>";
                        
                        }
                        if ($analysisname == "average-steps") {
                            $negPath = $value . "/data/average-steps/including-negatives.txt";
                            $absPath = $value . "/data/average-steps/absolute-value.txt";
                            $firstLastPath = $value . "/data/average-steps/first-last.txt";

                            $neg = file_get_contents($negPath);
                            $abs = file_get_contents($absPath);
                            $firstLast = file_get_contents($firstLastPath);

                            echo "
                            <div class='analysis-container_" . $filename . " hidden visuallyhidden' id=" . $analysisname . "_" . $filename . "  style=\" width: 100%; transition: all .4s ease;\">
                                <div class=analysis-content>
                                    <div class='chart-container'>
                                        <canvas class=graph id=" . $filename . "_steps_graph>
                                        </canvas>
                                    </div>
                                    <script>                                  
                                    let myChart_steps_" . $filename . " = document.getElementById('" . $filename . "_steps_graph').getContext('2d');

                                    Chart.defaults.global.defaultFontFamily = 'Avenir Light';
                                    Chart.defaults.global.defaultFontSize = 14;
                                    Chart.defaults.global.defaultFontColor = '#fff';

                                    let chart_steps_" . $filename . " = new Chart(myChart_steps_" . $filename . ", {
                                        type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                                        data: {
                                            datasets: [
                                              {
                                                label: 'With Negatives',
                                                data: [" . $neg . "],
                                                backgroundColor: 'rgba(255, 99, 132, 0.6)'

                                              },
                                              {
                                                label: 'Absolute Value',
                                                data: [" . $abs . "],
                                                backgroundColor: 'rgba(75, 192, 192, 0.6)'

                                              },
                                              {
                                                label: 'First-Last',
                                                data: [" . $firstLast . "],
                                                backgroundColor: 'rgba(255, 206, 86, 0.6)',
                                              }
                                            ]
                                          },

                                        options:{
                                            scales: {
                                                xAxes: [{
                                                    ticks: {
                                                        fontSize: 17
                                                    }
                                                }],
                                                yAxes: [{
                                                    ticks: {
                                                        fontSize: 17
                                                    }
                                                }]
                                            },
                                          legend:{
                                            display:true,
                                            position:'right',
                                            labels:{
                                              fontColor:'#fff'
                                            }
                                          },
                                          layout:{
                                            padding:{
                                              left:50,
                                              right:0,
                                              bottom:0,
                                              top:0
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
                        if ($analysisname == "average-pitch") {
                            $movingAverage = $value . "/data/average-pitch/pitch-moving-average.txt";
                            $averagePitch = $value . "/data/average-pitch/pitch.txt";

                            $averagePitch = file_get_contents($averagePitch);

                            $movingAverage = file_get_contents($movingAverage);
                            $movingAverage = explode(',', $movingAverage);
                            $movingAverageEncoded = json_encode($movingAverage);
                            echo "
                            <div class='analysis-container_" . $filename . " hidden visuallyhidden' id=" . $analysisname . "_" . $filename . "  style=\" width: 100%; transition: all .4s ease;\">
                                <div class=analysis-content>
                                    <div class='chart-container' >
                                        <canvas class=graph id=" . $filename . "_pitch_moving_graph>
                                        </canvas>

                                    </div>
                                    <script>                                  
                                    let myChart_pitch_moving_" . $filename . " = document.getElementById('" . $filename . "_pitch_moving_graph').getContext('2d');

                                    Chart.defaults.global.defaultFontFamily = 'Avenir Light';
                                    Chart.defaults.global.defaultFontSize = 14;
                                    Chart.defaults.global.defaultFontColor = '#fff';

                                        let chart_pitch_moving_" . $filename . " = new Chart(myChart_pitch_moving_" . $filename . ", {
                                            type: 'line',
                                            data: {
                                              labels:" . $movingAverageEncoded . ",
                                              datasets: [
                                                {
                                                  label: 'Moving Average',
                                                  data:" . $movingAverageEncoded . ",
                                                  backgroundColor:'rgb(255, 79, 125)',
                                                  hoverBackgroundColor:'rgba(214, 47, 82, 0.8)',
                                                  pointBackgroundColor:'rgba(0, 0, 0, 0.8)',
                                                  pointRadius: 0.1,
                                                  pointHoverRadius: 4
                                                }
                                                ]
                                            },
                                            options: {
                                              legend: { display: false },
                                              title: {
                                                display: true,
                                                text: 'Moving Average of Pitches'
                                              },
                                              scales: {
                                                xAxes: [{
                                                  gridLines: {
                                                    display: false
                                                  }
                                                }],
                                                yAxes: [{
                                                  gridLines: {
                                                    display: false
                                                  }
                                                }]
                                              }                                              
                                            }
                                        });
                                    </script>
                                    <br>
                                </div>
                             </div>";
                            
                        }


                        if ($analysisname == "average-note-value") {
                            $movingAverage = $value . "/data/average-note-value/moving-average.txt";
                            $averageValue = $value . "/data/average-note-value/value.txt";

                            $averageValue = file_get_contents($averageValue);

                            $movingAverage = file_get_contents($movingAverage);
                            $movingAverage = explode(',', $movingAverage);
                            $movingAverageEncoded = json_encode($movingAverage);
                            echo "
                            <div class='analysis-container_" . $filename . " hidden visuallyhidden' id=" . $analysisname . "_" . $filename . "  style=\" width: 100%; transition: all .4s ease;\">
                                <div class=analysis-content>
                                    <div class='chart-container' >
                                        <canvas class=graph id=" . $filename . "_value_moving_graph>
                                        </canvas>

                                    </div>
                                    <script>                                  
                                    let myChart_value_moving_" . $filename . " = document.getElementById('" . $filename . "_value_moving_graph').getContext('2d');

                                    Chart.defaults.global.defaultFontFamily = 'Avenir Light';
                                    Chart.defaults.global.defaultFontSize = 14;
                                    Chart.defaults.global.defaultFontColor = '#fff';

                                        let chart_value_moving_" . $filename . " = new Chart(myChart_value_moving_" . $filename . ", {
                                            type: 'line',
                                            data: {
                                              labels:" . $movingAverageEncoded . ",
                                              datasets: [
                                                {
                                                  label: 'Moving Average',
                                                  data:" . $movingAverageEncoded . ",
                                                  backgroundColor:'rgba(255, 99, 132, 0.8)',
                                                  hoverBackgroundColor:'rgba(214, 47, 82, 0.8)',
                                                  pointBackgroundColor:'rgba(0, 0, 0, 0.8)',
                                                  pointRadius: 0.1,
                                                  pointHoverRadius: 4
                                                }
                                                ]
                                            },
                                            options: {
                                              legend: { display: false },
                                              title: {
                                                display: true,
                                                text: 'Moving Average of Pitches'
                                              },
                                              scales: {
                                                xAxes: [{
                                                  gridLines: {
                                                    display: false
                                                  }
                                                }],
                                                yAxes: [{
                                                  gridLines: {
                                                    display: false
                                                  }
                                                }]
                                              }                                              
                                            }
                                        });
                                    </script>
                                    <br>
                                </div>
                             </div>";
                            
                        }

                        if ($analysisname == "most-used-pitches") {
                            $mostUsedPitchesDir = $value . "/data/most-used-pitches";
                            $i = 0; 
                            $dir = $mostUsedPitchesDir;
                            if ($handle = opendir($dir)) {
                                while (($file = readdir($handle)) !== false){
                                    if (!in_array($file, array('.', '..')) && !is_dir($dir.$file)) 
                                        $i++;
                                }
                            }
                            $i = $i / 2;

                            $mostUsedPitchesData = array();
                            $mostUsedPitchesLabels = array();

                            $x = 1; 

                            while ($x <= $i) {
                                $mostUsedPitchesLabelFile = $mostUsedPitchesDir . "/Percent_" . $x . ".txt";
                                $mostUsedPitchesLabels[] = file_get_contents($mostUsedPitchesLabelFile);
                            
                                $mostUsedPitchesDataFile = $mostUsedPitchesDir . "/" . $x . ".txt";
                                $mostUsedPitchesData[] = file_get_contents($mostUsedPitchesDataFile);
                                $x++;
                            }

                            $mostUsedPitchesData = json_encode($mostUsedPitchesData);
                            $mostUsedPitchesLabels = json_encode($mostUsedPitchesLabels);

                            echo "
                            <div class='analysis-container_" . $filename . " hidden visuallyhidden' id=" . $analysisname . "_" . $filename . "  style=\" width: 100%; transition: all .4s ease;\">
                                <div class=analysis-content>

                                    <div class='chart-container' >
                                        <canvas class=graph id=" . $filename . "_most_used_pitches_graph>
                                        </canvas>

                                    </div>
                                    <script>
                                    let myChart_most_used_pitches_graph_" . $filename . " = document.getElementById('" . $filename . "_most_used_pitches_graph').getContext('2d');
                                    var data = JSON.parse('" . $mostUsedPitchesLabels . "');
                                    var labels = JSON.parse('" . $mostUsedPitchesData . "');
                                    Chart.defaults.global.defaultFontFamily = 'Avenir Light';
                                    Chart.defaults.global.defaultFontSize = 14;
                                    Chart.defaults.global.defaultFontColor = '#fff';

                                        let chart_most_used_pitches_graph_" . $filename . " = new Chart(myChart_most_used_pitches_graph_" . $filename . ", {
                                            type: 'bar',
                                            data:{
                                                labels: ['Pitches (Scale Degree)'],
                                                datasets:[
                                                    {
                                                        label:[labels[0]],
                                                        data: [data[0]] ,
                    
                                                        backgroundColor:[
                                                            'rgba(255, 99, 132, 0.6)',
                                                        ],

                                                    },
                                                    {
                                                        label:[labels[1]],
                                                        data: [data[1]],
                        
                                                        backgroundColor:[
                                                            'rgba(54, 162, 235, 0.6)',
                                                        ],
    
                                                    },
                                                    {
                                                        label:[labels[2]],
                                                        data: [data[2]],
                        
                                                        backgroundColor:[
                                                            'rgba(255, 206, 86, 0.6)',
                                                        ],
    
                                                    },
                                                    {
                                                        label:[labels[3]],
                                                        data: [data[3]],
                        
                                                        backgroundColor:[
                                                            'rgba(75, 192, 192, 0.6)',
                                                        ],
    
                                                    },
                                                    {
                                                        label:[labels[4]],
                                                        data: [data[4]],
                        
                                                        backgroundColor:[
                                                            'rgba(153, 102, 255, 0.6)',
                                                        ],
    
                                                    }
                                                ]
                                            },


                                            options: {
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true
                                                    }
                                                }]
                                            },
                                            legend: { 
                                                display: true,
                                                position: 'right'
                                            },
                                            title: {
                                                display: false,
                                            }
                                            }
                                        });

                                        var resizeId" . $filename  . ";
                                        $(window).resize(function() {
                                            clearTimeout(resizeId" . $filename  . " );
                                            resizeId" . $filename  . " = setTimeout(afterResizingMostUsedPitches" . $filename . ", 100);
                                        });
    
                                        var resizeId" . $filename  . ";
                                        new ResizeSensor(jQuery('#analysis-panel" . $filename . "'), function(){ 
                                            clearTimeout(resizeId" . $filename  . " );
                                            resizeId" . $filename  . " = setTimeout(afterResizingMostUsedPitches" . $filename . ", 100);
                                        });
    
                                        var canvasheightMostUsedPitches". $filename . ";
                                        function afterResizingMostUsedPitches" . $filename . "(){
                                            var canvasheightMostUsedPitches" . $filename . " = document.getElementById('" . $filename . "_most_used_pitches_graph').width;
                                            if(canvasheightMostUsedPitches" . $filename . " <=396) {
                                                chart_most_used_pitches_graph_" . $filename . ".options.legend.display=false;
                                            }
                                            else {
                                                chart_most_used_pitches_graph_" . $filename . ".options.legend.display=true;
                                            }
                                                chart_most_used_pitches_graph_" . $filename . ".update();
                                        }

                                        
                                    </script>
                                    <br>
                                </div>
                             </div>";
                            
                        }



                        /// MOST USED NOTE VALUES
                        //+=========================

                        if ($analysisname == "most-used-note-value") {
                            $mostUsedOccurrencesDir = $value . "/data/most-used-note-value/occurrences";
                            $i = 0; 
                            $dir = $mostUsedOccurrencesDir;
                            if ($handle = opendir($dir)) {
                                while (($file = readdir($handle)) !== false){
                                    if (!in_array($file, array('.', '..')) && !is_dir($dir.$file)) 
                                        $i++;
                                }
                            }
                            $i = $i / 2;

                            $mostUsedOccurrencesData = array();
                            $mostUsedOccurrencesLabels = array();

                            $x = 1; 

                            while ($x <= $i) {
                                $mostUsedOccurrencesLabelFile = $mostUsedOccurrencesDir . "/Percent_" . $x . ".txt";
                                $mostUsedOccurrencesLabels[] = file_get_contents($mostUsedOccurrencesLabelFile);
                            
                                $mostUsedOccurrencesDataFile = $mostUsedOccurrencesDir . "/" . $x . ".txt";
                                $mostUsedOccurrencesData[] = file_get_contents($mostUsedOccurrencesDataFile);
                                $x++;
                            }

                            $mostUsedOccurrencesData = json_encode($mostUsedOccurrencesData);
                            $mostUsedOccurrencesLabels = json_encode($mostUsedOccurrencesLabels);

                            echo "
                            <div class='analysis-container_" . $filename . " hidden visuallyhidden' id=" . $analysisname . "_" . $filename . "  style=\" width: 100%; transition: all .4s ease;\">
                                <div class=analysis-content>

                                    <div class='chart-container' >
                                        <canvas class=graph id=" . $filename . "_most_used_occurrences_graph>
                                    </canvas>

                                    </div>
                                    <script>
                                    let myChart_most_used_occurrences_graph_" . $filename . " = document.getElementById('" . $filename . "_most_used_occurrences_graph').getContext('2d');
                                    var dataNew = JSON.parse('" . $mostUsedOccurrencesLabels . "');
                                    var labelsNew = JSON.parse('" . $mostUsedOccurrencesData . "');
                                    Chart.defaults.global.defaultFontFamily = 'Avenir Light';
                                    Chart.defaults.global.defaultFontSize = 14;
                                    Chart.defaults.global.defaultFontColor = '#fff';

                                        let chart_most_used_occurrences_graph_" . $filename . " = new Chart(myChart_most_used_occurrences_graph_" . $filename . ", {
                                            type: 'bar',
                                            data:{
                                                labels: ['Note Values (Occurrences)'],
                                                datasets:[
                                                    {
                                                        label:[labelsNew[0]],
                                                        data: [dataNew[0]] ,
                    
                                                        backgroundColor:[
                                                            'rgba(255, 99, 132, 0.6)',
                                                        ],

                                                    },
                                                    {
                                                        label:[labelsNew[1]],
                                                        data: [dataNew[1]],
                        
                                                        backgroundColor:[
                                                            'rgba(54, 162, 235, 0.6)',
                                                        ],
    
                                                    },
                                                    {
                                                        label:[labelsNew[2]],
                                                        data: [dataNew[2]],
                        
                                                        backgroundColor:[
                                                            'rgba(255, 206, 86, 0.6)',
                                                        ],
    
                                                    },
                                                    {
                                                        label:[labelsNew[3]],
                                                        data: [dataNew[3]],
                        
                                                        backgroundColor:[
                                                            'rgba(75, 192, 192, 0.6)',
                                                        ],
    
                                                    },
                                                    {
                                                        label:[labelsNew[4]],
                                                        data: [dataNew[4]],
                        
                                                        backgroundColor:[
                                                            'rgba(153, 102, 255, 0.6)',
                                                        ],
    
                                                    }
                                                ]
                                            },


                                            options: {
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true
                                                    }
                                                }]
                                            },
                                            legend: { 
                                                display: true,
                                                position: 'right'
                                            },
                                            title: {
                                                display: false,
                                            }
                                            }
                                        });
                                    </script>
                                    <br>";                            

                             $mostUsedTimeDir = $value . "/data/most-used-note-value/time";
                             $j = 0; 
                             $dir2 = $mostUsedTimeDir;
                             if ($handle = opendir($dir2)) {
                                 while (($file = readdir($handle)) !== false){
                                     if (!in_array($file, array('.', '..')) && !is_dir($dir2.$file)) 
                                         $j++;
                                 }
                             }
                             $j = $j / 2;
 
                             $mostUsedTimeData = array();
                             $mostUsedTimeLabels = array();
 
                             $x = 1; 
 
                             while ($x <= $j) {
                                 $mostUsedTimeLabelFile = $mostUsedTimeDir . "/Percent_" . $x . ".txt";
                                 $mostUsedTimeLabels[] = file_get_contents($mostUsedTimeLabelFile);
                             
                                 $mostUsedTimeDataFile = $mostUsedTimeDir . "/" . $x . ".txt";
                                 $mostUsedTimeData[] = file_get_contents($mostUsedTimeDataFile);
                                 $x++;
                             }
 
                             $mostUsedTimeData = json_encode($mostUsedTimeData);
                             $mostUsedTimeLabels = json_encode($mostUsedTimeLabels);
 
                             echo "
 
                                     <div class='chart-container' >
                                         <canvas class=graph id=" . $filename . "_most_used_time_graph>
                                     </canvas>
 
                                     </div>
                                     <script>
                                     let myChart_most_used_time_graph_" . $filename . " = document.getElementById('" . $filename . "_most_used_time_graph').getContext('2d');
                                     var dataNews = JSON.parse('" . $mostUsedTimeLabels . "');
                                     var labelsNews = JSON.parse('" . $mostUsedTimeData . "');
                                     Chart.defaults.global.defaultFontFamily = 'Avenir Light';
                                     Chart.defaults.global.defaultFontSize = 14;
                                     Chart.defaults.global.defaultFontColor = '#fff';
 
                                         let chart_most_used_time_graph_" . $filename . " = new Chart(myChart_most_used_time_graph_" . $filename . ", {
                                             type: 'bar',
                                             data:{
                                                 labels: ['Note Values (Time)'],
                                                 datasets:[
                                                     {
                                                         label:[labelsNews[0]],
                                                         data: [dataNews[0]] ,
                     
                                                         backgroundColor:[
                                                             'rgba(255, 99, 132, 0.6)',
                                                         ],
 
                                                     },
                                                     {
                                                         label:[labelsNews[1]],
                                                         data: [dataNews[1]],
                         
                                                         backgroundColor:[
                                                             'rgba(54, 162, 235, 0.6)',
                                                         ],
     
                                                     },
                                                     {
                                                         label:[labelsNews[2]],
                                                         data: [dataNews[2]],
                         
                                                         backgroundColor:[
                                                             'rgba(255, 206, 86, 0.6)',
                                                         ],
     
                                                     },
                                                     {
                                                         label:[labelsNews[23]],
                                                         data: [dataNews[3]],
                         
                                                         backgroundColor:[
                                                             'rgba(75, 192, 192, 0.6)',
                                                         ],
     
                                                     },
                                                     {
                                                         label:[labelsNews[4]],
                                                         data: [dataNews[4]],
                         
                                                         backgroundColor:[
                                                             'rgba(153, 102, 255, 0.6)',
                                                         ],
     
                                                     }
                                                 ]
                                             },
 
 
                                             options: {
                                             scales: {
                                                 yAxes: [{
                                                     ticks: {
                                                         beginAtZero: true
                                                     }
                                                 }]
                                             },
                                             legend: { 
                                                 display: true,
                                                 position: 'right'
                                             },
                                             title: {
                                                 display: false,
                                             }
                                             }
                                         });
                                     </script>
                                     <br>
                                 </div>
                              </div>";
                        }
                        //================================

                        // REPEATED NOTE VALUE 
                        // ======================
                        if ($analysisname == "repeated-pitches") {
                            $repeatedPitchesDir = $value . "/data/repeated-pitches/";
                            $repeatedPitches = array();
                            $repeatedPitches[] = file_get_contents($repeatedPitchesDir . "2.txt");
                            $repeatedPitches[] = file_get_contents($repeatedPitchesDir . "3.txt");
                            $repeatedPitches[] = file_get_contents($repeatedPitchesDir . "4.txt");
                            $repeatedPitches[] = file_get_contents($repeatedPitchesDir . "5.txt");
                            $repeatedPitches[] = file_get_contents($repeatedPitchesDir . "6.txt");

                            $repeatedPitches = json_encode($repeatedPitches);
                            echo "
                            <div class='analysis-container_" . $filename . " hidden visuallyhidden' id=" . $analysisname . "_" . $filename . "  style=\" width: 100%; transition: all .4s ease;\">
                                <div class=analysis-content>

                                    <div class='chart-container' >
                                        <canvas class=graph id=" . $filename . "_repeated_pitches_graph>
                                        </canvas>

                                    </div>
                                    <script>                                  
                                    let myChart_repeated_pitches_" . $filename . " = document.getElementById('" . $filename . "_repeated_pitches_graph').getContext('2d');

                                    Chart.defaults.global.defaultFontFamily = 'Avenir Light';
                                    Chart.defaults.global.defaultFontSize = 14;
                                    Chart.defaults.global.defaultFontColor = '#fff';

                                        let chart_repeated_pitches_" . $filename . " = new Chart(myChart_repeated_pitches_" . $filename . ", {
                                            type: 'line',
                                            data: {
                                                labels: ['2 Note', '3 Note', '4 Note', '5 Note', '6 Note'],
                                                datasets: [{ 
                                                        data: " . $repeatedPitches . ",
                                                        label: 'Repeated Pitches',
                                                        borderColor:'rgb(255, 79, 125)',
                                                        fill: true,
                                                        lineTension: '0',
                                                        backgroundColor:'rgba(255, 79, 125, 0.7)'
                                                    }
                                                ]
                                            },
    
                                        options:{
                                            legend:{
                                                display:true,
                                                position:'top',
                                                labels:{
                                                    fontSize: 12,
                                                    boxWidth: 28,
                                                    boxWidth: 12,
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

                        //REPEATED NOTE VALUE
                        //=========================

                        if ($analysisname == "repeated-note-value") {
                            $repeatedPitchesDirValue = $value . "/data/repeated-note-value/";
                            $repeatedPitchesValue = array();
                            $repeatedPitchesValue[] = file_get_contents($repeatedPitchesDirValue . "2.txt");
                            $repeatedPitchesValue[] = file_get_contents($repeatedPitchesDirValue . "3.txt");
                            $repeatedPitchesValue[] = file_get_contents($repeatedPitchesDirValue . "4.txt");
                            $repeatedPitchesValue[] = file_get_contents($repeatedPitchesDirValue . "5.txt");
                            $repeatedPitchesValue[] = file_get_contents($repeatedPitchesDirValue . "6.txt");

                            $repeatedPitchesValue = json_encode($repeatedPitchesValue);
                            echo "
                            <div class='analysis-container_" . $filename . " hidden visuallyhidden' id=" . $analysisname . "_" . $filename . "  style=\" width: 100%; transition: all .4s ease;\">
                                <div class=analysis-content>

                                    <div class='chart-container' >
                                        <canvas class=graph id=" . $filename . "_repeated_values_graph>
                                        </canvas>

                                    </div>
                                    <script>                                  
                                    let myChart_repeated_values_" . $filename . " = document.getElementById('" . $filename . "_repeated_values_graph').getContext('2d');

                                    Chart.defaults.global.defaultFontFamily = 'Avenir Light';
                                    Chart.defaults.global.defaultFontSize = 14;
                                    Chart.defaults.global.defaultFontColor = '#fff';

                                        let chart_repeated_values_" . $filename . " = new Chart(myChart_repeated_values_" . $filename . ", {
                                            type: 'line',
                                            data: {
                                                labels: ['2 Note', '3 Note', '4 Note', '5 Note', '6 Note'],
                                                datasets: [{ 
                                                        data: " . $repeatedPitchesValue . ",
                                                        label: 'Repeated Note Values',
                                                        borderColor: 'rgb(255, 79, 125)',
                                                        fill: true,
                                                        lineTension: '0',
                                                        backgroundColor:'rgba(255, 79, 125, 0.7)'
                                                    }
                                                ]
                                            },
    
                                        options:{
                                            legend:{
                                                display:true,
                                                position:'top',
                                                labels:{
                                                    fontSize: 12,
                                                    boxWidth: 28,
                                                    boxWidth: 12,
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

                        
                    }
                            //CREATE GENERAL SECTION ==================//
                            //==========================================


                            $timePath = $value . "/data/total-time/time.txt";
                            $timePath = file_get_contents($timePath);
                            $timePath = str_replace(" ", "  ", $timePath);

                            echo "
                            <div class=analysis-container_" . $filename . " id=general" . "_" . $filename .  " style='width: 100%; transition: all .4s ease;'>
                                <div class=analysis-content>
                                    <br>
                                    <br>
                                    <div id=clock>" . $timePath ."</div>
                                    <br>
                                    <br>
                                    <br>

                                </div>
                             </div>";


                            //===================================
                            //====================================


                            echo "
                            <div class='analysis-container_" . $filename . " hidden visuallyhidden' id=keyscape" . "_" . $filename .  " style='width: 100%; transition: all .4s ease;'>
                                <div class=analysis-content>

                                    <br>
                                    <img src='Song_Database/" . $filename . "/image-assets/keyscape.png' alt='Keyscape Chart' width=400px; height=200px>
                                </div>
                            </div>";

                            echo "
                            <div class='analysis-container_" . $filename . " hidden visuallyhidden' id=proll" . "_" . $filename .  " style='width: 100%; transition: all .4s ease;'>
                                <div class=analysis-content>

                                    <br>
                                    <div class=chart-container style='width:400px; height:200px; overflow: auto;'> 
                                    <img src='Song_Database/" . $filename . "/image-assets/proll.png' alt='Piano Roll' height=180px>
                                    </div>
                                </div>
                            </div>";

                echo "
                </div>";
                echo "
                </div>";
                echo "
                </div>";


            }
                    

            //===================
            //conditional:
                        // if ( sizeof($explodedfiledirs) == "1" ) {

                        // }
                        // else {
            //==================================


                echo "<div class=analysis-panel id=analysis-panel-averages><div class=panelheader><h1>Downloads</h1>";
                echo "</div>";

                // echo "<div id='largeitem' style=\"width: 22%;\">";

                // echo "
                // <div id=analysis-container_averages class=shelf>";

                // foreach($_POST['data-choose'] as $selected){
                //     $analysisname = substr($selected, 0, strpos($selected, "."));
                //     $containernames = "analysis-container_averages";

                //     echo "

                //     <div id=shelf-item class=" . $analysisname . "_" . "averages onclick=\"showDiv(this.className, '" . $containernames . "');\">
                //         <span>"
                //         . $analysisname . "
                //         </span>
                //     </div>";                    
                // }
                
                // echo "</div>";

                // echo "</div>";

                foreach ($explodedfiledirs as $value) {
                    $filename = str_replace("Song_Database/", "", $value);
                    $removedFileName = strstr($filename, '_');
                    $completeFileName = str_replace("_", " ", substr($removedFileName, 1));
                    $containernames = "analysis-container_" . $filename;
                    $zipdir = $value . "/assets.zip";
                    echo "
                    <div id=downloadSection>
                        <p class=panelheader> " . $completeFileName . "</p>";
                    echo "
                        <a class=downloadbutton href='" . $zipdir . "' download>
                            <button class=darkform>
                                All Assets
                            </button>
                        </a>";
                    echo "
                    </div>";
                }

                echo "</div>";

            

            //OCCURRENCES SECTION
            //-------------------
            //-==================

            // if ( sizeof($explodedfiledirs) == "1" ) {

            // }
            // else {
            //     echo "<div class=analysis-panel id=analysis-panel-occurrences><div class=panelheader><h1>Occurrences</h1>";
            //     echo "</div>";

            //     echo "<div id='largeitem' style=\"width: 22%;\">";

            //     echo "
            //     <div id=analysis-container_occurrences class=shelf>";

            //     foreach($_POST['data-choose'] as $selected){
            //         $analysisname = substr($selected, 0, strpos($selected, "."));
            //         $containernames = "analysis-container_occurrences";

            //         echo "

            //         <div id=shelf-item class=" . $analysisname . "_" . "occurrences onclick=\"showDiv(this.className, '" . $containernames . "');\">
            //             <span>"
            //             . $analysisname . "
            //             </span>
            //         </div>";                    
            //     }
                
            //     echo "</div>";

            //     echo "</div>";
            //     echo "<div id=largeitem>";
            //     foreach($_POST['data-choose'] as $selected){
            //         $analysisname = substr($selected, 0, strpos($selected, "."));
            //         $containernames = "analysis-container_occurrences";

            //         echo "
            //         <div class='analysis-container_occurrences hidden visuallyhidden' id=" . $analysisname . "_occurrences  style=\" width: 100%; transition: all .4s ease;\">
            //             <div class=analysis-content>
            //             </div>
            //         </div>";
            //     }
            //     echo "</div>";

            //     echo "</div>";

            // }
        ?>
        
        <br>
        <br>
        <script>
            //   $( function() {
            //         $( ".analysis-panel" ).draggable();
            //     } );
            $(window).bind('beforeunload', function(){
                return 'Your changes will not be saved! Continue?';
            });
        </script>
    </body>
</html>