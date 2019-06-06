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
mkdir($folderOutputPath);

 


foreach ($files as $file){
    $file = str_replace("dropzonefileicons", "", $file);
    $path = "Song_Database/" . $file . "/data-conversions/";

    $songOutputPath = $folderOutputPath . "/" . $file;
    mkdir($songOutputPath);


    foreach ($types as $type) {
        $type = str_replace("DownloadIcon", "", $type);
        $oldpath = $path . "song." . $type;

        $newPath = $folderOutputPath . "/" . $file . "/song." . $type;

        copy($oldpath, $newPath);
    }
}

$cdDir = "Song_Database/" . $folderOutput;
shell_exec("cd $cdDir && zip -r conversions.zip selectedConversions");


$zipDir = $cdDir . "/conversions.zip";
echo $zipDir;

header("Content-type: application/zip"); 
header("Content-Disposition: attachment; filename=$zipDir");
header("Content-length: " . filesize($zipDir));
header("Pragma: no-cache"); 
header("Expires: 0"); 
readfile("$zipDir");
?>