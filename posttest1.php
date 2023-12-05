<?php
    require_once('config-students.php');
    session_start();
    $student_id = $_SESSION['ebyrysUserLogin']['id'];
    $type = $_SESSION['ebyrysUserLogin']['type'];
    $task_id = $_GET['task_id'];
    if($type === 'student'){
        $sql = 'SELECT * FROM students WHERE id = :id';
    }else{
        $sql = 'SELECT * FROM teachers WHERE id = :id';
    }
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        input[type="radio"]{
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }
        label{
            margin-left: 5px;
        }

        .input-section{
            margin-bottom: 20px;
        }
        
        .error{
            display: none;
            color: red;
        }
        #back{
            font-weight: bold;
            border: 1px solid grey;
            background-color: rgb(146, 146, 246);
            color: white;
        }

    </style>
</head>
<body>
    <div class="container-fluid mt-5 w-75 p-4 mb-5" style="background-color: white; border-radius: 10px;">
        <button class="btn" id="back">Geri</button>
        <h2 class="form-header text-center mb-3">Basınç Ülserlerini Önlemeye Yönelik Tutum Ölçeği</h2>

    <div class="input-section">
        <h5 class="username-label">1.Basınç ülserlerini önlemeye yönelik becerilerime güveniyorum.</h5>
        <h6 class="error">Lütfen bir seçenek seçin</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_confidence">
            <label for="strongly agree">Kesinlikle Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_confidence">
            <label for="agree">Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_confidence">
            <label for="strongly agree">katılmıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_confidence">
            <label for="strongly agree">Kesinlikle katılmıyorum</label>
        </div>
    </div>
   
    <div class="input-section">
        <h5 class="username-label">2.Basınç ülserlerini önlemek konusunda iyi eğitimliyim.</h5>
        <h6 class="error">Lütfen bir seçenek seçin</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_training">
            <label for="strongly agree">Kesinlikle Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_training">
            <label for="agree">Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_training">
            <label for="strongly agree">katılmıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_training">
            <label for="strongly agree">Kesinlikle katılmıyorum</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">3.	Basınç ülserlerinin önlenmesi oldukça zordur. Diğer hemşireler bu konuda benden daha iyidir.</h5>
        <h6 class="error">Lütfen bir seçenek seçin</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_difficulty">
            <label for="strongly agree">Kesinlikle Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_difficulty">
            <label for="agree">Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_difficulty">
            <label for="strongly agree">katılmıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_difficulty">
            <label for="strongly agree">Kesinlikle katılmıyorum</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">4.	Basınç ülserlerini önlemek çok fazla dikkat gerektirir.</h5>
        <h6 class="error">Lütfen bir seçenek seçin</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_attention">
            <label for="strongly agree">Kesinlikle Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_attention">
            <label for="agree">Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_attention">
            <label for="strongly agree">katılmıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_attention">
            <label for="strongly agree">Kesinlikle katılmıyorum</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">5.	Basınç ülserinin önlenmesi o kadar önemli değildir.</h5>
        <h6 class="error">Lütfen bir seçenek seçin</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_importance">
            <label for="strongly agree">Kesinlikle Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_importance">
            <label for="agree">Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_importance">
            <label for="strongly agree">katılmıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_importance">
            <label for="strongly agree">Kesinlikle katılmıyorum</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">6.	Basınç ülserinin önlenmesi bir öncelik olmalıdır.</h5>
        <h6 class="error">Lütfen bir seçenek seçin</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_priority">
            <label for="strongly agree">Kesinlikle Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_priority">
            <label for="agree">Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_priority">
            <label for="strongly agree">katılmıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_priority">
            <label for="strongly agree">Kesinlikle katılmıyorum</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">7.Basınç ülseri hastaya neredeyse hiç rahatsızlık vermez.</h5>
        <h6 class="error">Lütfen bir seçenek seçin</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_discomfort">
            <label for="strongly agree">Kesinlikle Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_discomfort">
            <label for="agree">Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_discomfort">
            <label for="strongly agree">katılmıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_discomfort">
            <label for="strongly agree">Kesinlikle katılmıyorum</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">8.Basınç ülserlerinin hasta üzerine olan etkisi abartılmamalıdır.</h5>
        <h6 class="error">Lütfen bir seçenek seçin</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_exagerration">
            <label for="strongly agree">Kesinlikle Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_exagerration">
            <label for="agree">Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_exagerration">
            <label for="strongly agree">katılmıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_exagerration">
            <label for="strongly agree">Kesinlikle katılmıyorum</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">9.	Basınç ülserlerinin toplum üzerine olan ekonomik etkisi abartılmamalıdır.</h5>
        <h6 class="error">Lütfen bir seçenek seçin</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_economy">
            <label for="strongly agree">Kesinlikle Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_economy">
            <label for="agree">Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_economy">
            <label for="strongly agree">katılmıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_economy">
            <label for="strongly agree">Kesinlikle katılmıyorum</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">10.	Hastamda basınç ülseri gelişirse kendimi sorumlu hissetmem.	</h5>
        <h6 class="error">Lütfen bir seçenek seçin</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_responsibility">
            <label for="strongly agree">Kesinlikle Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_responsibility">
            <label for="agree">Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_responsibility">
            <label for="strongly agree">katılmıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_responsibility">
            <label for="strongly agree">Kesinlikle katılmıyorum</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">11.	Yüksek riskli hastalarda basınç ülserleri önlemede önemli bir role sahibim.</h5>
        <h6 class="error">Lütfen bir seçenek seçin</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_role">
            <label for="strongly agree">Kesinlikle Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_role">
            <label for="agree">Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_role">
            <label for="strongly agree">katılmıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_role">
            <label for="strongly agree">Kesinlikle katılmıyorum</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">12.	Yüksek riskli hastalarda basınç ülserleri önlenebilir.</h5>
        <h6 class="error">Lütfen bir seçenek seçin</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_highrisk">
            <label for="strongly agree">Kesinlikle Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_highrisk">
            <label for="agree">Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_highrisk">
            <label for="strongly agree">katılmıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_highrisk">
            <label for="strongly agree">Kesinlikle katılmıyorum</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">13.	Basınç ülserleri asla önlenemez.</h5>
        <h6 class="error">Lütfen bir seçenek seçin</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_ability">
            <label for="strongly agree">Kesinlikle Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_ability">
            <label for="agree">Katılıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_ability">
            <label for="strongly agree">katılmıyorum</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_ability">
            <label for="strongly agree">Kesinlikle katılmıyorum</label>
        </div>
    </div>

    <button type="submit" id="submit" class="btn btn-success">Gönder</button>
    </div>
