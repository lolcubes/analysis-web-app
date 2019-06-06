<!DOCTYPE html>
<html>
    <head>
        <title>Beats in Bytes | Analysis Tools</title>

        <link rel="stylesheet" type="text/css" href="style-main.css" />
        <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="image-assets/favicon.png"/>

    </head>

    <body id=home>
            <div id="navbarr" >
                <ul id=navbar>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>

                    <a href="index.php"><img id="headerbanner" src="image-assets/headerbanner.png" alt="Header logo" height="50px" width="260" align="middle"></a>
                    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                    <!-- <li id="Menu" class="logoimage"><img src="headerbanner.png" alt="Header logo" height="60px" width="313px"></img></li> -->
                    <li id="Menu" class="home"><a href="index.php">Home</a></li>
                    <li id="Menu"><a href="analysis-tools.php">Analysis Tools</a></li>
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
        outline: 0;
    }
    #topSection {
        text-align:center;
        width:100%;
        height:400px;
        background-image: linear-gradient(rgb(50,50,50), black);
        color:white;
    }
    #analysisButton {
        padding-left:12px;
        padding-right:12px;
        padding-top:8px;
        padding-bottom:8px;
        color:white;
        font-family: 'Avenir Light';
        border: 2px solid white;
        border-radius: 4px;
        background-color: rgba(0,0,0,0);
        font-size:20px;
        cursor: pointer;
        transition: .2s;
    }
    #analysisButton:hover {
        background-color:white;
        color: black;
        transition: .2s;
    }
</style>


<div id=topSection>
    <br style='line-height:20px;'>
    <img src=image-assets/BeatsBytesSmall.png height=100px></img>
    <br style='line-height:20px;'>

    <h1 style='margin:8px;font-size:40px;'>Simple interface.</h1>
    <h1 style='margin:8px;font-size:40px;'>Powerful musical analysis.</h1>
    <br><br>
    <button id=analysisButton>Try our tools</button>
</div>

</body>

</html>