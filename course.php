
<?php
    require_once('config-students.php');
    session_start();
    $student_id = $_SESSION['userlogin']['id'];
    $sql = 'SELECT * FROM students WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $student_id);
    $result = $stmt->execute();
    if($result){
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        $student_name = $student['name'] . ' ' . $student['surname'];
        $student_email = $student['email'];
        $student_group = $student['student_group'];
    }
    else{
        echo 'error1';
    }

    $sql = 'SELECT * FROM pretest1 WHERE student_id = :id AND student_group = :group';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $student_id);
    $stmt->bindParam(':group', $student_group);
    $result = $stmt->execute();

    if($result){

        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rows){
            $pretest1 = $rows;
        }
    }else{
        echo 'error2';
    }

    $sql = 'SELECT * FROM pretest2 WHERE student_id = :id AND student_group = :group' ;
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $student_id);
    $stmt->bindParam(':group', $student_group);

    $result = $stmt->execute();

    if($result){
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rows){
            $pretest2 = $rows;
        }
    }else{
        echo 'error3';
    }
    $sql = 'SELECT * FROM posttest1 WHERE student_id = :id AND student_group = :group';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $student_id);
    $stmt->bindParam(':group', $student_group);

    $result = $stmt->execute();

    if($result){
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rows){
            $posttest1 = $rows;
        }
    }else{
        echo 'error4';
    }
    $sql = 'SELECT * FROM posttest2 WHERE student_id = :id AND student_group = :group';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $student_id);
    $stmt->bindParam(':group', $student_group);

    $result = $stmt->execute();

    if($result){
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rows){
            $posttest2 = $rows;
        }
    }else{
        echo 'error5';
    }
    $sql = 'SELECT * FROM testcase WHERE student_id = :id AND student_group = :group';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $student_id);
    $stmt->bindParam(':group', $student_group);

    $result = $stmt->execute();

    if($result){
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rows){
            $testcase = $rows;
        }
    }else{
        echo 'error6';
    }

    $sql = 'SELECT * FROM task';
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();
    $tasks = [];
    if($result){
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($rows){
            $tasks = $rows;
        }
        else{
        }
    }else{
    }

    $sql = 'SELECT * FROM custom_task';
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();
    $custom_tasks = [];
    if($result){
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($rows){
            $custom_tasks = $rows;
        }
        else{
            echo 'error9';
        }
    }else{
        echo 'error10';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <style>
        
        .activity-container{
            width: 30%;
            /* display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: start; */
            box-shadow: 2px 2px 2px rgb(226, 226, 226);
            margin-bottom: 20px;
        }

        .activity-container h5{
            cursor: pointer;
            color: rgb(94, 94, 245);
            width: 75%;
        }
        .completion-indicator{
            width: fit-content;
        }
        .overlay{
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 999;
        }
        #assignment-container{
            position: absolute;
            z-index: 1000;
            width: 95%;
            height: 90%;
            border: 2px solid black;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 15px;
        }
            #file-container{
                    font-size: x-small;
                }
        @media screen and (max-width: 768px){
            #assignment-container{
              font-size: small;
            }
          
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    
        <div class="overlay" style="display: none;">
        </div>
    

    <div id="assignment-container" style="display: none;">
        <button class="btn btn-success" id='assignment-closer'>Kapat</button>
        <div id='custom-task-container' style="width: 90%; height: 90%;"></div>
    </div>




    <div class="send-patient w-75" style="background-color: white; margin-top: 50px; padding-bottom: 20px; padding-top: 20px; margin-bottom: 20px; aspect-ratio: 3; box-shadow: 2px 5px 10px 1px rgba(0, 0, 0, 0.2); border-radius: 10px">
        <?php
        if ($student_group === 'unassigned') {
            echo '<h3>Henüz bir gruba atanmadınız!</h3>';
        }else{
            
            echo '
            <div class="container-fluid">
                <h2 id="heading" class="text-center pt-2 mt-3" style="color : black">' . $student_group . ' Kurs</h2>
            </div>
            <div class="container-fluid">
                <h6 id="heading" class="text-start pt-2" style="color : black">Kursa Genel Bakış</h6>
            </div>
            <div class="container-fluid mb-5 mt-4 pb-4" style="border-bottom : 2px solid black; width: 98%;" >            
                <h2 style="color : black; border-bottom: 2px solid grey; padding-bottom : 10px">Hafta 1</h2>';
                $task_count = 0;
                foreach($tasks as $task){
                    if($task['task_week'] == 'week1' && strtolower($task['student_group']) == strtolower($student_group)){
                        $task_count++;
                    }
                }
                foreach($custom_tasks as $custom_task){
                    if($custom_task['task_week'] == 'week1' && strtolower($custom_task['student_group']) == strtolower($student_group)){
                        $task_count++;
                    }
                }
                if($task_count == 0){
                    echo '<h5 style="padding-bottom: 50px;">Bu hafta için henüz bir görev atanmadı!</h5>';
                }
            foreach($tasks as $task){
                if(strtolower($task['task_name']) == strtolower('pretest1') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week1'){
                    if (!isset($pretest1)) {
                        echo '
                        <div class="activity-container">
                        <h5 id="pretest1" data-task-id="'.$task['id'].'"  >Pre-test 1</h5>
                        <h5 class="completion-indicator" style="color: red;">
                            Eksik
                        </h5>
                        <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                    </div>';
                    }else {
                        echo '
                        <div class="activity-container">
                        <h5 id="pretest1-comp">Pre-test 1</h5>
                        <h5 class="completion-indicator" style="color: green;"  >
                            Tamamlandı
                        </h5>
                        <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                    </div>';
                    }      
                }
            }            

            foreach($tasks as $task){
                if(strtolower($task['task_name']) == strtolower('pretest2') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week1'){
                    if (!isset($pretest2)) {
                        echo '
                        <div class="activity-container">
                            <h5 id="pretest2" data-task-id="'.$task['id'].'">Pre-test 2</h5>
                            <h5 class="completion-indicator" style="color: red;">
                                Eksik
                            </h5>
                            <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                        </div>';
                    }else {
                        echo '
                        <div class="activity-container">
                            <h5 id="pretest2-comp">Pre-test 2</h5>
                            <h5 class="completion-indicator" style="color: green;">
                                Tamamlandı
                            </h5>
                            <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>

                        </div>';
                    }
        }
    }
            foreach($tasks as $task){
                if(strtolower($task['task_name']) == strtolower('posttest1') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week1'){
                    if (!isset($posttest1)) {
                        echo '
                        <div class="activity-container">
                            <h5 id="posttest1" data-task-id="'.$task['id'].'">Post-test 1</h5>
                            <h5 class="completion-indicator" style="color: red;">
                                Eksik
                            </h5>
                            <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>

                        </div>';
                    }else {
                        echo '
                        <div class="activity-container">
                            <h5 id="posttest1-comp">Post-test 1</h5>
                            <h5 class="completion-indicator" style="color: green;">
                                Tamamlandı
                            </h5>
                            <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                        </div>';
                    }
        }
    }
            foreach($tasks as $task){
                if(strtolower($task['task_name']) == strtolower('posttest2') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week1'){
                    if (!isset($posttest2)) {
                        echo '
                        <div class="activity-container">
                            <h5 id="posttest2" data-task-id="'.$task['id'].'">Post-test 2</h5>
                            <h5 class="completion-indicator" style="color: red;">
                                Eksik
                            </h5>
                            <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                        </div>';
                    }else {
                        echo '
                        <div class="activity-container">
                            <h5 id="posttest2-comp">Post-test 2</h5>
                            <h5 class="completion-indicator" style="color: green;">
                                Tamamlandı
                            </h5>
                            <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                        </div>';
                    }
        }
    }
    foreach($tasks as $task){
        if(strtolower($task['task_name']) == strtolower('testcase') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week1'){
            if (!isset($testcase)) {
                echo '
                <div class="activity-container">
                    <h5 id="testcase" data-task-id="'.$task['id'].'">Test Case</h5>
                    <h5 class="completion-indicator" style="color: red;">
                        Eksik
                    </h5>
                    <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                </div>';
            }else {
                echo '
                <div class="activity-container">
                    <h5 id="testcase-comp">Test Case</h5>
                    <h5 class="completion-indicator" style="color: green;">
                        Tamamlandı
                    </h5>
                    <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                </div>';
            }
}
}

foreach ($custom_tasks as $single_custom_task) {
    $viewCountContainerId = $single_custom_task['id'];
    if (strtolower($single_custom_task['task_week']) == strtolower('week1') && strtolower($single_custom_task['student_group']) == strtolower($student_group)) {
        echo '<a class="custom-task-anchor" style="text-decoration: none;"  href="#" data-task-desc="' . $single_custom_task['task_desc'] . '" data-file-name="' . $single_custom_task['file_name'] . '" data-file-path="' . $single_custom_task['file_path'] . '" data-task-id="'.$single_custom_task['id'].'"><div class="activity-container" id="custom-container" >';
        echo '<h5 id="custom-task" class="text-start">Başlık : ' . $single_custom_task['task_name'] . '</h5>';
        echo '<textarea name="" id="" cols="30" rows="10" disabled style="width: 80%; padding: 10px;"> Tarif: ' . $single_custom_task['task_desc'] . 'asdasdjadkjaskjdjkasdkjaskjdjkakjdkjsadkjasjkdjkasjdkjaskdasdasdansdnmsadmnsa</textarea>';
        echo '<p id="file-container"><i class="fas fa-file"></i> ' . $single_custom_task['file_name'] . '</p>';
        echo '<h6 id="'.$viewCountContainerId.'"><i class="fas fa-eye"></i> ' . $single_custom_task['view_count'] . '</h6>';
        echo '</div></a>';
    }
}
echo '</div>';


            

            echo '
            <div class="container-fluid mb-5 pb-4" style="border-bottom : 2px solid black; width: 98%;">            
            <h2 style="color : black; border-bottom: 2px solid grey; padding-bottom : 10px">Hafta 2</h2>';
            $task_count = 0;
                foreach($tasks as $task){
                    if($task['task_week'] == 'week2' && strtolower($task['student_group']) == strtolower($student_group)){
                        $task_count++;
                    }
                }
                foreach($custom_tasks as $custom_task){
                    if($custom_task['task_week'] == 'week2' && strtolower($custom_task['student_group']) == strtolower($student_group)){
                        $task_count++;
                    }
                }
                if($task_count == 0){
                    echo '<h5 style="padding-bottom: 50px;">Bu hafta için henüz bir görev atanmadı!</h5>';
                }
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('pretest1') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week2'){
                        if (!isset($pretest1)) {
                            echo '
                            <div class="activity-container">
                            <h5 id="pretest1" data-task-id="'.$task['id'].'">Pre-test 1</h5>
                            <h5 class="completion-indicator" style="color: red;">
                                Eksik
                            </h5>
                            <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                        </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                            <h5 id="pretest1-comp">Pre-test 1</h5>
                            <h5 class="completion-indicator" style="color: green;"  >
                                Tamamlandı
                            </h5>
                            <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                        </div>';
                        }      
                    }
                }   
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('pretest2') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week2'){
                        if (!isset($pretest2)) {
                            echo '
                            <div class="activity-container">
                                <h5 id="pretest2" data-task-id="'.$task['id'].'">Pre-test 2</h5>
                                <h5 class="completion-indicator" style="color: red;">
                                    Eksik
                                </h5>
                                <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                                <h5 id="pretest2-comp">Pre-test 2</h5>
                                <h5 class="completion-indicator" style="color: green;">
                                    Tamamlandı
                                </h5>
                                <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </div>';
                        }
            }
        }
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('posttest1') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week2'){
                        if (!isset($posttest1)) {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest1" data-task-id="'.$task['id'].'">Post-test 1</h5>
                                <h5 class="completion-indicator" style="color: red;">
                                    Eksik
                                </h5>
                                <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest1-comp">Post-test 1</h5>
                                <h5 class="completion-indicator" style="color: green;">
                                    Tamamlandı
                                </h5>
                                <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </div>';
                        }
            }
        }
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('posttest2') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week2'){
                        if (!isset($posttest2)) {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest2" data-task-id="'.$task['id'].'">Post-test 2</h5>
                                <h5 class="completion-indicator" style="color: red;">
                                    Eksik
                                </h5>
                                <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest2-comp">Post-test 2</h5>
                                <h5 class="completion-indicator" style="color: green;">
                                    Tamamlandı
                                </h5>
                                <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </div>';
                        }
            }
        } 
        foreach($tasks as $task){
            if(strtolower($task['task_name']) == strtolower('testcase') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week2'){
                if (!isset($testcase)) {
                    echo '
                    <div class="activity-container">
                        <h5 id="testcase" data-task-id="'.$task['id'].'">Test Case</h5>
                        <h5 class="completion-indicator" style="color: red;">
                            Eksik
                        </h5>
                        <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                    </div>';
                }else {
                    echo '
                    <div class="activity-container">
                        <h5 id="testcase-comp">Test Case</h5>
                        <h5 class="completion-indicator" style="color: green;">
                            Tamamlandı
                        </h5>
                        <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                    </div>';
                }
    }
    }
    foreach ($custom_tasks as $single_custom_task) {
        $viewCountContainerId = $single_custom_task['id'];
        if (strtolower($single_custom_task['task_week']) == strtolower('week2') && strtolower($single_custom_task['student_group']) == strtolower($student_group)) {
            echo '<a class="custom-task-anchor" style="text-decoration: none;"  href="#" data-task-desc="' . $single_custom_task['task_desc'] . '" data-file-name="' . $single_custom_task['file_name'] . '" data-file-path="' . $single_custom_task['file_path'] . '" data-task-id="'.$single_custom_task['id'].'"><div class="activity-container" id="custom-container" >';
            echo '<h5 id="custom-task" class="text-start">Başlık : ' . $single_custom_task['task_name'] . '</h5>';
            echo '<textarea name="" id="" cols="30" rows="10" disabled style="width: 80%; padding: 10px;"> Tarif: ' . $single_custom_task['task_desc'] . 'asdasdjadkjaskjdjkasdkjaskjdjkakjdkjsadkjasjkdjkasjdkjaskdasdasdansdnmsadmnsa</textarea>';
            echo '<p id="file-container"><i class="fas fa-file"></i> ' . $single_custom_task['file_name'] . '</p>';
            echo '<h6 id="'.$viewCountContainerId.'"><i class="fas fa-eye"></i> ' . $single_custom_task['view_count'] . '</h6>';
            echo '</div></a>';
        }
    }
            echo '    
            </div>
            ';



            echo '
            <div class="container-fluid mb-5 pb-4" style="border-bottom : 2px solid black; width: 98%;">            <h2 style="color : black; border-bottom: 2px solid grey; padding-bottom : 10px">Hafta 3</h2>';
            $task_count = 0;
                foreach($tasks as $task){
                    if($task['task_week'] == 'week3' && strtolower($task['student_group']) == strtolower($student_group)){
                        $task_count++;
                    }
                }
                foreach($custom_tasks as $custom_task){
                    if($custom_task['task_week'] == 'week3' && strtolower($custom_task['student_group']) == strtolower($student_group)){
                        $task_count++;
                    }
                }
                if($task_count == 0){
                    echo '<h5 style="padding-bottom: 50px;">Bu hafta için henüz bir görev atanmadı!</h5>';
                }
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('pretest1') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week3'){
                        if (!isset($pretest1)) {
                            echo '
                            <div class="activity-container">
                            <h5 id="pretest1" data-task-id="'.$task['id'].'">Pre-test 1</h5>
                            <h5 class="completion-indicator" style="color: red;">
                                Eksik
                                <h5><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </h6></div>';
                        }else {
                            echo '
                            <div class="activity-container">
                            <h5 id="pretest1-comp">Pre-test 1</h5>
                            <h5 class="completion-indicator" style="color: green;"  >
                                Tamamlandı
                                <h5><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </h6></div>';
                        }      
                    }
                }   
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('pretest2') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week3'){
                        if (!isset($pretest2)) {
                            echo '
                            <div class="activity-container">
                                <h5 id="pretest2" data-task-id="'.$task['id'].'">Pre-test 2</h5>
                                <h5 class="completion-indicator" style="color: red;">
                                    Eksik
                                </h5>
                                <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                                <h5 id="pretest2-comp">Pre-test 2</h5>
                                <h5 class="completion-indicator" style="color: green;">
                                    Tamamlandı
                                </h5>
                                <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </div>';
                        }
            }
        }
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('posttest1') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week3'){
                        if (!isset($posttest1)) {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest1" data-task-id="'.$task['id'].'">Post-test 1</h5>
                                <h5 class="completion-indicator" style="color: red;">
                                    Eksik
                                </h5>
                                <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest1-comp">Post-test 1</h5>
                                <h5 class="completion-indicator" style="color: green;">
                                    Tamamlandı
                                </h5>
                                <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </div>';
                        }
            }
        }
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('posttest2') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week3'){
                        if (!isset($posttest2)) {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest2" data-task-id="'.$task['id'].'">Post-test 2</h5>
                                <h5 class="completion-indicator" style="color: red;">
                                    Eksik
                                </h5>
                                <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest2-comp">Post-test 2</h5>
                                <h5 class="completion-indicator" style="color: green;">
                                    Tamamlandı
                                </h5>
                                <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </div>';
                        }
            }
        } 
        foreach($tasks as $task){
            if(strtolower($task['task_name']) == strtolower('testcase') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week3'){
                if (!isset($posttest2)) {
                    echo '
                    <div class="activity-container">
                        <h5 id="testcase">Test Case</h5>
                        <h5 class="completion-indicator" style="color: red;">
                            Eksik
                        </h5>
                        <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                    </div>';
                }else {
                    echo '
                    <div class="activity-container">
                        <h5 id="testcase-comp">Test Case</h5>
                        <h5 class="completion-indicator" style="color: green;">
                            Tamamlandı
                        </h5>
                        <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                    </div>';
                }
    }
    }
    foreach ($custom_tasks as $single_custom_task) {
        $viewCountContainerId = $single_custom_task['id'];
        if (strtolower($single_custom_task['task_week']) == strtolower('week3') && strtolower($single_custom_task['student_group']) == strtolower($student_group)) {
            echo '<a class="custom-task-anchor" style="text-decoration: none;"  href="#" data-task-desc="' . $single_custom_task['task_desc'] . '" data-file-name="' . $single_custom_task['file_name'] . '" data-file-path="' . $single_custom_task['file_path'] . '" data-task-id="'.$single_custom_task['id'].'"><div class="activity-container" id="custom-container" >';
            echo '<h5 id="custom-task" class="text-start">Başlık : ' . $single_custom_task['task_name'] . '</h5>';
            echo '<textarea name="" id="" cols="30" rows="10" disabled style="width: 80%; padding: 10px;"> Tarif: ' . $single_custom_task['task_desc'] . 'asdasdjadkjaskjdjkasdkjaskjdjkakjdkjsadkjasjkdjkasjdkjaskdasdasdansdnmsadmnsa</textarea>';
            echo '<p id="file-container"><i class="fas fa-file"></i> ' . $single_custom_task['file_name'] . '</p>';
            echo '<h6 id="'.$viewCountContainerId.'"><i class="fas fa-eye"></i> ' . $single_custom_task['view_count'] . '</h6>';
            echo '</div></a>';
        }
    }
              
            echo '</div>';



            echo '
            <div class="container-fluid mb-5 pb-4" style="border-bottom : 2px solid black; width: 98%;">            <h2 style="color : black; border-bottom: 2px solid grey; padding-bottom : 10px">Hafta 4</h2>';
            $task_count = 0;
                foreach($tasks as $task){
                    if($task['task_week'] == 'week4' && strtolower($task['student_group']) == strtolower($student_group)){
                        $task_count++;
                    }
                }
                foreach($custom_tasks as $custom_task){
                    if($custom_task['task_week'] == 'week4' && strtolower($custom_task['student_group']) == strtolower($student_group)){
                        $task_count++;
                    }
                }
                if($task_count == 0){
                    echo '<h5 style="padding-bottom: 50px;">Bu hafta için henüz bir görev atanmadı!</h5>';
                } 
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('pretest1') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week4'){
                        if (!isset($pretest1)) {
                            echo '
                            <div class="activity-container">
                            <h5 id="pretest1" data-task-id="'.$task['id'].'">Pre-test 1</h5>
                            <h5 class="completion-indicator" style="color: red;">
                                Eksik
                            </h5>
                            <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                        </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                            <h5 id="pretest1-comp">Pre-test 1</h5>
                            <h5 class="completion-indicator" style="color: green;"  >
                                Tamamlandı
                            </h5>
                            <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                        </div>';
                        }      
                    }
                }   
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('pretest2') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week4'){
                        if (!isset($pretest2)) {
                            echo '
                            <div class="activity-container">
                                <h5 id="pretest2" data-task-id="'.$task['id'].'">Pre-test 2</h5>
                                <h5 class="completion-indicator" style="color: red;">
                                    Eksik
                                </h5>
                                <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                                <h5 id="pretest2-comp">Pre-test 2</h5>
                                <h5 class="completion-indicator" style="color: green;">
                                    Tamamlandı
                                </h5>
                                <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </div>';
                        }
            }
        }
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('posttest1') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week4'){
                        if (!isset($posttest1)) {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest1" data-task-id="'.$task['id'].'">Post-test 1</h5>
                                <h5 class="completion-indicator" style="color: red;">
                                    Eksik
                                </h5>
                                <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest1-comp">Post-test 1</h5>
                                <h5 class="completion-indicator" style="color: green;">
                                    Tamamlandı
                                </h5>
                                <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </div>';
                        }
            }
        }
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('posttest2') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week4'){
                        if (!isset($posttest2)) {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest2" data-task-id="'.$task['id'].'">Post-test 2</h5>
                                <h5 class="completion-indicator" style="color: red;">
                                    Eksik
                                </h5>
                                <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest2-comp">Post-test 2</h5>
                                <h5 class="completion-indicator" style="color: green;">
                                    Tamamlandı
                                </h5>
                                <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                            </div>';
                        }
            }
        } 
        foreach($tasks as $task){
            if(strtolower($task['task_name']) == strtolower('testcase') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week4'){
                if (!isset($posttest2)) {
                    echo '
                    <div class="activity-container">
                        <h5 id="testcase" data-task-id="'.$task['id'].'">Test Case</h5>
                        <h5 class="completion-indicator" style="color: red;">
                            Eksik
                        </h5>
                        <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                    </div>';
                }else {
                    echo '
                    <div class="activity-container">
                        <h5 id="testcase-comp">Test Case</h5>
                        <h5 class="completion-indicator" style="color: green;">
                            Tamamlandı
                        </h5>
                        <h6><i class="fas fa-eye"></i> ' . $task['view_count'] . '</h6>
                    </div>';
                }
    }
    }
    foreach ($custom_tasks as $single_custom_task) {
        $viewCountContainerId = $single_custom_task['id'];
        if (strtolower($single_custom_task['task_week']) == strtolower('week4') && strtolower($single_custom_task['student_group']) == strtolower($student_group)) {
            echo '<a class="custom-task-anchor" style="text-decoration: none;"  href="#" data-task-desc="' . $single_custom_task['task_desc'] . '" data-file-name="' . $single_custom_task['file_name'] . '" data-file-path="' . $single_custom_task['file_path'] . '" data-task-id="'.$single_custom_task['id'].'"><div class="activity-container" id="custom-container" >';
            echo '<h5 id="custom-task" class="text-start">Başlık : ' . $single_custom_task['task_name'] . '</h5>';
            echo '<textarea name="" id="" cols="30" rows="10" disabled style="width: 80%; padding: 10px;"> Tarif: ' . $single_custom_task['task_desc'] . 'asdasdjadkjaskjdjkasdkjaskjdjkakjdkjsadkjasjkdjkasjdkjaskdasdasdansdnmsadmnsa</textarea>';
            echo '<p id="file-container"><i class="fas fa-file"></i> ' . $single_custom_task['file_name'] . '</p>';
            echo '<h6 id="'.$viewCountContainerId.'"><i class="fas fa-eye"></i> ' . $single_custom_task['view_count'] . '</h6>';
            echo '</div></a>';
        }
    }
            echo '</div>';
        }
        ?>
    </div>
