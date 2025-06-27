<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    $guests = htmlspecialchars($_POST['guests']);

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gallery_cafe";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO reservations (name, email, phone, date, time, guests) VALUES ('$name', '$email', '$phone', '$date', '$time', '$guests')";

    if ($conn->query($sql) === TRUE) {
        echo "Reservation successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
