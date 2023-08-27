<?php
require_once('./config-students.php');

if (isset($_POST['task_id'])) {
    $sql = 'SELECT * FROM custom_task WHERE id = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute([$_POST['task_id']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $task_id = $_POST['task_id'];
    if ($result) {
        $viewCount = $result['view_count'];
        $viewCount++;
        $sqlUpdate = 'UPDATE custom_task SET view_count= ?  WHERE id = ?';
        $stmtUpdate = $db->prepare($sqlUpdate);
        $stmtUpdate->execute([$viewCount, $task_id]);
        echo 'successfully updated';
    } else {
        echo 'No data';
    }
}
?>