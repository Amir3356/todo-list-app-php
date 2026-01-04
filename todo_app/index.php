<?php require_once 'includes/header.php';  
$tasks = getTasks(getCurrentUserId()); 
$currentDate = '2025-12-21';  // Or date('Y-m-d') 
?> 
<h1>Your Tasks</h1> 
<table> 
    
<tr><th>Title</th><th>Description</th><th>Status</th><th>Deadline</th><th>Actions</
th></tr> 
    <?php foreach ($tasks as $task):  
        $status = $task['completed'] ? 'Done' : 'Pending'; 
        $dueClass = (!$task['completed'] && $task['deadline'] && $task['deadline'] 
< $currentDate) ? 'overdue' : ''; 
    ?> 
    <tr> 
        <td><?php echo htmlspecialchars($task['title']); ?></td> 
        <td><?php echo htmlspecialchars($task['description']); ?></td> 
        <td><?php echo $status; ?></td> 
        <td class="<?php echo $dueClass; ?>"><?php echo $task['deadline'] ?: 
'None'; ?></td> 
        <td><a href="edit_task.php?id=<?php echo $task['id']; ?>">Edit</a> | <a 
href="delete_task.php?id=<?php echo $task['id']; ?>" onclick="return 
confirmDelete();">Delete</a></td> 
    </tr> 
    <?php endforeach; ?> 
</table> 
<?php require_once 'includes/footer.php'; ?>