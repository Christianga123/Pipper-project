<!-- side_panel.php -->
<nav class="side-panel">
    <ul>
        <li><a href="home.php"><img src="images/home.svg" alt="Home" class="icon"> Home</a></li>
        <li><a href="messages.php"><img src="images/message-square.svg" alt="Messages" class="icon"> Messages</a></li>
        <li><a href="notifications.php"><img src="images/bell.svg" alt="Notifications" class="icon"> Notifications</a></li>
        <li><a href="#" id="pip-button"><img src="images/twitter.svg" alt="Create Pip" class="icon"> Create Pip</a></li>
        <li><a href="profile.php"><img src="images/Default image.png" alt="Profile" class="icon"> Profile</a></li>
    </ul>
</nav>

<!-- Popup Overlay for Creating Pip -->
<div id="pip-overlay" class="overlay" style="display: none;">
    <div class="overlay-content">
        <span class="close" id="close-overlay">&times;</span>
        <h2>Create a Pip</h2>
        <form method="POST" action="create_pip.php"> <!-- Your pip creation action -->
            <textarea id="pip-content-overlay" name="content" placeholder="What's happening?" maxlength="255" required autofocus></textarea>
            <button type="submit">Pip</button>
        </form>
    </div>
</div>
