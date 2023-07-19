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

    </style>
</head>
<body>
    <div class="container-fluid mt-5 w-75 p-4 mb-4" style="background-color: white;">
        <h2 class="form-header text-center mb-3">Pretest 1</h2>

    <div class="input-section">
        <h5 class="username-label">1.Basınç ülserlerini önlemeye yönelik becerilerime güveniyorum.</h5>
        <h6 class="error">Please select one option</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_confidence">
            <label for="strongly agree">Strongly Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_confidence">
            <label for="agree">Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_confidence">
            <label for="strongly agree">disagree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_confidence">
            <label for="strongly agree">Strongly disagree</label>
        </div>
    </div>
   
    <div class="input-section">
        <h5 class="username-label">2.Basınç ülserlerini önlemek konusunda iyi eğitimliyim.</h5>
        <h6 class="error">Please select one option</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_training">
            <label for="strongly agree">Strongly Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_training">
            <label for="agree">Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_training">
            <label for="strongly agree">disagree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_training">
            <label for="strongly agree">Strongly disagree</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">3.	Basınç ülserlerinin önlenmesi oldukça zordur. Diğer hemşireler bu konuda benden daha iyidir.</h5>
        <h6 class="error">Please select one option</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_difficulty">
            <label for="strongly agree">Strongly Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_difficulty">
            <label for="agree">Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_difficulty">
            <label for="strongly agree">disagree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_difficulty">
            <label for="strongly agree">Strongly disagree</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">4.	Basınç ülserlerini önlemek çok fazla dikkat gerektirir.</h5>
        <h6 class="error">Please select one option</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_attention">
            <label for="strongly agree">Strongly Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_attention">
            <label for="agree">Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_attention">
            <label for="strongly agree">disagree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_attention">
            <label for="strongly agree">Strongly disagree</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">5.	Basınç ülserinin önlenmesi o kadar önemli değildir.</h5>
        <h6 class="error">Please select one option</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_importance">
            <label for="strongly agree">Strongly Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_importance">
            <label for="agree">Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_importance">
            <label for="strongly agree">disagree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_importance">
            <label for="strongly agree">Strongly disagree</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">6.	Basınç ülserinin önlenmesi bir öncelik olmalıdır.</h5>
        <h6 class="error">Please select one option</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_priority">
            <label for="strongly agree">Strongly Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_priority">
            <label for="agree">Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_priority">
            <label for="strongly agree">disagree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_priority">
            <label for="strongly agree">Strongly disagree</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">7.Basınç ülseri hastaya neredeyse hiç rahatsızlık vermez.</h5>
        <h6 class="error">Please select one option</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_discomfort">
            <label for="strongly agree">Strongly Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_discomfort">
            <label for="agree">Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_discomfort">
            <label for="strongly agree">disagree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_discomfort">
            <label for="strongly agree">Strongly disagree</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">8.Basınç ülserlerinin hasta üzerine olan etkisi abartılmamalıdır.</h5>
        <h6 class="error">Please select one option</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_exagerration">
            <label for="strongly agree">Strongly Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_exagerration">
            <label for="agree">Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_exagerration">
            <label for="strongly agree">disagree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_exagerration">
            <label for="strongly agree">Strongly disagree</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">9.	Basınç ülserlerinin toplum üzerine olan ekonomik etkisi abartılmamalıdır.</h5>
        <h6 class="error">Please select one option</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_economy">
            <label for="strongly agree">Strongly Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_economy">
            <label for="agree">Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_economy">
            <label for="strongly agree">disagree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_economy">
            <label for="strongly agree">Strongly disagree</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">10.	Hastamda basınç ülseri gelişirse kendimi sorumlu hissetmem.	</h5>
        <h6 class="error">Please select one option</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_responsibility">
            <label for="strongly agree">Strongly Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_responsibility">
            <label for="agree">Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_responsibility">
            <label for="strongly agree">disagree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_responsibility">
            <label for="strongly agree">Strongly disagree</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">11.	Yüksek riskli hastalarda basınç ülserleri önlemede önemli bir role sahibim.</h5>
        <h6 class="error">Please select one option</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_role">
            <label for="strongly agree">Strongly Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_role">
            <label for="agree">Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_role">
            <label for="strongly agree">disagree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_role">
            <label for="strongly agree">Strongly disagree</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">12.	Yüksek riskli hastalarda basınç ülserleri önlenebilir.</h5>
        <h6 class="error">Please select one option</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_highrisk">
            <label for="strongly agree">Strongly Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_highrisk">
            <label for="agree">Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_highrisk">
            <label for="strongly agree">disagree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_highrisk">
            <label for="strongly agree">Strongly disagree</label>
        </div>
    </div>
    <div class="input-section">
        <h5 class="username-label">13.	Basınç ülserleri asla önlenemez.</h5>
        <h6 class="error">Please select one option</h6>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly agree" name="ulcer_prevention_ability">
            <label for="strongly agree">Strongly Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="agree" name="ulcer_prevention_ability">
            <label for="agree">Agree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="disagree" name="ulcer_prevention_ability">
            <label for="strongly agree">disagree</label>
        </div>
        <div class="d-flex flex-row align-items-center">
            <input type="radio" value="strongly disagree" name="ulcer_prevention_ability">
            <label for="strongly agree">Strongly disagree</label>
        </div>
    </div>

    <button type="submit" id="submit" class="btn btn-success">Submit</button>
    </div>
</body>


<script>
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
            scrollTop: $('input[ulcer_prevention_responsibility="username"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }

    if ($('input[ulcer_prevention_role="username"]:checked').length === 0) {
        // Find the nearest error
        $('input[ulcer_prevention_role="username"]').closest('.input-section').find('.error').css('display', 'block');

        // Scroll to the error
        $('html, body').animate({
            ulcer_prevention_role: $('input[ulcer_prevention_role="username"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }

    if ($('input[ulcer_prevention_highrisk="username"]:checked').length === 0) {
        // Find the nearest error
        $('input[ulcer_prevention_highrisk="username"]').closest('.input-section').find('.error').css('display', 'block');

        // Scroll to the error
        $('html, body').animate({
            ulcer_prevention_role: $('input[ulcer_prevention_highrisk="username"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }

    if ($('input[ulcer_prevention_ability="username"]:checked').length === 0) {
        // Find the nearest error
        $('input[ulcer_prevention_ability="username"]').closest('.input-section').find('.error').css('display', 'block');
        // Scroll to the error
        $('html, body').animate({
            ulcer_prevention_role: $('input[ulcer_prevention_ability="username"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }








    });
</script>
</html>