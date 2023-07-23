<?php
    require_once('./config-students.php');

    $task_name = $_POST['task_name'];
    $task_week = $_POST['task_week'];
    $student_group = $_POST['student_group'];
    $sql = "SELECT * from task WHERE task_name = ? AND student_group = ?";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute([$task_name, $student_group]);
    $task = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($task) > 0) {
        echo 'Task already exists';
    } else {
        if(isset($_POST['task_name'])){
            $assoc_file = isset($_POST['assoc_file']) ? $_POST['assoc_file'] : 'unspecified';
            $sql = 'INSERT into task (task_name, task_week, student_group, assoc_file) VALUES (?,?,?,?)';
            $stmt = $db->prepare($sql);
            $result = $stmt->execute([$task_name, $task_week, $student_group, $assoc_file]);
            if($result){
                echo json_encode(['task_id' => $db->lastInsertId(), 'task_name' => $task_name, 'task_week' => $task_week, 'student_group' => $student_group]);
            }
            else{
                echo 'Error';
            }

        }else{
            echo 'Error';
        }
    }
?>