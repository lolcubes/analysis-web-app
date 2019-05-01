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
       
       <script>

            Highcharts.theme = {
                colors: ['#DDDF0D', '#55BF3B', '#DF5353', '#7798BF', '#aaeeee',
                    '#ff0066', '#eeaaee', '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
                chart: {
                    backgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
                        stops: [
                            [0, 'rgb(0, 0, 0)'],
                            [1, 'rgb(0, 0, 0)']
                        ]
                    },
                    borderColor: '#000000',
                    borderWidth: 2,
                    className: 'dark-container',
                    plotBackgroundColor: 'rgba(255, 255, 255, .1)',
                    plotBorderColor: '#CCCCCC',
                    plotBorderWidth: 1
                },
                title: {
                    style: {
                        color: '#C0C0C0',
                        font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
                    }
                },
                subtitle: {
                    style: {
                        color: '#666666',
                        font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
                    }
                },
                xAxis: {
                    gridLineColor: '#333333',
                    gridLineWidth: 1,
                    labels: {
                        style: {
                            color: '#A0A0A0'
                        }
                    },
                    lineColor: '#A0A0A0',
                    tickColor: '#A0A0A0',
                    title: {
                        style: {
                            color: '#CCC',
                            fontWeight: 'bold',
                            fontSize: '12px',
                            fontFamily: 'Trebuchet MS, Verdana, sans-serif'

                        }
                    }
                },
                yAxis: {
                    gridLineColor: '#333333',
                    labels: {
                        style: {
                            color: '#A0A0A0'
                        }
                    },
                    lineColor: '#A0A0A0',
                    minorTickInterval: null,
                    tickColor: '#A0A0A0',
                    tickWidth: 1,
                    title: {
                        style: {
                            color: '#CCC',
                            fontWeight: 'bold',
                            fontSize: '12px',
                            fontFamily: 'Trebuchet MS, Verdana, sans-serif'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.75)',
                    style: {
                        color: '#F0F0F0'
                    }
                },
                toolbar: {
                    itemStyle: {
                        color: 'silver'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            color: '#CCC'
                        },
                        marker: {
                            lineColor: '#333'
                        }
                    },
                    spline: {
                        marker: {
                            lineColor: '#333'
                        }
                    },
                    scatter: {
                        marker: {
                            lineColor: '#333'
                        }
                    },
                    candlestick: {
                        lineColor: 'white'
                    }
                },
                legend: {
                    itemStyle: {
                        font: '9pt Trebuchet MS, Verdana, sans-serif',
                        color: '#A0A0A0'
                    },
                    itemHoverStyle: {
                        color: '#FFF'
                    },
                    itemHiddenStyle: {
                        color: '#444'
                    }
                },
                credits: {
                    style: {
                        color: '#666'
                    }
                },
                labels: {
                    style: {
                        color: '#CCC'
                    }
                },

                navigation: {
                    buttonOptions: {
                        symbolStroke: '#DDDDDD',
                        hoverSymbolStroke: '#FFFFFF',
                        theme: {
                            fill: {
                                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                                stops: [
                                    [0.4, '#606060'],
                                    [0.6, '#333333']
                                ]
                            },
                            stroke: '#000000'
                        }
                    }
                },

                // scroll charts
                rangeSelector: {
                    buttonTheme: {
                        fill: {
                            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                            stops: [
                                [0.4, '#888'],
                                [0.6, '#555']
                            ]
                        },
                        stroke: '#000000',
                        style: {
                            color: '#CCC',
                            fontWeight: 'bold'
                        },
                        states: {
                            hover: {
                                fill: {
                                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                                    stops: [
                                        [0.4, '#BBB'],
                                        [0.6, '#888']
                                    ]
                                },
                                stroke: '#000000',
                                style: {
                                    color: 'white'
                                }
                            },
                            select: {
                                fill: {
                                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                                    stops: [
                                        [0.1, '#000'],
                                        [0.3, '#333']
                                    ]
                                },
                                stroke: '#000000',
                                style: {
                                    color: 'yellow'
                                }
                            }
                        }
                    },
                    inputStyle: {
                        backgroundColor: '#333',
                        color: 'silver'
                    },
                    labelStyle: {
                        color: 'silver'
                    }
                },

                navigator: {
                    handles: {
                        backgroundColor: '#666',
                        borderColor: '#AAA'
                    },
                    outlineColor: '#CCC',
                    maskFill: 'rgba(16, 16, 16, 0.5)',
                    series: {
                        color: '#7798BF',
                        lineColor: '#A6C7ED'
                    }
                },

                scrollbar: {
                    barBackgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0.4, '#888'],
                            [0.6, '#555']
                        ]
                    },
                    barBorderColor: '#CCC',
                    buttonArrowColor: '#CCC',
                    buttonBackgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0.4, '#888'],
                            [0.6, '#555']
                        ]
                    },
                    buttonBorderColor: '#CCC',
                    rifleColor: '#FFF',
                    trackBackgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0, '#000'],
                            [1, '#333']
                        ]
                    },
                    trackBorderColor: '#666'
                },

                // special colors for some of the
                legendBackgroundColor: 'rgba(0, 0, 0, 0.5)',
                background2: 'rgb(35, 35, 70)',
                dataLabelsColor: '#444',
                textColor: '#C0C0C0',
                maskColor: 'rgba(255,255,255,0.3)'
            };

            // Apply the theme
            Highcharts.setOptions(Highcharts.theme);

        </script>
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
                console.log(y);
                y.style.display = "inline-block";
                console.log(classVar);
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

                    shell_exec("$scriptdirec $song");
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
                                $keySigsRead[] = file_get_contents($fullKeySigPath);
                            }


                            echo "
                            <div class=analysis-container_" . $filename . " id=" . $analysisname . "_" . $filename . "  style=\"display: none;\">
                                <div class=analysis-content>
                                    <span>
                                        Key Signatures:
                                    </span>
                                    <br>
                                    <span>";
                                    foreach ($keySigsRead as $currentKeySigRead) {
                                        echo $currentKeySigRead;
                                        echo "<br>";
                                    }
                                    echo "
                                    </span>
                                </div>
                             </div>";
                            
                        }
                        
                        // if the analysis name is such and such, echo a different thing
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
