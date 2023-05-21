<?php
require_once("config-teachers.php");
session_start()

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

    <div>
        <form action="" method="post">
            <div class="login-box login-login">

                <h1 class="header">e-BYRYS-KKDS</h1>
                <h2 class="login">Öğretmen Girişi</h2>

                <p class="labels">E-Posta</p>
                <input type="text" required name="email" id="email" placeholder="E-Posta Giriniz">
                <p class="labels">Şifre</p>
                <input type="password" name="password" id="password" required placeholder="Şifre Giriniz">
                <input type="submit" name="submit" id="login" value="Giriş Yap">
                <div style="display: flex;"><a class="btn btn-primary" href="recoverPasswordTeacher.php">şifremi
                        unuttum</a>
                    <a href="main.php" class="lower-buttons"><i class="gg-arrow-left-o"
                            style="margin: 0; margin-right: 20px;"></i>Ana Sayfaya Dön</a>
                </div>
        </form>

    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>,
    <script>
    $(function() {
        $('#login').click(function(e) {

            var email = $('#email').val();
            var password = $('#password').val();
            console.log(email)

            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'process-login-teacher.php',
                data: {
                    email: email,
                    password: password
                },
                success: function(data) {
                    alert(data)
                    if ($.trim(data) === "Başarılı") {
                        setTimeout('window.location.href = "teacher-main.php"', 1000);
                    }
                },
                error: function(data) {
                    alert('Hata');
                }
            })

        })
    });
    </script>
</body>

</html>