<?php 
// functions.php - Reusable helpers 
require_once 'config/database.php'; 
 
function registerUser($username, $plainPassword) { 
    global $pdo; 
    
    $hash = password_hash($plainPassword, PASSWORD_DEFAULT); 
    $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)"); 
    $stmt->execute([$username, $hash]); 
    return $pdo->lastInsertId(); 
} 
 
function loginUser($username, $plainPassword) { 
    global $pdo; 
    $stmt = $pdo->prepare("SELECT id, password_hash FROM users WHERE username = ?"); 
    $stmt->execute([$username]); 
    $user = $stmt->fetch(); 
    if ($user && password_verify($plainPassword, $user['password_hash'])) { 
        session_regenerate_id(); 
        $_SESSION['user_id'] = $user['id']; 
        return true; 
    } 
    return false; 
} 
 
function isLoggedIn() { 
    return isset($_SESSION['user_id']); 
} 
 
function getCurrentUserId() { 
    return $_SESSION['user_id'] ?? null; 
} 
 
function logout() { 
    session_destroy(); 
}

function addTask($title, $description, $deadline, $userId) { 
    global $pdo; 
    if (empty($title)) return false; // PDF requirement: Add validation check
    $stmt = $pdo->prepare("INSERT INTO tasks (title, description, deadline, user_id) VALUES (?, ?, ?, ?)"); 
    $stmt->execute([trim($title), trim($description), $deadline ?: null, $userId]); 
    return true; // Return success status
} 
 
function getTasks($userId) { 
    global $pdo; 
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY deadline ASC"); 
    $stmt->execute([$userId]); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
} 
 
function getTask($id, $userId) { 
    global $pdo; 
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?"); 
    $stmt->execute([$id, $userId]); 
    return $stmt->fetch(PDO::FETCH_ASSOC); 
} 
 
function updateTask($id, $title, $description, $completed, $deadline, $userId) { 
    global $pdo; 
    if (empty($title)) return false; // PDF requirement: Add validation check
    $stmt = $pdo->prepare("UPDATE tasks SET title=?, description=?, completed=?, deadline=? WHERE id=? AND user_id=?"); 
    $stmt->execute([trim($title), trim($description), $completed, $deadline ?: null, $id, $userId]); 
    return true; // Return success status
} 
 
function deleteTask($id, $userId) { 
    global $pdo; 
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id=? AND user_id=?"); 
    $stmt->execute([$id, $userId]); 
} 
?>