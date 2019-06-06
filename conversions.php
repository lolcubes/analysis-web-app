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


$zipname = $cdDir . "/conversions.zip";

$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);
if ($handle = opendir('.')) {
  while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != ".." && !strstr($entry,'.php')) {
        $zip->addFile($entry);
    }
  }
  closedir($handle);
}

$zip->close();

header('Content-Type: application/zip');
header("Content-Disposition: attachment; filename='$zipname'");
header('Content-Length: ' . filesize($zipname));
header("Location: $zipname");

?>