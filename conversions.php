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
print_r($files);
echo "<br>";
print_r($types);

foreach ($files as $file){
    $file = str_replace("dropzonefileicons", "", $file);
    $path = "Song_Database/" . $file . "/data-conversions/";
    foreach ($types as $type) {
        $type = str_replace("DownloadIcon", "", $type);
        echo "$path$type";
    }
}

?>