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
    $composerdirectory = "$value" . "/" . "composer.txt";
    $perioddirectory = "$value" . "/" . "period.txt";
    file_put_contents($composerdirectory, $composer);
    file_put_contents($perioddirectory, $period);
}

?>