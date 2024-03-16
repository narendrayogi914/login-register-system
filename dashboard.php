<?php
session_start();

// Check if the user is logged in
if(!isset($_SESSION['gmail'])){
    header("Location: login.php");
    exit;
}

// Include your database connection file
include_once('connection.php');

// Get the Gmail address from the session
$gmail = $_SESSION['gmail'];

// Fetch user information from the database based on the Gmail address
$stmt = $conn->prepare("SELECT name, city FROM user WHERE gmail = ?");
$stmt->bind_param("s", $gmail);
$stmt->execute();
$stmt->bind_result($name, $city);

// Fetch the result
$stmt->fetch();

// Close the statement
$stmt->close();

// Logout functionality
if(isset($_POST['logout'])){
    session_destroy();
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $name; ?>!</h2>
    <p>You are from <?php echo $city; ?>.</p>
    
    <form action="" method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>
</html>
