<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli("localhost", "root", "newpassword", "blog");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$edit_mode = false;
$post_id = '';
$title = '';
$content = '';

// Handle form submission (Add / Update)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);

    if (!empty($_POST['post_id'])) {
        // Update post
        $post_id = (int)$_POST['post_id'];
        $sql = "UPDATE post SET title='$title', content='$content' WHERE id=$post_id";
        $conn->query($sql);
        echo "<p style='color: green;'>Post updated successfully!</p>";
    } else {
        // Add new post
        $sql = "INSERT INTO post (title, content) VALUES ('$title', '$content')";
        $conn->query($sql);
        echo "<p style='color: green;'>New post added successfully!</p>";
    }
}

// Handle edit request
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $post_id = (int)$_GET['edit'];
    $result = $conn->query("SELECT * FROM post WHERE id = $post_id");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $content = $row['content'];
    }
}

// Handle delete request
if (isset($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    $conn->query("DELETE FROM post WHERE id = $delete_id");
    echo "<p style='color: red;'>Post deleted successfully.</p>";
}
?>

<!-- HTML Form -->
<h2><?php echo $edit_mode ? "Edit Post" : "Add New Post"; ?></h2>
<form method="POST" action="">
    <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post_id); ?>">

    <label>Title:</label><br>
    <input type="text" name="title" required value="<?php echo htmlspecialchars($title); ?>"><br><br>

    <label>Content:</label><br>
    <textarea name="content" rows="5" cols="40" required><?php echo htmlspecialchars($content); ?></textarea><br><br>

    <input type="submit" value="<?php echo $edit_mode ? 'Update Post' : 'Add Post'; ?>">
    <?php if ($edit_mode): ?>
        <a href="add_post.php">Cancel</a>
    <?php endif; ?>
</form>

<hr>

<!-- Display Posts -->
<h2>All Posts</h2>

<?php
$result = $conn->query("SELECT * FROM post ORDER BY created_at DESC");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 15px;'>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
        echo "<small>Posted on: " . $row['created_at'] . "</small><br>";
        echo "<a href='add_post.php?edit=" . $row['id'] . "'>Edit</a> | ";
        echo "<a href='add_post.php?delete=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this post?');\">Delete</a>";
        echo "</div>";
    }
} else {
    echo "<p>No posts found.</p>";
}
?>
