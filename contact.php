<?php
include 'include/session.php';
include 'include/DatabaseConnection.php';
include 'include/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['subject'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    ini_set('sendmail_path', "\"C:\xampp\sendmail\sendmail.exe\" -t");
    ini_set('SMTP', 'smtp.gamil.com');
    ini_set('smtp_port', 587);
    ini_set('smtp_ssl', 'auto');


    $to = 'luunguyentanbao@gmail.com';
    $subject = "<b> . $title . </b>";
    $headers = "From: $email\r\n";
    $body = "Name: $name\nEmail: $email\n\n$message";

    if (mail($to, $subject, $body, $headers)) {
        $output = 'Message sent successfully.';
    } else {
        $output = 'Error sending message.';
    }
} else {
    $title = 'Contact Us';

    ob_start();
    include 'templates/contactform.html.php';
    $output = ob_get_clean();
}

include 'templates/layout.html.php';
?>