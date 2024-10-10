<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: home.php");
        } else {
            echo "Invalid credentials!";
        }
    } else {
        echo "User not found!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pipper</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

 <!-- Sticky Header -->
 <header>
    <a href="home.php">
        <img src="images/twitter-logo.png" alt="Pipper Logo" class="logo">
    </a>
    <h1>Welcome to Pipper!</h1>
    <!-- Search Bar -->
    <form method="GET" action="search.php" class="search-form"> 
        <input type="text" name="query" placeholder="Search users and pips..." required>
        <button type="submit">Search</button>
    </form>
</header>


    <!-- Login Form Section -->
    <div class="form-container">
        <h2>Login</h2>
        <form method="POST" action="">
            <div class="input-container">
                <label for="username">Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="input-container">
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>

        <!-- Register Link -->
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>

</body>
</html>

