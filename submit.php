<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Validate that all fields are filled in
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "<script>alert('All fields are required!'); window.history.back();</script>";
        exit;
    }

    // Database connection settings
    $servername = "localhost";  // Change this if your database is hosted remotely
    $username = "root";         // Your database username
    $password = "";             // Your database password (leave empty if using XAMPP default)
    $dbname = "reclaim";       // Your actual database name

    // Establish the database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL query
    $stmt = $conn->prepare("INSERT INTO contact_form (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    // Execute the query and handle success or failure
    if ($stmt->execute()) {
        echo "<script>alert('Your message has been sent successfully!');
         window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Error submitting form. Try again!'); window.history.back();</script>";
        // Optionally log the error for debugging purposes
        error_log("MySQL Error: " . $stmt->error);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
