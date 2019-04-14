<?php
            function array_replace_value(&$ar, $value, $replacement)
            {
                if (($key = array_search($ar, $value)) !== FALSE) {
                    $ar[$key] = $replacement;
                }
            }            
            
            
            $filenames = $_FILES['userfile']['name'];

            $filetmpnames = $_FILES['userfile']['tmp_name'];
            $filenumber = sizeof($_FILES['userfile']['name']);
            $type = $_FILES['userfile']['type'];
            $filedirs = array();
			$filedirlocations = array();

            foreach ($filenames as $value) {
                $value = substr($value, 0, strpos($value, "."));
                $numberfolders = shell_exec("/Applications/MAMP/htdocs/NewTestings/foldermaker.sh | tr -d ' '");
                $numberfolders = str_replace(array("\n", "\r"), '', $numberfolders);

                $filedir = $numberfolders . "_" . $value;
                mkdir("/Applications/MAMP/htdocs/NewTestings/Song_Database/$filedir");
				$filedirs[] = $filedir;
				$filedirlocations[] = "/Applications/MAMP/htdocs/NewTestings/Song_Database/" . "$filedir";
            }

            for( $i = 0; $i<$filenumber; $i++ ) {
                $tmp = $filetmpnames[$i];
                $foldername = $filedirs[$i];
                $destination = "/Applications/MAMP/htdocs/NewTestings/Song_Database/" . "$foldername" . "/song.txt" ;
                move_uploaded_file ($tmp , $destination );
			 }    
            $myJSON = json_encode($filenames);
            $myJSON2 = json_encode($filedirs);

            $myJSON3 = json_encode($filedirlocations, JSON_UNESCAPED_SLASHES);
            $myJSON4 = json_encode($type, JSON_UNESCAPED_SLASHES);
            $myJSONcombined = "{\"names\":" . "$myJSON" . "," . "\"phyisicalnames\":" . "$myJSON2" . "," . "\"filelocations\":" . "$myJSON3" . "," . "\"filetype\":" . "$myJSON4" . "}";
            
            echo $myJSONcombined;

            $varNew = $_POST['varNew'];

            $arraydirectory = "/Applications/MAMP/htdocs/NewTestings/Array_Lists/" . "$varNew[0]" . ".txt";

            file_put_contents("$arraydirectory", "$myJSONcombined");


            //  return $arraynumeral;
			//  $myJSON2 = json_encode($filedirs);
            //  echo $myJSON2;


            $output = str_replace("text/plain", "boii", $type);
            $output2 = str_replace("text/x-sh", "boii34", $output);
            echo "<pre>";
            echo json_encode($output2, JSON_UNESCAPED_SLASHES);
            echo "</pre>"

?>