<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");  // Redirect to login if not logged in
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello World</title>
</head>

<body>
    <h1>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>Welcome to the Hello World page.</p>
    <a href="logout.php">Logout</a>
</body>

</html>