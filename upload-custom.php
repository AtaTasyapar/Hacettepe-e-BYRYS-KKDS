<?php
require_once('./config-students.php');

if (isset($_POST['student_group'])) {
    $student_group = $_POST['student_group'];
    $task_name = $_POST['task_name'];
    $task_week = $_POST['task_week'];
    $file_name = $_POST['file_name'];
    $file_data = $_POST['file_data'];
    $task_desc = $_POST['task_desc'];

    $sql = "INSERT INTO custom_task (task_name, task_desc, task_week, student_group, file_name, file_data) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute([$task_name, $task_desc, $task_week, $student_group, $file_name, $file_data]);
    if ($result) {
        echo json_encode(['task_id' => $db->lastInsertId(), 'task_name' => $task_name, 'task_week' => $task_week, 'student_group' => $student_group]);
    } else {
        echo 'Error';
    }
}
?>