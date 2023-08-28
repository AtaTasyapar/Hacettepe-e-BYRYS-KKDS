<?php
require_once("config-students.php");
$sql = "DELETE FROM task;
        DELETE FROM uploads;
        DELETE FROM testcase;
        DELETE FROM pretest1;
        DELETE FROM pretest2;
        DELETE FROM posttest1;
        DELETE FROM posttest2;
        DELETE FROM custom_task;";
$stmt = $db->prepare($sql);
$result = $stmt->execute();

//unlink everytthing from the uploads folder
$files = glob('uploads/*');
foreach ($files as $file) {
    if (is_file($file)) {
        unlink($file);
    }
}
if ($result) {
    echo 'success';
} else {
    echo 'Hata';
}
?>