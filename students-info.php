<?php 
    require_once('config-students.php');
    $sql = "SELECT * FROM students";
    $result = $db->query($sql);
    $students = '';
    if($result->rowCount() > 0){
     $students = $result->fetchAll(PDO::FETCH_ASSOC);
    }else{
        $students = '';
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        p{
            text-align: start;
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
        }

        .overlay{
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 999;
        }
        
    </style>
</head>
<body>
    <div class="overlay" style="display: none;">
    </div>
    <div id="assignment-container" style="display: none;">
        <h5 class="text-center mb-3">Group Assignment</h5>
        <h6 id="student_name" class="mb-2"></h6>
        <h6 id="student_id" class="mb-2"></h6>
        <h6 id="student_group" class="mb-2"></h6>
        <select name="group-options" id="group-options" class="mb-2" style="border: 2px solid rgb(160, 160, 239); padding: 5px;">
            <option>
                Control group 1
            </option>
            <option>
                Control group 2
            </option>
            <option>
                Intervention group 1
            </option>
            <option>
                Intervention group 2
            </option>
        </select>
        <div class="d-flex justify-content-between mt-4">
            <button class="btn btn-success" id="assign-group">Assign</button>
            <button class="btn btn-danger" id="cancel">Cancel</button>
    </div>
    </div>
    <div class='mt-5 w-75 p-3' style="background-color: white;">
        <div class="d-flex justify-content-between align-items-center mb-3" style="border-bottom: 2px solid grey;">
           <div class="w-25"><h5 class="text-left" style="text-align: left;">Name</h5></div>
        <div class="w-25"><h5 class='text-left'>Group</h5></div>
    <div class="w-25"><h5 class='text-left'>Assign Group</h5></div>
<div class="w-25" > <h5 class='text-left'>Links</h5></div> 
</div>
        
        <?php
        foreach($students as $student){
            echo "<div class='d-flex justify-content-between align-items-center mb-2' style='border-bottom : 0.2px solid grey' id=".$student['id'].">";
                echo "<div class='w-25 student-info'><h6>".$student['name']." ".$student['surname']."</h6></div>";
                echo "<div class='w-25 student-info'><h6>".$student['student_group']."</h6></div>";
                if($student['student_group'] == 'unassigned'){
                    echo "<div class='w-25 student-info'><h6 class='btn btn-success' id='assign'>Assign</h6></div>";
                }else{
                    echo "<div class='w-25 student-info'><h6 class='btn btn-success' id='assign'>Change</h6></div>";
                }
                echo "<div class='w-25 student-info'><h6 class='btn btn-success' id='submissions'>Forms</h6></div>";
            echo "</div>";
        }
        ?>
    </div>

</body>
    <script>
        $("#assign").click(function (e) { 
            e.preventDefault();
            var name = $(this).parent().parent().find('.student-info').eq(0).text();
            var id = $(this).parent().parent().attr('id');
            var group = $(this).parent().parent().find('.student-info').eq(1).text();
            console.log(name, id);
            $(".overlay").toggle('');
            $("#assignment-container").toggle('slow');
            $("#student_name").text("Student Name: "+name);
            $("#student_id").text("Student ID: "+id);
            $("#student_group").text("Current Group: "+group);
            $('body').css('overflow', 'hidden');
        });
        $('#assign-group').click(function (e) { 
            e.preventDefault();
            var group = $("#group-options").val();
            var id = $("#student_id").text().split(" ")[2];
            console.log(group, id);
            $.ajax({
                type: "POST",
                url: "assign-group.php",
                data: {
                    group: group,
                    id: id
                },
                success: function (response) {
                    console.log(response);
                    if(response == 'success'){
                        $("#"+id).find('.student-info').eq(1).find('h6').text(group);
                        $("#"+id).find('.student-info').eq(2).find('h6').text('Change');
                        $('body').css('overflow', 'auto');
                        $(".overlay").toggle('');
                        $("#assignment-container").toggle('slow');
                    }
                }
            });
        });
        $("#cancel").click(function (e) { 
            e.preventDefault();
            $(".overlay").toggle('');
            $('body').css('overflow', 'hidden');
            $('body').css('overflow', 'auto')
            $("#assignment-container").toggle('slow');
        });
    </script>
</html>