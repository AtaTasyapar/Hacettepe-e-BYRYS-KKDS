<?php
require_once("config-students.php");
$sql = "DELETE FROM task;
        DELETE FROM uploads;
        DELETE FROM testcase;
        DELETE FROM pretest1;
        DELETE FROM pretest2;
        DELETE FROM posttest1;
        DELETE FROM posttest2;";
$stmt = $db->prepare($sql);
$result = $stmt->execute();
if ($result) {
    echo 'success';
} else {
    echo 'Hata';
}
?>