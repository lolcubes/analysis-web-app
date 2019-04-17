<?php
foreach ($_POST['periodDropdown'] as $select)
{
echo $select;
}
print_r($_POST['periodDropdown']);

echo "<br>";
echo $_POST['composer_input'];

echo "<br>";
$filedirs = $_POST['filesarrayinput'];
echo $filedirs;

$exploded = explode(",", $filedirs);
echo "<pre>";
print_r($exploded);
echo "</pre>"
?>