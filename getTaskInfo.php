<?php
require_once('./config-students.php');


if(isset($_POST)){

    if($_POST['type'] == 'simple-task-controller'){
        $sql = 'Select * from task where id = ?';
        $stmt = $db->prepare($sql);
        $stmt->execute([$_POST['task_id']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
           echo json_encode($result);
        }
}
if($_POST['type'] == 'custom-task-controller'){
    $sql = 'Select * from custom_task where id = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute([$_POST['task_id']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
       echo json_encode($result);
    }else{
        echo 'task was not found';
    }
}
}
else{
    echo 'No data';
}
?>