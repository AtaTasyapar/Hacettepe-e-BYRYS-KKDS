<?php

    require_once('./config-students.php');

    $task_id = $_POST['task_id'];
    $task_name = $_POST['task_name'];
    $task_group = $_POST['task_group'];

    $sql = "DELETE FROM task WHERE id = ?;";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute([$task_id]);

    if($result){
        echo 'success';
    }
    else{
        echo 'Error';
    }

    // Delete record from task_name table
    $sql = "DELETE FROM $task_name WHERE student_group = \"$task_group\"";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();

    if($result){
        echo 'success';
    }
    else{
        echo 'Error';
    }

?>