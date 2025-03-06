<?php
require 'vendor/autoload.php'; // Path to Twilio's autoload.php

use Twilio\Rest\Client;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Send Email
    $to = 'ssaliwhite0@gmail.com';
    $email_subject = 'Contact Form Submission: ' . $subject;
    $email_body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $email_headers = "From: $email";

    $email_sent = mail($to, $email_subject, $email_body, $email_headers);

    // Send WhatsApp Message
    $account_sid = 'your_account_sid';
    $auth_token = 'your_auth_token';
    $twilio_number = 'whatsapp:+14155238886'; // Your Twilio WhatsApp number
    $to_number = 'whatsapp:+256758268218';

    $client = new Client($account_sid, $auth_token);

    $whatsapp_body = "Contact Form Submission:\n\nName: $name\nEmail: $email\nSubject: $subject\nMessage: $message";

    $whatsapp_sent = $client->messages->create(
        $to_number,
        array(
            'from' => $twilio_number,
            'body' => $whatsapp_body
        )
    );

    if ($email_sent && $whatsapp_sent) {
        echo 'Message sent successfully!';
    } else {
        echo 'Failed to send message.';
    }
}
?>
