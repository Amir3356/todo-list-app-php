<?php require_once 'includes/header.php'; ?>

<?php 
require_once 'functions.php'; 
if (!isLoggedIn()) { header('Location: login.php'); exit; } 
$id = $_GET['id'] ?? 0; 
$task = getTask($id, getCurrentUserId()); 
if (!$task) { header('Location: index.php'); exit; } 

$error = ''; // PDF requirement: Add error variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $title = $_POST['title']; 
    $description = $_POST['description']; 
    $completed = isset($_POST['completed']) ? 1 : 0; 
    $deadline = $_POST['deadline']; 
    
    // PDF requirement: Enhanced validation with error message
    if (empty($title)) { 
        $error = 'Title required'; 
    } else { 
        if (updateTask($id, $title, $description, $completed, $deadline, getCurrentUserId())) {
            header('Location: index.php'); 
            exit; 
        } else {
            $error = 'Failed to update task';
        }
    } 
} 
?> 

<!-- PDF requirement: Display error message -->
<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST"> 
    <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required> 
    <textarea name="description"><?php echo htmlspecialchars($task['description']); ?></textarea> 
    <input type="checkbox" name="completed" <?php if ($task['completed']) echo 'checked'; ?>> Completed 
    <input type="date" name="deadline" value="<?php echo $task['deadline']; ?>"> 
    <button>Update</button> 
</form> 

<?php require_once 'includes/footer.php'; ?>