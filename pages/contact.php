<?php 
    // $name = $_POST['name'];
    // $email = $_POST['email'];
    // $subject = $_POST['subject'];
    // $message = $_POST['message'];

    // $subjectLine = "BiB | " . $subject;
    // $from = "From: " . $email;

    // // mail("kaivernooy@gmail.com", "$subjectLine", $message, $from);

    $sender = 'beatsinbytesofficial@gmail.com';
    $recipient = 'kaivernooy@gmail.com';
    
    $subject = "php mail test";
    $message = "php test message";
    $headers = 'From:' . $sender;
    
    if (mail($recipient, $subject, $message, $headers))
    {
        echo "Message accepted";
    }
    else
    {
        echo "Error: Message not accepted";
    }


?>