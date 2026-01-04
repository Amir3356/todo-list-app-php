<?php
session_start();
require_once 'functions.php';

if (isLoggedIn() && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $task = getTask($id, getCurrentUserId());
    
    if ($task) {
        $completed = $task['completed'] ? 0 : 1;
        updateTask($id, $task['title'], $task['description'], $completed, $task['deadline'], getCurrentUserId());
    }
}

header('Location: index.php');
exit;
?>