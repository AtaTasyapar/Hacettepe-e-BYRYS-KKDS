<?php

require_once('./config-students.php');

if(isset($_POST['student_id'])){

    $tests = [];

    $sql = "SELECT * FROM pretest1 where student_id = {$_POST['student_id']}";
    $result = $db->query($sql)->fetchAll();
    if (sizeof($result) > 0){
        array_push($tests, "Pretest_1");
    }
    $sql = "SELECT * FROM pretest2 where student_id = {$_POST['student_id']}";
    $result = $db->query($sql)->fetchAll();
    if (sizeof($result) > 0){
        array_push($tests, "Pretest_2");
    }
    $sql = "SELECT * FROM posttest1 where student_id = {$_POST['student_id']}";
    $result = $db->query($sql)->fetchAll();
    if (sizeof($result) > 0){
        array_push($tests, "Posttest_1");
    }
    $sql = "SELECT * FROM posttest2 where student_id = {$_POST['student_id']}";
    $result = $db->query($sql)->fetchAll();
    if (sizeof($result) > 0){
        array_push($tests, "Posttest_2");
    }
    $sql = "SELECT * FROM testcase where student_id = {$_POST['student_id']}";
    $result = $db->query($sql)->fetchAll();
    if (sizeof($result) > 0){
        array_push($tests, "testcase");
    }

    echo json_encode($tests);

} else {
    echo 'No data';
}

?>