<?php
session_start();
if (!isset($_SESSION['userlogin'])) {
    header("Location: login-teacher.php");
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
    <link href="style.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->

</head>

<body style="background-color:white">
    <div class="container-fluid pt-4 px-4">
        <?php
        require_once('config-students.php');
        $userid = $_SESSION['userlogin']['id'];
        //echo $userid;
        $sql = "SELECT * FROM  students";
        $smtmselect = $db->prepare($sql);
        $result = $smtmselect->execute();
        if ($result) {
            $values = $smtmselect->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo 'Hata';
        }

        $sql = "SELECT * FROM  vakalar";
        $smtmselect = $db->prepare($sql);
        $result = $smtmselect->execute();
        if ($result) {
            $vakalar = $smtmselect->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo 'Hata';
        }
        ?>
        <div class="send-patient">







            <div class="row pdf-upload-wrapper">
                <div class="col-lg-6 col-md-6 col-12">

                    <form method="post" enctype="multipart/form-data">


                        <div class="form-input py-2">
                            <label for="images" class="drop-container">
                                <span class="drop-title">PDF Dosyasını Sürükleyin</span>
                                ya da
                                <input type="file" id="pdffile" accept="application/pdf, application/ms-word" required>
                            </label>
                            <span id="error-message" class="validation-error-label"></span>
                            <div class="checkbox-wrapper">
                                <div class="checkboxes">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="student_group" id="student_group" value="kontrol" checked>
                                        <label class="form-check-label" for="student_group">
                                            <span class="checkbox-header"> Kontrol Grubu</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="student_group" id="student_group" value="mudahale">
                                        <label class="form-check-label" for="student_group">
                                            <span class="checkbox-header"> Müdahale Grubu </span>

                                        </label>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" id="submit" class="form-control butunluknot submit pdf-upload-btn" name="submit" value="Kaydet">
                            </div>
                        </div>


                    </form>
                </div>


            </div>

            <div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class=" darkcyan table-head">

                                <th scope="col">Vaka No</th>
                                <th scope="col">Vaka</th>
                                <th scope="col">Detay</th>



                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($vakalar as $vaka) {
                                $vakapdf = $vaka["filename"];


                                $basePath = $vakapdf;
                                $fileLoc = strpos($basePath, 'vakalar');
                                $filePath = substr($basePath, $fileLoc);

                                /*  var_dump(file_exists($filePath));
 var_dump($filePath);

 file_get_contents($vaka["filename"], FILE_USE_INCLUDE_PATH);
 var_dump($vaka["filename"]);
 var_dump("aaaxxxx"); */

                                if (file_exists($filePath)) {
                                    echo "
                                <tr>
                                   
                                    <td style='
                                    color: black; font-size: 18px;'>" . $vaka["id"] . "</td>
                                    <td style='
                                    color: black; font-size: 18px;'>" . $vaka["filename"] . "</td>
                                    
                                    <td style='
                                    color: black; font-size: 18px;
                                    '> <button type='button' id = '" . $vaka['id'] . "' class='btn btn-success'>Detay</button> </td>
                                    
                                    <div id='myModal" . $vaka['id'] . "' class='modal none'>

                                    <!-- Modal content -->
                                        <div class='modal-content' id='modal-content" . $vaka['id'] . "'>
                                            <span class='close" . $vaka['id'] . " closeBtn' id='close" . $vaka['id'] . "'>&times;</span>
                                            <p>Dosya Konumu: " . $vaka['filename'] . "</p>
                                            <p>Öğrenci Grubu: " . $vaka['student_group'] . "</p>
                                            <div class='pdf-section'>
                    <iframe id='iframepdf' class='iframepdf' runat='server' src=" . $filePath . " title=''></iframe>
                    
                    
                    
                </div>
                                            
                                           
                                        </div>
                                    </div>
                                </tr>
                                
                             
                                
                                    
                                
                                <script>
                            var modal" . $vaka['id'] . " = document.getElementById('myModal" . $vaka['id'] . "');

                                // Get the button that opens the modal
                                var btn" . $vaka['id'] . " = document.getElementById('" . $vaka['id'] . "');
                        
                                // Get the <span> element that closes the modal
                                var span" . $vaka['id'] . " = document.getElementById('close" . $vaka['id'] . "');
                               
                                
                                // When the user clicks on the button, open the modal
                                btn" . $vaka['id'] . ".onclick = function() {
                                    modal" . $vaka['id'] . ".classList.remove('none');
                                    modal" . $vaka['id'] . ".classList.add('block');
                                 

                                span" . $vaka['id'] . ".onclick = function() {
                                    modal" . $vaka['id'] . ".classList.remove('block');
                                    modal" . $vaka['id'] . ".classList.add('none');
                                }
                    
                                
                                window.onclick = function(event) {
                                    if (event.target == modal" . $vaka['id'] . ") {
                                        modal" . $vaka['id'] . ".classList.remove('block');
                                    
                                    }
                                }
                                }
                    
                                
                            </script>";
                                }
                            }
                            ?>


                        </tbody>
                    </table>
                </div>


            </div>
        </div>

        <script>
            $(function() {
                const url = new URL("C:\wamp\www\Hacettepe-e-BYRYS-KKDS\vakalar\1677970467_Biometrik.jpeg")
                console.log("pathh");
                console.log(url);

                const re = new RegExp()
                const file = re.exec(url);
                console.log(file);

                $(document).ready(function() {
                    $('#pdffile').on('change', function() {
                        for (var i = 0; i < $(this).get(0).files.length; ++i) {
                            var file1 = $(this).get(0).files[i].size;
                            if (file1) {
                                var file_size = $(this).get(0).files[i].size;
                                if (file_size > 5000000) {
                                    $('#error-message').html(
                                        "Dosya boyutu maksimum 5 mb olabilir.");
                                    $('#error-message').css("display", "block");
                                    $('#error-message').css("color", "red");
                                    $('#submit').css("display", "none");

                                } else {
                                    $('#error-message').css("display", "none");
                                    $('#submit').css("display", "block");
                                }
                            }
                        }
                    });
                });
                $('#submit').click(function(e) {


                    var valid = this.form.checkValidity();

                    if (valid) {
                        console.log("aaaaaaaaaa");
                        var fup = document.getElementById('pdffile');
                        var fileName = fup.value;
                        var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
                        if (ext == "pdf") {
                            var id = <?php

                                        $userid = $_SESSION['userlogin']['id'];
                                        echo $userid
                                        ?>;
                            var ele = document.getElementsByName('student_group');

                            for (i = 0; i < ele.length; i++) {
                                if (ele[i].checked)
                                    var student_group = ele[i].value;

                            }
                            console.log(student_group);

                            var pdffile = document.getElementById("pdffile").files[0];
                            var uploadData = new FormData();
                            uploadData.append("file", pdffile);
                            uploadData.append("student_group", student_group)
                            // console.log($("#pdffile"));
                            // console.log(pdffile);


                            e.preventDefault()

                            $.ajax({
                                type: 'POST',
                                url: 'vaka-db.php',
                                data: uploadData,



                                success: function(data) {
                                    console.log(data);
                                    console.log(name);
                                    location.reload(true)
                                },
                                error: function(data) {
                                    Swal.fire({
                                        'title': 'Hata',
                                        'text': 'Hata',
                                        'type': 'error'
                                    })
                                },
                                processData: false,
                                contentType: false
                            })

                            return true;
                        } else {
                            alert("Lütfen PDF uzantılı dosya yükleyin");
                            fup.focus();
                            return false;
                        }



                    }
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