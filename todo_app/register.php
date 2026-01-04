<?php 
session_start(); 
require_once 'functions.php'; 
if (isLoggedIn()) { header('Location: index.php'); exit; } 
 
$error = ''; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $username = trim($_POST['username']); 
    $password = $_POST['password']; 
    if ($username && $password) { 
        registerUser($username, $password); 
        loginUser($username, $password);  // Auto-login after register 
        header('Location: index.php'); 
        exit; 
    } else { 
        $error = 'Fill in all fields'; 
    } 
} 
?> 
<!DOCTYPE html> 
<html><head><title>Register</title></head><body> 
<h1>Register</h1> 
<form method="POST"> 
    <input type="text" name="username" placeholder="Username" required> 
    <input type="password" name="password" placeholder="Password" required> 
    <button>Register</button> 
</form> 
<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?> 
<p>Already have an account? <a href="login.php">Login</a></p> 
</body></html> 