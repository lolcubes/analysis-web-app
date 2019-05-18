<!DOCTYPE html>
<html>
    <head>
        <title>Beats in Bytes | Analysis Tools</title>

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
            print_r($exploded);
            echo "</pre>";

            foreach ($exploded as $value) {
                $filename = str_replace("Song_Database/", "", $value);
                $removedFileName = strstr($filename, '_');
                $completeFileName = str_replace("_", " ", substr($removedFileName, 1));

                echo "
                <div class=composer-panel><p>$completeFileName</p></div>";
            }
        ?>

    </body>
</html>