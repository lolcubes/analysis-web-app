<?php
$files = scandir('Song_Database/');
foreach($files as $file) {
    $filetypes = 'Song_Database/' . $file . "/dataTypes.txt";
    // echo $filetypes;
    echo file_get_contents($filetypes);
    echo "<br>";
    
}


?>