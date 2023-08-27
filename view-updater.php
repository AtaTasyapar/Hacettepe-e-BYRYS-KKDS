<?php
require_once('./config-students.php');

if (isset($_POST['task_id'])) {
    $sql = 'SELECT * FROM custom_task WHERE id = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute([$_POST['task_id']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $viewCount = $result['view_count'];
        $watches = $result['watches'];
        $watchesArray = json_decode($watches, true);
        
        $student_group = $_POST['student_group'];
        $task_id = $_POST['task_id'];
        $student_id = $_POST['student_id'];
        $currentLength = $_POST['currentLength'];
        
        // Create a new watch entry
        $newWatch = [
            'student_id' => $student_id,
            'watch_time' => $currentLength
        ];
        $viewCount++;
        
        $flag = false;
        
        foreach ($watchesArray as &$watch) {
            if ($watch['student_id'] == $student_id) {
                $watch['watch_time'] += $currentLength;
                $flag = true;
                break; 
            }
        }
        
        if (!$flag) {
            $watchesArray[] = $newWatch;
        }

        $watchesJson = json_encode($watchesArray);
        $sqlUpdate = 'UPDATE custom_task SET watches = ?  WHERE id = ?';
        $stmtUpdate = $db->prepare($sqlUpdate);
        $stmtUpdate->execute([$watchesJson, $task_id]);
        echo 'successfully updated';
    } else {
        echo 'No data';
    }
}
?>