<?php
    $arrayfiledirectory = $_POST['arrayfiledirectory'];
    $output = shell_exec("cat $arrayfiledirectory");
    echo $output
?>