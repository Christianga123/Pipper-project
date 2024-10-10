<?php
session_start();
include 'db.php';

// Redirect to login if user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle search query
$query = $_GET['query'] ?? '';
$stmt = $conn->prepare("SELECT pips.content, users.username, users.avatar_url, pips.created_at 
                        FROM pips 
                        JOIN users ON pips.user_id = users.id 
                        WHERE pips.content LIKE CONCAT('%', ?, '%') 
                        OR users.username LIKE CONCAT('%', ?, '%') 
                        ORDER BY pips.created_at DESC");
$stmt->bind_param("ss", $query, $query);
$stmt->execute();
$pips = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Pipper</title>
    <link rel="stylesheet" type="text/css" href="style.css"> 
</head>
<body>

    <!-- Sticky Header with Bird Logo and Search Bar -->
    <header>
        <a href="home.php">
            <img src="images/twitter-logo.png" alt="Pipper Logo" class="logo"> 
        </a>
        <h1>Welcome to Pipper!</h1>
        
        <!-- Search Bar -->
        <form method="GET" action="search.php" class="search-form"> 
            <input type="text" name="query" placeholder="Search users and pips..." value="<?= htmlspecialchars($query) ?>" required>
            <button type="submit">Search</button>
        </form>
    </header>

    <!-- Include the Side Panel -->
    <?php include 'side_panel.php'; ?>

    <div class="content">
        <h3>Search Results for "<?= htmlspecialchars($query) ?>"</h3>

        <!-- Display fetched pips -->
        <div class="pips-container"> 
            <?php while ($row = $pips->fetch_assoc()): ?>
                <div class="pip-box"> 
                    <div class="pip-header">
                        <!-- Display the avatar next to the username -->
                        <?php if (!empty($row['avatar_url'])): ?>
                            <img src="<?= htmlspecialchars($row['avatar_url']) ?>" alt="Avatar" class="avatar"> 
                        <?php else: ?>
                            <img src="images/Default image.png" alt="Default Avatar" class="avatar"> <!-- Placeholder image if no avatar -->
                        <?php endif; ?>
                        <p class="username"><strong><?= htmlspecialchars($row['username']) ?></strong></p>
                    </div>
                    <p><?= htmlspecialchars($row['content']) ?><br>
                       <small><?= $row['created_at'] ?></small></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script>
        const textarea = document.getElementById('pip-content');
        const charCount = document.getElementById('char-count');

        textarea.addEventListener('input', function() {
            const length = textarea.value.length;
            charCount.textContent = `${length}/255 characters`;

            // Optional: Prevent submission if length exceeds 255
            if (length > 255) {
                textarea.value = textarea.value.substring(0, 255); 
            }
        });
    </script>

</body>
</html>
