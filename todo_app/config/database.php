<?php
// database.php- DB connection, reusable across files 
$host = 'localhost'; 
$dbname = 'tasks_db'; 
$username = 'root'; 
$password = '';  // Empty for XAMPP default; change in prod! 
 
try { 
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) { 
    die("DB Error: " . $e->getMessage());  // Graceful error 
} 
?>