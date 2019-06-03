<?php 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $subjectLine = "BiB | " . $subject;
    $from = "From: " . $email;

    // mail("kaivernooy@gmail.com", "$subjectLine", $message, $from);

    $messago = "Line 1\r\nLine 2\r\nLine 3";

    // In case any of our lines are larger than 70 characters, we should use wordwrap()
    $messago = wordwrap($messago, 70, "\r\n");
    
    // Send
    mail('kaivernooy@gmail.com', 'My Subject', $messago);
?>