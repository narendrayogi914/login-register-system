<?php
include_once('connection.php');

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $gmail = $_POST['gmail'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['ph-number'];
    $location = $_POST['location'];
    $check_stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE gmail = ?");
    $check_stmt->bind_param("s", $gmail);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();
    if($count>0){
        echo "<script>alert('Your Gmail is already registered! Please Change Your Gmail Address');</script>";
    }
    else{
        if(empty($name) || empty($username) || empty($gmail) || empty($password) || empty($phone) || empty($location)) {
            echo "<script>alert('Please enter all the fields')</script>";
        } else {
           
            // Prepare statement
            $stmt = $conn->prepare("INSERT INTO user (name, username, gmail, password, phone, city) VALUES (?, ?, ?, ?, ?, ?)");
            
            // Bind parameters
            $stmt->bind_param("ssssss", $name, $username, $gmail, $password, $phone, $location);
            
            // Execute statement
            if($stmt->execute()) {
                echo "<script>alert('Registration successful')</script>";
            } else {
                echo "<script>alert('Error: ".$stmt->error."')</script>";
            }
            
            // Close statement and connection
            $stmt->close();
            $conn->close();
        }

    }
    
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <?php include 'file.php'; ?>
    <style>
        body{
            display:flex;
            justify-content:center;
            align-items: center;
        }
      
        form input{
            
            width: 300px;
            margin: 2px;
        }
    </style>
</head>
<body>
    <div class="card mt-5" style="width:20rem;">
      <img src="register.jpeg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title text-center">Registration here </h5>
        <form action="" method="post" class="">
            <div class="form-group">
            <label for="name">Name : </label>
            <input type="text" id="name" name="name" required>
            </div>
            <div >
            <label for="name">Username : </label>
            <input type="text" id="username" name="username" required>
            </div>
            <div>
            <label for="name">Gmail : </label>
            <input type="text" id="gmail" name="gmail" required>
            </div>
            <div>
            <label for="name">Password : </label>
            <input type="password" id="password" name="password" required>
            </div>
            <div>
            <label for="name">Re- Enter Password </label>
            <input type="password" id="name" name="name" required>
            </div>
            <div>
            <label for="name">Phone</label>
            <input type="number" id="number" name="ph-number" required>
            </div>
            <div>
            <label for="location">Location </label>
            <input type="text" id="location" name="location" required>
            </div>
            <div>
            
            <input  class="bg-secondary" type="submit" value="Register" name="submit" required>
            </div>
            
        </form>
      </div>
    </div>
</body>
</html>