<?php

    require_once('./config-students.php');

    $task_id = $_POST['task_id'];
    $task_name = strtolower($_POST['task_name']);
    $task_group = $_POST['task_group'];

    $sql = "SELECT * FROM task where id = ?;";
    $stmt = $db->prepare($sql);
    $stmt->execute([$task_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $assoc_file = $result['assoc_file'];

    $sql = "DELETE FROM task WHERE id = ?;";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute([$task_id]);

    if($result){
        echo 'success';
    }
    else{
        echo 'Error';
    }

    if($task_name === 'pretest1'){
        $sql = "DELETE FROM pretest1 WHERE task_id = \"$task_id\";";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute();
    }    
    if($task_name === 'pretest2'){
        $sql = "DELETE FROM pretest2 WHERE task_id = \"$task_id\";";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute();
    }    
    if($task_name === 'posttest1'){
        $sql = "DELETE FROM posttest1 WHERE task_id = \"$task_id\";";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute();
    }
    if($task_name === 'posttest2'){
        $sql = "DELETE FROM posttest2 WHERE task_id = \"$task_id\";";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute();
    }    
    
    
    if($task_name === 'testcase'){
        $sql = "DELETE FROM testcase WHERE task_id = \"$task_id\";";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute();
        $sql = "DELETE FROM uploads WHERE file_name = \"$assoc_file\";";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute();
        
        if($result){
            echo 'success';
        }

    else{
            echo 'Error';
        }
    }

?>