<?php
session_start();
include 'db.php';

// Redirect to login if user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle POST request to create a new pip
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    // Check if content length exceeds 255 characters
    if (strlen($content) > 255) {
        echo "<p style='color: red;'>Pip message is too long! Maximum length is 255 characters.</p>";
    } elseif (!empty($content)) {
        $stmt = $conn->prepare("INSERT INTO pips (user_id, content) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $content);
        $stmt->execute();
    }
}

// Handle GET request to fetch all pips including avatar URLs
$stmt = $conn->prepare("SELECT pips.content, users.username, users.avatar_url, pips.created_at 
                        FROM pips 
                        JOIN users ON pips.user_id = users.id 
                        ORDER BY pips.created_at DESC");
$stmt->execute();
$pips = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Pipper</title>
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <script src="script.js" defer></script> 
</head>
<body>

    <!-- Include Side Panel -->
    <?php include 'side_panel.php'; ?>

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


    <!-- Form for creating a new pip -->
    <div class="form-container">
        <form method="POST" action="">
            <h2>What is on your mind?</h2>
            <textarea id="pip-content" name="content" placeholder="What's happening?" maxlength="255" required></textarea><br>
            <p id="char-count">0/255 characters</p> <!-- Display character count -->
            <button type="submit">Pip</button>
        </form>
    </div>

    <h3>Latest Pips:</h3>

    <!-- Display fetched pips -->
    <div class="pips-container">
        <?php while ($row = $pips->fetch_assoc()): ?>
            <div class="pip-box">
                <div class="pip-header">
                    <?php if (!empty($row['avatar_url'])): ?>
                        <img src="<?= htmlspecialchars($row['avatar_url']) ?>" alt="Avatar" class="avatar"> 
                    <?php else: ?>
                        <img src="images/Default image.png" alt="Default Avatar" class="avatar"> 
                    <?php endif; ?>
                    <p class="username"><strong><?= htmlspecialchars($row['username']) ?></strong></p>
                </div>
                <p><?= htmlspecialchars($row['content']) ?><br>
                   <small><?= $row['created_at'] ?></small></p>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Include Popup Overlay for Creating Pip -->
    <div id="pip-overlay" class="overlay" style="display:none;"> <!-- Initially hidden -->
        <div class="overlay-content">
            <span class="close" id="close-overlay">&times;</span>
            <h2>Create a Pip</h2>
            <form method="POST" action="create_pip.php"> <!-- Your pip creation action -->
                <textarea name="content" placeholder="What's happening?" maxlength="255" required></textarea>
                <button type="submit">Pip</button>
            </form>
        </div>
    </div>

</body>
</html>
