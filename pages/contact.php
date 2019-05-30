<?php 
    $name = $_POST['name'];
    echo "Name: $name";
    echo "<br>";

    $email = $_POST['email'];
    echo "Email: $email";
    echo "<br>";

    $subject = $_POST['subject'];
    echo "Subject: $subject";
    echo "<br>";

    $message = $_POST['message'];
    echo "Message:" . nl2br($message);
?>