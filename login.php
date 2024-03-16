<?php
session_start();

// Include database connection
include_once('connection.php');

// Check if the user is already logged in
if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit;
}

// Check if the login form is submitted
if(isset($_POST['login'])){
    $gmail = $_POST['gmail'];
    $password = $_POST['password'];
    
    // Prepare a SQL statement to fetch user data
    $stmt = $conn->prepare("SELECT id, gmail, password FROM user WHERE gmail = ?");
    $stmt->bind_param("s", $gmail);
    $stmt->execute();
    $stmt->store_result();
    
    // Check if a user with the given gmail exists
    if($stmt->num_rows > 0){
        $stmt->bind_result($user_id, $db_gmail, $db_password);
        $stmt->fetch();
        
        // Verify password
        if(password_verify($password, $db_password)){
            // Password is correct, start a new session
            session_regenerate_id();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['gmail'] = $db_gmail;
            header("Location: dashboard.php");
            exit;
        } else {
            // Invalid password
            $error = "Invalid gmail or password";
        }
    } else {
        // User does not exist
        $error = "Invalid gmail or password";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if(isset($error)) echo "<p>$error</p>"; ?>
    <form action="" method="post">
        <input type="text" name="gmail" placeholder="Gmail" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>
