<?php
session_start();

include "conn.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // check creds
     $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $result = $stmt->get_result();
 
     if ($result->num_rows > 0) {
         $user = $result->fetch_assoc();
 
         if (password_verify($password, $user['password'])) {
             // user ID session
             $_SESSION['user_id'] = $user['id'];
             $_SESSION['username'] = $user['username'];
             header('Location: homepage.php');
             exit();
         } else {
             echo "Invalid password.";
         }
     } else {
         echo "User not found.";
     }
 }
 ?>