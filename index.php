<!DOCTYPE html>
<html>
    <head>
        <title>Beats in Bytes - Analysis Tools</title>
        <link rel="stylesheet" type="text/css" href="styletestboi.css" />
        <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="favicon.png"/>
        <script src="https://verovio-script.humdrum.org/scripts/verovio-toolkit.js"></script>
        <script src="https://plugin.humdrum.org/scripts/humdrum-notation-plugin.js"></script>
        <script> var vrvToolkit = new verovio.toolkit(); </script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
        <script src="http://malsup.github.com/jquery.form.js"></script> 
</head>

    <body id=home>
            <div id="navbarr">
                <ul id=navbar>
                    <a  href="index.php"><img id="headerbanner" src="headerbanner.png" alt="Header logo" height="50px" width="260" align="middle"></a>
                    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                    <!-- <li id="Menu" class="logoimage"><img src="headerbanner.png" alt="Header logo" height="60px" width="313px"></img></li> -->
                    <li id="Menu"><a href="index.php">Home</a></li>
                    <li id="Menu"><a href="pages/about.html">About</a></li>
                    <li id="Menu"><a href="pages/code.html">Code</a></li>
                    <li id="Menu"><a href="pages/research.html">Our Research</a></li>
                    <li id="Menu"><a href="pages/library.html">Database</a></li>
                    <li id="Menu"><a href="pages/analysis-tools.html">Analysis Tools</a></li>
                </ul>
            </div>
            <div id="bumper">
</div>

<!-- 
<script>
    window.onscroll = function() {myFunction()};

// Get the header
var header = document.getElementById("navbarbar");

// Get the offset position of the navbar
var sticky = header.offsetTop;

// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
    </script> -->
<!---- -------------------------------->

<?php
    $arrayfilenumber = shell_exec( "/Applications/MAMP/htdocs/NewTestings/array-number-finder.sh");
    $arrayfiledirectory = "/Applications/MAMP/htdocs/NewTestings/Array_Lists/" . "$arrayfilenumber" . ".txt";
    shell_exec( "touch $arrayfiledirectory");
?>

<br>
<div id="center">
<br>
<button class="buttonform" id="uploadfilesbutton">Upload File</button>
&nbsp;&nbsp;&nbsp;
<span id="orspan">or</span>
&nbsp;&nbsp;&nbsp;
<button class="buttonform" id="choosedatabasebutton">Choose From Database</button>
<p id=demo ></p>

<a id=testanchor></a>


    <div id="dropzone-content">

        <div id="dropzone" class="dropzone" >
            <p>Drop Files
                <br>
                <br>
                <br>
                or
            </p>
            <div id="plusfile">
                    <form target="votar" method="post" enctype="multipart/form-data" target="uploaddirect" id="filechooserform" name="filechooserform" onchange="filechooserform.submit();">
                        <input class="inputfile" name="userfile[]" type="file" multiple value="Choose Files" id="uploadchooser"  data-form="filechooserform" /><br />
                        <label for="uploadchooser" class="buttonform"><span>Add Files</span></label>
                        <input type='hidden' name='varNew[]' value='<?php echo "$arrayfilenumber";?>'/> 
                    </form>
                    <br>
                    <br>
                    <div id="myProgress">
                        <div id="myBar">
                            0%
                        </div>
                    </div>
            </div>
        </div>
    </div>

<script id="uploader">
   $('#inserting_btn').click(function(){
        var file = $('#inserting_file').val();
        $.ajax({
            method: 'POST',
            url: 'input_text/import.php',
            data: 'file='+file,
            success: function(data){
                alert(data);
            }
        });
    });
</script>


    <script id="cleardropzone">

$( "#dropzone" ).on("drop", function() {
    $('#dropzone').children().delay(800).fadeOut(500).promise().then(function() {
        $('#dropzone').empty();
    });
});



</script>

    
    
    <script>
        function toObject(names, values) {
            var result = {};
            for (var i = 0; i < names.length; i++)
                result[names[i]] = values[i];
            // obj[Object.keys(obj)[0]];
            console.log(result);
            console.log(Object.values(result));
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
                        var data = this.responseText;
                        document.getElementById("demo").innerHTML = data;

  
                    }

                    xhr.responseType = "text";
                    xhr.open('post', 'upload.php');
                    xhr.send(formData);
                    
            }


            dropzone.ondrop = function(e) {
                e.preventDefault();
                upload(e.dataTransfer.files);
                var elem = document.getElementById("myBar");
                var width = 1;
                var id = setInterval(frame, 2);
                function frame() {
                    if (width >= 100) {
                    clearInterval(id);
                    } else {
                    width++;
                    elem.style.width = width + '%';
                    elem.innerHTML = width * 1 + '%';
                    }

                }

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
            $('#file-info-accordions').delay(800).show("slow");

        });

        $("#filechooserform").on("change", function()
        {
            $('#file-info-accordions').delay(800).show("slow");

        });
    </script>





