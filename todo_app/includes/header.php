<?php 
session_start(); 
require_once 'functions.php'; 
if (!isLoggedIn()) { header('Location: login.php'); exit; } 
?> 
<!DOCTYPE html> 
<html><head><title>Todo App</title><link rel="stylesheet" 
href="assets/style.css"></head><body> 
<nav><a href="index.php">Tasks</a> | <a href="add_task.php">Add</a> | <a 
href="logout.php">Logout</a></nav>