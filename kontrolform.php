<?php
session_start();
$base_url = 'http://' . $_SERVER['HTTP_HOST'] . '/Hacettepe-KDSE-BPYS';
if (!isset($_SESSION['ebyrysUserLogin'])) {
    header("Location: login-student.php");
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION);
    header("Location: main.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>KDSE-BPYS</title>
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
    <!-- Customized Bootstrap Stylesheet -->
    <link href="../bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Template Stylesheet -->
    <link href="../style.css" rel="stylesheet">
    <style>
    table {
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid black;
        padding: 10px;
    }

    th {
        background-color: #eee;
    }

    h1 {
        text-align: center;
    }

    tr,
    td {
        width: 200px;
    }
    </style>

<body>
    <div class="container-fluid pt-4 px-4">
        <div class="send-patient">
            <span class='close closeBtn' id='closeBtn1'>&times;</span>
            <h1 class="form-header">Bakım Planı</h1>
            <div class="input-section-item">
                <div class="patients-save">
                    <form action="" method="POST" class="patients-save-fields">
                        <div class="input-section d-flex">
                            <p class="usernamelabel">Sorunla İlişkili Veriler:</p>
                            <input type="text" class="form-control" required name="problem_info" id="diger"
                                placeholder="Sorunla İlişkili Veriler" maxlength="5000">
                        </div>
                        <div class="input-section d-flex">
                            <p class="usernamelabel">Hemşirelik Tanıları:</p>
                            <input type="text" class="form-control" required name="nurse_description" id="diger"
                                placeholder="Hemşirelik Tanıları" maxlength="5000">
                        </div>
                        <div class="input-section d-flex">
                            <p class="usernamelabel">NOC Çıktıları:</p>
                            <input type="text" class="form-control" required name="noc_output" id="diger"
                                placeholder="NOC Çıktıları" maxlength="200">
                        </div>
                        <div class="input-section d-flex">
                            <p class="usernamelabel">NOC Gösterge:</p>
                            <input type="text" class="form-control" required name="noc_indicator" id="diger"
                                placeholder="NOC Gösterge" maxlength="200">
                        </div>
                        <div class="input-section d-flex">
                            <p class="usernamelabel">Hemşirelik Girişimleri:</p>
                            <input type="text" class="form-control" required name="nurse_attempt" id="diger"
                                placeholder="Hemşirelik Girişimleri" maxlength="200">
                        </div>
                        <div class="input-section d-flex">
                            <p class="usernamelabel">Değerlendirme:</p>
                            <input type="text" class="form-control" required name="evaluation" id="diger"
                                placeholder="Değerlendirme" maxlength="200">
                        </div>
                        <input type="submit" class="form-control submit" name="submit" id="submit" value="Kaydet">
                    </form>
                </div>
            </div>
        </div>


    </div>
    <script>
    $(function() {
        $('#closeBtn1').click(function(e) {
            let patient_id = <?php
                                    $userid = $_GET['patient_id'];
                                    echo $userid
                                    ?>;
            let patient_name = "<?php
                                    echo urldecode($_GET['patient_name']);
                                    ?>";
            var url = "<?php echo $base_url; ?>/updateForms/showAllForms.php?patient_id=" + patient_id +
                "&patient_name=" + encodeURIComponent(patient_name);
            $("#content").load(url);

        })
    });
    </script>
    <script>
    $(function() {
        $('#submit').click(function(e) {
            e.preventDefault()
            console.log("clicked")
            var valid = this.form.checkValidity();

            if (valid) {
                var id = <?php
                                $userid = $_SESSION['ebyrysUserLogin']['id'];
                                echo $userid
                                ?>;
                var name = $('#name').val();
                var surname = $('#surname').val();
                var age = $('#age').val();
                var not = $('#not').val();
                let form_num = 15;
                var patient_id = <?php
                                        $userid = $_GET['patient_id'];
                                        echo $userid
                                        ?>;
                let patient_name = "<?php
                                        echo urldecode($_GET['patient_name']);
                                        ?>";
                let yourDate = new Date();
                let creationDate = yourDate.toISOString().split('T')[0];
                let updateDate = yourDate.toISOString().split('T')[0];
                let problem_info = $("input[name='problem_info']").val();
                let nurse_description = $("input[name='nurse_description']").val();
                let noc_output = $("input[name='noc_output']").val();
                let noc_indicator = $("input[name='noc_indicator']").val();
                let nurse_attempt = $("input[name='nurse_attempt']").val();
                let evaluation = $("input[name='evaluation']").val();
                console.log("values initiated")

                $.ajax({
                    type: 'POST',
                    url: '<?php echo $base_url; ?>/submitOrUpdateBakimPlani_form14.php',
                    data: {
                        id: id,
                        name: name,
                        surname: surname,
                        age: age,
                        not: not,
                        form_num: form_num,
                        patient_id: patient_id,
                        patient_name: patient_name,
                        creation_date: creationDate,
                        update_date: updateDate,
                        problem_info: problem_info,
                        nurse_description: nurse_description,
                        noc_output: noc_output,
                        noc_indicator: noc_indicator,
                        nurse_attempt: nurse_attempt,
                        evaluation: evaluation
                    },
                    success: function(data) {
                        alert(data);
                        let url =
                            "<?php echo $base_url; ?>/updateForms/showAllForms.php?patient_id=" +
                            patient_id + "&patient_name=" + encodeURIComponent(
                                patient_name);
                        $("#content").load(url);
                    },
                    error: function(data) {
                        console.log(data)
                    }
                })



            }
        })

    });
    </script>
    <script src=""></script>
</body>

</html>