<?php
    require_once('./config-students.php');
    if(isset($_POST['student_id'])){
        $student_id = $_POST['student_id'];
        $task_id = $_POST['task_id'];
        $student_name = $_POST['student_name'];
        $student_email = $_POST['student_email'];
        $student_group = $_POST['student_group'];
        $stimulus_detection = $_POST['stimulus_detection'];
        $body_humidity = $_POST['body_humidity'];
        $physical_activity = $_POST['physical_activity'];
        $mobility_confidence = $_POST['mobility_confidence'];
        $feeding_habit = $_POST['feeding_habit'];
        $friction_control = $_POST['friction_control'];
        $total = $_POST['total'];
        $submission_time = date("Y-m-d H:i:s");

        $sql = 'INSERT into testcase (student_id, task_id, student_name, student_email, student_group, stimulus_detection, body_humidity, physical_activity, mobility_confidence, feeding_habit, friction_control, total, submission_time) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $stmt = $db->prepare($sql);
        $result = $stmt->execute([$student_id, $task_id, $student_name, $student_email, $student_group, $stimulus_detection, $body_humidity, $physical_activity, $mobility_confidence, $feeding_habit, $friction_control, $total, $submission_time]);
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