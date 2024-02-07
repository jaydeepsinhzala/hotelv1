<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminlogin-css.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Galada' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
  <form  method="POST" class="box">
    <h1>Admin Login</h1>
    <input type="text" name="username" id="username" placeholder="Username">
    <input type="password" name="password" id="password" placeholder="Password">        
    <button type="submit" name="login-btn" id="login-btn" class="login-btn">Login</button>
</form>
</div>
    
</body>
</html>
<?php
session_start();
include('config.php');

if (isset($_SESSION['login_user'])) {
    // Check cus_role from the database
	$username=$_POST['username'];
    $sql = "SELECT cus_role FROM customer WHERE cus_name='$username'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    $cus_role = $row['cus_role'];

    header("Location: " . getRedirectUrl($cus_role)); // Use a function to determine redirect URL
    exit();
}

// ... rest of your login code ...

function getRedirectUrl($cus_role) {
    switch ($cus_role) {
        case 0:
            return "index.php";
        case 1:
            return "manager/index.php";
        case 2:
            return "../index.php";
        default:
            return "../index.php"; // Redirect to default if cus_role is invalid
    }
}
?>

?>