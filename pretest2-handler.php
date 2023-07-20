<?php
require_once('./config-students.php');
if(isset($_POST['student_id'])){

$student_id = $_POST['student_id'];
$student_name = $_POST['student_name'];
$student_email = $_POST['student_email'];
$student_group = $_POST['student_group'];
$theme1q1 = $_POST['theme1q1'];
$theme1q2 = $_POST['theme1q2'];
$theme1q3 = $_POST['theme1q3'];
$theme1q4 = $_POST['theme1q4'];
$theme1q5 = $_POST['theme1q5'];
$theme1q6 = $_POST['theme1q6'];
$theme2q1 = $_POST['theme2q1'];
$theme2q2 = $_POST['theme2q2'];
$theme2q3 = $_POST['theme2q3'];
$theme2q4 = $_POST['theme2q4'];
$theme2q5 = $_POST['theme2q5'];
$theme3q1 = $_POST['theme3q1'];
$theme3q2 = $_POST['theme3q2'];
$theme4q1 = $_POST['theme4q1'];
$theme5q1 = $_POST['theme5q1'];
$theme5q2 = $_POST['theme5q2'];
$theme5q3 = $_POST['theme5q3'];
$theme5q4 = $_POST['theme5q4'];
$theme5q5 = $_POST['theme5q5'];
$theme5q6 = $_POST['theme5q6'];
$theme5q7 = $_POST['theme5q7'];
$theme6q1 = $_POST['theme6q1'];
$theme6q2 = $_POST['theme6q2'];
$theme6q3 = $_POST['theme6q3'];
$theme6q4 = $_POST['theme6q4'];
$theme6q5 = $_POST['theme6q5'];
$submission_time = date("Y-m-d H:i:s");
$sql = 'INSERT into pretest2 (student_id, student_name, student_email, theme1q1, theme1q2, theme1q3, theme1q4, theme1q5, theme1q6, theme2q1, theme2q2, theme2q3, theme2q4, theme2q5, theme3q1, theme3q2, theme4q1, theme5q1, theme5q2, theme5q3, theme5q4, theme5q5, theme5q6, theme5q7, theme6q1, theme6q2, theme6q3, theme6q4, theme6q5, submission_time) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
$stmt = $db->prepare($sql);
$result = $stmt->execute([$student_id, $student_name, $student_email, $theme1q1, $theme1q2, $theme1q3, $theme1q4, $theme1q5, $theme1q6, $theme2q1, $theme2q2, $theme2q3, $theme2q4, $theme2q5, $theme3q1, $theme3q2, $theme4q1, $theme5q1, $theme5q2, $theme5q3, $theme5q4, $theme5q5, $theme5q6, $theme5q7, $theme6q1, $theme6q2, $theme6q3, $theme6q4, $theme6q5, $submission_time]);
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