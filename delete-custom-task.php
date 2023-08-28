<?php
require_once('./config-students.php');
if(isset($_POST['task_id'])){
    $sql = 'SELECT * FROM custom_task WHERE id = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute([$_POST['task_id']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        $file_path = $result['file_path'];
        $fileExtention = pathinfo($file_path, PATHINFO_EXTENSION);
        $file_name_pdf = str_replace($fileExtention, 'pdf', $file_path);
        if(file_exists($file_name_pdf)){
            unlink($file_name_pdf);
        }
    }
    if(file_exists($file_path)){   
        unlink($file_path);
    }


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