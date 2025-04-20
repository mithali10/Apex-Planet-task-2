<?php
session_start();
$conn = new mysqli("localhost", "root", "newpassword", "blog");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // secure hash

    $check = $conn->query("SELECT * FROM users WHERE username = '$username'");
    if ($check->num_rows > 0) {
        echo "Username already exists!";
    } else {
        $conn->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
        echo "Registered successfully! <a href='login.php'>Login</a>";
    }
}
?>

<h2>Register</h2>
<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Register</button>
</form>
