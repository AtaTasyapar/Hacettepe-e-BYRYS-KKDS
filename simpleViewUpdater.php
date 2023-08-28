<?php
require_once('./config-students.php');

if (isset($_POST['task_id'])) {
    // Get the task_id from the POST data
    $task_id = $_POST['task_id'];
    
    // Increment the view_count by 1
    $sqlUpdate = 'UPDATE task SET view_count = view_count + 1 WHERE id = ?';
    $stmtUpdate = $db->prepare($sqlUpdate);
    $stmtUpdate->execute([$task_id]);
    
    echo 'Successfully updated';
}
?>