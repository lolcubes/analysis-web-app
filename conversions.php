<?php

$recieved = $_POST['downloadsFilesTypes'];
$recieved = explode(",", $recieved);


$files = array();
$types = array();

foreach ($recieved as $value) {

    $testFile = substr($value, 0, 17);

    if ( $testFile == "dropzonefileicons" ){
        $files[] = $value;
    }
    else {
        $types[] = $value;
    }
}


$folderOutput = $files[0];
echo $folderOutput;
$folderOutputPath = "Song_Database/" . $folderOutput . "/selectedConversions";
echo $folderOutputPath;



foreach ($files as $file){
    $file = str_replace("dropzonefileicons", "", $file);
    $path = "Song_Database/" . $file . "/data-conversions/";
    foreach ($types as $type) {
        $type = str_replace("DownloadIcon", "", $type);
        $typepath = $path . "song." . $type;
        echo file_get_contents($typepath);
        echo "<br>";
    }
}

?>