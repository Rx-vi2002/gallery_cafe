<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    $meal = htmlspecialchars($_POST['meal']);
    $special_requests = htmlspecialchars($_POST['special_requests']);

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gallery_cafe";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO preorders (name, email, phone, date, time, meal, special_requests) VALUES ('$name', '$email', '$phone', '$date', '$time', '$meal', '$special_requests')";

    if ($conn->query($sql) === TRUE) {
        echo "Pre-order successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
