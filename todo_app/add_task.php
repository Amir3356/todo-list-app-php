<?php require_once 'includes/header.php'; ?>

<?php 
require_once 'functions.php'; 
if (!isLoggedIn()) { header('Location: login.php'); exit; } 

$error = ''; // PDF requirement: Add error variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $title = $_POST['title']; 
    $description = $_POST['description']; 
    $deadline = $_POST['deadline']; 
    
    // PDF requirement: Enhanced validation with error message
    if (empty($title)) { 
        $error = 'Title required'; 
    } else { 
        if (addTask($title, $description, $deadline, getCurrentUserId())) {
            header('Location: index.php'); 
            exit; 
        } else {
            $error = 'Failed to add task';
        }
    } 
} 
?> 

<!-- PDF requirement: Display error message -->
<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST"> 
    <input type="text" name="title" required> 
    <textarea name="description" required></textarea> 
    <input type="date" name="deadline" required> 
    <button>Add Task</button> 
</form>

<?php require_once 'includes/footer.php'; ?>