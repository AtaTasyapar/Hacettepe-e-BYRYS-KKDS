<?php
session_start();
require_once('config-students.php');

$id = $_POST['id'];
$student_group = $_POST['group'];

$sql = "UPDATE students SET student_group = ? WHERE id = ?";
$smtmselect = $db->prepare($sql);
$result = $smtmselect->execute([$student_group,$id]);
if ($result) {
       echo 'success';
} else {
    echo 'Hata';
}
