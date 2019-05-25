<!DOCTYPE html>
<html>
<head>
        <title>Database</title>
        <link rel="stylesheet" type="text/css" href="../style-main.css" />
        <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="../favicon.png"/>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    </head>
    <body>
    <div id="navbarr">
                    <ul id=navbar>
                    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
        
                        <a  href="../index.php"><img id="headerbanner" src="../image-assets/headerbanner.png" alt="Header logo" height="50px" width="260" align="middle"></a>
                        <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                        <!-- <li id="Menu" class="logoimage"><img src="headerbanner.png" alt="Header logo" height="60px" width="313px"></img></li> -->
                        <li id="Menu" class="home"><a href="../index.php">Home</a></li>
                        <li id="Menu" class="about"><a href="about.html">About</a></li>
                        <li id="Menu"><a href="code.html">Code</a></li>
                        <li id="Menu" class="research"><a href="research.html">Our Research</a></li>
                        <li id="Menu" class="library"><a href="library.html">Database</a></li>
                        <li id="Menu"><a href="analysis-tools.html">Analysis Tools</a></li>
                    </ul>
                </div>
                <div id="bumper">
        </div>

        <style>
            .library{
                background-color: rgb(153, 153, 153);
                box-shadow: 1px 4px 28px  rgb(0, 0, 0);
                outline: 0;
            }
        </style>


        <p> Retrieved data: </p>

        <?php
            // $timeperiod = $_POST['time-period'];
            // echo $timeperiod;
            $timeperiod = "Bach";

            //     $files = scandir('../Song_Database');
            //     foreach($files as $file) {
            //         echo $file;
            //         echo "<br>";
            //     }
            $filedirs = array();

            foreach (new DirectoryIterator('../Song_Database') as $fileInfo) {
                if($fileInfo->isDot()) continue;
                $currentfilerel = $fileInfo->getFilename();
                $currentfile = "/Applications/MAMP/htdocs/NewTestings/Song_Database/" . $currentfilerel;

                $period = $currentfile . "/time-info/composer.txt";

                if (file_exists($period)) {
                    $periodcontents = file_get_contents($period);
                    if ("$periodcontents" == "$timeperiod"){
                        $filedirs[] = $currentfile;
                    }
                }

            }
            echo "<pre>";
            print_r($filedirs);
            echo "</pre>";
            foreach ($filedirs as $value) {
                $valueo = $value . '/song.txt';
                echo "<pre>";
                echo file_get_contents($valueo);
                echo "</pre>";
            }
        ?>

        <a href="library.html"> <button class="buttonform"><span>Back</span></button></a>
    </body>
</html>