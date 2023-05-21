<?php
session_start();
if (isset($_SESSION['userlogin'])) {
    header("Location: student-main.php");
}
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
            <div class="login-box login-login" style= 'width : 50%;'>

                <h1 class="header">e-BYRYS-KKDS</h1>
                <h2 class="login">Size bir e-posta gönderildi, lütfen kodu girin</h2>

                <p class="labels">Kodu</p>
                <input type="text" required name="code" id="code" placeholder="Kodu girin">
                <input type="submit" name="submit" id="validate" value="devam">
                <a href="main.php" class="lower-buttons" style="padding-top:10px"><i class="gg-arrow-left-o"
                        style="margin: 0; margin-right: 20px;"></i>Ana Sayfaya Dön</a>
            </div>
        </form>

    </div>

    <div id="recovery-box">
        <form action="" method="post">
            <div class="login-box login-login">
                <h1 class="header">e-BYRYS-KKDS</h1>
                <h2 class="login">Şifre kurtarma</h2>

                <p class="labels">Mail Onayla</p>
                <input type="text" required name="email" id="email" placeholder="Mail Giriniz">
                <input type="submit" name="submit" id="send-code" value="Kodu gönder">
                <a href="main.php" class="lower-buttons" style="padding-top:10px"><i class="gg-arrow-left-o"
                        style="margin: 0; margin-right: 20px;"></i>Ana Sayfaya Dön</a>
                </div>
        </form>

    </div>
    <div id="password-box">
        <form action="" method="post">
            <div class="login-box login-login">
                <h1 class="header">e-BYRYS-KKDS</h1>
                <h2 class="login">Şifre kurtarma</h2>

                <p class="labels">Yeni Şifre</p>
                <input type="text" required name="email" id="password" placeholder="Mail Giriniz" oninput="sanitizePasswordRecovery()">
                <p class="labels">Şifreyi Onayla</p>
                <input type="text" required name="email" id="confirm-password" placeholder="Mail Giriniz" oninput="sanitizePasswordRecovery()">
                <p id="password-error" style='color:red;'></p>
                <input type="submit" name="submit" id="change-password" value="Done">
                <a href="main.php" class="lower-buttons" style="padding-top:10px"><i class="gg-arrow-left-o"
                        style="margin: 0; margin-right: 20px;"></i>Ana Sayfaya Dön</a>
                </div>
        </form>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>,
    <script>
        var emailCode = '';
        var email = '';
        $("#validation-box").css("display", "none");
        $("#password-box").css("display", "none");
        $("#change-password").css("display", "none");


//send code
    $(function() {
        $('#send-code').click(function(e) {
            e.preventDefault();
            sendEmail();                
        })
    })
    
    //password checking
function sanitizePasswordRecovery() {
  var passwordInput = document.getElementById("password");
  var confirmPasswordInput = document.getElementById("confirm-password");
  var passwordError = document.getElementById("password-error");

  if (passwordInput.value.length < 6) {
    passwordError.innerText = "Şifreniz en az 6 karakter uzunluğunda olmalıdır.";
    passwordError.style.display = "inline";
    document.getElementById("change-password").style.display = 'none';
  } else {
    passwordError.style.display = "none";
    if (passwordInput.value !== confirmPasswordInput.value) {
    passwordError.innerText = "şifreler aynı değil";
    passwordError.style.display = "inline";
    confirmPasswordInput.setCustomValidity("Şifreler eşleşmiyor.");
    document.getElementById("change-password").style.display = 'none';
  } else {
    confirmPasswordInput.setCustomValidity("");
    if (passwordError.style.display === "none") {
        passwordError.style.display = "none";
      document.getElementById("change-password").style.display = 'block';
    }
  }
  }


}


    //validate codde
    $(function() {
        $('#validate').click(function(e) {
            e.preventDefault();
            if(emailCode === $('#code').val() ){
                alert("validated");
                $("#recovery-box").css("display", 'none');
                $("#validation-box").css("display", 'none');
                $("#password-box").css("display", "block");
            }
            else{
                alert("Kodlar eşleşmiyor! Tekrar deneyin.");
            }
        })
    })
    $(function() {
        $('#change-password').click(function(e) {
            e.preventDefault();
            var password = $("#password").val();
            var confirmPassword = $("#confirm-password").val();
            if(password !== confirmPassword || password==''){
                alert("Şifreniz değişti");
            }
            else{
                $.ajax({
                    type: "POST",
                    url: "changePasswordTeacher.php",
                    data: {
                        email :email,
                        password :password
                    },
                    success: function (response) {
                        if(response == "success"){
                            alert("Şifreniz değişti.!")
                            window.location.href = "main.php"
                        }else{
                            alert("Server hatası!")
                        }
                    },
                    error :function(response){
                        alert(response);
                    }

                });
            }
            })
    })


    </script>
    <script>
 function sendEmail(){
                    email = $('#email').val();
                    
                    $.ajax({
                                type: "POST",
                                url: "checkEmailTeacher.php",
                                data: {
                                    email: email,
                                },
                                success: function (response) {
                                       if(response == 'exists'){
                                        $.ajax({
                                type: "POST",
                                url: "sendEmail.php",
                                data: {
                                    email: email,
                                },
                                success: function (response) {
                                        $("#recovery-box").css("display", 'none');
                                        $("#validation-box").css("display", 'block');
                                       emailCode = response;
                                },
                                error :function(response){
                                    console.log(response)
                                }
                            });   
                                       }else{
                                        alert("email does not exist")
                                       }
                                },
                                error :function(response){
                                    console.log(response)
                                }
                            });   



        }
    </script>



</body>

</html>