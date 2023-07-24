<?php
require_once('./config-students.php');

if(isset($_POST['noc'])){
    $patient_data = $_POST['patient_data'];
    $noc = $_POST['noc'];
    $noc_assessment = $_POST['noc_assessment'];
    $nic = $_POST['nic'];
    $student_id = $_POST['student_id'];

    $sql = "UPDATE testcase SET noc=?, noc_assessment=?, nic=?, patient_data=? WHERE student_id=? ";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute([$noc, $noc_assessment, $nic, $patient_data, $student_id]);
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