<?php
foreach ($_POST['periodDropdown'] as $select)
{
echo $select;
}
print_r($_POST['periodDropdown']);

$composer = $_POST['composer_input'];
echo $composer;
?>