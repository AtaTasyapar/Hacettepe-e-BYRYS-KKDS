<?php
session_start();
require_once('config-students.php');

$id = $_POST['id'];
$student_group = $_POST['group'];
$current_group = $_POST['current_group'];
if($current_group != 'unassigned'){
    if ($current_group != $student_group) {
        // Define the SQL statements for each table
        $sql1 = 'DELETE FROM pretest1 WHERE student_id = ?';
        $sql2 = 'DELETE FROM pretest2 WHERE student_id = ?';
        $sql3 = 'DELETE FROM posttest1 WHERE student_id = ?';
        $sql4 = 'DELETE FROM posttest2 WHERE student_id = ?';
    
            $stmt1 = $db->prepare($sql1);
            $stmt2 = $db->prepare($sql2);
            $stmt3 = $db->prepare($sql3);
            $stmt4 = $db->prepare($sql4);
    
            $stmt1->execute([$id]);
            $stmt2->execute([$id]);
            $stmt3->execute([$id]);
            $stmt4->execute([$id]);
}
    }
$sql = "UPDATE students SET student_group = ? WHERE id = ?";
$smtmselect = $db->prepare($sql);
$result = $smtmselect->execute([$student_group,$id]);
if ($result) {
       echo 'success';
} else {
    echo 'Hata';
}
