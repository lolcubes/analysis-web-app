<!DOCTYPE html>
<html>
    <head>
        <title>Beats in Bytes | Analysis Tools</title>

        <link rel="stylesheet" type="text/css" href="style-main.css" />
        <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="image-assets/favicon.png"/>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
        <script src="https://verovio-script.humdrum.org/scripts/verovio-toolkit.js"></script>
        <script src="https://plugin.humdrum.org/scripts/humdrum-notation-plugin.js"></script>
        <script> var vrvToolkit = new verovio.toolkit(); </script>

    </head>

    <body id=home>
    <div id=fullpagecontent>
            <div id="navbarr" >
                <ul id=navbar>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>

                    <a href="index.php"><img id="headerbanner" src="image-assets/headerbanner.png" alt="Header logo" height="50px" width="260" align="middle"></a>
                    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                    <!-- <li id="Menu" class="logoimage"><img src="headerbanner.png" alt="Header logo" height="60px" width="313px"></img></li> -->
                    <li id="Menu" ><a href="index.php">Home</a></li>
                    <li id="Menu" class="home" ><a href="analysis-tools.php">Analysis Tools</a></li>
                    <li id="Menu"><a href="pages/about.html">About</a></li>
                    <li id="Menu"><a href="pages/code.html">Code</a></li>
                    <li id="Menu"><a href="pages/research.html">Our Research</a></li>
                    <li id="Menu"><a href="pages/library.html">Database</a></li>
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
<div id="center">
<br>
<br>
<div id="analysis-header">
    <h1>Musical Analysis Tools</h1>
</div>

<br>
<br>

<button class="buttonform" id="uploadfilesbutton">Upload File</button>
&nbsp;&nbsp;&nbsp;

<span id="orspan">or</span>
&nbsp;&nbsp;&nbsp;
<button class="buttonform" id="choosedatabasebutton">Choose From Database</button>
<p id=demo ></p>

<a id=testanchor></a>

<div id="selected-files-div">
</div>
    <div id="dropzone-content">
    <div id="loading-bar"></div>

        <div id="dropzone" class="dropzone" >
        <br><br><br><br><br><br><br><br><br>
            <span>Drop files to upload or</span>
            <div id="plusfile">
                    <form target="votar" method="post" enctype="multipart/form-data" id="filechooserform" name="filechooserform" onchange="filechooserform.submit();">
                        <input class="inputfile" name="userfile[]" type="file" multiple value="Choose Files" id="uploadchooser" /><br />
                        <label for="uploadchooser" class="buttonform"><span>Add Files</span></label>
                        <input type='hidden' name='varNew[]' value='<?php echo "$arrayfilenumber";?>'/> 
                    </form>
            </div>
        </div>
    </div>
<br>
<br>
<script id="uploader">

$("#filechooserform").on("change", function(){
    $.ajax({
        url: "upload.php",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data){
            document.getElementById("demo").innerHTML = data;
        }           
    });
});

$( document ).ajaxStart(function() {
    document.getElementById("loading-bar").className = "loading";
});

$( document ).ajaxComplete(function() {
    $('#file-info-accordions').delay(800).show("slow");
    document.getElementById("loading-bar").className = "loaded";
    document.getElementById("selected-files-div").innerHTML = "<p id=selected-files-text>Selected Files:</p>";
    addHiddenValue();
    addDownloadSection();

});

    function populateDownloadSectionFiles(){
        var array = document.getElementById("demo").innerHTML;
            var arrayparsed = JSON.parse(array);
            var names = arrayparsed.names;
            var icons = arrayparsed.fileicon;
            var size = arrayparsed.filesize

            $("#downloadfilesselectionsection").append("<br>");

            for (var i = 0; i < icons.length; i += 1) {
                var icon = icons[i];
                var name = names[i];
                var thissize = size[i];
                $("#downloadfilesselectionsection").append( '<div class="dropzonefileicons unselected"  style="cursor:pointer;" id="dropzonefileicons' + name + '" onclick="addSelectedClassFiles(this.id)">' + '<img src=' + icon + " height=90px;" + '>' + '<p>' + name + '</p>' + '</div>');
            }
    }
</script>

