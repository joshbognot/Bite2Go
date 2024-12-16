<?php
// Connect to the database
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        die("Passwords do not match. <a href='signup.php'>Go back</a>");
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the user into the database
    $stmt = $conn->prepare("INSERT INTO users (username, email, contact_number, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $contact_number, $hashed_password);

    if ($stmt->execute()) {
        echo "Sign-up successful. <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>