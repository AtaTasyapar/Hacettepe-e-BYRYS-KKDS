<?php 
session_start();
if (isset($_SESSION['ebyrysUserLogin'])) {
    if($_SESSION['ebyrysUserLogin']['type'] == 'teacher'){
        header("Location: teacher-main.php");
    }
    else if($_SESSION['ebyrysUserLogin']['type'] == 'student'){
        header("Location: student-main.php");
    }
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

</head>

<body>


    <div class="login-box">
        <div class="hacettepelogo-wrapper">
            <object class="hacettepelogo" data="hacettepelogo.svg" width="300" height="300"> </object>
            <p class="hemsire-fakulte">Hemşirelik Fakültesi</p>
        </div>
        <h1 class="header">e-BYRYS-KKDS</h1>

        <div class="buttons-wrapper">
            <a class="buttons" href="login-teacher.php">Öğretmen Girişi</a>
            <a class="buttons" href="login-student.php">Öğrenci Girişi</a>
            <a class="buttons" href="registration-student.php">Öğrenci Kaydı</a>
        </div>
    </div>


</body>

</html>