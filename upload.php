<?php       
           
            #=============================
            # Recieves the files array
            #=============================
            $filenames = $_FILES['userfile']['name'];
            $filesizes = $_FILES['userfile']['size'];
            

            #======================================================
            # rounds the file sizes of each file, returns an array
            #-=====================================================
            $filesize = array_map( function($val) { return $val * 0.01; }, $filesizes);
            foreach(array_keys($filesize) AS $ek){ //Get key of each value so it can be set back to itself 
                $filesize[$ek] = round($filesize[$ek]); //Do rounding 
            } 

            #====================================================
            # Assigns vars to names, amount of files, type of file
            #====================================================
            $filetmpnames = $_FILES['userfile']['tmp_name'];
            $filenumber = sizeof($_FILES['userfile']['name']);
            $type = $_FILES['userfile']['type'];

            #========================================================
            # Creates empty arrays for the directories and locations
            #========================================================
            $filedirs = array();
            $filedirlocations = array();
            $relativefiledirlocations = array();

            #==================================================
            # Creates array of folder names, makes the folders
            #==================================================
            foreach ($filenames as $value) {
                $value = substr($value, 0, strpos($value, "."));
                $value = str_replace(' ', '_', $value);
                $numberfolders = shell_exec("./foldermaker.sh | tr -d ' '");
                $numberfolders = str_replace(array("\n", "\r"), '', $numberfolders);

                $filedir = $numberfolders . "_" . $value;
                
                mkdir("Song_Database/$filedir");
				$filedirs[] = $filedir;
                $filedirlocations[] = "Song_Database/" . "$filedir";
                $relativefiledirlocations[] = "Song_Database" . "/" . "$filedir";
            }

            #===========================================
            # Moves to temp files to their destination
            #===========================================
            for( $i = 0; $i<$filenumber; $i++ ) {
                $tmp = $filetmpnames[$i];
                $foldername = $filedirs[$i];
                $destination = "Song_Database/" . "$foldername" . "/song.txt" ;
                move_uploaded_file($tmp , $destination );
             }    

            #===================================================================
            # Creates various JSON encodings of arrays to be passed to the index
            #===================================================================
            $myJSON = json_encode($filenames);
            $myJSON2 = json_encode($filedirs);
            $myJSON3 = json_encode($filedirlocations, JSON_UNESCAPED_SLASHES);
            $myJSON4 = json_encode($type, JSON_UNESCAPED_SLASHES);
            $myJSON5 = json_encode($filesize, JSON_UNESCAPED_SLASHES);
            $myJSON6 = json_encode($relativefiledirlocations, JSON_UNESCAPED_SLASHES);

            #===========================================
            # Gives icon directories based on filetype
            #===========================================
            $output = str_replace("text/plain", "file-icons/txt.png", $type);
            $output2 = str_replace("text/x-sh", "file-icons/sh.png", $output);
            $output3 = str_replace("application/octet-stream", "file-icons/krn.png", $output2);
            $output4 = str_replace("audio/midi", "file-icons/midi.png", $output3);
            $output5 = str_replace("audio/mp3", "file-icons/mp3.png", $output4);
            $finaloutput = json_encode($output5, JSON_UNESCAPED_SLASHES);    
      
            #=======================================================
            # Combines all json encodings, echoes (passes to index)
            #======================================================
            $myJSONcombined = "{\"names\":" . "$myJSON" . "," . "\"phyisicalnames\":" . "$myJSON2" . "," . "\"filelocations\":" . "$myJSON3" . "," . "\"filetype\":" . "$myJSON4" . "," . "\"fileicon\":" . "$finaloutput" . "," . "\"filesize\":" . "$myJSON5" . "," . "\"relativedirs\":" . "$myJSON6" . "}";
            echo $myJSONcombined;

            #======================================
            # Creates conversions and image assets
            #======================================
            foreach ($relativefiledirlocations as $filedirectory){ 
                $fileconvert = "$filedirectory" . "/song.txt";
                $target = "$filedirectory" . "/song.mid";
                $degoutput = "$filedirectory" . "/deg.txt";
                $assetsdir = "$filedirectory" . "/image-assets";
                $conversionsDir = "$filedirectory" . "/data-conversions";

                mkdir($conversionsDir);
                mkdir($assetsdir);

                $abcOutput = $conversionsDir . "/song.abc";
                $enpOutput = $conversionsDir . "/song.enp";
                $gmnOutput = $conversionsDir . "/song.gmn";
                $meiOutput = $conversionsDir . "/song.mei";
                $museOutput = $conversionsDir . "/song.md2";
                $xmlOutput = $conversionsDir . "/song.xml";

                $prolloutput = "$filedirectory" . "/image-assets/proll.ppm";
                $prolloutputpng = "$filedirectory" . "/image-assets/proll.png";
                $keyscapeoutput = "$filedirectory" . "/image-assets/keyscape.ppm";
                $keyscapeoutputpng = "$filedirectory" . "/image-assets/keyscape.png";

                exec("analysis-scripts/humdrum/conversions/hum2abc $fileconvert | grep -v '^%%abcx-conversion-date' > $abcOutput");
                exec("analysis-scripts/humdrum/conversions/hum2enp $fileconvert > $enpOutput");
                exec("analysis-scripts/humdrum/conversions/hum2gmn $fileconvert | grep -v Converted > $gmnOutput");
                exec("analysis-scripts/humdrum/conversions/hum2mei $fileconvert > $meiOutput");
                exec("analysis-scripts/humdrum/conversions/hum2muse $fileconvert > $museOutput");
                exec("analysis-scripts/humdrum/conversions/hum2xml $fileconvert > $xmlOutput");

                exec("analysis-scripts/humdrum/hum2mid $fileconvert -o $target");
                shell_exec( "timidity $target -Ow");
                shell_exec( "analysis-scripts/humdrum/deg/degrunner.sh $fileconvert $degoutput");
                shell_exec( "analysis-scripts/humdrum/proll -K $fileconvert > $prolloutput");

                shell_exec( "analysis-scripts/humdrum/mkeyscape $target > $keyscapeoutput");
                shell_exec("pnmtopng -transparent white $keyscapeoutput > $keyscapeoutputpng");

                shell_exec( "pnmtopng $prolloutput -transparent black > $prolloutputpng");
            }       

?>