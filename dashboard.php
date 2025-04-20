<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
<p>This is a protected dashboard.</p>
<a href="logout.php">Logout</a>


<?php
// Load the add_post form and functionality inside dashboard
include("add_post.php");
?>