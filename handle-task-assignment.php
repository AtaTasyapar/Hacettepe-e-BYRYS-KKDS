<?php
    require_once('./config-students.php');
    if(isset($_POST['task_name'])){
        $task_name = $_POST['task_name'];
        $task_week = $_POST['task_week'];
        $student_group = $_POST['student_group'];
        $assoc_file = isset($_POST['assoc_file']) ? $_POST['assoc_file'] : 'unspecified';
        $sql = 'INSERT into task (task_name, task_week, student_group, assoc_file) VALUES (?,?,?,?)';
        $stmt = $db->prepare($sql);
        $result = $stmt->execute([$task_name, $task_week, $student_group, $assoc_file]);
        if($result){
            echo 'success';
        }
        else{
            echo 'Error';
        }

    }else{
        echo 'No data';
    }
?>