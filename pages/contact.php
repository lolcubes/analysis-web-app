<?php 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $subjectLine = "BiB | " . $subject;
    $from = "From: " . $email;

    mail("kaivernooy@gmail.com", "$subjectLine", $message, $from);
?>