</body>

<script>
    $('#back').click(function (e) { 
        e.preventDefault();
     $('#content').load('course.php');
    });
    $('#submit').click(function (e) { 
        e.preventDefault();
        //validation
        $('.error').css('display', 'none');
        if ($('input[name="ulcer_prevention_confidence"]:checked').length === 0) {
        // Find the nearest error
        $('input[name="ulcer_prevention_confidence"]').closest('.input-section').find('.error').css('display', 'block');

        // Scroll to the error
        $('html, body').animate({
            scrollTop: $('input[name="ulcer_prevention_confidence"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }

    if ($('input[name="ulcer_prevention_training"]:checked').length === 0) {
        // Find the nearest error
        $('input[name="ulcer_prevention_training"]').closest('.input-section').find('.error').css('display', 'block');

        // Scroll to the error
        $('html, body').animate({
            scrollTop: $('input[name="ulcer_prevention_training"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }

    if ($('input[name="ulcer_prevention_difficulty"]:checked').length === 0) {
        // Find the nearest error
        $('input[name="ulcer_prevention_difficulty"]').closest('.input-section').find('.error').css('display', 'block');

        // Scroll to the error
        $('html, body').animate({
            scrollTop: $('input[name="ulcer_prevention_difficulty"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }

    if ($('input[name="ulcer_prevention_attention"]:checked').length === 0) {
        // Find the nearest error
        $('input[name="ulcer_prevention_attention"]').closest('.input-section').find('.error').css('display', 'block');

        // Scroll to the error
        $('html, body').animate({
            scrollTop: $('input[name="ulcer_prevention_attention"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }

    if ($('input[name="ulcer_prevention_importance"]:checked').length === 0) {
        // Find the nearest error
        $('input[name="ulcer_prevention_importance"]').closest('.input-section').find('.error').css('display', 'block');

        // Scroll to the error
        $('html, body').animate({
            scrollTop: $('input[name="ulcer_prevention_importance"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }

    if ($('input[name="ulcer_prevention_priority"]:checked').length === 0) {
        // Find the nearest error
        $('input[name="ulcer_prevention_priority"]').closest('.input-section').find('.error').css('display', 'block');

        // Scroll to the error
        $('html, body').animate({
            scrollTop: $('input[name="ulcer_prevention_priority"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }

    if ($('input[name="ulcer_prevention_discomfort"]:checked').length === 0) {
        // Find the nearest error
        $('input[name="ulcer_prevention_discomfort"]').closest('.input-section').find('.error').css('display', 'block');

        // Scroll to the error
        $('html, body').animate({
            scrollTop: $('input[name="ulcer_prevention_discomfort"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }

    if ($('input[name="ulcer_prevention_exagerration"]:checked').length === 0) {
        // Find the nearest error
        $('input[name="ulcer_prevention_exagerration"]').closest('.input-section').find('.error').css('display', 'block');

        // Scroll to the error
        $('html, body').animate({
            scrollTop: $('input[name="ulcer_prevention_exagerration"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }

    if ($('input[name="ulcer_prevention_economy"]:checked').length === 0) {
        // Find the nearest error
        $('input[name="ulcer_prevention_economy"]').closest('.input-section').find('.error').css('display', 'block');

        // Scroll to the error
        $('html, body').animate({
            scrollTop: $('input[name="ulcer_prevention_economy"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }

    if ($('input[name="ulcer_prevention_responsibility"]:checked').length === 0) {
        // Find the nearest error
        $('input[name="ulcer_prevention_responsibility"]').closest('.input-section').find('.error').css('display', 'block');

        // Scroll to the error
        $('html, body').animate({
            scrollTop: $('input["ulcer_prevention_responsibility"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }

    if ($('input[name="ulcer_prevention_role"]:checked').length === 0) {
    // Find the nearest error
    $('input[name="ulcer_prevention_role"]').closest('.input-section').find('.error').css('display', 'block');

    // Scroll to the error
    $('html, body').animate({
        scrollTop: $('input[name="ulcer_prevention_role"]').closest('.input-section').find('.error').offset().top - 200
    }, 500);
    return;
}

if ($('input[name="ulcer_prevention_highrisk"]:checked').length === 0) {
    // Find the nearest error
    $('input[name="ulcer_prevention_highrisk"]').closest('.input-section').find('.error').css('display', 'block');

    // Scroll to the error
    $('html, body').animate({
        scrollTop: $('input[name="ulcer_prevention_highrisk"]').closest('.input-section').find('.error').offset().top - 200
    }, 500);
    return;
}

if ($('input[name="ulcer_prevention_ability"]:checked').length === 0) {
    // Find the nearest error
    $('input[name="ulcer_prevention_ability"]').closest('.input-section').find('.error').css('display', 'block');
    
    // Scroll to the error
    $('html, body').animate({
        scrollTop: $('input[name="ulcer_prevention_ability"]').closest('.input-section').find('.error').offset().top - 200
    }, 500);
    return;
}
    var student_id = "<?php echo $student_id; ?>"; 
    var student_name = "<?php echo $student_name; ?>";
    var student_email = "<?php echo $student_email; ?>";
    var student_group = "<?php echo $student_group; ?>";
    var ulcer_prevention_confidence = $('input[name="ulcer_prevention_confidence"]:checked').length > 0 ? $('input[name="ulcer_prevention_confidence"]:checked').val() : '';
    var ulcer_prevention_training = $('input[name="ulcer_prevention_training"]:checked').length > 0 ? $('input[name="ulcer_prevention_training"]:checked').val() : '';
    var ulcer_prevention_difficulty = $('input[name="ulcer_prevention_difficulty"]:checked').length > 0 ? $('input[name="ulcer_prevention_difficulty"]:checked').val() : '';
    var ulcer_prevention_attention = $('input[name="ulcer_prevention_attention"]:checked').length > 0 ? $('input[name="ulcer_prevention_attention"]:checked').val() : '';
    var ulcer_prevention_importance = $('input[name="ulcer_prevention_importance"]:checked').length > 0 ? $('input[name="ulcer_prevention_importance"]:checked').val() : '';
    var ulcer_prevention_priority = $('input[name="ulcer_prevention_priority"]:checked').length > 0 ? $('input[name="ulcer_prevention_priority"]:checked').val() : '';
    var ulcer_prevention_discomfort = $('input[name="ulcer_prevention_discomfort"]:checked').length > 0 ? $('input[name="ulcer_prevention_discomfort"]:checked').val() : '';
    var ulcer_prevention_exagerration = $('input[name="ulcer_prevention_exagerration"]:checked').length > 0 ? $('input[name="ulcer_prevention_exagerration"]:checked').val() : '';
    var ulcer_prevention_economy = $('input[name="ulcer_prevention_economy"]:checked').length > 0 ? $('input[name="ulcer_prevention_economy"]:checked').val() : '';
    var ulcer_prevention_responsibility = $('input[name="ulcer_prevention_responsibility"]:checked').length > 0 ? $('input[name="ulcer_prevention_responsibility"]:checked').val() : '';
    var ulcer_prevention_role = $('input[name="ulcer_prevention_role"]:checked').length > 0 ? $('input[name="ulcer_prevention_role"]:checked').val() : '';
    var ulcer_prevention_highrisk = $('input[name="ulcer_prevention_highrisk"]:checked').length > 0 ? $('input[name="ulcer_prevention_highrisk"]:checked').val() : '';
    var ulcer_prevention_ability = $('input[name="ulcer_prevention_ability"]:checked').length > 0 ? $('input[name="ulcer_prevention_ability"]:checked').val() : '';
    $.ajax({
        type: "POST",
        url: "./posttest1-handler.php",
        data: {
            task_id : <?php echo $task_id ?>,
            student_id: student_id,
            student_name: student_name,
            student_email: student_email,
            student_group: student_group,
            ulcer_prevention_confidence: ulcer_prevention_confidence,
            ulcer_prevention_training: ulcer_prevention_training,
            ulcer_prevention_difficulty: ulcer_prevention_difficulty,
            ulcer_prevention_attention: ulcer_prevention_attention,
            ulcer_prevention_importance: ulcer_prevention_importance,
            ulcer_prevention_priority: ulcer_prevention_priority,
            ulcer_prevention_discomfort: ulcer_prevention_discomfort,
            ulcer_prevention_exagerration: ulcer_prevention_exagerration,
            ulcer_prevention_economy: ulcer_prevention_economy,
            ulcer_prevention_responsibility: ulcer_prevention_responsibility,
            ulcer_prevention_role: ulcer_prevention_role,
            ulcer_prevention_highrisk: ulcer_prevention_highrisk,
            ulcer_prevention_ability: ulcer_prevention_ability

        },
        success: function (response) {
            if(response.trim() === "success"){
                window.alert("Pretest 1 submitted successfully");
                $('#content').load('course.php');
            } 
             else{
                window.alert(response);
             }
        }
    });






    });
</script>
</html>