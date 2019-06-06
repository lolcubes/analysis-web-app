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


$folderOutput = str_replace("dropzonefileicons", "", $files[0]);
$folderOutputPath = "Song_Database/" . $folderOutput . "/selectedConversions";
echo $folderOutputPath;
echo "<br>";



foreach ($files as $file){
    $file = str_replace("dropzonefileicons", "", $file);
    $path = "Song_Database/" . $file . "/data-conversions/";
    foreach ($types as $type) {
        $type = str_replace("DownloadIcon", "", $type);
        $typepath = $path . "song." . $type;
        echo $typepath;
        echo "<br>";
    }
}

?>