<!---- -------------------------------->

            <div id="file-info-accordions" >

                    <script>

                    jQuery(document).ready(function ($) { 
                        $("#editortextarea").load("file.txt");
                    })

                        // document.getElementById("editortextarea").value = textvalue;

                    </script>

                    <script>

                    function singleSelectChangeText() {

                            var selObj = document.getElementById("editordropdown");
                            var selValue = selObj.options[selObj.selectedIndex].text;

                            document.getElementById("textFieldTextJS").innerHTML = selValue;
                        }

                    </script>


                <button class="accordion" id="editorbutton">Download Files and Conversions</button>

                <div class="panel">
                    <span>Select A File To Edit: &nbsp; &nbsp; &nbsp; &nbsp;</span>

                            <select name="editor" id="editordropdown" onchange=singleSelectChangeText()>
                                <option value="" selected disabled hidden>
                                    Select a song
                                </option>
                            </select>

                        <form target="votar">
                            </textarea>
                            <br>
                            <input type="submit" id="buttonone" class="buttonform" value="Download Selected Files" name="buttonone"/>
                        </form>
                        <p id="textFieldTextJS">replaceo</p>

                </div>

                <button class="accordion">Add File Details (Optional)</button>
                    <div class="panel">
                        <p>In order to add to our large collection of songs, please specify the following information about your files</p>
                            <form>
                                <div id="boi">Song Name:&nbsp;&nbsp;&nbsp;<input id="composer_input" type="text"/>
                                </div>
                                <br>
                                <br>
                                <div id="TimePeriod_Dropdown" >
                                    Time Period:&nbsp;&nbsp;&nbsp;
                                    <select name="periodDropdown">
                                        <option value="volvo">Renaissance</option>
                                        <option value="saab">Baroque</option>
                                        <option value="fiat">Classical</option>
                                        <option value="audi">Romantic</option>
                                        <option value="audi">20th Century</option>
                                        <br>
                                    </select>
                                </div>
                            </form>
                    </div>
    <!----------------------- -->
    <script>

    $('#editorbutton').click(function() {
        // document.getElementById("getmyelementbyid").innerHTML = "<?php// echo $arrayfiledirectory;?>";

        var readarray = document.getElementById("demo").innerHTML;
        var arrayparsed = JSON.parse(readarray);
        var arraynames = arrayparsed.filetype
        console.log(arraynames);

        var select = document.getElementById("editordropdown");
                
        for (var i = 0; i < arraynames.length; i++)
        {
            var option = document.createElement("OPTION"),
                txt = document.createTextNode(arraynames[i]);
            option.appendChild(txt);
            option.setAttribute("value",arraynames[i]);
            select.insertBefore(option,select.lastChild);
        }
    });

    </script>

                <a id="midianchor"></a>

                <button class="accordion">Play Song and View as Music</button>
                    <div class="panel">
                        <br>
                        <!-- <span id=musicalnotation>Musical Notation:</span>
                        <span class="button right" onclick="saveHumdrumSvg('SongNameHere')">Save as .svg</span>

                        <script id="displaysong">
                        displayHumdrum({
                            autoResize: true,
                            source: "SongNameHere",
                            url: "file.txt",
                            scale: 35,
                            spacingStaff: 12,
                        })

                        </script>
                        <script type="text/x-humdrum" id="SongNameHere"></script> -->
    <br>
    <br>
                    <iframe name="votar" style="display:none;"></iframe>

                    <form target="votar" method="post">
                    <input type="submit" name="playsongbutton" value="Play Song" class="buttonform" />
                    </form>


                    <?php
                        if (isset($_GET['playsongbutton'])) {
                            $output = exec("/Applications/MAMP/htdocs/NewTestings/hum2mid file.txt -o file.mid");
                        }
                    ?>

                </div>
                <script>
                var acc = document.getElementsByClassName("accordion");
                var i;

                for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var panel = this.nextElementSibling;
                    if (panel.style.maxHeight){
                    panel.style.maxHeight = null;
                    } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                    } 
                });
                }
                </script>

        


        <form method="post">
            <br/>

            <br>
            <br>

            <hr>
            <h2>Select Analysis Types:</h2>

            <label class="container">Key Signature
            <input type="checkbox" name="keysig" value="checked">
            <span class="checkmark"></span>
            </label>

            <label class="container">Repeated Note Value
            <input type="checkbox" name="repeatednotevalue" value="checked" >
            <span class="checkmark"></span>
            </label>

            <label class="container">Average Note Value
            <input type="checkbox" name="averagenotevalue" value="checked" >
            <span class="checkmark"></span>
            </label>

            <label class="container">Most Used Note Value
            <input type="radio" name="mostusednotevalue" value="checked" >
            <span class="checkmark"></span>
            </label>
            </form>

            <br>
            <br>
            <button type="submit" id="submit" name="submit" class="buttonform">Begin Analysis</button>


            <form>
        <button type="submit" name="degtest" id="degtest">deg me!</button>
        </form>
        <?php
        if (isset($_GET['degtest'])) {
            $output = shell_exec( "/Applications/MAMP/htdocs/NewTestings/degrunner.sh file.txt");
            echo $output;
        }
        ?>

        <form>
            <button type="submit" name="wavme" id="wavme">convert to music</button>
        </form>

        <?php
        if (isset($_GET['wavme'])) {
            echo "test";
            exec("/Applications/MAMP/htdocs/NewTestings/Timidity/bin/timidity /Applications/MAMP/htdocs/NewTestings/file.mid -Ow");
        }
        ?>

    </div>



    <div id="footer">
    </div>
    </div id=file-info-accordions>


    
</body>





</html>