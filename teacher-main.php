<?php
session_start();
if (!isset($_SESSION['userlogin'])) {
    header("Location: login-student.php");
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION);
    header("Location: main.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>e-BYRYS-KKDS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">


    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="style.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->

</head>

<body class="stu-body">
    <div class="stu-body1">
        <div class="navigation-wrapper">
            <div class="navigation-both">
                <div class="navigation-left d-flex" id="navigation-left">
                    <div class="hacettepelogo-wrapper">
                        <object class="hacettepelogo" data="hacettepelogo.svg" width="300" height="300"> </object>
                        <p class="hemsire-fakulte">Hemşirelik Fakültesi</p>
                    </div>
                    <a href="" class="title-wrapper">

                        <h3 class="title"><i class="fa fa-user-edit me-2"></i>e-BYRYS-KKDS</h3>
                    </a>

                </div>
                <div class="navigation-right" id="navigation-right">
                    <div class="nav-items-wrapper">
                        <a href="formlar-teacher.php" id="formlar" class="nav-link nav-items formlar btn-success"> <i
                                class="fa fa-table me-2 "></i>Öğrenciler</a>

                        <a href="vaka-upload.php" class="nav-link nav-items btn-success">
                            <i class="fa fa-th me-2"></i>Vakalar</a>

                    </div>
                    <div>

                        <a href="#" class="nav-link username-wrapper" data-bs-toggle="dropdown">
                            <span class=" d-lg-inline-flex username"><?php
                                                            echo '' . $_SESSION['userlogin']['name'] . ' ' . $_SESSION['userlogin']['surname'] . '';
                                                            ?></span></a>
                        <span class="status">Öğretmen</span>

                        <a class="black logout" href="teacher-main.php?logout=true">Çıkış Yap</a>

                    </div>

                    <!-- <div>
                        <a href="delete-account.php?type=teacher" id="deleteAccount" class="nav-link btn" style="background-color:red;"> <i class="fa fa-table me-2 "></i>silmek</a>
                    </div> -->
                    <span class=' closehamburger' id='closeBtn'>&laquo;</span>
                </div>



            </div>
            <div class="stu-hamburger" id="stu-hamburger">
                <div class="hamburger-wrapper" id="hamburger-wrapper" onclick="hamburger()">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </div>

        <div class="content" id="content">

        </div>
        <script>
        function hamburger() {

            const hamburger = document.getElementById('stu-hamburger');
            console.log(hamburger);
            hamburger.classList.remove("d-block");
            hamburger.classList.add("d-none-resp");

            const navright = document.getElementById('navigation-right');
            console.log(navright);
            navright.classList.remove("d-none");
            navright.classList.add("d-block-resp");

            const navleft = document.getElementById('navigation-left');
            console.log(navleft);
            navleft.classList.add("d-none");
            navleft.classList.remove("d-block-resp");

            const closebtn = document.getElementById('closeBtn');
            console.log(closebtn)
            closebtn.classList.remove("d-none");
            closebtn.classList.add("d-block-resp");
        };
        $("#closeBtn").on("click", function(e) {
            const hamburger = document.getElementById('stu-hamburger');
            console.log(hamburger);
            hamburger.classList.add("d-block");
            hamburger.classList.remove("d-none-resp");

            const navright = document.getElementById('navigation-right');
            console.log(navright);
            navright.classList.add("d-none");
            navright.classList.remove("d-block-resp");


            const navleft = document.getElementById('navigation-left');
            console.log(navleft);
            navleft.classList.remove("d-none");
            navleft.classList.add("d-block-resp");

            const closebtn = document.getElementById('closeBtn');
            console.log(closebtn)
            closebtn.classList.add("d-none");
            closebtn.classList.remove("d-block-resp");
        })
        </script>
        <script>
        $(function() {
            $.ajaxSetup({
                cache: false
            }); // disable caching for all requests.

            // RAW Text/Html data from a file
            $("#content").load("formlar-teacher.php");

            $(function() {
                $("a.nav-items").on("click", function(e) {
                    e.preventDefault();
                    $("#content").load(this.href);
                })
            })

        });
        </script>
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/chart/chart.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="main.js"></script>
</body>

</html>