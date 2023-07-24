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

    $sql = 'SELECT * FROM task WHERE student_group = "Control Group 1"';
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();
    $control1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = 'SELECT * FROM task WHERE student_group = "Control Group 2"';
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();
    $control2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = 'SELECT * FROM task WHERE student_group = "Intervention Group 1"';
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();
    $intervention1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = 'SELECT * FROM task WHERE student_group = "Intervention Group 2"';
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();
    $intervention2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        #group-selection {
            display: flex;
            flex-direction: column;
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
            <input type="file" accept="application/pdf,application/vnd.ms-excel">
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
                <div id="Control_group_1">
                    <?php
                        $i = 1;
                        foreach($control1 as $task){
                            echo '<div id="' . $task['id'] . '" style="display: flex; margin-bottom: 10px;">';
                            echo '<p style="margin-right: 20px">' . $task['task_name'] . ' - ' . $task['task_week'] . '</p>';
                            echo '<button class="btn btn-success delete-btn" id="delete-btn'.$i.'">Delete</button>';
                            echo '</div>';
                            $i++;
                        }

                    ?>
                </div>
                <div class="w-50 group-container" id="control2">
                    <h5>Control Group 2</h5>
                </div>
                <div id="Control_group_2">
                    <?php

                        foreach($control2 as $task){
                            echo `<div id="{$task["id"]}" style="display: flex; margin-bottom: 10px;">`;
                            echo '<p style="margin-right: 20px">' . $task['task_name'] . ' - ' . $task['task_week'] . '</p>';
                            echo '<button class="btn btn-success delete-btn" id="delete-btn'.$i.'">Delete</button>';
                            echo '</div>';
                            $i++;
                        }

                    ?>
                <div>
                <div class="w-50 group-container" id="intervention1">
                    <h5>Intervention Group 1</h5>
                </div>
                <div id="Intervention_group_1">
                    <?php

                        foreach($intervention1 as $task){
                            echo '<div id="' . $task['id'] . '" style="display: flex; margin-bottom: 10px;">';
                            echo '<p style="margin-right: 20px">' . $task['task_name'] . ' - ' . $task['task_week'] . '</p>';
                            echo '<button class="btn btn-success delete-btn" id="delete-btn'.$i.'">Delete</button>';
                            echo '</div>';
                            $i++;
                        }

                    ?>
                </div>
                <div class="w-50 group-container" id="intervention2" >
                    <h5>Intervention Group 2</h5>
                </div>
                <div id="Intervention_group_2">
                    <?php

                        foreach($intervention2 as $task){
                            echo '<div id="' . $task['id'] . '" style="display: flex; margin-bottom: 10px;">';
                            echo '<p style="margin-right: 20px">' . $task['task_name'] . ' - ' . $task['task_week'] . '</p>';
                            echo '<button class="btn btn-success delete-btn" id="delete-btn'.$i.'">Delete</button>';
                            echo '</div>';
                            $i++;
                        }

                    ?>
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
     
        if(group === 'Control Group 1' || group === 'Intervention Group 1'){
            $('#task-options').append('<option value="pretest1">Pretest 1</option>');
            $('#task-options').append('<option value="pretest2">Pretest 2</option>');
            $('#task-options').append('<option value="testCase">Test Case</option>');
            $('#task-options').append('<option value="posttest1">Posttest 1</option>');
            $('#task-options').append('<option value="posttest2">Posttest 2</option>');
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

    var numOfDeleteBtns = <?php echo $i; ?>;

    $('#assign-task').click(function (e) {
        e.preventDefault();
        const task_name = $('#task-options').val();
        const week_name = $('#week-options').val();

        if($('#task-options').val() === 'testCase'){
            if($('input[type="file"]').val() === ''){
                alert('Please upload a file');
                return;
            }

                const file = $('input[type="file"]').prop('files')[0];
                const fileExtension = file.name.split('.').pop().toLowerCase();
                if(fileExtension !== 'pdf'){
                    alert('Please upload a pdf file');
                    return;
                }
                const fileSize = $('input[type="file"]')[0].files[0].size;
                    if(fileSize > 5000000){
                        alert('File size must be less than 5MB');
                        return;
                    }
                console.log(file)
                const reader = new FileReader();
                reader.onload = function (event) {
                    const base64data = event.target.result;
                    const filename = $('input[type="file"]')[0].files[0].name;
                    console.log(base64data) 
                    $.ajax({
                        type: "POST",
                        url: "./upload-task-pdf.php",
                        data: {
                            file_name: filename,
                            base64: base64data,
                            student_group: $('#group-name').text().split(' ')[2] + ' ' + $('#group-name').text().split(' ')[3] + ' ' + $('#group-name').text().split(' ')[4],
                        },
                        success: function (response) {
                            console.log(response);
                            if(response === 'success'){
                                $.ajax({
                                type: "POST",
                                url: "./handle-task-assignment.php",
                                data: {
                                    student_group: $('#group-name').text().split(' ')[2] + ' ' + $('#group-name').text().split(' ')[3] + ' ' + $('#group-name').text().split(' ')[4],
                                    task_name: task_name,
                                    task_week: week_name,
                                    assoc_file : filename,
                                },
                                success: function (response) {
                                    if(response !== 'Error'){
                                        const task = JSON.parse(response);
                                        if (task.student_group == "Control Group 1"){
                                            // append a div after the control group 1 div
                                            $('#control1').after('<div id="' + task.task_id + '" style="display: flex; margin-bottom: 10px;"><p style="margin-right: 20px">' + task.task_name + ' - ' + task.task_week + '</p><button class="btn btn-success delete-btn" id="delete-btn'+numOfDeleteBtns+'">Delete</button></div>');
                                            numOfDeleteBtns++;
                                            triggerDeleteBtn();
                                        } else if (task.student_group == "Control Group 2"){
                                            $('#control2').after('<div id="' + task.task_id + '" style="display: flex; margin-bottom: 10px;"><p style="margin-right: 20px">' + task.task_name + ' - ' + task.task_week + '</p><button class="btn btn-success delete-btn" id="delete-btn'+numOfDeleteBtns+'">Delete</button></div>');
                                            numOfDeleteBtns++;
                                            triggerDeleteBtn();
                                        } else if (task.student_group == "Intervention Group 1"){
                                            $('#intervention1').after('<div id="' + task.task_id + '" style="display: flex; margin-bottom: 10px;"><p style="margin-right: 20px">' + task.task_name + ' - ' + task.task_week + '</p><button class="btn btn-success delete-btn" id="delete-btn'+numOfDeleteBtns+'">Delete</button></div>');
                                            numOfDeleteBtns++;
                                            triggerDeleteBtn();
                                        } else if (task.student_group == "Intervention Group 2") {
                                            $('#intervention2').after('<div id="' + task.task_id + '" style="display: flex; margin-bottom: 10px;"><p style="margin-right: 20px">' + task.task_name + ' - ' + task.task_week + '</p><button class="btn btn-success delete-btn" id="delete-btn'+numOfDeleteBtns+'">Delete</button></div>');
                                            numOfDeleteBtns++;
                                            triggerDeleteBtn();
                                        }
                                        if(task === 'exists'){
                                            alert('task already assigned!');
                                        }
                                    }else{
                                        // alert(response)
                                    }
                                },
                            error: function (response) {
                                alert(response);
                            }
                        });
                        }
                                            else{
                                                alert(response)
                                            }
                                        },
                                        error: function (response) {
                                            alert(response);
                                        }
                                    });
                                };  
                                reader.readAsDataURL(file);  
            }
            else{

                
                $.ajax({
                    type: "POST",
                    url: "./handle-task-assignment.php",
                    data: {
                        student_group: $('#group-name').text().split(' ')[2] + ' ' + $('#group-name').text().split(' ')[3] + ' ' + $('#group-name').text().split(' ')[4],
                        task_name: $('#task-options').val(),
                        task_week: $('#week-options').val(),
                    },
            success: function (response) {
                if(response !== 'Error'){
                    // alert('Task assigned successfully');
                    // add task to the list of tasks using the response for the id and the task name and week for the text
                    const task = JSON.parse(response);
                    if (task.student_group == "Control Group 1"){
                        // append a div after the control group 1 div
                        $('#Control_group_1').append('<div id="' + task.task_id + '" style="display: flex; margin-bottom: 10px;"><p style="margin-right: 20px">' + task.task_name + ' - ' + task.task_week + '</p><button class="btn btn-success delete-btn" id="delete-btn'+numOfDeleteBtns+'">Delete</button></div>');
                        numOfDeleteBtns++;
                        triggerDeleteBtn();
                    } else if (task.student_group == "Control Group 2"){
                        $('#Control_group_2').append('<div id="' + task.task_id + '" style="display: flex; margin-bottom: 10px;"><p style="margin-right: 20px">' + task.task_name + ' - ' + task.task_week + '</p><button class="btn btn-success delete-btn" id="delete-btn'+numOfDeleteBtns+'">Delete</button></div>');
                        numOfDeleteBtns++;
                        triggerDeleteBtn();
                    } else if (task.student_group == "Intervention Group 1"){
                        $('#Intervention_group_1').append('<div id="' + task.task_id + '" style="display: flex; margin-bottom: 10px;"><p style="margin-right: 20px">' + task.task_name + ' - ' + task.task_week + '</p><button class="btn btn-success delete-btn" id="delete-btn'+numOfDeleteBtns+'">Delete</button></div>');
                        numOfDeleteBtns++;
                        triggerDeleteBtn();
                    } else if (task.student_group == "Intervention Group 2") {
                        $('#Intervention_group_2').append('<div id="' + task.task_id + '" style="display: flex; margin-bottom: 10px;"><p style="margin-right: 20px">' + task.task_name + ' - ' + task.task_week + '</p><button class="btn btn-success delete-btn" id="delete-btn'+numOfDeleteBtns+'">Delete</button></div>');
                        numOfDeleteBtns++;
                        triggerDeleteBtn();
                    }
                    if(task === 'exists'){
                        alert('task already assigned!');
                    }
                }else{
                    alert(response)
                }
            },
            error: function (response) {
                alert(response);
            }
        });
    }
        $('body').css('overflow', 'auto');
        $('.overlay').toggle('medium');
        $('#assignment-container').toggle('medium');
        $('#task-options').empty();
        $('#week-options').empty();
        $('#upload-pdf').hide('medium');

    });

    // // make the value of num the first delete button id number
    // var num = $('.delete-btn:first').attr('id').split('btn')[1];

    // // turn the value of num into an integer
    // num = parseInt(num);

    triggerDeleteBtn();

    function triggerDeleteBtn(){
        for (i = 1; i < numOfDeleteBtns; i++){
            console.log(i);
            $("#delete-btn"+i).click(function () {
                    var divId = $(this).parent().attr("id");
                    var task_name = $(this).siblings('p').text().split(' - ')[0].trim();
                    var task_group = $(this).parent().parent().attr("id").split('_').join(' ');
                    console.log(task_group);
                    console.log(task_name);
                    console.log("Clicked on div with ID:", divId);

                    $.ajax({
                        type: "POST",
                        url: "./delete-task.php",
                        data: {
                            task_id: divId,
                            task_name: task_name,
                            task_group: task_group,
                        },
                        success: function (response) {
                            $("#" + divId).remove();
                        },
                        error: function (response) {
                            // alert(response);
                        }
                    });
            });
        }
    }

    console.log($('#task-options').val());

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