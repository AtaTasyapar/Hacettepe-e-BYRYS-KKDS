<?php
    require_once('./config-students.php');
    if(isset($_POST['file_name'])){
        $sql = 'INSERT into uploads (file_name, base64, student_group) VALUES (?,?,?)';
        $stmt = $db->prepare($sql);
        $result = $stmt->execute([$_POST['file_name'], $_POST['base64'], $_POST['student_group']]);
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