<script>
$("body").on('DOMSubtreeModified', "#demo", function() {
    $('#dropzone').empty();

    populateDropzone();
    populateDownloadSectionFiles()
    addAudioPlayers();
});
</script>

<style id="styleloaderbar">
#loading-bar{
    display:none;
    position:fixed;
    z-index:1000000;
    left:0;
    top:0;
    width:100%;
    height:100%;
    background-image: url('image-assets/animation.gif');
    background-size: 600px 600px;
    background-position: 50% 30%;
    background-color: rgba(255,255,255,0.95);
    background-repeat: no-repeat;
}

#loading-bar.loading{
    display:block;
}
</style>


<script id="cleardropzone">



$( "#dropzone" ).on("drop", function() {
    $('#dropzone').children().delay(800).fadeOut(500).promise().then(function() {
        $('#dropzone').empty();
        if ( $('#demo').html().length == 0 ) {
            }
            else {
                populateDropzone();
                populateDownloadSectionFiles()

            }
   });
});


$( "#filechooserform" ).on("change", function() {
    $('#dropzone').attr('class', 'dropzone dropped')

    $('#dropzone').children().delay(800).fadeOut(500).promise().then(function() {
        $('#dropzone').empty();
        if ( $('#demo').html().length == 0 ) {
        }
        else {
            populateDropzone()
            populateDownloadSectionFiles();
        }
    });
});

</script>



<script>
function showHidePlayContent() {
    var text = document.getElementById("notationInstruction");
    text.style.display = "none";

    var button = document.getElementById("saveSvgButton");
    button.style.display = "";
}
function addAudioPlayers(){

    var array = document.getElementById("demo").innerHTML;
    var arrayparsed = JSON.parse(array);
    var dirs = arrayparsed.relativedirs;
    var names = arrayparsed.names;
    // document.getElementById("audioplayer").innerHTML = "";


    for (i=0; i<names.length; i++){ 
        var name = names[i];
        var dir = dirs[i];



        var appendtext = '<audio id="audio-player-element" onplaying="addMusicalNotation(' + "'" + dir + "'" +  ", " + "'" + name + "'" + ');showHidePlayContent();" controls="controls" src="' + dir + '/song.wav" type="audio/wav">'
        $("#audioplayer").append('<div id="audioelement"><br><span id="audiotext">' + name + ':</span><br><br>' + appendtext + '</div><br>');
    }               

}
</script>
    
    
    <script>
        function toObject(names, values) {

        }
           
        function populateDropdown(dropdownId){
            var select = document.getElementById(dropdownId);
            
            select.innerHTML = ""

            var array = document.getElementById("demo").innerHTML;
            var arrayparsed = JSON.parse(array);
            var names = arrayparsed.names;
            var locations = arrayparsed.relativedirs;

            var options = arrayparsed.names;


            for(var i = 0; i < options.length; i++) {
                var opt = options[i];
                var el = document.createElement("option");
                el.textContent = opt;
                el.value = opt;
                select.appendChild(el);
            }

        }

        function populateDropzone(){
            var array = document.getElementById("demo").innerHTML;
            var arrayparsed = JSON.parse(array);
            var names = arrayparsed.names;
            var icons = arrayparsed.fileicon;
            var size = arrayparsed.filesize
            $("#dropzone").append("<br>");

            $("#dropzone").append("<br>");
            for (var i = 0; i < icons.length; i += 1) {
                var icon = icons[i];
                var name = names[i];
                var thissize = size[i];
                $("#dropzone").append( '<div class="dropzonefileicons">' + '<img src=' + icon + " height=90px;" + '>' + '<br style="line-height:24px"><span style="font-size:18px">' + name + '</span><br style="line-height:34px">' + '<span style="font-size:18px">' + thissize + ' kb' + '</span>' + '<br style="line-height:24px"></div>');
            }
            
        }

        (function() {
            var dropzone = document.getElementById('dropzone');
            
            var upload = function(files){
                var formData = new FormData(),
                
                    xhr = new XMLHttpRequest(),
                    x;
                    for(x = 0; x < files.length; x = x + 1) {
                        formData.append('userfile[]', files[x]);
                    }

                    formData.append('varNew[]', '<?php echo "$arrayfilenumber"; ?>' ),

                    xhr.onload = function() {
                        document.getElementById("loading-bar").className = "loaded";


                        var data = this.responseText;
                        document.getElementById("demo").innerHTML = data;
                        var readarray = document.getElementById("demo").innerHTML;

                        $('#file-info-accordions').delay(800).show("slow");
                        document.getElementById("selected-files-div").innerHTML = "<p>Selected Files:</p>";

                        addHiddenValue();
                        addDownloadSection();

                        if ( $('#dropzone').html().length == 0 ) {
                            populateDropzone();
                            populateDownloadSectionFiles()
                        }


                    }

                    xhr.responseType = "text";
                    xhr.open('post', 'upload.php');
                    xhr.send(formData);
                    document.getElementById("loading-bar").className = "loading";

            }


            dropzone.ondrop = function(e) {
                e.preventDefault();
                upload(e.dataTransfer.files);

                    this.className = 'dropzone dropped';


            }


            dropzone.ondragover = function () {
                this.className = 'dropzone dragover';
                return false;

            }
            dropzone.ondragleave = function(){
                this.className = 'dropzone'
            }

        }());
    </script>


    <div id="choosefromdatabase-content">
        <p>This is a test!</p>
        <p>This is a test!</p>
        <p>This is a test!</p>
    </div>
    <script>
        $('#uploadfilesbutton').click(function()
        {
            $('#dropzone-content').show("slow");
            $('#choosefromdatabase-content').hide("slow");
            $('#uploadfilesbutton').hide();
            $('#choosedatabasebutton').hide();
            $('#orspan').hide();


        });

        $('#choosedatabasebutton').click(function()
        {
            $('#dropzone-content').hide("slow");
            $('#choosefromdatabase-content').show("slow");
            $('#choosedatabasebutton').hide();
            $('#uploadfilesbutton').hide();
            $('#orspan').hide();

        });
        $("#dropzone").on("drop", function() {
            // $('#file-info-accordions').delay(800).show("slow");
        
        });

        $("#filechooserform").on("change", function()
        {
            // $('#file-info-accordions').delay(800).show("slow");

        });
    </script>





