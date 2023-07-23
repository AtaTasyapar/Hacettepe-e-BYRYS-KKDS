<?php

    require_once('./config-students.php');

    $task_id = $_POST['task_id'];

    $sql = "DELETE FROM task WHERE id = ?";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute([$task_id]);

    if($result){
        echo 'success';
    }
    else{
        echo 'Error';
    }

?>