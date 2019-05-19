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
            <div id="navbarr" >
                <ul id=navbar>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>

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
    populateDropdown("playSongDropdown");


});

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
                $("#dropzone").append( '<div id="dropzonefileicons">' + '<img src=' + icon + " height=90px;" + '>' + '<p>' + name + '</p>' + '<p>' + thissize + ' kb' + '</p>' + '</div>');
            }
            
        }

</script>

<script>
$("body").on('DOMSubtreeModified', "#demo", function() {
    $('#dropzone').empty();

    populateDropzone();
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
            populateDropzone();
        }
    });
});

</script>



<script>
function addAudioPlayers(){

    var array = document.getElementById("demo").innerHTML;
    var arrayparsed = JSON.parse(array);
    var dirs = arrayparsed.relativedirs;
    var names = arrayparsed.names;
    document.getElementById("audioplayer").innerHTML = "";


    for (i=0; i<names.length; i++){ 
        var name = names[i];
        var dir = dirs[i];

        var appendtext = '<audio id="audio-player-element" onplaying="addMusicalNotation(' + "'" + dir + "'" +  ", " + "'" + name + "'" + ')" controls="controls" src="' + dir + '/song.wav" type="audio/wav">'
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
            for (var i = 0; i < icons.length; i += 1) {
                var icon = icons[i];
                var name = names[i];
                $("#dropzone").append( '<div id="dropzonefileicons">' + '<img src=' + icon + " height=70px;" + '>' + '<p>' + name + '</p>' + '</div>');
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

                        populateDropdown("playSongDropdown");
                        addHiddenValue();

                        if ( $('#dropzone').html().length == 0 ) {
                            populateDropzone();
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



                <div class="panels">
                            <p>Play chosen songs:</p>
                            <div name="audioplayer" id="audioplayer">

                            </div>
                            <div id="musicalnotation">
                                <p>View musical notation:</p>
                                <div id="notation-content">
                                        <div id="svg-button">
                                            <button class="buttonform" onclick="saveHumdrumSvg('song_svg')">Save as .svg</button>
                                        </div>
                                        <script type="text/x-humdrum" id="song_svg"></script>
                                    </div>
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

<!-- ADD THE addHiddenValue() function on ajax load? -->
                    <div class="panels">

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

                <script>
                    function successDetailsMessage(){
                        document.getElementById("infoexplain").innerHTML = "The information has been recorded."
                    }
                </script>


                <script>
                    $('#dropzone').on("drop", function() {
                        populateDropzone();

                    });
                </script>

                    <a id="midianchor"></a>


                    <div class="panels">
                        <p>To begin, please choose one of your uploaded songs.</p>


                        <select name="editor" id="playSongDropdown" onchange="singleSelectChangeText('playSongDropdown')">
                            <option value="" selected disabled hidden>
                                Select a song
                            </option>
                        </select>

                        <br>
                        <!-- <button class="buttonform" onclick="saveHumdrumSvg('song_svg')">Save as .svg</button>
                        <script id="displaysong">displayHumdrum({autoResize: true,source: "song_svg",url:"Song_Database/3_1/song.txt",scale: 35,spacingStaff: 12,})</script>
                        <script type="text/x-humdrum" id="song_svg"></script> -->
                        <br>
                        <br>
                        <iframe name="votar" style="display:none;"></iframe>

                    </div>


                    <script >
                            function unCheckAll(formname) {
                            var checkboxes = new Array(); 
                            checkboxes = document[formname].getElementsByTagName('input');
                            
                            for (var i=0; i<checkboxes.length; i++)  {
                                if (checkboxes[i].type == 'checkbox')   {
                                    checkboxes[i].checked = false;
                                }
                            }

                            document.getElementById("check-all").innerHTML = '<label class="container">Check All&nbsp;&nbsp;<input type=checkbox class="buttonform" onclick="checkAll(\'analysis-form\')"  /><span class="checkmark"></span>';
                            }


                        function checkAll(formname){
                        var checkboxes = new Array(); 
                        checkboxes = document[formname].getElementsByTagName('input');
                        
                        for (var i=0; i<checkboxes.length; i++)  {
                            if (checkboxes[i].type == 'checkbox')   {
                                checkboxes[i].checked = true;
                            }
                        }

                        document.getElementById("check-all").innerHTML = '<label class="container">Check All&nbsp;&nbsp;<input checked=checked type=checkbox class="buttonform" onclick="unCheckAll(\'analysis-form\')"  /><span class="checkmark"></span>';
                        }

                    </script>

        <form method="post" action="analysis.php" onsubmit="addHiddenValue();startLoader()" name="analysis-form">
            <br/>

            <br>
            <br>

            <hr>

            <h2 id="data-heading">Select Analysis Types:</h2>

            <br>
            <div id="check-all">
                <label class="container">Check All&nbsp;&nbsp;
                    <input type=checkbox class="buttonform" onclick="checkAll('analysis-form')"  />
                    <span class="checkmark"></span>
                </label>
            </div>
            <br>
            <div id="data-types" class="panels">
                
            <div id="heading">
                <p id="data-heading">Pitch:</p>
            </div>
            <br>
            <br>
            
                <label class="container">Scales&nbsp;&nbsp;
                    <input type="checkbox" name="data-choose[]" value="scales.sh">
                    <span class="checkmark"></span>
                </label>

                <label class="container">Key Signature&nbsp;&nbsp;
                    <input type="checkbox" name="data-choose[]" value="key-signature.sh" >
                    <span class="checkmark"></span>
                </label>

                <label class="container">Average Pitch&nbsp;&nbsp;
                    <input type="checkbox" name="data-choose[]" value="average-pitch.sh" >
                    <span class="checkmark"></span>
                </label>

                <label class="container">Average Steps&nbsp;&nbsp;
                    <input type="checkbox" name="data-choose[]" value="average-steps.sh" >
                    <span class="checkmark"></span>
                </label>

                <label class="container">Most Used Pitches&nbsp;&nbsp;
                    <input type="checkbox" name="data-choose[]" value="most-used-pitches.sh" >
                    <span class="checkmark"></span>
                </label>

                <label class="container">Repeated Pitches&nbsp;&nbsp;
                    <input type="checkbox" name="data-choose[]" value="repeated-pitches.sh" >
                    <span class="checkmark"></span>
                </label>
            </div>

            <div id="data-types" class="panels">
                <div id="heading">
                    <p id="data-heading">Rhythm:</p>
                </div>
                <br>
                <br>

                <label class="container">Average Note Value&nbsp;&nbsp;
                    <input type="checkbox" name="data-choose[]" value="average-note-value.sh">
                    <span class="checkmark"></span>
                </label>

                <label class="container">Repeated Note Value&nbsp;&nbsp;
                    <input type="checkbox" name="data-choose[]" value="repeated-note-value.sh" >
                    <span class="checkmark"></span>
                </label>

                <label class="container">Time Signature&nbsp;&nbsp;
                    <input type="checkbox" name="data-choose[]" value="time-signature.sh" >
                    <span class="checkmark"></span>
                </label>

                <label class="container">Most Used Note Value&nbsp;&nbsp;
                    <input type="checkbox" name="data-choose[]" value="most-used-note-value.sh" >
                    <span class="checkmark"></span>
                </label>
            </div>

            <br>
            <br>
                <input type="submit" id="submit" name="submit" class="buttonform" value="Begin Analysis" >
                <input type="hidden" name='userfilelocations'/> 
            </form>

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
    
</body>

</html>