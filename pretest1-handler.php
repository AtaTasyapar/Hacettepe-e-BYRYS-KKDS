<?php
require_once('./config-students.php');
if(isset($_POST['student_id'])){

$student_id = $_POST['student_id'];
$student_name = $_POST['student_name'];
$student_email = $_POST['student_email'];
$student_group = $_POST['student_group'];
$ulcer_prevention_confidence = $_POST['ulcer_prevention_confidence'];
$ulcer_prevention_training = $_POST['ulcer_prevention_training'];
$ulcer_prevention_difficulty = $_POST['ulcer_prevention_difficulty'];
$ulcer_prevention_attention = $_POST['ulcer_prevention_attention'];
$ulcer_prevention_importance = $_POST['ulcer_prevention_importance'];
$ulcer_prevention_priority = $_POST['ulcer_prevention_priority'];
$ulcer_prevention_discomfort = $_POST['ulcer_prevention_discomfort'];
$ulcer_prevention_exagerration = $_POST['ulcer_prevention_exagerration'];
$ulcer_prevention_economy = $_POST['ulcer_prevention_economy'];
$ulcer_prevention_responsibility = $_POST['ulcer_prevention_responsibility'];
$ulcer_prevention_role = $_POST['ulcer_prevention_role'];
$ulcer_prevention_highrisk = $_POST['ulcer_prevention_highrisk'];
$ulcer_prevention_ability = $_POST['ulcer_prevention_ability'];
$sql = 'INSERT into pretest1 (student_id, student_name, student_email, student_group, ulcer_prevention_confidence, ulcer_prevention_training, ulcer_prevention_difficulty, ulcer_prevention_attention, ulcer_prevention_importance, ulcer_prevention_priority, ulcer_prevention_discomfort, ulcer_prevention_exagerration, ulcer_prevention_economy, ulcer_prevention_responsibility, ulcer_prevention_role, ulcer_prevention_highrisk, ulcer_prevention_ability) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
$stmt = $db->prepare($sql);
$result = $stmt->execute([$student_id, $student_name, $student_email, $student_group, $ulcer_prevention_confidence, $ulcer_prevention_training, $ulcer_prevention_difficulty, $ulcer_prevention_attention, $ulcer_prevention_importance, $ulcer_prevention_priority, $ulcer_prevention_discomfort, $ulcer_prevention_exagerration, $ulcer_prevention_economy, $ulcer_prevention_responsibility, $ulcer_prevention_role, $ulcer_prevention_highrisk, $ulcer_prevention_ability]);
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