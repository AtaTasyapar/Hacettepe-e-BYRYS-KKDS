<?php
    session_start();
    require_once('config-teachers.php');
    $teacher_id = $_SESSION['userlogin']['id'];
    $sql = 'SELECT * FROM teachers WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $teacher_id);
    $result = $stmt->execute();
    if($result){
        $teacher = $stmt->fetch(PDO::FETCH_ASSOC);
        $teacher_name = $teacher['name'] . ' ' . $teacher['surname'];
        $teacher_email = $teacher['email'];
    }
    else{
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
        .group-container{
            border: 1px solid grey;
            padding: 10px;
            background-color: rgb(205, 205, 247);
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
        }
        .overlay{
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 13%;
            width: 100%;
            height: 100%;
            z-index: 999;
        }
        #assignment-container{
            position: absolute;
            z-index: 1000;
            width: 50%;
            border: 2px solid black;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 15px;
            padding-bottom: 30px;
            border-radius: 10px;
        }
        input[type="file"]{
            padding: 5px;
            border: 1px dotted grey;
        }
    </style>
</head>
<body>
    <div class="overlay" style="display: none;">
    </div>

    <div id="assignment-container" style="display: none;">
        <h5 class="text-center">Task Selection</h5>
        <h6 id="group-name">Current Group:</h6>
        <h6 class="mt-3">Select a Task:</h6>
        <select name="task-options w-25" id="task-options" style="border: 2px solid rgb(160, 160, 239); padding: 5px;">
        </select>
        <h6 class="mt-3">Select Week:</h6>
        <select name="week-options w-25" id="week-options" style="border: 2px solid rgb(160, 160, 239); padding: 5px; margin-bottom: 20px;">
        </select>
        <div id="upload-pdf"  style="display: none;">
            <input type="file">
        </div>
        <div class="d-flex justify-content-between mt-4">
            <button class="btn btn-success" id="assign-task">Assign</button>
            <button class="btn btn-danger" id="cancel">Cancel</button>
    </div>
    </div>
    <div class="container-fluid mt-5 w-75 p-4 mb-4" style="background-color: white; aspect-ratio: 2; border-radius: 20px;">
            <h2 class="text-center mb-4">Task Assignment</h2>
            <div id="group-selection">
                <div class="w-50 group-container" id="control1" >
                    <h5>Control Group 1</h5>
                </div>
                <div class="w-50 group-container" id="control2">
                    <h5>Control Group 2</h5>
                </div>
                <div class="w-50 group-container" id="intervention1">
                    <h5>Intervention Group 1</h5>
                </div>
                <div class="w-50 group-container" id="intervention2" >
                    <h5>Intervention Group 2</h5>
                </div>
            </div>
    </div>
</body>
<script>
    $('.group-container').click(function (e) { 
        e.preventDefault();
        const group = $(this).find('h5').text();
        $('body').css('overflow', 'hidden');
        $('.overlay').toggle('medium');
        $('#assignment-container').toggle('medium');
        $('#group-name').text('Current Group: ' + group);
     
        if(group === 'Control Group 1'){
            $('#task-options').append('<option value="pretest1">Pretest 1</option>');
            $('#task-options').append('<option value="pretest2">Pretest 2</option>');
            $('#task-options').append('<option value="testCase">Test Case</option>');
            $('#task-options').append('<option value="posttest1">Posttest 1</option>');
            $('#task-options').append('<option value="posttest1">Posttest 1</option>');
            $('#week-options').append('<option value="week1">Week 1</option>');
            $('#week-options').append('<option value="week2">Week 2</option>');
            $('#week-options').append('<option value="week3">Week 3</option>');
            $('#week-options').append('<option value="week4">Week 4</option>');
            
        }else{
            $('#task-options').append('<option value="testCase">Test Case</option>');
            $('#week-options').append('<option value="week1">Week 1</option>');
            $('#week-options').append('<option value="week2">Week 2</option>');
            $('#week-options').append('<option value="week3">Week 3</option>');
            $('#week-options').append('<option value="week4">Week 4</option>');
        }
        if($('#task-options').val() === 'testCase'){
            console.log($('#task-options').val());
            $('#upload-pdf').toggle('medium');
        }
    });

    $('#assign-task').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "./handle-task-assignment.php",
            data: {
                student_group: $('#group-name').text().split(' ')[2],
                task_name: $('#task-options').val(),
                task_week: $('#week-options').val(),
            },
            success: function (response) {
                if(response === 'success'){
                    alert('Task assigned successfully');
                }else{
                    alert(response)
                }
            },
            error: function (response) {
                alert(response);
            }
        });
        $('body').css('overflow', 'auto');
        $('.overlay').toggle('medium');
        $('#assignment-container').toggle('medium');
        $('#task-options').empty();
        $('#week-options').empty();
        $('#upload-pdf').hide('medium');

    });


  


        $('#task-options').change(function (e) { 
            if($(this).val() === 'testCase'){
                console.log($(this).val());
                $('#upload-pdf').toggle('medium');
            }else{
                $('#upload-pdf').hide('medium');
            }
        });

        $('#cancel').click(function (e) { 
            e.preventDefault();
            $('body').css('overflow', 'auto');
            $('.overlay').toggle('medium');
            $('#assignment-container').toggle('medium');
            $('#task-options').empty();
            $('#week-options').empty();
            $('#upload-pdf').hide('medium');
        });

    
</script>
</html>