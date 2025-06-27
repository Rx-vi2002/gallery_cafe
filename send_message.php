<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Change the recipient email address below
    $to = 'your-email@example.com';
    $subject = 'New Message from Gallery Cafe Website';
    $message_body = "Name: $name\n\nEmail: $email\n\nMessage:\n$message";

    // Headers
    $headers = "From: $name <$email>";

    // Send email
    if (mail($to, $subject, $message_body, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Oops! Something went wrong.";
    }
}
?>