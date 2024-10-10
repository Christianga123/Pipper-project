<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Password hashing for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);
    
    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Error: Could not register user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pipper</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

   <!-- Header Section -->
<header>
    <a href="home.php">
        <img src="images/twitter-logo.png" alt="Pipper Logo" class="logo">
    </a>
    <h1 class="welcome-header">Welcome to Pipper!</h1>
    <div class="search-form">
        <input type="text" placeholder="Search...">
        <button type="submit">Search</button>
    </div>
</header>


    <!-- Registration Form Section -->
    <div class="form-container">
        <h2>Register</h2>
        <form method="POST" action="">
            <div class="input-container">
                <label for="username">Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="input-container">
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="login-button">Register</button>
        </form>

        <!-- Login Link -->
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

</body>
</html>

