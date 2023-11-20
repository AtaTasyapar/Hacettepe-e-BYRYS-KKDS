<?php
session_start();
$message = '';
if (isset($_SESSION['email_alert'])) {
    $message = 'Email Already Existed';
}
require_once("config-students.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>e-BYRYS-KKDS</title>



    <link rel="icon" href="img/core-img/favicon.ico">


    <link rel="stylesheet" href="style.css">
    <link href='https://css.gg/arrow-left-o.css' rel='stylesheet'>

</head>

<body>

    <div id="validation-box">
        <form action="" method="post">
            <div class="login-box login-login" style='width : 50%;'>

                <h1 class="header">e-BYRYS-KKDS</h1>
                <h2 class="login"></h2>

                <p class="labels">Kodu</p>
                <input type="text" required name="code" id="code" placeholder="enter code">
                <input type="submit" name="submit" id="validate" value="Giriş Yap">
                <button class='btn btn-primary' id="sendEmail">Tekrar Gonder</button>
                <a href="main.php" class="lower-buttons" style="padding-top:10px"><i class="gg-arrow-left-o" style="margin: 0; margin-right: 20px;"></i>Ana Sayfaya Dön</a>
            </div>
        </form>

    </div>
    <!-- oninput="checkPasswordMatch(); sanitizePassword()" -->
    <!-- oninput="sanitizeEmail()" -->
    <!-- oninput="checkPasswordMatch()" -->


    <form action="" method="post">
        <div class="login-box login-signup" id="registrationForm">

            <h1 class="header">e-BYRYS-KKDS</h1>
            <h2 class="login">Öğrenci Kaydı</h2>
            <h3><?php echo $message; ?></h3>

            <p class="usernamelabel">İsim</p>
            <input type="text" required name="name" id="name" placeholder="İsim Giriniz">

            <p class="usernamelabel">Soyisim</p>
            <input type="text" required name="surname" id="surname" placeholder="Soyisim Giriniz">

            <p class="usernamelabel">E-Posta</p>
            <input type="email" required name="email" id="email" placeholder="E-Posta Giriniz" >
            <span id="email-error" style="display:none; color:red;">Lütfen geçerli bir e-posta adresi
                giriniz.</span>

            <p class="passwordlabel">Şifre</p>
            <input type="password" name="password" id="password" required placeholder="Şifre Giriniz" minlength="6" >
            <span id="password-error" style="display:none; color:red;">Şifre en az 6 karakter uzunluğunda
                olmalıdır.</span>
            <p class="passwordlabel">Şifreyi Tekrar Girin</p>
            <input type="password" name="confirm-password" id="confirm-password" required placeholder="Şifreyi Tekrar Girin" minlength="6" >
            <span id="confirm-password-error" style="display:none; color:red;">Şifreler eşleşmiyor.</span>


            <input type="submit" name="submit" id="register" value="Kayıt Ol">
            <a href="main.php" class="lower-buttons" style="padding-top:10px"><i class="gg-arrow-left-o" style="margin: 0; margin-right: 20px;"></i>Ana Sayfaya Dön</a>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // document.getElementById("register").style.display = 'none';

        var emailCode = '';


    function sendEmail(name, surname, email, password) {
    $.ajax({
        type: "POST",
        url: "sendEmail.php",
        data: {
            name: name,
            surname: surname,
            email: email,
            password: password
        },
        success: function(response) {
            $("#registrationForm").css("display", 'none');
            $("#validation-box").css("display", 'block');
            emailCode = response;
        },
        error: function(response) {
            console.log(response);
        }
    });
}

        $(function() {

            $('#validate').click(function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var surname = $('#surname').val();
                var email = $('#email').val();
                var password = $('#password').val();

                if (emailCode === $("#code").val()) {
                    $.ajax({
                        type: 'POST',
                        url: 'process-student.php',
                        data: {
                            name: name,
                            surname: surname,
                            email: email,
                            password: password
                        },
                        success: function(data) {

                            alert("Kayıt Başarılı")
                            window.location.href = './login-student.php';
                        },
                        error: function(data) {
                            console.log("Ka", data)
                            alert("Kayıt başarısız!");
                        }
                    })
                } else {
                    alert("Kodlar eşleşmiyor!")
                };

            })
        });


        $("#validation-box").css("display", 'none');

        $(function() {
    $('#register').click(function(e) {
        e.preventDefault();
        var name = $('#name').val();
        var surname = $('#surname').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var password_again = $('#confirm-password').val(); 

        if(name === '' || surname === '' || email === '' || password === '' || password_again === '') {
            alert("Lütfen tüm alanları doldurunuz.");
            return;
        }
        else if(!isValidEmail(email)) {
            alert("Lütfen geçerli bir e-posta adresi giriniz.");
            return;
        }
        else if(password !== password_again) {
            alert("Şifreler eşleşmiyor.");
            return;
        }
        else if(password.length < 6) {
            alert("Şifre en az 6 karakter uzunluğunda olmalıdır.");
            return;
        }
        else{
            isEmailExist(email, function(exists) {
                if (exists) {
                    alert("Bu e-posta adresi zaten kayıtlı. Lütfen farklı bir e-posta adresi seçin.");
                } else {
                    sendEmail(name, surname, email, password);
                }
            });
        }
    });
});


        $("#sendEmail").click(function(e) {
            e.preventDefault();
            alert("Kodu tekrar gönderildi.")
            sendEmail();
        });
    </script>
    <script>
       function isEmailExist(email, callback) {
    $.ajax({
        type: "POST",
        url: "checkEmailStudent.php",
        data: {
            email: email,
        },
        success: function(response) {
            response === 'exists' ? callback(true) : callback(false);
        },
        error: function(response) {
            callback(false);
        }
    });
}
    </script>
    <script>
        

        function isValidEmail(email) {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    </script>

</body>

</html>