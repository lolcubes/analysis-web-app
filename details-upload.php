<?php
foreach ($_POST['periodDropdown'] as $select)
{
echo $select;
}
print_r($_POST['periodDropdown']);

echo "<br>";
$composer = $_POST['composer_input'];

echo "<br>";
$filedirs = $_POST['filesarrayinput'];

$exploded = explode(",", $filedirs);


foreach ($exploded as $value) {
    echo "<br>";
    echo $value;
    $directory = "$value" . "/" . "composer.txt";
    file_put_contents($directory, $composer);
    echo "<br>";
}

?>