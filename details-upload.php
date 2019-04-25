<?php
foreach ($_POST['periodDropdown'] as $select)
{
echo $select;
}

$period = ($_POST['periodDropdown']);
$composer = $_POST['composer_input'];
$filedirs = $_POST['filesarrayinput'];

$explodedfiledirs = explode(",", $filedirs);

foreach ($explodedfiledirs as $value) {
    $fileinfo = "$value" . "/time-info";
    mkdir($fileinfo);
    $composerdirectory = "$value" . "/time-info/" . "composer.txt";
    $perioddirectory = "$value" . "/time-info/" . "period.txt";
    file_put_contents($composerdirectory, $composer);
    file_put_contents($perioddirectory, $period);
}

?>