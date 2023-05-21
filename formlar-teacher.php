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

        $sql = "SELECT * FROM  patients";
        $smtmselect = $db->prepare($sql);
        $result = $smtmselect->execute();
        if ($result) {
            $patients = $smtmselect->fetchAll(PDO::FETCH_ASSOC);
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


            <div class="patients-table dark-blue text-center rounded p-4" id="patients-table">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0 darkcyan table-title">Öğrenciler</h6>

                </div>

                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class=" darkcyan table-head">

                                <th scope="col">İsim</th>
                                <th scope="col">Soyisim</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Hastalar</th>
                                <th scope="col">Detay</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($values as &$value) {
                                if ($value['student_group'] == "kontrol") {
                                    $grup = "Kontrol";
                                };
                                if ($value['student_group'] == "mudahale") {
                                    $grup = "Müdahale";
                                };
                                if ($value['student_group'] == NULL) {
                                    $grup = "Grup Yok";
                                }
                                echo "
                                <tr>
                                   
                                    <td class='
                                    color: black; font-size: 18px;'>" . $value["name"] . "</td>
                                    <td style='
                                    color: black; font-size: 18px;'>" . $value["surname"] . "</td>
                                    <td style='
                                    color: black; font-size: 18px;'>" . $value["email"] . "</td>
                                    <td class='
                                    grup-button-wrapper'> " . $grup . "  <button type='button' id = 'group" . $value['id'] . "' class='grup-button btn btn-success'>Öğrenci Grubu Değiştir</button></td>
                           

                                    <div id='groupModal" . $value['id'] . "' class='modal none'>

                                    <!-- Modal content -->
                                        <div class='modal-content' id='group-modal-content" . $value['id'] . "'>
                                            <span class='close" . $value['id'] . " closeBtn' id='close" . $value['id'] . "'>&times;</span>
                                            <p>Öğrenci Adı: " . $value['name'] . "</p>
                                            <p>Öğrenci Soyadı: " . $value['surname'] . "</p>
                                            <p>Öğrenci Maili: " . $value['email'] . "</p>
                                            <div class='form-input py-2'>
                                            
                                            <div class='checkbox-wrapper'>
                                                <div class='checkboxes'>
                                                    <div class='form-check'>
                                                        <input class='form-check-input' type='radio' name='student_group'
                                                            id='student_group' value='kontrol'>
                                                        <label class='form-check-label' for='student_group'>
                                                            <span class='checkbox-header'> Kontrol Grubu</span>
                                                        </label>
                                                    </div>
                                                    <div class='form-check'>
                                                        <input class='form-check-input' type='radio' name='student_group'
                                                            id='student_group' value='mudahale'>
                                                        <label class='form-check-label' for='student_group'>
                                                            <span class='checkbox-header'> Müdahale Grubu </span>
                
                                                        </label>
                                                    </div>
                
                                                </div>
                                            </div>
                                            <div class='form-group'>
                                <input type='submit' id='submit" . $value['id'] . "' class='form-control butunluknot submit pdf-upload-btn'
                                    name='submit' value='Kaydet'>
                            </div>
                                        </div>
                                    </div>

                                    <td style='
                                    color: black; font-size: 18px;
                                    '> <button type='button' id = '" . $value['id'] . "' class='btn btn-success'>Detay</button> </td>
                                    
                                    <div id='myModal" . $value['id'] . "' class='modal none'>

                                    <!-- Modal content -->
                                        <div class='modal-content' id='modal-content" . $value['id'] . "'>
                                            <span class='close" . $value['id'] . " closeBtn' id='close" . $value['id'] . "'>&times;</span>
                                            <p>Öğrenci Adı: " . $value['name'] . "</p>
                                            <p>Öğrenci Soyadı: " . $value['surname'] . "</p>
                                            <p>Öğrenci Maili: " . $value['email'] . "</p>
                                            ";
                                foreach ($patients as &$patient) {
                                    $stuid = $patient['id'];
                                    if ($value['id'] == $stuid) {
                                        require('patient-info-teacher.php');
                                        //  require('patient-info-teacher.php');
                                    } else {
                                    }
                                }
                                echo "
                                        </div>
                                    </div>
                                </tr>
                                
                             
                                
                                    
                                
                                <script>
                            var modal" . $value['id'] . " = document.getElementById('myModal" . $value['id'] . "');

                                // Get the button that opens the modal
                                var btn" . $value['id'] . " = document.getElementById('" . $value['id'] . "');
                        
                                // Get the <span> element that closes the modal
                                var span" . $value['id'] . " = document.getElementById('close" . $value['id'] . "');
                               
                                
                                // When the user clicks on the button, open the modal
                                btn" . $value['id'] . ".onclick = function() {
                                    modal" . $value['id'] . ".classList.remove('none');
                                    modal" . $value['id'] . ".classList.add('block');
                                 

                                span" . $value['id'] . ".onclick = function() {
                                    modal" . $value['id'] . ".classList.remove('block');
                                    modal" . $value['id'] . ".classList.add('none');
                                }
                    
                                
                                window.onclick = function(event) {
                                    if (event.target == modal" . $value['id'] . ") {
                                        modal" . $value['id'] . ".classList.remove('block');
                                    
                                    }
                                }
                                }
                    

                                var groupModal" . $value['id'] . " = document.getElementById('groupModal" . $value['id'] . "');

                                // Get the button that opens the modal
                                var groupbtn" . $value['id'] . " = document.getElementById('group" . $value['id'] . "');
                        
                                // Get the <span> element that closes the modal
                                var span" . $value['id'] . " = document.getElementById('close" . $value['id'] . "');
                               
                                
                                // When the user clicks on the button, open the modal
                                groupbtn" . $value['id'] . ".onclick = function() {
                                    groupModal" . $value['id'] . ".classList.remove('none');
                                    groupModal" . $value['id'] . ".classList.add('block');
                                 

                                span" . $value['id'] . ".onclick = function() {
                                    groupModal" . $value['id'] . ".classList.remove('block');
                                    groupModal" . $value['id'] . ".classList.add('none');
                                }
                    
                                
                                window.onclick = function(event) {
                                    if (event.target == groupModal" . $value['id'] . ") {
                                        groupModal" . $value['id'] . ".classList.remove('block');
                                    
                                    }
                                }
                                }
                                

                                $(function() {
                                    $('#submit" . $value['id'] . "').click(function(e) {
                    
                    
                    
                                        
                                            var ele = document.getElementsByName('student_group');

                                            for (i = 0; i < ele.length; i++) {
                                                if (ele[i].checked)
                                                    var student_group = ele[i].value;
                    
                                            }
                                            console.log(student_group);
                                            var id = " . $value['id'] . ";
                                           
                    
                    
                                            e.preventDefault()
                    
                                            $.ajax({
                                                type: 'POST',
                                                url: 'groupUpdate.php',
                                                data: {
                                                    id: id,
                                                    student_group: student_group,           
                                                },
                                                success: function(data) {
                                                    alert('Başarılı');
                                                    location.reload(true)
                                                },
                                                error: function(data) {
                                                    Swal.fire({
                                                        'title': 'Hata',
                                                        'text': 'Hata',
                                                        'type': 'error'
                                                    })
                                                }
                                            })
                    
                    
                    
                                        
                                    })
                    
                                });
                            </script>
                            ";
                            }
                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            $(function() {
                $('#submit').click(function(e) {


                    var valid = this.form.checkValidity();

                    if (valid) {
                        var id = <?php

                                    $userid = $_SESSION['userlogin']['id'];
                                    echo $userid
                                    ?>;
                        var name = $('#name').val();
                        var surname = $('#surname').val();
                        var age = $('#age').val();
                        var not = $('#not').val();


                        e.preventDefault()

                        $.ajax({
                            type: 'POST',
                            url: 'student-patient.php',
                            data: {
                                id: id,
                                name: name,
                                surname: surname,
                                age: age,
                                not: not

                            },
                            success: function(data) {
                                alert("Başarılı");
                                location.reload(true)
                            },
                            error: function(data) {
                                Swal.fire({
                                    'title': 'Hata',
                                    'text': 'Hata',
                                    'type': 'error'
                                })
                            }
                        })



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