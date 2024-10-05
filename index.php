<?php
// Start session
session_start();

// Path to the SQLite database file
$dbname = 'lamp.db';

// Create or open the database
$conn = new SQLite3($dbname);

// Error message
$error = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = $_POST["password"];

    // Prepare and execute an SQLite query to get the user
    $stmt = $conn->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->bindValue(':username', $user, SQLITE3_TEXT);
    $result = $stmt->execute();

    $row = $result->fetchArray(SQLITE3_ASSOC);

    if ($row) {
        // Verify the password
        if (password_verify($pass, $row['password'])) {
            $_SESSION['username'] = $user;
            header("Location: hello.php");  // Redirect to hello.php
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Login Page</h2>
    <form method="POST" action="index.php">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>

    <!-- Display error message if any -->
    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
</body>

</html>