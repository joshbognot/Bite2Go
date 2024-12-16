<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// random user ID for display
$random_user_id = rand(100000, 999999);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
    <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($_SESSION['contact_number']); ?></p>
    <p><strong>User ID:</strong> <?php echo $random_user_id; ?></p>
    <br>
    <button onclick="window.location.href='show_receipts.php'">Show Receipts</button>
    <button onclick="window.location.href='menu.php'">Go Order</button>
    <br><br>
    <button onclick="window.location.href='logout.php'">Logout</button>
</body>
</html>