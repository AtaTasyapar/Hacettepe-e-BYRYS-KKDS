<?php
require_once("config-students.php");
$sql = "DELETE from task, uploads, testcase, pretest1, pretest2, posttest1, posttest2";
$stmt = $db->prepare($sql);
$result = $stmt->execute();
if ($result) {
    echo 'success';
} else {
    echo 'Hata';
}
?>