<!---- -------------------------------->

            <div id="file-info-accordions" >

                    <script>

                    function singleSelectChangeText(elementId) {

                            var selObj = document.getElementById(elementId);
                            var selValue = selObj.options[selObj.selectedIndex].text;
                            console.log(selValue);
                            // document.getElementById("textFieldTextJS").innerHTML = selValue;
                    }

                    </script>

                    <div class=third>
                        <h3>Play Songs</h3>
                        <button id="myBtn" class='openBtn buttonform'>Open</button>
                    </div>

                    <div id="myModal" class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <br>
                                <span class="close">&times;</span>
                                <h1 style='margin-bottom:40px'>Play Songs & Musical Notation</h1>
                            <div name="audioplayer" id="audioplayer">
                            </div>
                            <div id="musicalnotation">
                                <div id="notation-content">
                                        <p id=notationInstruction>To view musical notation, play a song on left</p>
                                        <div id="svg-button">
                                            <button style='display:none' id=saveSvgButton class="buttonform" onclick="saveHumdrumSvg('song_svg')">Save as .svg</button>
                                        </div>
                                        <script type="text/x-humdrum" id="song_svg"></script>
                                    </div>
                            </div>
                            </div>
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>

<script>

function addMusicalNotation( directory, name ) {
    $('#musicalnotation').delay(800).show("slow");

    var file = directory + "/song.txt"
    var div = document.getElementById("musicalnotation");

    var appendtext = 'displayHumdrum({autoResize: true,source: "song_svg",' + 'url:"' + file + '",scale: 35,spacingStaff: 12,})'

    displayHumdrum({
      source: "song_svg",
      scale: 25,
      url: file
    });

    var scriptNEW = document.createElement('script');
    scriptNEW.id = "displaysong";
    scriptNEW.text = appendtext;
    div.appendChild(scriptNEW);

}
</script>

<script>
function addHiddenValue() {
     var filearray = document.getElementById("demo").innerHTML;
     var parsed = JSON.parse(filearray);
     var filearraylocations = parsed.relativedirs;
     document.getElementsByName("filesarrayinput")[0].value = filearraylocations;
     document.getElementsByName("userfilelocations")[0].value = filearraylocations;
}

