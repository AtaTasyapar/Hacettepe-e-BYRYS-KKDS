<?php
require_once('./config-students.php');
if(isset($_POST['task_id'])){
    $sql = 'DELETE FROM custom_task WHERE id = ?';
    $stmt = $db->prepare($sql);
    $result = $stmt->execute([$_POST['task_id']]);
    if($result){
        echo 'success';
    }
    else{
        echo 'Error';
    }
}
else{
    echo 'No data';
}
?>