</body>

<script>
    //scroll to top
    $('body').css('overflow', 'auto');
    var student_group = <?php echo json_encode($student_group); ?>;
    console.log(student_group)
    if(student_group != 'unassigned'){
        $('#unassigned').css('display', 'none');
            $('#assigned-heading').css('display', 'none');
    }
    else{
        $('#heading').css('display', 'none');
    }
    $('#pretest1').click(function (e) { 
        const task_id = $(this).data('task-id');
        $.ajax({
            type: "POST",
            url: "./simpleViewUpdater.php",
            data: {
                task_id: task_id
            },
            success: function (response) {
                console.log(response);
            }
        });
        e.preventDefault();
    
    $('#content').load('./pretest1.php?task_id=' + task_id)
        
    });
    $('#pretest2').click(function (e) { 
        const task_id = $(this).data('task-id');
        $.ajax({
            type: "POST",
            url: "./simpleViewUpdater.php",
            data: {
                task_id: task_id
            },
            success: function (response) {
                
            }
        });
        e.preventDefault();

    $('#content').load('./pretest2.php?task_id=' + task_id)
                
    });
    $('#posttest1').click(function (e) { 
        const task_id = $(this).data('task-id');
        $.ajax({
            type: "POST",
            url: "./simpleViewUpdater.php",
            data: {
                task_id: task_id
            },
            success: function (response) {
                
            }
        });
        console.log(task_id);
        $('#content').load('./posttest1.php')
    });
    $('#posttest2').click(function (e) { 
        const task_id = $(this).data('task-id');
        $.ajax({
            type: "POST",
            url: "./simpleViewUpdater.php",
            data: {
                task_id: task_id
            },
            success: function (response) {
                
            }
        });
        e.preventDefault();
        $('#content').load('./posttest2.php?task_id=' + task_id)
    });
   
   
    $('#testcase').click(function (e) { 
    const task_id = $(this).data('task-id');
    $.ajax({
        type: "POST",
        url: "./simpleViewUpdater.php",
        data: {
            task_id: task_id
        },
        success: function (response) {
            console.log(response);
            $('#content').load('test-case.php?task_id=' + task_id);
        }
    });
    e.preventDefault();
});

    $('.custom-task-anchor').click(function(e){
        e.preventDefault();
        //scroll to top
        $('.overlay').css('display', 'block');
        $('html, body').animate({scrollTop:0}, '0');
        //scroll disabled
        $('html, body').css('overflow', 'hidden');
        const fileName = $(this).data('file-name');
        const fileExtension = fileName.split('.').pop();
        const file_path = $(this).data('file-path');
        const task_id = $(this).data('task-id');
        console.log(file_path);

        if(fileExtension==='pdf'){
            $('#custom-task-container').append('<p id=' +  task_id + '></p>')
            $.ajax({
                            type: "POST",
                            url: "./viewCount-updater.php",
                            data: {
                                task_id: task_id
                            },
                            success: function (response) {
                                console.log(response);
                            },
                            error: function (response) {
                                console.log('unable to send data');
                            }
                        });
            $('#custom-task-container').html('<embed src='+ encodeURI(file_path) + ' type="application/pdf" width="100%" height="100%" />');
        }
        else if (fileExtension === 'pptx' || fileExtension === 'ppt') {
            $('#custom-task-container').append('<h1 id="presentation"></h1>');
            $('#custom-task-container').append('<p id=' +  task_id + '></p>')
            $('#custom-task-container').append('<p id="loading">Loading..... please wait</p>')
            $.ajax({
                            type: "POST",
                            url: "./viewCount-updater.php",
                            data: {
                                task_id: task_id
                            },
                            success: function (response) {
                                console.log(response);
                            },
                            error: function (response) {
                                console.log('unable to send data');
                            }
                        });
            $.ajax({
                type: "POST",
                url: "./converter.php",
                data: {
                    file_path: file_path,
                    file_name: fileName
                },
                success: function (response) {
                    if(response === 'conversion successfull'){
                        $('#custom-task-container #loading').remove();
                        console.log('helloo')
                        let newFileName = "uploads/" + fileName.split('.')[0] + '.pdf';
                        $('#custom-task-container').append('<embed src='+ encodeURI(newFileName) + ' type="application/pdf" width="100%" height="100%" />');
                    }
                },
                error: function (response) {
                    console.log('unable to send data');
                }
            });
}       
else if(fileExtension === 'word' || fileExtension === 'docx' || fileExtension === 'doc'){
            $('#custom-task-container').append('<p id=' +  task_id + '></p>')
            $('#custom-task-container').append('<p id="loading">Loading..... please wait</p>')
        
            $.ajax({
                            type: "POST",
                            url: "./viewCount-updater.php",
                            data: {
                                task_id: task_id
                            },
                            success: function (response) {
                                console.log(response);
                            },
                            error: function (response) {
                                console.log('unable to send data');
                            }
                        });
            $.ajax({
                type: "POST",
                url: "./converter.php",
                data: {
                    file_path: file_path,
                    file_name: fileName
                },
                success: function (response) {
                    alert(response)
                    if(response === 'conversion successfull'){
                        
                        $('#custom-task-container #loading').remove();
                        let newFileName = "uploads/" + fileName.split('.')[0] + '.pdf';
                        console.log(newFileName)
                        $('#custom-task-container').append('<embed src='+ encodeURI(newFileName) + ' type="application/pdf" width="100%" height="100%" />');
                    }
                },
                error: function (response) {
                    console.log('unable to send data');
                }
            });
}

        else if(fileExtension==='png' || fileExtension==='jpg' || fileExtension==='jpeg'){
            $('#custom-task-container').append('<p id=' +  task_id + '></p>')
            $('#custom-task-container').html('<img src=' + file_data + ' width="100%" height="100%" />');
            $.ajax({
                            type: "POST",
                            url: "./viewCount-updater.php",
                            data: {
                                task_id: task_id
                            },
                            success: function (response) {
                                console.log(response);
                            },
                            error: function (response) {
                                console.log('unable to send data');
                            }
                        });

        }
        else if(fileExtension==='mp4' || fileExtension==='webm' || fileExtension==='ogg' || fileExtension==='mov' || fileExtension==='wmv' || fileExtension==='flv' || fileExtension==='avi' || fileExtension==='mkv'){
            
            $('#custom-task-container').html('<video width="100%" height="100%" controls autoplay><source src=' + encodeURI(file_path) + ' type="video/mp4"></video>');
            $('#custom-task-container').append('<p id=' +  task_id + '></p>')
            $('#custom-task-container').append('<h1 id="video"></h1>');
            $.ajax({
                            type: "POST",
                            url: "./viewCount-updater.php",
                            data: {
                                task_id: task_id
                            },
                            success: function (response) {
                                console.log(response);
                            },
                            error: function (response) {
                                console.log('unable to send data');
                            }
                        });
        }
        else if(fileExtension==='mp3'){
            $('#custom-task-container').append('<p id=' +  task_id + '></p>')
            $.ajax({
                            type: "POST",
                            url: "./viewCount-updater.php",
                            data: {
                                task_id: task_id
                            },
                            success: function (response) {
                                console.log(response);
                            },
                            error: function (response) {
                                console.log('unable to send data');
                            }
                        });
            $('#custom-task-container').append('<audio controls><source src=' + encodeURI(file_path) + ' type="audio/mp3"></audio>');
        }
        else if(fileExtension==='txt'){
            $('#custom-task-container').append('<p id=' +  task_id + '></p>')
            $.ajax({
                            type: "POST",
                            url: "./viewCount-updater.php",
                            data: {
                                task_id: task_id
                            },
                            success: function (response) {
                                console.log(response);
                            },
                            error: function (response) {
                                console.log('unable to send data');
                            }
                        });
            $('#custom-task-container').append('<pre>' + file_data + '</pre>');
            $.ajax({
                            type: "POST",
                            url: "./viewCount-updater.php",
                            data: {
                                task_id: task_id
                            },
                            success: function (response) {
                                console.log(response);
                            },
                            error: function (response) {
                                console.log('unable to send data');
                            }
                        });
        }
        else{
            $('#custom-task-container').html('<h1>Invalid file format</h1>');
        }
        $('#assignment-container').css('display', 'block');

    })
    $('#assignment-closer').click(function (e) { e.preventDefault();
        $('.overlay').css('display', 'none');
        $('html, body').css('overflow', 'auto');
        const student_id = <?php echo json_encode($student_id); ?>;
        const student_name = <?php echo json_encode($student_name); ?>;
        const student_group = <?php echo json_encode($student_group); ?>;
        const task_id = $('#custom-task-container p').attr('id');
        const task_type = $('#custom-task-container h1').attr('id');
      console.log($('#custom-task-container h6').html());
        if(task_type === 'video'){
            let  video = document.querySelector('video');
            let currentLength = video.currentTime;

            if(video){
                video.pause();
         $.ajax({
             type: "POST",
             url: "./view-updater.php",
             data: {
                 currentLength: currentLength,
                 student_id: student_id,
                 student_group: student_group,
                 student_name: student_name,
                task_id: task_id
            },
            success: function (response) {
                console.log(response);
            },
            error: function (response) {
                console.log('unable to send data');
            }
        });
    }
}

        $('#custom-task-container').empty();  $('#assignment-container').css('display', 'none');
        $('#content').load('course.php')

    })

    // $('#pretest1-comp').click(function (e) { 
    //     e.preventDefault();

    // $('#content').load('./pretest1-review.php')
        
    // });
    // $('#pretest2-comp').click(function (e) { 
    //     e.preventDefault();

    // $('#content').load('./pretest2-review.php')
        
    // });


    // $('.activity-container h5').click(function (e) { 
    //     e.preventDefault();
    //      $(".overlay").toggle('');
    //         $("#assignment-container").toggle('slow');
    //         $('body').css('overflow', 'hidden');
    // });
    </script>
</html>