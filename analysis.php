<?php
    $filesrecieved = $_POST['userfilelocations'];


    $explodedfiledirs = explode(",", $filesrecieved);

    foreach ($explodedfiledirs as $value) {
            echo $value;
            echo "<br>";
            // mkdir()
    }


?>