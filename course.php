
<?php
    session_start();
    $student_id = $_SESSION['userlogin']['id'];
    $student_name = $_SESSION['userlogin']['name']." ".$_SESSION['userlogin']['surname'];
    $student_email = $_SESSION['userlogin']['email'];
    $student_group = $_SESSION['userlogin']['student_group'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- displayed when group assigned -->
    <!-- <div class="send-patient w-75" style="background-color: white; margin-top: 50px; aspect-ratio: 3;" id="assigned-heading">
        <div class="container-fluid">
            <h6 id='heading' class="text-start pt-2"><?php echo $student_group?> Course</h6>
        </div>
    </div> -->
    <div class="send-patient w-75" style="background-color: white; margin-top: 50px;padding-bottom: 20px; margin-bottom: 20px; aspect-ratio: 3;">
        <div class="container-fluid">
            <h6 id='heading' class="text-start pt-2">Course Overview</h6>
        </div>
        <div class="container-fluid mb-5 mt-4">            
            <h2>Week 1: Introduction and Pre-testing</h2>
            <div class="activity-container">
                <h5>Pre-test 1</h5>
            </div>
            <div class="activity-container">
                <h5>Pre-test 2</h5>
            </div>
            <div class="activity-container">
                <h5>Test-Case </h5>
            </div>
        </div>
        <div class="container-fluid mb-5">            
            <h2>Week 2: Syllabus Un-announced</h2>
        </div>
        <div class="container-fluid mb-5">            
            <h2>Week 3: Syllabus Un-announced</h2>
        </div>
        <div class="container-fluid mb-5">            
            <h2>Week 4: Syllabus Un-announced</h2>
        </div>
    </div>
</body>

<script>
    var student_group = <?php echo json_encode($student_group); ?>;
    console.log(student_group)
    // if(student_group != 'unassigned'){
    //     $('#unassigned').css('display', 'none');
            // $('#assigned-heading').css('display', 'none');
    // }
    // else{
    //     $('#heading').css('display', 'none');
    // }
    </script>
</html>