<?php
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

    <div>
        <form action="" method="post">
            <div class="login-box login-signup">

                <h1 class="header">e-BYRYS-KKDS</h1>
                <h2 class="login">Sign Up as Student</h2>

                <p class="usernamelabel">İsim</p>
                <input type="text" required name="name" id="name" placeholder="İsim Giriniz">

                <p class="usernamelabel">Soyisim</p>
                <input type="text" required name="surname" id="surname" placeholder="Soyisim Giriniz">

                <p class="usernamelabel">E-mail</p>
                <input type="email" required name="email" id="email" placeholder="E-mail Giriniz">

                <p class="passwordlabel">Şifre</p>
                <input type="password" name="password" id="password" required placeholder="Şifre Giriniz">

                <input type="submit" name="submit" id="register" value="Kayıt Ol">
                <a href="main.php" class="lower-buttons" style="padding-top:10px"><i class="gg-arrow-left-o" style="margin: 0; margin-right: 20px;"></i>Ana Sayfaya Dön</a>
        </form>

    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $password = trim($password); // remove whitespace from the beginning and end of the string
        $password = stripslashes($password); // remove backslashes from the string

        // check if the password meets the minimum length requirement
        if (strlen($password) < 6) {
        // handle the error, for example:
         $error_message = "Password must be at least 6 characters long.";
         echo $error_message;
}
        $(function() {
            $('#register').click(function(e) {

                var valid = this.form.checkValidity();

                if (valid) {

                    var name = $('#name').val();
                    var surname = $('#surname').val();
                    var email = $('#email').val();
                    var password = $('#password').val();

                    e.preventDefault()

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
                            Swal.fire({
                                'title': 'Success',
                                'text': data,
                                'type': 'success'
                            })
                            setTimeout('window.location.href = "main.php"', 1000);

                        },
                        error: function(data) {
                            Swal.fire({
                                'title': 'Errors',
                                'text': 'There were errors',
                                'type': 'error'
                            })
                        }
                    })


                } else {

                }

            })

        })
    </script>
</body>

</html>