function changeDetailsMessage(){
    document.getElementById("infoexplain").innerHTML = "In order to add to our large collection of songs, please specify the following information about your files. Please note that provided information is assumed to apply to all songs."
}
</script>



                    <div class=third>
                        <h3>Add to BiB Database</h3>
                        <button id="myBtn" class='openBtn buttonform'>Open</button>
                    </div>

                    <div id="myModal" class="modal ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="close">&times;</span>
                                <p id="infoexplain">In order to add to our large collection of songs, please specify the following information about your files. Please note that provided information is assumed to apply to all songs.</p>
                                <form onsubmit="successDetailsMessage();addHiddenValue()" method="post" action="details-upload.php" name="infoform" id="infoform" target="votar" onchange="changeDetailsMessage()">
                                <div id="boi">Composer Name:&nbsp;&nbsp;
                                <input id="composer_input" name="composer_input" type="text"/>
                                </div>
                                <br>
                                <br>
                                <div id="TimePeriod_Dropdown" >
                                    Time Period:&nbsp;&nbsp;&nbsp;
                                    <select name="periodDropdown" id="periodDropdown">
                                        <option value="None">None</option>
                                        <option value="Renaissance">Renaissance</option>
                                        <option value="Baroque">Baroque</option>
                                        <option value="Classical">Classical</option>
                                        <option value="Romantic">Romantic</option>
                                        <option value="20th_Century">20th Century</option>
                                        <br>
                                    </select>
                                </div>
                                <br>
                                <input type="hidden" name='filesarrayinput' id="composer_input" value="test"/> 
                                <input type="submit" class="buttonform" value="Confirm" >
                                <p id="success-message-details"></p>
                                <br>
                                <br>

                            </form>
                            </div>
                        </div>
                    </div>

                <script>
                    function successDetailsMessage(){
                        document.getElementById("infoexplain").innerHTML = "The information has been recorded."
                    }
                </script>


                <script>
                    $('#dropzone').on("drop", function() {
                        populateDropzone();
                        populateDownloadSectionFiles()
                    });
                </script>

                    <a id="midianchor"></a>

                    <div class=third>
                        <h3>Download Conversions</h3>
                        <button id="myBtn" class='openBtn buttonform'>Open</button>
                    </div>

                    <div id="myModal" class="modal ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="close">&times;</span>
                                <h1>Download Files</h1>
                                <br>
                                <div id=downloadContent>

                                    <div id=selectFiles

                                        <div id=selectAllDownloadFiles class="filetypeDownload unselected" onclick="selectAllFiles(this.id)" style='vertical-align:middle'>
                                            <span style='position:relative;top:43%;'> Select All </span>
                                        </div>

                                        <div class=selectionSection id=downloadfilesselectionsection>
                                        </div>
                                    </div>
                                    
                                    
                                    <br>
                                    <br>
                                    
                                    <div id=selectFileTypes style='display:none;'>
                                        <div id=selectAllDownloadIcon class="filetypeDownload unselected" onclick="selectAllFileTypes(this.id)" style='vertical-align:middle'>
                                            <span style='position:relative;top:43%;'> Select All </span>
                                        </div>
                                        <div class=selectionSection>

                                            <div id=abcDownloadIcon class="filetypeDownload unselected" onclick="addSelectedClass(this.id)">
                                                <img src='icons-misc/conversions/abc.png' width=100px style="box-shadow:2px 2px 7px rgba(0,0,0,.5);border-radius:50%;margin:6.4px;"  ></img>
                                            </div>

                                            <div id=enpDownloadIcon class="filetypeDownload unselected" onclick="addSelectedClass(this.id)">
                                                <img src='icons-misc/conversions/enp.png' width=100px style="box-shadow:2px 2px 7px rgba(0,0,0,.5);border-radius:50%;margin:6.4px;"  ></img>
                                            </div>

                                            <div id=gmnDownloadIcon class="filetypeDownload unselected" onclick="addSelectedClass(this.id)">
                                                <img src='icons-misc/conversions/gmn.png' width=100px style="box-shadow:2px 2px 7px rgba(0,0,0,.5);border-radius:50%;margin:6.4px;"  ></img>
                                            </div>

                                            <div id=kernDownloadIcon class="filetypeDownload unselected" onclick="addSelectedClass(this.id)">
                                                <img src='icons-misc/conversions/kern.png' width=100px style="box-shadow:2px 2px 7px rgba(0,0,0,.5);border-radius:50%;margin:6.4px;"  ></img>
                                            </div>

                                            <div id=meiDownloadIcon class="filetypeDownload unselected" onclick="addSelectedClass(this.id)">
                                                <img src='icons-misc/conversions/mei.png' width=100px style="box-shadow:2px 2px 7px rgba(0,0,0,.5);border-radius:50%;margin:6.4px;"  ></img>
                                            </div>

                                            <div id=midiDownloadIcon class="filetypeDownload unselected" onclick="addSelectedClass(this.id)">
                                                <img src='icons-misc/conversions/midi.png' width=100px style="box-shadow:2px 2px 7px rgba(0,0,0,.5);border-radius:50%;margin:6.4px;"  ></img>
                                            </div>

                                            <div id=mp3DownloadIcon class="filetypeDownload unselected" onclick="addSelectedClass(this.id)">
                                                <img src='icons-misc/conversions/mp3.png' width=100px style="box-shadow:2px 2px 7px rgba(0,0,0,.5);border-radius:50%;margin:6.4px;"  ></img>
                                            </div>

                                            <div id=museDownloadIcon class="filetypeDownload unselected" onclick="addSelectedClass(this.id)">
                                                <img src='icons-misc/conversions/muse.png' width=100px style="box-shadow:2px 2px 7px rgba(0,0,0,.5);border-radius:50%;margin:6.4px;"  ></img>
                                            </div>

                                            <div id=xmlDownloadIcon class="filetypeDownload unselected" onclick="addSelectedClass(this.id)">
                                                <img src='icons-misc/conversions/xml.png' width=100px style="box-shadow:2px 2px 7px rgba(0,0,0,.5);border-radius:50%;margin:6.4px;"  ></img>
                                            </div>

                                        </div>
                                        
                                    </div>
                                    <div id=downloadSection>
                                    </div>
                                </div>
                                <br><br>

                            </div>
                        </div>
                    </div>
                    <script>


                        function selectAllFiles(id) {
                            var classname = document.getElementById(id).className
                            if (classname == 'filetypeDownload unselected') {
                                var els = document.getElementsByClassName('dropzonefileicons');
                                for (var i=0; i<els.length; i++)  {
                                    document.getElementsByClassName('dropzonefileicons')[i].className = 'dropzonefileicons selected'
                                }
                                document.getElementById(id).className = 'filetypeDownload selected'
                            }
                            if (classname == 'filetypeDownload selected') {
                                var els = document.getElementsByClassName('dropzonefileicons');
                                for (var i=0; i<els.length; i++)  {
                                    document.getElementsByClassName('dropzonefileicons')[i].className = 'dropzonefileicons unselected'
                                }
                                document.getElementById(id).className = 'filetypeDownload unselected'
                            }

                            $('#selectFileTypes').delay(200).show("slow");
                        }

                        function selectAllFileTypes(id) {
                            var classname = document.getElementById(id).className
                            if (classname == 'filetypeDownload unselected') {
                                var els = document.getElementsByClassName('filetypeDownload');
                                for (var i=1; i<els.length; i++)  {
                                    document.getElementsByClassName('filetypeDownload')[i].className = 'filetypeDownload selected'
                                }
                            }
                            if (classname == 'filetypeDownload selected') {
                                var els = document.getElementsByClassName('filetypeDownload');
                                for (var i=1; i<els.length; i++)  {
                                    document.getElementsByClassName('filetypeDownload')[i].className = 'filetypeDownload unselected'
                                }
                            }
                        }

                        function addSelectedClass(id) {
                            var el = document.getElementById(id);
                            var classo = el.className

                            if (classo == 'filetypeDownload unselected'){
                                el.className = '';
                                el.className = 'filetypeDownload selected'
                            }; 
                            if (classo == 'filetypeDownload selected') {
                                el.className = '';
                                el.className = 'filetypeDownload unselected';
                            }
                            $('#selectFileTypes').delay(200).show("slow");
                        }

                        function addSelectedClassFiles(id) {
                            var el = document.getElementById(id);
                            var classo = el.className

                            if (classo == 'dropzonefileicons unselected'){
                                el.className = '';
                                el.className = 'dropzonefileicons selected'
                            }; 
                            if (classo == 'dropzonefileicons selected') {
                                el.className = '';
                                el.className = 'dropzonefileicons unselected';
                            }
                            
                        }
                    </script>

                    <iframe name="votar" style="display:none;"></iframe>

                    
                    <script>
                        var modal = document.getElementsByClassName("modal")[0];
                        var btn = document.getElementsByClassName("openBtn")[0];
                        var span = document.getElementsByClassName("close")[0];
                        btn.onclick = function() {
                            modal.style.display = "block";
                            
                        }
                        span.onclick = function() {
                            modal.style.display = "none";
                        }

                        var modal2 = document.getElementsByClassName("modal")[1];
                        var btn2 = document.getElementsByClassName("openBtn")[1];
                        var span2 = document.getElementsByClassName("close")[1];

                        btn2.onclick = function() {
                            modal2.style.display = "block";
                        }
                        span2.onclick = function() {
                            modal2.style.display = "none";
                        }

                        var modal3 = document.getElementsByClassName("modal")[2];
                        var btn3 = document.getElementsByClassName("openBtn")[2];
                        var span3 = document.getElementsByClassName("close")[2];

                        btn3.onclick = function() {
                            modal3.style.display = "block";
                        }
                        span3.onclick = function() {
                            modal3.style.display = "none";
                        }
                        window.onclick = function(event) {
                            if (event.target == modal2) {
                                modal2.style.display = "none";
                            }
                            if (event.target == modal3) {
                                modal3.style.display = "none";
                            }
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        }
                    </script>

                    <script >
                            function unCheckAll(formname) {
                            var checkboxes = new Array(); 
                            checkboxes = document[formname].getElementsByTagName('input');
                            
                            for (var i=0; i<checkboxes.length; i++)  {
                                if (checkboxes[i].type == 'checkbox')   {
                                    checkboxes[i].checked = false;
                                }
                            }

                            document.getElementById("check-all").innerHTML = '<label class="buttonform">Check All<input type=checkbox style="display:none" class="buttonform" onclick="checkAll(\'analysis-form\')"  />';
                            }

                        function checkAll(formname){
                        var checkboxes = new Array(); 
                        checkboxes = document[formname].getElementsByTagName('input');
                        
                        for (var i=0; i<checkboxes.length; i++)  {
                            if (checkboxes[i].type == 'checkbox')   {
                                checkboxes[i].checked = true;
                            }
                        }

                        document.getElementById("check-all").innerHTML = '<label class="buttonformfilled">Uncheck All<input checked=checked type=checkbox class="buttonform" style="display:none" onclick="unCheckAll(\'analysis-form\')"  />';
                        }

                    </script>

        <form method="post" action="analysis.php" onsubmit="addHiddenValue();startLoader()" name="analysis-form">
            <br/>

            <br>
            <br>
            <div class=mainSection>
                <h1 id="data-heading">Select Analysis Types</h1>

                <br>
                <div id="check-all">
                    <label class="buttonform">Check All
                        <input style="display:none" type=checkbox class="buttonform" onclick="checkAll('analysis-form')"  />
                    </label>
                </div>
                <br>

                <div id=pitch style='display:inline-block;vertical-align:middle;margin-right:68px;'>
                    <h2 style='margin-bottom:12px'>Pitch:</h2>
                    <div id=pitchSwitchLabels style='display:inline-block;line-height:28px;text-align:left;font-size:18px;margin-right:8px;'>
                        <span class=switchesLabel>Scales</span><br>
                        <span class=switchesLabel>Key Signature</span><br>
                        <span class=switchesLabel>Average Pitch</span><br>
                        <span class=switchesLabel>Average Steps</span><br>
                        <span class=switchesLabel>Pitch Distribution</span><br>
                        <span class=switchesLabel>Repeated Pitches</span>
                    </div>

                    <div id=pitchSwitches style='display:inline-block;'>
                        <label class="switch">
                            <input type="checkbox" name="data-choose[]" value="scales.sh">
                            <span class="slider round"></span>
                        </label>
                        <br>

                        <label class="switch">
                            <input type="checkbox" name="data-choose[]" value="key-signature.sh" >
                            <span class="slider round"></span>
                        </label>
                        <br>

                        <label class="switch">
                            <input type="checkbox" name="data-choose[]" value="average-pitch.sh" >
                            <span class="slider round"></span>
                        </label>
                        <br>

                        <label class="switch">
                            <input type="checkbox" name="data-choose[]" value="average-steps.sh" >
                            <span class="slider round"></span>
                        </label>
                        <br>

                        <label class="switch">
                            <input type="checkbox" name="data-choose[]" value="most-used-pitches.sh" >
                            <span class="slider round"></span>
                        </label>
                        <br>

                        <label class="switch">
                            <input type="checkbox" name="data-choose[]" value="repeated-pitches.sh" >
                            <span class="slider round"></span>
                        </label>
                        <br>
                    </div>
                </div>
                
                <div id=rhythm style='display:inline-block;vertical-align:top'>
                    <h2 style='margin-bottom:20px'>Rhythm:</h2>
                    <div id=noteValueSwitchLabels style='display:inline-block;line-height:28px;text-align:left;font-size:18px;argin-right:8px;'>
                        <span class=switchesLabel>Time Signature</span><br>
                        <span class=switchesLabel>Average Note Value</span><br>
                        <span class=switchesLabel>Repeated Note Value</span><br>
                        <span class=switchesLabel>Note Value Distribution</span><br>
                    </div>

                    <div id=rhythmSwitches style='display:inline-block;'>

                        <label class="switch">
                            <input type="checkbox" name="data-choose[]" value="time-signature.sh" >
                            <span class="slider round"></span>
                        </label>
                        <br>

                        <label class="switch">
                            <input type="checkbox" name="data-choose[]" value="average-note-value.sh">
                            <span class="slider round"></span>
                        </label>
                        <br>

                        <label class="switch">
                            <input type="checkbox" name="data-choose[]" value="repeated-note-value.sh" >
                            <span class="slider round"></span>
                        </label>
                        <br>

                        <label class="switch">
                            <input type="checkbox" name="data-choose[]" value="most-used-note-value.sh" >
                            <span class="slider round"></span>
                        </label>

                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                    <input type="submit" id="submit" name="submit" class="buttonform" value="Begin Analysis" >
                    <input type="hidden" name='userfilelocations'/> 
                </form>
                <br>
                <br>
            </div> 
        </div>
    <script>
        function startLoader(){
            document.getElementById("loading-bar").className = "loading";
        }
    </script>
    <br>
    <br>

    <div id="footer">
    </div>
    </div id=file-info-accordions>

    <script>
        
        // $(window).bind('beforeunload', function(){
        //      return 'Your changes will not be saved! Continue?';
        // });
    </script>


    </div>

    <footer>
        
        <br>
        <div id=footerLogo>
            <img src="image-assets/footerbanner.png" height=40px></img>
        </div>
        <hr>
        <br>
        <div id=footerContent>
            <div class=half>
                <div id=footermenu>
                    <p class=footerMenuItem>Home
                    <p class=footerMenuSeparater>|
                    <p href=about.html#contact class=footerMenuItem><a class="hoverme" href=about.html#contact>Analysis Tools</a></p>
                    <p class=footerMenuSeparater>|</p>
                    <p class=footerMenuItem><a class="hoverme" href=about.html>About</a></p>
                    <p class=footerMenuSeparater>|
                    <p class=footerMenuItem><a class="hoverme" href=code.html>Code</a></p>
                    <p class=footerMenuSeparater>|
                    <p class=footerMenuItem><a class="hoverme" href=research.html>Research</a></p>
                    <p class=footerMenuSeparater>|
                    <p class=footerMenuItem><a class="hoverme" href=library.html>Database</a></p>
                </div>
            </div>
            <br>
            <br>
            <div class=half id=contactInfo>
                <span>For questions and comments, contact: <a style='color: #54b4ff' href="mailto:beatsinbytesofficial@gmail.com?subject=">beatsinbytesofficial@gmail.com</a></span>
            </div>
            <br>
            
        </div>
        <br>
        <hr>
        <br>
        <div id=footerUpdated style='text-align:left; margin-left: 12%;'> 
            <span >Beats in Bytes - Updated June 1st, 2019</span>
        </div>
        <br>

    </footer>
        </div>
</body>


</html>