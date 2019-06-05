<?php

$recieved = $_POST['downloadsFilesTypes'];
$recieved = explode(",", $recieved);


$files = array();
$types = array();

foreach ($recieved as $value) {
    $testFile = substr($value, 0, 17);
    if ($testFile == "dropzonefileicons"){
        $files[] = $value
    }
    else {
        $types[] = $value
    }
}
print_r($files);

?>