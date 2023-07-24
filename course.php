
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
        echo 'error';
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
        echo 'error';
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
        echo 'error';
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
        echo 'error';
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
        echo 'error';
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
            echo 'error';
        }
    }else{
        echo 'error';
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .activity-container h5{
            cursor: pointer;
            color: rgb(94, 94, 245);
            width: fit-content;
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

    </style>
</head>
<body>
        <div class="overlay" style="display: none;">
        </div>
    

    <div id="assignment-container" style="display: none;">
    </div>




    <div class="send-patient w-75" style="background-color: white; margin-top: 50px; padding-bottom: 20px; margin-bottom: 20px; aspect-ratio: 3;">
        <?php
        if ($student_group === 'unassigned') {
            echo '<h3>You have not been assigned to a group yet!</h3>';
        }else{
            
            echo '
            <div class="container-fluid">
                <h2 id="heading" class="text-center pt-2 mt-3">' . $student_group . ' Course</h2>
            </div>
            <div class="container-fluid">
                <h6 id="heading" class="text-start pt-2">Course Overview</h6>
            </div>
            <div class="container-fluid mb-5 mt-4">            
                <h2>Week 1: Introduction and Pre-testing</h2>';
            foreach($tasks as $task){
                if(strtolower($task['task_name']) == strtolower('pretest1') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week1'){
                    if (!isset($pretest1)) {
                        echo '
                        <div class="activity-container">
                        <h5 id="pretest1">Pre-test 1</h5>
                        <h6 class="completion-indicator" style="color: red;">
                            incomplete
                        </h6></div>';
                    }else {
                        echo '
                        <div class="activity-container">
                        <h5 id="pretest1-comp">Pre-test 1</h5>
                        <h6 class="completion-indicator" style="color: green;"  >
                            complete
                        </h6></div>';
                    }      
                }
            }            

            foreach($tasks as $task){
                if(strtolower($task['task_name']) == strtolower('pretest2') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week1'){
                    if (!isset($pretest2)) {
                        echo '
                        <div class="activity-container">
                            <h5 id="pretest2">Pre-test 2</h5>
                            <h6 class="completion-indicator" style="color: red;">
                                incomplete
                            </h6>
                        </div>';
                    }else {
                        echo '
                        <div class="activity-container">
                            <h5 id="pretest2-comp">Pre-test 2</h5>
                            <h6 class="completion-indicator" style="color: green;">
                                complete
                            </h6>
                        </div>';
                    }
        }
    }
            foreach($tasks as $task){
                if(strtolower($task['task_name']) == strtolower('posttest1') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week1'){
                    if (!isset($posttest1)) {
                        echo '
                        <div class="activity-container">
                            <h5 id="posttest1">Post-test 1</h5>
                            <h6 class="completion-indicator" style="color: red;">
                                incomplete
                            </h6>
                        </div>';
                    }else {
                        echo '
                        <div class="activity-container">
                            <h5 id="posttest1-comp">Post-test 1</h5>
                            <h6 class="completion-indicator" style="color: green;">
                                complete
                            </h6>
                        </div>';
                    }
        }
    }
            foreach($tasks as $task){
                if(strtolower($task['task_name']) == strtolower('posttest2') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week1'){
                    if (!isset($posttest2)) {
                        echo '
                        <div class="activity-container">
                            <h5 id="posttest2">Post-test 2</h5>
                            <h6 class="completion-indicator" style="color: red;">
                                incomplete
                            </h6>
                        </div>';
                    }else {
                        echo '
                        <div class="activity-container">
                            <h5 id="posttest2-comp">Post-test 2</h5>
                            <h6 class="completion-indicator" style="color: green;">
                                complete
                            </h6>
                        </div>';
                    }
        }
    }
    foreach($tasks as $task){
        if(strtolower($task['task_name']) == strtolower('testcase') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week1'){
            if (!isset($posttest2)) {
                echo '
                <div class="activity-container">
                    <h5 id="testcase">Test Case</h5>
                    <h6 class="completion-indicator" style="color: red;">
                        incomplete
                    </h6>
                </div>';
            }else {
                echo '
                <div class="activity-container">
                    <h5 id="testcase-comp">Test Case</h5>
                    <h6 class="completion-indicator" style="color: green;">
                        complete
                    </h6>
                </div>';
            }
}
}
echo '</div>';

            

            echo '
            <div class="container-fluid mb-5">            
                <h2>Week 2: Intermediate Testing</h2>';
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('pretest1') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week2'){
                        if (!isset($pretest1)) {
                            echo '
                            <div class="activity-container">
                            <h5 id="pretest1">Pre-test 1</h5>
                            <h6 class="completion-indicator" style="color: red;">
                                incomplete
                            </h6></div>';
                        }else {
                            echo '
                            <div class="activity-container">
                            <h5 id="pretest1-comp">Pre-test 1</h5>
                            <h6 class="completion-indicator" style="color: green;"  >
                                complete
                            </h6></div>';
                        }      
                    }
                }   
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('pretest2') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week2'){
                        if (!isset($pretest2)) {
                            echo '
                            <div class="activity-container">
                                <h5 id="pretest2">Pre-test 2</h5>
                                <h6 class="completion-indicator" style="color: red;">
                                    incomplete
                                </h6>
                            </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                                <h5 id="pretest2-comp">Pre-test 2</h5>
                                <h6 class="completion-indicator" style="color: green;">
                                    complete
                                </h6>
                            </div>';
                        }
            }
        }
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('posttest1') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week2'){
                        if (!isset($posttest1)) {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest1">Post-test 1</h5>
                                <h6 class="completion-indicator" style="color: red;">
                                    incomplete
                                </h6>
                            </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest1-comp">Post-test 1</h5>
                                <h6 class="completion-indicator" style="color: green;">
                                    complete
                                </h6>
                            </div>';
                        }
            }
        }
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('posttest2') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week2'){
                        if (!isset($posttest2)) {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest2">Post-test 2</h5>
                                <h6 class="completion-indicator" style="color: red;">
                                    incomplete
                                </h6>
                            </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest2-comp">Post-test 2</h5>
                                <h6 class="completion-indicator" style="color: green;">
                                    complete
                                </h6>
                            </div>';
                        }
            }
        } 
        foreach($tasks as $task){
            if(strtolower($task['task_name']) == strtolower('testcase') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week2'){
                if (!isset($posttest2)) {
                    echo '
                    <div class="activity-container">
                        <h5 id="testcase">Test Case</h5>
                        <h6 class="completion-indicator" style="color: red;">
                            incomplete
                        </h6>
                    </div>';
                }else {
                    echo '
                    <div class="activity-container">
                        <h5 id="testcase-comp">Test Case</h5>
                        <h6 class="completion-indicator" style="color: green;">
                            complete
                        </h6>
                    </div>';
                }
    }
    }
            echo '    
            </div>
            ';



            echo '
            <div class="container-fluid mb-5">            
                <h2>Week 3: Syllabus Un-announced</h2>';
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('pretest1') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week3'){
                        if (!isset($pretest1)) {
                            echo '
                            <div class="activity-container">
                            <h5 id="pretest1">Pre-test 1</h5>
                            <h6 class="completion-indicator" style="color: red;">
                                incomplete
                            </h6></div>';
                        }else {
                            echo '
                            <div class="activity-container">
                            <h5 id="pretest1-comp">Pre-test 1</h5>
                            <h6 class="completion-indicator" style="color: green;"  >
                                complete
                            </h6></div>';
                        }      
                    }
                }   
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('pretest2') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week3'){
                        if (!isset($pretest2)) {
                            echo '
                            <div class="activity-container">
                                <h5 id="pretest2">Pre-test 2</h5>
                                <h6 class="completion-indicator" style="color: red;">
                                    incomplete
                                </h6>
                            </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                                <h5 id="pretest2-comp">Pre-test 2</h5>
                                <h6 class="completion-indicator" style="color: green;">
                                    complete
                                </h6>
                            </div>';
                        }
            }
        }
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('posttest1') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week3'){
                        if (!isset($posttest1)) {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest1">Post-test 1</h5>
                                <h6 class="completion-indicator" style="color: red;">
                                    incomplete
                                </h6>
                            </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest1-comp">Post-test 1</h5>
                                <h6 class="completion-indicator" style="color: green;">
                                    complete
                                </h6>
                            </div>';
                        }
            }
        }
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('posttest2') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week3'){
                        if (!isset($posttest2)) {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest2">Post-test 2</h5>
                                <h6 class="completion-indicator" style="color: red;">
                                    incomplete
                                </h6>
                            </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest2-comp">Post-test 2</h5>
                                <h6 class="completion-indicator" style="color: green;">
                                    complete
                                </h6>
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
                        <h6 class="completion-indicator" style="color: red;">
                            incomplete
                        </h6>
                    </div>';
                }else {
                    echo '
                    <div class="activity-container">
                        <h5 id="testcase-comp">Test Case</h5>
                        <h6 class="completion-indicator" style="color: green;">
                            complete
                        </h6>
                    </div>';
                }
    }
    }
              
            echo '</div>';



            echo '
            <div class="container-fluid mb-5">            
                <h2>Week 4: Syllabus Un-announced</h2>';
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('pretest1') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week4'){
                        if (!isset($pretest1)) {
                            echo '
                            <div class="activity-container">
                            <h5 id="pretest1">Pre-test 1</h5>
                            <h6 class="completion-indicator" style="color: red;">
                                incomplete
                            </h6></div>';
                        }else {
                            echo '
                            <div class="activity-container">
                            <h5 id="pretest1-comp">Pre-test 1</h5>
                            <h6 class="completion-indicator" style="color: green;"  >
                                complete
                            </h6></div>';
                        }      
                    }
                }   
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('pretest2') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week4'){
                        if (!isset($pretest2)) {
                            echo '
                            <div class="activity-container">
                                <h5 id="pretest2">Pre-test 2</h5>
                                <h6 class="completion-indicator" style="color: red;">
                                    incomplete
                                </h6>
                            </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                                <h5 id="pretest2-comp">Pre-test 2</h5>
                                <h6 class="completion-indicator" style="color: green;">
                                    complete
                                </h6>
                            </div>';
                        }
            }
        }
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('posttest1') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week4'){
                        if (!isset($posttest1)) {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest1">Post-test 1</h5>
                                <h6 class="completion-indicator" style="color: red;">
                                    incomplete
                                </h6>
                            </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest1-comp">Post-test 1</h5>
                                <h6 class="completion-indicator" style="color: green;">
                                    complete
                                </h6>
                            </div>';
                        }
            }
        }
                foreach($tasks as $task){
                    if(strtolower($task['task_name']) == strtolower('posttest2') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week4'){
                        if (!isset($posttest2)) {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest2">Post-test 2</h5>
                                <h6 class="completion-indicator" style="color: red;">
                                    incomplete
                                </h6>
                            </div>';
                        }else {
                            echo '
                            <div class="activity-container">
                                <h5 id="posttest2-comp">Post-test 2</h5>
                                <h6 class="completion-indicator" style="color: green;">
                                    complete
                                </h6>
                            </div>';
                        }
            }
        } 
        foreach($tasks as $task){
            if(strtolower($task['task_name']) == strtolower('testcase') &&  strtolower($task['student_group']) == strtolower($student_group) && $task['task_week'] == 'week4'){
                if (!isset($posttest2)) {
                    echo '
                    <div class="activity-container">
                        <h5 id="testcase">Test Case</h5>
                        <h6 class="completion-indicator" style="color: red;">
                            incomplete
                        </h6>
                    </div>';
                }else {
                    echo '
                    <div class="activity-container">
                        <h5 id="testcase-comp">Test Case</h5>
                        <h6 class="completion-indicator" style="color: green;">
                            complete
                        </h6>
                    </div>';
                }
    }
    }
              
            echo '</div>';
        }
        ?>
    </div>
</body>

<script>
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
        e.preventDefault();

    $('#content').load('./pretest1.php')
        
    });
    $('#pretest2').click(function (e) { 
        e.preventDefault();

    $('#content').load('./pretest2.php')
        
    });
    $('#posttest1').click(function (e) { 
        e.preventDefault();
        $('#content').load('./posttest1.php')
    });
    $('#posttest2').click(function (e) { 
        e.preventDefault();
        $('#content').load('./posttest2.php')
    });

    $('#testcase').click(function (e) { 
        e.preventDefault();
        $('#content').load('./test-case.php')
    });

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