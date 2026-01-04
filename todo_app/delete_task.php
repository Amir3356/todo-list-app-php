<?php 
session_start(); 
require_once 'functions.php'; 
if (isLoggedIn() && isset($_GET['id'])) { 
    deleteTask($_GET['id'], getCurrentUserId()); 
} 
header('Location: index.php'); 
exit; 
?>