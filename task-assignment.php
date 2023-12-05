<?php
    session_start();
    require_once('config-teachers.php');
    $week_translation = [
        'week1' => 'Hafta 1',
        'week2' => 'Hafta 2',
        'week3' => 'Hafta 3',
        'week4' => 'Hafta 4',
    ];
    $task_name_proper = [
        'pretest1' => 'Pretest 1',
        'pretest2' => 'Pretest 2',
        'testCase' => 'Test Case',
        'posttest1' => 'Posttest 1',
        'posttest2' => 'Posttest 2',
    ];
    $teacher_id = $_SESSION['ebyrysUserLogin']['id'];
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

    $sql = 'SELECT * FROM task WHERE student_group = "Kontrol Grubu 1"';
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();
    $control1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = 'SELECT * FROM task WHERE student_group = "Kontrol Grubu 2"';
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();
    $control2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = 'SELECT * FROM task WHERE student_group = "Müdahale Grubu 1"';
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();
    $intervention1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = 'SELECT * FROM task WHERE student_group = "Müdahale Grubu 2"';
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();
    $intervention2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = 'SELECT * FROM custom_task';
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();
    $custom_tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

        #details-container{
            position: absolute;
            z-index: 1000;
            width: 75%;
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
    <div id="details-container" style="display: none;">
        <h5 class="text-center">Görev Ayrıntıları</h5>
        <div class="mt-4" id="details-inner">
        </div>
        <button class="btn btn-success" id="close-details">Iptal</button>
    </div>


    <div id="assignment-container" style="display: none;">
        <h5 class="text-center">Görev Seçimi</h5>
        <h6 id="group-name">Güncel Grup:</h6>
        <h6 class="mt-3">Bir Görev Seçin:</h6>
        <select name="task-options w-25" id="task-options" style="border: 2px solid rgb(160, 160, 239); padding: 5px;">
        </select>
        <h6 class="mt-3">Bir Görev Seçin:</h6>
        <select name="week-options w-25" id="week-options" style="border: 2px solid rgb(160, 160, 239); padding: 5px; margin-bottom: 20px;">
        </select>
        <div id="task-name" style="display: none;">
            <label for="task-nameInput">Görev Adı:</label>
            <input type="text" placeholder="Görev adını girin" id="task-nameInput" name="task-nameInput" class="form-control">
        </div>
        <div id="task-descriptions" style="display: none;">
            <label for="task_desc">Görev Tanımı:</label>
            <textarea name="task_desc"  id="task_desc" cols="30" rows="10" class="form-control" placeholder="Görev Tanımını Girin"></textarea>
        </div>
        <div id="upload-pdf"  style="display: none;">
            <input type="file" lang="tr" accept="application/pdf,application/vnd.ms-excel">
        </div>
        <div id="upload-custom" style="display: none;">
            <input type="file" lang="tr" id="custom-file" accept=".pdf, .ppt, .pptx, .doc, .docx, .mp4, .mov, .avi">
        </div>
       
        <div class="d-flex justify-content-between mt-4">
            <button class="btn btn-success" id="assign-task">Ata</button>
            <button class="btn btn-danger" id="cancel">İptal</button>
    </div>
    </div>
    <div class="container-fluid mt-5 w-75 p-4 mb-4" style="background-color: white; aspect-ratio: 2; border-radius: 20px;">
            <h2 class="text-center mb-4">Görev Atama</h2>
            <div id="group-selection">
                <div class="w-50 group-container" id="control1" >
                    <h5>Kontrol Grubu 1</h5>
                </div>
                <?php
                echo '<div id="Control_group_1">';
                        $i = 1;
                        foreach($control1 as $task){
                            echo '<div id="' . $task['id'] . '" style="display: flex; align-items:center; margin-bottom: 10px; border-bottom : 2px solid grey"; class="simple-task-controller">';
                            echo '<p style="margin-right: 20px">' . $task_name_proper[$task['task_name']] . ' - ' . $week_translation[$task['task_week']] . '</p>';
                            echo '<button style="margin-left:10px; font-size: 10px;" class="btn btn-success delete-btn" id="delete-btn'.$i.'">Sil</button>';
                            echo '<button style="margin-left:10px; font-size: 10px;" class="btn btn-success showTaskDetails" id="task-details-' . $task['id'] . '">Ayrııntılar</button>';
                            echo '</div>';
                            $i++;
                        }
                        foreach($custom_tasks as $custom_task){
                            if($custom_task['student_group'] === 'Kontrol Grubu 1'){
                                echo '<div id="task-div' . $custom_task['id'] . '" style="display: flex; align-items:center; margin-bottom: 10px; border-bottom : 2px solid grey" class="custom-task-controller">';
                                    echo '<p style="margin-right: 20px">' . $custom_task['task_name'] . ' - ' . $week_translation[$custom_task['task_week']] . '</p>';
                                    echo '<button style="margin-left:10px; font-size: 10px;" class="btn btn-success custom-delete-btn" id="custom-delete-btn-'.$custom_task['id'].'">Sil</button>';
                                    echo '<button style="margin-left:10px; font-size: 10px;" class="btn btn-success showTaskDetails" id="task-details-' . $custom_task['id'] . '">Ayrııntılar</button>';
                                    echo '</div>';
                                }
                        }
                    echo '</div>';
                    ?>
                
                <div class="w-50 group-container" id="control2">
                    <h5>Kontrol Grubu 2</h5>
                </div>
                <?php
                echo '<div id="Control_group_2">';

                        foreach($control2 as $task){
                            echo '<div id="' . $task['id'] . '" style="display: flex; margin-bottom: 10px; border-bottom : 2px solid grey" class="simple-task-controller">';
                            echo '<p style="margin-right: 20px">' . $task_name_proper[$task['task_name']] . ' - ' . $week_translation[$task['task_week']]
                            . '</p>';
                            echo '<button style="margin-left:10px; font-size: 10px;" class="btn btn-success delete-btn" id="delete-btn'.$i.'">Sil</button>';
                            echo '<button style="margin-left:10px; font-size: 10px;" class="btn btn-success showTaskDetails" id="task-details-' . $task['id'] . '">Ayrııntılar</button>';

                            echo '</div>';
                            $i++;
                        }
                        foreach($custom_tasks as $custom_task){
                            if($custom_task['student_group'] === 'Kontrol Grubu 2'){
                                echo '<div id="task-div' . $custom_task['id'] . '" style="display: flex; margin-bottom: 10px; border-bottom : 2px solid grey" class="custom-task-controller">';
                                    echo '<p style="margin-right: 20px">' . $custom_task['task_name'] . ' - ' . $week_translation[$custom_task['task_week']] . '</p>';
                                    echo '<button style="margin-left:10px; font-size: 10px;" class="btn btn-success custom-delete-btn" id="custom-delete-btn-'.$custom_task['id'].'">Sil</button>';
                                    echo '<button style="margin-left:10px; font-size: 10px;" class="btn btn-success showTaskDetails" id="task-details-' . $custom_task['id'] . '">Ayrııntılar</button>';

                                    echo '</div>';
                                }
                        }

                        echo '</div>';
                    ?>
                    
                <div class="w-50 group-container" id="intervention1">
                    <h5>Müdahale Grubu 1</h5>
                </div>
                <?php
                echo '<div id="Intervention_group_1">';
                        foreach($intervention1 as $task){
                            echo '<div id="' . $task['id'] . '" style="display: flex; margin-bottom: 10px; border-bottom : 2px solid grey"" class="simple-task-controller">';
                            echo '<p style="margin-right: 20px">' . $task_name_proper[$task['task_name']] . ' - ' . $week_translation[$task['task_week']]
                            . '</p>';
                            echo '<button style="margin-left:10px; font-size: 10px;" class="btn btn-success delete-btn" id="delete-btn'.$i.'">Sil</button>';
                            echo '<button style="margin-left:10px; font-size: 10px;" class="btn btn-success showTaskDetails" id="task-details-' . $task['id'] . '">Ayrııntılar</button>';
                            echo '</div>';
                            $i++;
                        }
                        foreach($custom_tasks as $custom_task){
                            if($custom_task['student_group'] === 'Müdahale Grubu 1'){
                                echo '<div id="task-div' . $custom_task['id'] . '" style="display: flex; margin-bottom: 10px; border-bottom : 2px solid grey"" class="custom-task-controller">';
                                    echo '<p style="margin-right: 20px">' . $custom_task['task_name'] . ' - ' . $week_translation[$custom_task['task_week']] . '</p>';
                                    echo '<button style="margin-left:10px; font-size: 10px;" class="btn btn-success custom-delete-btn" id="custom-delete-btn-'.$custom_task['id'].'">Sil</button>';
                                    echo '<button style="margin-left:10px; font-size: 10px;" class="btn btn-success showTaskDetails" id="task-details-' . $custom_task['id'] . '">Ayrııntılar</button>';
                                    echo '</div>';
                                }
                        }

                    echo '</div>';
                    ?>


                <div class="w-50 group-container" id="intervention2" >
                    <h5>Müdahale Grubu 2</h5>
                </div>
                <?php
                echo '<div id="Intervention_group_2">';

                        foreach($intervention2 as $task){
                            echo '<div id="' . $task['id'] . '" style="display: flex; margin-bottom: 10px; border-bottom : 2px solid grey"" class="simple-task-controller">';
                            echo '<p style="margin-right: 20px">' . $task_name_proper[$task['task_name']] . ' - ' . $week_translation[$task['task_week']]
                            . '</p>';
                            echo '<button style="margin-left:10px; font-size: 10px;" class="btn btn-success delete-btn" id="delete-btn'.$i.'">Sil</button>';
                            echo '<button style="margin-left:10px; font-size: 10px;" class="btn btn-success showTaskDetails" id="task-details-' . $task['id'] . '">Ayrııntılar</button>';
                            echo '</div>';
                            $i++;
                        }
                        foreach($custom_tasks as $custom_task){
                            if($custom_task['student_group'] === 'Müdahale Grubu 2'){
                                echo '<div id="task-div' . $custom_task['id'] . '" style="display: flex; margin-bottom: 10px; border-bottom : 2px solid grey"" class="custom-task-controller">';
                                    echo '<p style="margin-right: 20px">' . $custom_task['task_name'] . ' - ' . $week_translation[$custom_task['task_week']] . '</p>';
                                    echo '<button style="margin-left:10px; font-size: 10px;" class="btn btn-success custom-delete-btn" id="custom-delete-btn-'.$custom_task['id'].'">Sil</button>';
                                    echo '<button style="margin-left:10px; font-size: 10px;" class="btn btn-success showTaskDetails" id="task-details-' . $custom_task['id'] . '">Ayrııntılar</button>';
                                    echo '</div>';
                                }
                        }

                    echo '</div>';
                    ?>
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
        //scroll to top
        $('html, body').animate({scrollTop: '0px'}, 300);
     
        if(group === 'Kontrol Grubu 1' || group === 'Müdahale Grubu 1'){
            $('#task-options').append('<option value="pretest1">Pretest 1</option>');
            $('#task-options').append('<option value="pretest2">Pretest 2</option>');
            $('#task-options').append('<option value="testCase">Test Case</option>');
            $('#task-options').append('<option value="posttest1">Posttest 1</option>');
            $('#task-options').append('<option value="posttest2">Posttest 2</option>');
            $('#task-options').append('<option value="Custom-Task">Günlük Çalışma</option>');
            $('#week-options').append('<option value="week1">Hafta 1</option>');
            $('#week-options').append('<option value="week2">Hafta 2</option>');
            $('#week-options').append('<option value="week3">Hafta 3</option>');
            $('#week-options').append('<option value="week4">Hafta 4</option>');
            
        }else{
            $('#task-options').append('<option value="testCase">Test Case</option>');
            $('#task-options').append('<option value="Custom-Task">Günlük Çalışma</option>');
            $('#week-options').append('<option value="week1">Hafta 1</option>');
            $('#week-options').append('<option value="week2">Hafta 2</option>');
            $('#week-options').append('<option value="week3">Hafta 3</option>');
            $('#week-options').append('<option value="week4">Hafta 4</option>');
        }
        if($('#task-options').val() === 'testCase'){
            $('#upload-pdf').show('medium');
            $('#upload-custom').hide('medium');
        }
        if($('#task-options').val() === 'Custom-Task'){
            $('#upload-pdf').hide('medium');
            $('#upload-custom').show('medium');
            $('#task-name').show('medium');
            $('#task-descriptions').show('medium');
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
                const reader = new FileReader();
                reader.onload = function (event) {
                    const base64data = event.target.result;
                    const filename = $('input[type="file"]')[0].files[0].name;
                    $.ajax({
                        type: "POST",
                        url: "./upload-task-pdf.php",
                        data: {
                            file_name: filename,
                            base64: base64data,
                            student_group: $('#group-name').text().split(' ')[2] + ' ' + $('#group-name').text().split(' ')[3] + ' ' + $('#group-name').text().split(' ')[4],
                        },
                        success: function (response) {
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
                                        console.log(response)
                                        const task = JSON.parse(response);
                                        const view_count = task.view_count;
                                        if (task.student_group == "Kontrol Grubu 1"){
                                            $('#control1').append('<div id="' + task.task_id + '" style="display: flex; align-items: end; margin-bottom: 10px; border-bottom: 2px solid grey" class="simple-task-controller"><p style="margin-right: 20px">' + task.task_name + ' - ' + task.task_week + '</p><button style="margin-left:10px" class="btn btn-success showTaskDetails" id="task-details-'+ task.task_id +'">Ayrııntılar</button><button class="btn btn-success" id="task-details-'+ task.task_id +'" >Details</button><button class="btn btn-success delete-btn" id="delete-btn'+numOfDeleteBtns+'">Sil</button></div>');
                                            numOfDeleteBtns++;
                                            triggerDeleteBtn();
                                            $('#content').load('task-assignment.php')
                                        } else if (task.student_group == "Kontrol Grubu 2"){
                                            $('#control2').append('<div id="' + task.task_id + '" style="display: flex; align-items: end; margin-bottom: 10px; border-bottom: 2px solid grey" class="simple-task-controller"><p style="margin-right: 20px">' + task.task_name + ' - ' + task.task_week + '</p><button style="margin-left:10px" class="btn btn-success showTaskDetails" id="task-details-'+ task.task_id +'">Ayrııntılar</button><button class="btn btn-success delete-btn" id="delete-btn'+numOfDeleteBtns+'">Sil</button></div>');
                                            numOfDeleteBtns++;
                                            triggerDeleteBtn();
                                            $('#content').load('task-assignment.php')
                                        } else if (task.student_group == "Müdahale Grubu 1"){
                                            $('#intervention1').append('<div id="' + task.task_id + '" style="display: flex; align-items: end; margin-bottom: 10px; border-bottom: 2px solid grey" class="simple-task-controller"><p style="margin-right: 20px">' + task.task_name + ' - ' + task.task_week + '</p><button style="margin-left:10px" class="btn btn-success showTaskDetails" id="task-details-'+ task.task_id +'">Ayrııntılar</button><button class="btn btn-success delete-btn" id="delete-btn'+numOfDeleteBtns+'">Sil</button></div>');
                                            numOfDeleteBtns++;
                                            triggerDeleteBtn();
                                            $('#content').load('task-assignment.php')
                                        } else if (task.student_group == "Müdahale Grubu 2") {
                                            $('#intervention2').append('<div id="' + task.task_id + '" style="display: flex; align-items: end; margin-bottom: 10px; border-bottom: 2px solid grey" class="simple-task-controller"><p style="margin-right: 20px">' + task.task_name + ' - ' + task.task_week + '</p><button style="margin-left:10px" class="btn btn-success showTaskDetails" id="task-details-'+ task.task_id +'">Ayrııntılar</button><button class="btn btn-success delete-btn" id="delete-btn'+numOfDeleteBtns+'">Sil</button></div>');
                                            numOfDeleteBtns++;
                                            triggerDeleteBtn();
                                            $('#content').load('task-assignment.php')
                                        }
                                        if(task === 'exists'){
                                            alert('task already assigned!');
                                        }                                    }else{
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


 else if ($('#task-options').val() === 'Custom-Task') {
    if ($('#task-nameInput').val() === '') {
        alert('Please enter a task name');
        return;
    }
    if ($('#task_desc').val() === '') {
        alert('Please enter a task description');
        return;
    }

    if ($('#custom-file').val() === '') {
        alert('Please upload a file');
        return;
    }

    const file = $('#custom-file').prop('files')[0];
const task_name = $('#task-nameInput').val();
const task_desc = $('#task_desc').val();
const fileSize = $('#custom-file')[0].files[0].size;
const student_group = $('#group-name').text().split(' ')[2] + ' ' + $('#group-name').text().split(' ')[3] + ' ' + $('#group-name').text().split(' ')[4];
if (fileSize > 1000000000) {
    alert('File size must be less than 10MB');
    return;
}

const formData = new FormData();
formData.append('file', file);
formData.append('file_name', file.name);
formData.append('student_group', student_group);
formData.append('task_name', task_name);
formData.append('task_desc', task_desc);
formData.append('task_week', week_name);

$.ajax({
    type: "POST",
    url: "./upload-custom.php",
    data: formData,
    processData: false, // Prevent jQuery from processing the data
    contentType: false, // Set content type to false as FormData handles it
    success: function (response) {
        if (JSON.parse(response).task_id) {
            alert('Görev başarıyla atandı');
            task_data = JSON.parse(response);
            $('#content').load('task-assignment.php')
        } else {
            alert(response);
        }
    },
    error: function (response) {
        alert(response);
    }
});
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
                    const task = JSON.parse(response);
                    const task_id = task.task_id;
                    if (task.student_group == "Kontrol Grubu 1"){
                        $('#Control_group_1').append('<div id="' + task.task_id + '" style="display: flex; margin-bottom: 10px;" class="custom-task-controller"><p style="margin-right: 20px">' + task.task_name + ' - ' + task.task_week + '</p><button class="btn btn-success showTaskDetails" id="task-details-'+ task_id +'" >Ayrııntılar</button><button class="btn btn-success delete-btn" id="delete-btn'+numOfDeleteBtns+'">Sil</button></div>');
                        numOfDeleteBtns++;
                        triggerDeleteBtn();
                        $('#content').load('task-assignment.php');
                    } else if (task.student_group == "Kontrol Grubu 2"){
                        $('#Control_group_2').append('<div id="' + task.task_id + '" style="display: flex; margin-bottom: 10px;" class="custom-task-controller"><p style="margin-right: 20px">' + task.task_name + ' - ' + task.task_week + '</p><button class="btn btn-success showTaskDetails" id="task-details-'+ task_id +'" >Ayrııntılar</button><button class="btn btn-success delete-btn" id="delete-btn'+numOfDeleteBtns+'">Sil</button></div>');
                        numOfDeleteBtns++;
                        triggerDeleteBtn();
                        $('#content').load('task-assignment.php');

                    } else if (task.student_group == "Müdahale Grubu 1"){
                        $('#Intervention_group_1').append('<div id="' + task.task_id + '" style="display: flex; margin-bottom: 10px;" class="custom-task-controller"><p style="margin-right: 20px">' + task.task_name + ' - ' + task.task_week + '</p><button class="btn btn-success showTaskDetails" id="task-details-'+ task_id +'" >Ayrııntılar</button><button class="btn btn-success delete-btn" id="delete-btn'+numOfDeleteBtns+'">Sil</button></div>');
                        numOfDeleteBtns++;
                        triggerDeleteBtn();
                        $('#content').load('task-assignment.php');

                    } else if (task.student_group == "Müdahale Grubu 1") {
                        $('#Intervention_group_2').append('<div id="' + task.task_id + '" style="display: flex; margin-bottom: 10px;" class="custom-task-controller"><p style="margin-right: 20px">' + task.task_name + ' - ' + task.task_week + '</p><button class="btn btn-success showTaskDetails" id="task-details-'+ task_id +'" >Ayrııntılar</button><button class="btn btn-success delete-btn" id="delete-btn'+numOfDeleteBtns+'">Sil</button></div>');
                        numOfDeleteBtns++;
                        triggerDeleteBtn();
                        $('#content').load('task-assignment.php');

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
        $('#upload-custom').hide('medium');
        $('#task-name').hide('medium');
        $('#task-descriptions').hide('medium');

    });

    // // make the value of num the first delete button id number
    // var num = $('.delete-btn:first').attr('id').split('btn')[1];

    // // turn the value of num into an integer
    // num = parseInt(num);

    triggerDeleteBtn();

    function triggerDeleteBtn(){
        for (i = 1; i < numOfDeleteBtns; i++){
            $("#delete-btn"+i).click(function () {
                    var divId = $(this).parent().attr("id");
                    var task_name = $(this).siblings('p').text().split(' - ')[0].trim().toLowerCase().replace(/\s/g, '');
                    var task_group = $(this).parent().parent().attr("id").split('_').join(' ');
                    console.log(task_name,  task_group,     divId)
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
                            $('#content').load('task-assignment.php')

                        },
                        error: function (response) {
                            // alert(response);
                        }
                    });
            });
        }
    }

   

$('.custom-delete-btn').click(function (e) {
    //get the id
    const task_id = $(this).attr('id').split('-')[3];
    const student_group = $(this).parent().parent().attr('id').split('_').join(' ');
    
    $.ajax({
        type: "POST",
        url: "./delete-custom-task.php",
        data: {
            task_id: task_id,
            student_group: student_group,
        },
        success: function (response) {
            console.log(response);
            if(response == 'success'){
                //remove the div
                $('#task-div' + task_id).remove();
            }        
                else alert(response);
        },
        error: function (response) {
            alert(response);
        }
    });
    
})

$('#custom-file').change(function (e) {
    const fileInput = $(this);
    const file = fileInput.prop('files')[0];
    $('#assign-task').prop('disabled', true);

    const fileReader = new FileReader();

    fileReader.onloadend = function () {
        console.log('hello there');
        const base64data = fileReader.result;
        const filename = fileInput.val().split('\\').pop();
        const fileExtension = filename.split('.').pop().toLowerCase();
        if (fileExtension !== 'pdf' && fileExtension !== 'ppt' && fileExtension !== 'pptx' && fileExtension !== 'doc' && fileExtension !== 'docx' && fileExtension !== 'mp4' && fileExtension !== 'mov' && fileExtension !== 'avi') {
            alert('Please upload a pdf, ppt, pptx, doc, docx, mp4, mov, or avi file');
            return;
        }
        const fileSize = fileInput[0].files[0].size;
        if (fileSize > 1000000000) {
            alert('File size must be less than 10MB');
            return;
        }
        $('#assign-task').prop('disabled', false);
    }

    // Read the file as data URL
    fileReader.readAsDataURL(file);
});

    $('#task-options').change(function (e) { 
        //empty all prev values
        $('#upload-pdf').hide('medium');
        $('#task-name').hide('medium');
        $('#task-descriptions').hide('medium');
        $('#task-nameInput').val('');
        $('#task_desc').val('');
        $('#upload-pdf input').val('');
        if($(this).val() === 'testCase'){
            $('#upload-custom').hide('medium');
            $('#upload-pdf').show('medium');
        }else if($(this).val() === 'Custom-Task'){
            $('#upload-pdf').hide('medium');
            $('#upload-custom').show('medium');
            $('#task-name').show('medium');
            $('#task-descriptions').show('medium');
        }  
        else{
            $('#upload-pdf').hide('medium');
            $('#upload-custom').hide('medium');
            $('#task-name').hide('medium');
            $('#task-descriptions').hide('medium');
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
        $('#upload-custom').hide('medium');
        $('#task-name').hide('medium');
        $('#task-descriptions').hide('medium');
    });
    indexDetailsBtn();

    function indexDetailsBtn(){
        
        $('.showTaskDetails').click(function (e) { 
            e.preventDefault();
            //scroll to top
            $('html, body').animate({scrollTop: '0px'}, 300);
            console.log($(this).parent().attr('id'));
            const type = $(this).parent().attr('class');
            const task_id = $(this).attr('id').split('-')[2];
            console.log(type)
        console.log(task_id)
        $.ajax({
            type: "POST",
            url: "getTaskInfo.php",
            data: {
                task_id: task_id,
                type: type,
            },
            success: function (response) {
                const task = JSON.parse(response);
                $('.overlay').css('display','block');
                $('#details-container').css('display','block');
                $('#details-inner').append('<h6 style="margin-top : 20px">Görev Adı: ' + task.task_name + '</h6>');
                $('#details-inner').append('<h6>Görev Haftası: ' + task.task_week + '</h6>');
                if(task.task_desc)
                $('#details-inner').append('<h6>Görev Tanımı: ' + task.task_desc + '</h6>');
            if(task.task_file)
            $('#details-inner').append('<h6>Görev Dosyası: ' + task.task_file + '</h6>');
        if(task.view_count)
        $('#details-inner').append('<h6>Görev Görüntüleme Sayısı: ' + task.view_count + '</h6>');
    if(task.watches){
        if(JSON.parse(task.watches).length > 0){
            let totalWacthtime = 0;
            const watches = JSON.parse(task.watches);
            const totalStudents = watches.length;
            $('#details-inner').append('<h6>Görev Saatleri: </h6>');
            watches.forEach(element => {
                totalWacthtime += parseFloat(element.watch_time);
                singleWatchTime = parseFloat(element.watch_time);
                
                        $('#details-inner').append('<h6>Öğrenci: ' + element.student_name + ' İzlenme Süresi: ' + formatTime(singleWatchTime.toFixed(3)) + '</h6>');
                    });
                    $('#details-inner').append('<h6>Toplam İzlenen Öğrenci Sayısı: ' + totalStudents + '</h6>');
                    $('#details-inner').append('<h6>Toplam İzlenme Süresi: ' + formatTime(totalWacthtime.toFixed(3)) + '</h6>');
                    //scroll to top
                }
            }
        }
    });
});
}

    $('#close-details').click(function (e) { 
        e.preventDefault();
        $('.overlay').css('display','none');
        $('#details-inner').empty();
        $('#details-container').css('display','none');
    });

    function formatTime(totalSeconds) {
    if (totalSeconds >= 3600) {
        const hours = Math.floor(totalSeconds / 3600);
        const minutes = Math.floor((totalSeconds % 3600) / 60);
        return `${hours} hours ${minutes} minutes`;
    } else if (totalSeconds >= 60) {
        const minutes = Math.floor(totalSeconds / 60);
        return `${minutes} minutes`;
    } else {
        return `${totalSeconds} seconds`;
    }
}

</script>
</html>