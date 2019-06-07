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
                <li id="Menu"><a href="index.php">Home</a></li>
                <li id="Menu" class="home"><a href="analysis-tools.php">Analysis Tools</a></li>
                <li id="Menu"><a href="pages/about.html">About</a></li>
                <li id="Menu"><a href="https://github.com/BeatsInBytes">Code</a></li>
                <li id="Menu"><a href="pages/research.html">Our Research</a></li>
            </ul>
        </div>
        <div id="bumper">
        </div>

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

            <h1 style="display: inline-block;vertical-align:middle">Comparison Analytics</h1> 
            <br>
            <br>
            <br>
        </div>
        <?php
            $files = $_POST['filesarray'];
            $exploded = explode(",", $files);
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
                        $output = $value . "/comparison-outputs/averages/" . $file . ".txt";


                        // shell_exec("octave -fq formula.m $arg1 $data | tr -d '\n' | tr -d ' ' > $output");
                        // shell_exec("./formula.sh $arg1 $data");
                    }
                }

                $cdDir = $value . "/comparison-outputs";
                shell_exec("cd $cdDir && zip -r data.zip averages");

                $zipDir = $value . "/comparison-outputs/data.zip";

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

                $combined = array_combine($composerNames,$comparisonValues);
                $max = max($combined);
                $max = $max * 100;
                $max = substr($max, 0, -3);

                $rounded = substr(round($max, -1), 0, -1);
                $minus = 10 - $rounded;

                $barArray = array();

                $i = "";
                for ($i;$i<$rounded;$i++) {
                    $barArray[] = "barOn" . $i;
                }

                $j = "";
                for ($j;$j<$minus;$j++) {
                    $barArray[] = "barOff";
                }

                //for the bar chart
                //=====================

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

                $combined = array_combine($composerNames,$comparisonValues);
                arsort($combined);

                $sortedKeys = array_keys($combined);
                $sortedValues = array_values($combined);

                $sortedKeys = array_slice($sortedKeys, 0, 3);
                $sortedValues = array_slice($sortedValues, 0, 3);

                $minimum = min($sortedValues);
                $minimum = $minimum - 0.03;

                $sortedKeys = json_encode($sortedKeys);
                $sortedValues = json_encode($sortedValues);


                $filename = str_replace("Song_Database/", "", $value);
                $removedFileName = strstr($filename, '_');
                $removedUnder = str_replace("_", "", $removedFileName);


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

                    $max = max($comparisonValues);
                    $min = min($comparisonValues);
                    $halfmin = $min/2;
                    $subtracted = array();

                    foreach ($comparisonValues as $num) {
                        $subtracted[] = $num - $halfmin;
                    }

                    $subtracted = json_encode($subtracted);
                    $comparisonValues = json_encode($comparisonValues);

                echo "
                <div class='composer-panel'>
                    <h1 style='margin-top:26px'> $completeFileName</h1> 
                    <div class='content-section'>
                    <p style='margin:16px'> This song is most correlated with <b>" . array_search(max($combined),$combined) . "</b> with a correlation value of <b>" . $max . "%</b> 
                        <div class=meterBar>
                            <div class='bar " . $barArray[0] . "'></div>
                            <div class='bar " . $barArray[1] . "'></div>
                            <div class='bar " . $barArray[2] . "'></div>
                            <div class='bar " . $barArray[3] . "'></div>
                            <div class='bar " . $barArray[4] . "'></div>
                            <div class='bar " . $barArray[5] . "'></div>
                            <div class='bar " . $barArray[6] . "'></div>
                            <div class='bar " . $barArray[7] . "'></div>
                            <div class='bar " . $barArray[8] . "'></div>
                            <div class='bar " . $barArray[9] . "'></div>
                        </div>
                    </div>
                    <div class='content-section' style='display:inline-block;width:45%'>
                        <br><br>
                        <h2 style='margin:4px'>Top Three Correlations:</h2>
                        <div id=barmap" . $filename . "> </div>
                    </div>
                    <div class='content-section' style='display:inline-block;width:40%'>
                        <h2 style='margin-top:4px'>Radar Chart: " . $completeFileName . "</h2>

                        <div id=radarChart" . $removedUnder . "></div>
                    <script>
                    var options = {
                        chart: {
                            height: 350,
                            type: 'radar',
                            dropShadow: {
                                enabled: true,
                                blur: .2,
                                left: 1,
                                top: 1
                            }
                        },
                        series: [{
                            name: 'Series 1',
                            data: " . $subtracted . ",
                        }],

                        stroke: {
                            width: 0
                        },
                        fill: {
                            opacity: 0.4
                        },
                        markers: {
                            size: 0
                        },
                        yaxis: {
                            show: false
                        },
                        labels: ['African','Bach','Beethoven','Chinese','Chopin','Corelli','DuFay','Frescobaldi','Haydn','Hummel','Joplin','Josquin','Martini','Mozart','NativeAmerican','Rue','Scarlatti','Schubert'],
                    }
            
                        var chart = new ApexCharts(
                            document.querySelector('#radarChart" . $removedUnder . "'),
                            options
                        );
                
                        chart.render();
                    </script>;
                    </div>
                    <br>
                    

                <script>
                    var baroptions = {
                        chart: {
                            height: 200,
                            type: 'bar',
                            forecolor: 'black',
                        },
                        plotOptions: {
                            bar: {
                              horizontal: false,
                              dataLabels: {
                                position: 'top'
                              }
                            }
                          },
                        dataLabels: {
                            offsetY: 30,
                            style:{
                                fontFamily:'Avenir Light'
                            }
                        },
                        series: [{
                            data: $sortedValues
                        }],
                        xaxis: {
                            categories: $sortedKeys,
                            labels: {
                                style: {
                                    colors: 'white',
                                    fontSize: '16px',
                                    fontFamily: 'Avenir Light',
                            
                                }
                            }
                        },
                        yaxis: {
                            min: $minimum
                        },
                        grid: {
                            show: false
                        }
                    }
            
                var barchart = new ApexCharts(
                        document.querySelector('#barmap" . $filename . "'),
                        baroptions
                    );
                
                barchart.render();
                </script>
                <a href=$zipDir download><button class=darkform>Download Data</button></a>
                <br>
                </div>";
            }



            echo "
            <div class=big-panel>
                <h1 style='margin-top:30px'>Heatmap</h1>
                <div id=heatmap> </div>
            </div>";
            echo "
            <script>
                    var data = [
                    ";
                    foreach ($exploded as $value) {
                        $filename = str_replace("Song_Database/", "", $value);
                        $removedFileName = strstr($filename, '_');
                        $completeFileName = str_replace("_", " ", substr($removedFileName, 1));

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
                        $comparisonValues = json_encode($comparisonValues);
                        echo "
                        {
                            name: '" . $completeFileName . "',
                            data: " . $comparisonValues . "
                        },
                        ";                        
                    }
                    echo "]";

                    echo "
                    var options = {
                        chart: {
                            height: 450,
                            type: 'heatmap',
                            foreColor: '#fff',
                            fontFamily: 'Avenir Light',
                        },
                        dataLabels: {
                            enabled: false
                        },
                        series: data,
                        xaxis: {
                            type: 'category',
                            categories: ['African','Bach','Beethoven','Chinese','Chopin','Corelli','DuFay','Frescobaldi','Haydn','Hummel','Joplin','Josquin','Martini','Mozart','NativeAmerican','Rue','Scarlatti','Schubert'],
                            labels: {
                                style: {
                                    fontSize: '18px',
                                }
                            }
                        },
                        legend: {
                            show: false,
                        },
                        grid: {
                            show: false,
                        },
                        yaxis: {
                            
                            labels: {
                                style: {
                                    fontSize: '18px',
                                }
                            } 
                        },
                        grid: {
                            padding: {
                                right: 20
                            }
                        },
                        plotOptions: {
                            heatmap: {
                                
                              enableShades: true,
                              shadeIntensity: 1,
                              colorScale: {
                                ranges: [{
                                    from: 0,
                                    to: .48,
                                    color: '#e01a1a',
                                    name: 'Low',
                                  },
                                  {
                                    from: .48,
                                    to: .54,
                                    color: '#ff9605',
                                    name: 'medium',
                                  },
                                  {
                                    from:.54,
                                    to: .6,
                                    color: '#ffe207',
                                    name: 'high',
                                  },
                                  {
                                    from:.6,
                                    to: .9,
                                    color: '#0fc109',
                                    name: 'high',
                                  }
                                ]
                              }
                            }
                          }
                    }
            
                    var chart = new ApexCharts(
                        document.querySelector('#heatmap'),
                        options
                    );
            
                    chart.render();
                </script>";
                
        ?>

    </body>
</html>