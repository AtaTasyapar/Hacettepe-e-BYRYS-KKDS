<?php
ini_set('max_execution_time', 300);
ini_set('upload_max_filesize', '100M');
ini_set('post_max_size', '100M');
error_log(print_r($_POST, true));

require_once('./config-students.php');
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_name = $_POST['task_name'];
    $task_week = $_POST['task_week'];
    $student_group = $_POST['student_group'];
    $file_name = $_FILES['file']['name'];
    $file_extention = pathinfo($file_name, PATHINFO_EXTENSION);
    $task_desc = $_POST['task_desc'];
    $viewCOunt = 0;
    $watches = [];
    $targetDir = "uploads/"; 
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);


    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        $file_path = $targetFile;

        $sql = "INSERT INTO custom_task (task_name, task_desc, task_week, student_group, file_name, file_path, view_count, watches) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute([$task_name, $task_desc, $task_week, $student_group, $file_name, $file_path, $viewCOunt, json_encode($watches)]);

        if ($result) {
            // File path saved to the database
            echo json_encode(['task_id' => $db->lastInsertId(), 'task_name' => $task_name, 'task_week' => $task_week, 'student_group' => $student_group]);
        } else {
            echo "Error saving to the database.";
        }
    } else {
        echo "Error uploading the file.";
    }
} else {
    echo "Invalid request.";
}