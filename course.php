
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

    $sql = 'SELECT * FROM pretest1 WHERE student_id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $student_id);
    $result = $stmt->execute();

    if($result){
        $pretest1 = $stmt->fetch(PDO::FETCH_ASSOC);
    }else{
        echo 'error';
    }

    $sql = 'SELECT * FROM pretest2 WHERE student_id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $student_id);
    $result = $stmt->execute();

    if($result){
        $pretest2 = $stmt->fetch(PDO::FETCH_ASSOC);
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
                <h2>Week 1: Introduction and Pre-testing</h2>
                <div class="activity-container">';
            
            if (!isset($pretest1)) {
                echo '
                    <h5 id="pretest1">Pre-test 1</h5>
                    <h6 class="completion-indicator">
                        incomplete
                    </h6></div>';
            }else {
                echo '
                <h5 id="pretest1-comp">Pre-test 1</h5>
                    <h6 class="completion-indicator">
                        complete
                    </h6></div>';
            }
            
            echo '<div class="activity-container">';

            if (!isset($pretest2)) {
                echo '
                    <h5 id="pretest2">Pre-test 2</h5>
                    <h6 class="completion-indicator">
                        incomplete
                    </h6>
                </div>';
            }else {
                echo '
                <h5 id="pretest2-comp">Pre-test 2</h5>
                <h6 class="completion-indicator">
                    complete
                </h6>
            </div>';
            }
            echo '
                <div class="activity-container">
                    <h5>Test-Case </h5>
                    <h6 class="completion-indicator">
                        incomplete
                    </h6>
                </div>
            </div>
            <div class="container-fluid mb-5">            
                <h2>Week 2: Syllabus Un-announced</h2>
                <div class="activity-container">
                    <h6 class="completion-indicator">
                        To be announced
                    </h6>
                </div>
            </div>
            <div class="container-fluid mb-5">            
                <h2>Week 3: Syllabus Un-announced</h2>
                <div class="activity-container">
                    <h6 class="completion-indicator">
                        To be announced
                    </h6>
                </div>
            </div>
            <div class="container-fluid mb-5">            
                <h2>Week 4: Syllabus Un-announced</h2>
                <div class="activity-container">
                    <h6 class="completion-indicator">
                        To be announced
                    </h6>
                </div>
            </div>
            ';
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
    $('#pretest1-comp').click(function (e) { 
        e.preventDefault();

    $('#content').load('./pretest1-review.php')
        
    });
    $('#pretest2-comp').click(function (e) { 
        e.preventDefault();

    $('#content').load('./pretest2-review.php')
        
    });


    // $('.activity-container h5').click(function (e) { 
    //     e.preventDefault();
    //      $(".overlay").toggle('');
    //         $("#assignment-container").toggle('slow');
    //         $('body').css('overflow', 'hidden');
    // });
    </script>
</html>