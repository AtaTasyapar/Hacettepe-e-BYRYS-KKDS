<?php

require_once('./config-students.php');

if(isset($_POST['student_id'])){

    $tests = [];

    $sql = "SELECT * FROM pretest1 where student_id = {$_POST['student_id']}";
    $result = $db->query($sql);
    if ($result){
        array_push($tests, "Pretest 1");
    }
    $sql = "SELECT * FROM pretest2 where student_id = {$_POST['student_id']}";
    $result = $db->query($sql);
    if ($result){
        array_push($tests, "Pretest 2");
    } 

    echo json_encode($tests);

} else {
    echo 'No data';
}

?>