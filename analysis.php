<?php
    $filesrecieved = $_POST['userfilelocations'];
    $explodedfiledirs = explode(",", $filesrecieved);

    foreach ($explodedfiledirs as $value) {
            echo $value;
            echo "<br>";
    }

    foreach($_POST['data-choose'] as $selected){
        echo $selected . "</br>";
    }

?>