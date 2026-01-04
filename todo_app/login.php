<?php 
session_start(); 
require_once 'functions.php'; 
if (isLoggedIn()) { header('Location: index.php'); exit; } 
 
$error = ''; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $username = trim($_POST['username']); 
    $password = $_POST['password']; 
    if (loginUser($username, $password)) { 
        header('Location: index.php'); 
        exit; 
    } else { 
        $error = 'Invalid login'; 
    } 
} 
?> 
<!DOCTYPE html> 
<html><head><title>Login</title></head><body> 
<h1>Login</h1> 
<form method="POST"> 
    <input type="text" name="username" placeholder="Username" required> 
    <input type="password" name="password" placeholder="Password" required> 
    <button>Login</button> 
</form> 
<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?> 
<p>New? <a href="register.php">Register</a></p> 
</body></html> 