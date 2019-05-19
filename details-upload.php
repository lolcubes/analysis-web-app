<?php

#========================
# create vars for data
#========================
$period = ($_POST['periodDropdown']);
$composer = $_POST['composer_input'];
$filedirs = $_POST['filesarrayinput'];

#===============================
#explode the data into an array
#==============================
$explodedfiledirs = explode(",", $filedirs);

#=====================================
#loop through array, save data to file
#=====================================
foreach ($explodedfiledirs as $value) {
    $fileinfo = "$value" . "/time-info";
    mkdir($fileinfo);
    $composerdirectory = "$value" . "/time-info/" . "composer.txt";
    $perioddirectory = "$value" . "/time-info/" . "period.txt";
    file_put_contents($composerdirectory, $composer);
    file_put_contents($perioddirectory, $period);
}

?>