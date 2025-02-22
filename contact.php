<?php
// Database configuration
$servername = "localhost"; // Change if your database server is different
$username = "your username"; // Your database username
$password = "your password"; // Your database password
$dbname = "reclaim"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO contact_form( Name, Email, Subject, Message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $Name, $Email, $Subject, $Message);

// Set parameters and execute
$name = $_POST['Name'];
$email = $_POST['Email'];
$subject = $_POST['Subject'];
$message = $_POST['Message'];

if ($stmt->execute()) {
    echo "Message sent successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>