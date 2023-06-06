<?php
session_start();
$base_url = 'http://' . $_SERVER['HTTP_HOST'] . '/Hacettepe-KDSE-BPYS';
if (!isset($_SESSION['userlogin'])) {
    header("Location: login-student.php");
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION);
    header("Location: main.php");
}

// $tanı_respiratory_rate = $_GET['tanı_respiratory_rate'];
// $tanı_heart_rate = $_GET['tanı_heart_rate'];
// $tanı_spo2_percentage = $_GET['tanı_spo2_percentage'];
// $tanı_o2_status = $_GET['tanı_o2_status'];
// $tanı_respiratory_nature = $_GET['tanı_respiratory_nature'];
$BKI = isset($_GET['BKI']) ? $_GET['BKI'] : "NaN";
$permitted_food_consumption = isset($_GET['permitted_food_consumption']) ? $_GET['permitted_food_consumption'] : "NaN";
$sleeping_problem = isset($_GET['sleeping_problem']) ? $_GET['sleeping_problem'] : "NaN";
$exercise_habit = isset($_GET['exercise_habit']) ? $_GET['exercise_habit'] : "NaN";
$family_history = isset($_GET['family_history']) ? $_GET['family_history'] : 'NaN';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>KDSE-BPYS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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
                            <p class="usernamelabel">Hemşirelik Tanıları:</p>
                            <p class="tanıdescription">Fazla kilo </p>
                        </div>
                        <div class="input-section d-flex">
                            <p class="usernamelabel">NOC Çıktıları:</p>
                            <p class="tanıdescription">Hastanın günlük olarak izin verilen besinleri tüketmesi </p>
                        </div>






                        <div class="input-section" id="o2-delivery-container">
                            <p class="usernamelabel">NOC Gösterge: </p>
                            <div class="form-check">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" required name="noc_indicator"
                                        id="noc_indicator"
                                        value="1: Hastanın sürekli izin verilenden daha fazla besin tüketimi var">
                                    <label class="form-check-label" for="noc_indicator">
                                        <span class="checkbox-header">1: Hastanın sürekli izin verilenden daha fazla
                                            besin tüketimi var</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" required name="noc_indicator"
                                        id="noc_indicator"
                                        value="2: Hastanın sık sık izin verilenden daha fazla besin tüketimi var">
                                    <label class="form-check-label" for="noc_indicator">
                                        <span class="checkbox-header">2: Hastanın sık sık izin verilenden daha fazla
                                            besin tüketimi var</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" required name="noc_indicator"
                                        id="noc_indicator"
                                        value="3: Hastanın bazen izin verilenden daha fazla besin tüketimi var">
                                    <label class="form-check-label" for="noc_indicator">
                                        <span class="checkbox-header">3: Hastanın bazen izin verilenden daha fazla besin
                                            tüketimi var</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" required name="noc_indicator"
                                        id="noc_indicator"
                                        value="4: Hastanın nadiren izin verilenden daha fazla besin tüketimi var ">
                                    <label class="form-check-label" for="noc_indicator">
                                        <span class="checkbox-header">4: Hastanın nadiren izin verilenden daha fazla
                                            besin tüketimi var </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" required name="noc_indicator" id="
                                        noc_indicator"
                                        value="5: Hasta günlük olarak izin verilen besinlerin tamamını tüketir">
                                    <label class="form-check-label" for="noc_indicator">
                                        <span class="checkbox-header">5: Hasta günlük olarak izin verilen besinlerin
                                            tamamını tüketir
                                        </span>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="input-section d-flex" style="flex-direction: column;">
                            <p class="usernamelabel">Hemşirelik Girişimleri:</p>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="nurse_attempt" id="nurse_attempt1"
                                    value="Hastanın ne zaman, nerede, ne yediği ile ilgili bir günlük tutması için teşvik edilir ve geçerli yeme kalıpları tanımlanır   ">
                                <label class="form-check-label" for="nurse_attempt">
                                    <span class="checkbox-header">Hastanın ne zaman, nerede, ne yediği ile ilgili bir
                                        günlük tutması için teşvik edilir ve geçerli yeme kalıpları tanımlanır</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="nurse_attempt" id="nurse_attempt2"
                                    value="Kaydedilmiş besin içerikleri ve kalori alımı izlenir">
                                <label class="form-check-label" for="nurse_attempt">
                                    <span class="checkbox-header">Kaydedilmiş besin içerikleri ve kalori alımı
                                        izlenir</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="nurse_attempt" id="nurse_attempt3"
                                    value="Hasta ile beraber verilmesi istenen kilo belirlenir">
                                <label class="form-check-label" for="nurse_attempt">
                                    <span class="checkbox-header">HHasta ile beraber verilmesi istenen kilo
                                        belirlenir</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="nurse_attempt" id="nurse_attempt4"
                                    value="Kilo vermek için haftalık bir hedef belirlenir">
                                <label class="form-check-label" for="nurse_attempt">
                                    <span class="checkbox-header">Kilo vermek için haftalık bir hedef belirlenir</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="nurse_attempt" id="nurse_attempt5"
                                    value="Haftalık kilo takibi yapılır">
                                <label class="form-check-label" for="nurse_attempt">
                                    <span class="checkbox-header">Haftalık kilo takibi yapılır</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="nurse_attempt" id="nurse_attempt6"
                                    value="Tolere edebileceği ölçüde düzenli egzersiz yapması konusunda hasta teşvik edilir">
                                <label class="form-check-label" for="nurse_attempt">
                                    <span class="checkbox-header">Tolere edebileceği ölçüde düzenli egzersiz yapması
                                        konusunda hasta teşvik edilir</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="nurse_attempt" id="nurse_attempt7"
                                    value="Hastayla güvene dayalı, destekleyici bir ilişki kurulur">
                                <label class="form-check-label" for="nurse_attempt">
                                    <span class="checkbox-header">Hastayla güvene dayalı, destekleyici bir ilişki
                                        kurulur</span>
                                </label>
                            </div>







                            <p class="usernamelabel">Eğitim:</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="nurse_attempt8"
                                    id="nurse_attempt8"
                                    value="Dengeli beslenmek için beslenme ilkeleri ve besin pramitleri hakkında bilgi verilir">
                                <label class="form-check-label" for="nurse_attempt">
                                    <span class="checkbox-header">Dengeli beslenmek için beslenme ilkeleri ve besin
                                        pramitleri hakkında bilgi verilir </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="nurse_attempt9"
                                    id="nurse_attempt9"
                                    value="Kompleks karbonhidratlar ve proteinlerden oluşan bir diyet izlemesi ve basit şekerler, fast food, kafein ve yumuşak içeceklerden kaçınması gerektiği anlatılır">
                                <label class="form-check-label" for="nurse_attempt">
                                    <span class="checkbox-header">Kompleks karbonhidratlar ve proteinlerden oluşan bir
                                        diyet izlemesi ve basit şekerler, fast food, kafein ve yumuşak içeceklerden
                                        kaçınması gerektiği anlatılır</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="nurse_attempt10"
                                    id="nurse_attempt10"
                                    value="Besin tüketimini arttırabileceği için, hastaya okuma, tv izleme gibi aktivitelerle birlikte yemek yememesi konusunda bilgi verilir">
                                <label class="form-check-label" for="nurse_attempt">
                                    <span class="checkbox-header">Besin tüketimini arttırabileceği için, hastaya okuma,
                                        tv izleme gibi aktivitelerle birlikte yemek yememesi konusunda bilgi
                                        verilir</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="nurse_attempt11"
                                    id="nurse_attempt11"
                                    value="Hastaya ve bakım verenlerine alkol tüketiminin gıda emilimi üzerine etkisi hakkında bilgi verilir">
                                <label class="form-check-label" for="nurse_attempt">
                                    <span class="checkbox-header">Hastaya ve bakım verenlerine alkol tüketiminin gıda
                                        emilimi üzerine etkisi hakkında bilgi verilir</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="nurse_attempt12"
                                    id="nurse_attempt12"
                                    value="Hastaya ve bakım verenlerine obezite ya da yeme bozukluğuyla ilişkili olabilecek fiziksel problemler hakkında bilgi verilir">
                                <label class="form-check-label" for="nurse_attempt">
                                    <span class="checkbox-header">Hastaya ve bakım verenlerine obezite ya da yeme
                                        bozukluğuyla ilişkili olabilecek fiziksel problemler hakkında bilgi
                                        verilir</span>
                                </label>
                            </div>

                            <p class="usernamelabel">İŞ BİRLİĞİ GEREKTİREN UYGULAMALAR</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="nurse_attempt13"
                                    id="nurse_attempt13"
                                    value="Beslenme ihtiyaçlarını karşılamak için gerekli kalori sayısı ve besin tipleri diyetisyenle birlikte belirlenir">
                                <label class="form-check-label" for="nurse_attempt">
                                    <span class="checkbox-header">Beslenme ihtiyaçlarını karşılamak için gerekli kalori
                                        sayısı ve besin tipleri diyetisyenle birlikte belirlenir</span>
                                </label>
                            </div>
                        </div>







                        <div class="input-section d-flex justify-content-between align-items-start"
                            id="o2-delivery-container">
                            <div class="input-section d-flex ">
                                <p class="usernamelabel">Değerlendirme:</p>
                                <div class="input-section d-flex">
                                    <p class="usernamelabel">NOC Çıktıları:</p>
                                    <p class="tanıdescription">Hastanın günlük olarak izin verilen besinleri tüketmesi
                                    </p>
                                </div>
                                <div>
                                    <p class="usernamelabel">NOC Gösterge: </p>
                                </div>
                                <div class="form-check">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="noc_indicator_after"
                                            id="noc_indicator"
                                            value="1: Hastanın sürekli izin verilenden daha fazla besin tüketimi var">
                                        <label class="form-check-label" for="noc_indicator">
                                            <span class="checkbox-header">1: Hastanın sürekli izin verilenden daha fazla
                                                besin tüketimi var</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="noc_indicator_after"
                                            id="noc_indicator"
                                            value="2: Hastanın sık sık izin verilenden daha fazla besin tüketimi var">
                                        <label class="form-check-label" for="noc_indicator">
                                            <span class="checkbox-header">2: Hastanın sık sık izin verilenden daha fazla
                                                besin tüketimi var</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="noc_indicator_after"
                                            id="noc_indicator"
                                            value="3: Hastanın bazen izin verilenden daha fazla besin tüketimi var">
                                        <label class="form-check-label" for="noc_indicator">
                                            <span class="checkbox-header">3: Hastanın bazen izin verilenden daha fazla
                                                besin tüketimi var</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="noc_indicator_after"
                                            id="noc_indicator"
                                            value="4: Hastanın nadiren izin verilenden daha fazla besin tüketimi var ">
                                        <label class="form-check-label" for="noc_indicator">
                                            <span class="checkbox-header">4: Hastanın nadiren izin verilenden daha fazla
                                                besin tüketimi var </span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" required name="noc_indicator_after"
                                            id="
                                        noc_indicator"
                                            value="5: Hasta günlük olarak izin verilen besinlerin tamamını tüketir">
                                        <label class="form-check-label" for="noc_indicator">
                                            <span class="checkbox-header">5: Hasta günlük olarak izin verilen besinlerin
                                                tamamını tüketir
                                            </span>
                                        </label>
                                    </div>

                                </div>


                            </div>
                            <p class="tanıdescription"> Sorun devam ediyor: 1-4 gösterge seçildiyse; yeni günde bakım
                                planında tanımlı tanı olacak.</p>
                            <p class="tanıdescription"> Sorun çözümlendi:
                                5 gösterge seçildiyse; yeni günde bakım planına bu tanıyı taşımayacak
                            </p>

                        </div>
                        <input type="submit" class="form-control submit" name="submit" id="submit" value="Kaydet">

                    </form>
                </div>
            </div>
        </div>


    </div>
    <script>
    var BKI = document.getElementById('BKI').innerText;
    var permitted_food_consumption = document.getElementById('permitted_food_consumption').innerText;
    var sleeping_problem = document.getElementById('sleeping_problem').innerText;
    var exercise_habit = document.getElementById('exercise_habit').innerText;
    var family_history = document.getElementById('family_history').innerText;

    var matchedfields_string = BKI + " / " + permitted_food_consumption + " / " + sleeping_problem + " / " +
        exercise_habit + "/" + family_history;
    </script>

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
            console.log("submit clicked")
            var id = <?php
                            $userid = $_SESSION['userlogin']['id'];
                            echo $userid
                            ?>;
            var name = $('#name').val();
            var surname = $('#surname').val();
            var age = $('#age').val();
            var not = $('#not').val();
            let form_num = 15;
            var patient_id = <?php
                                    $userid = isset($_GET['patient_id']) ? $_GET['patient_id'] : 20;
                                    echo $userid
                                    ?>;
            $userid = $_GET['patient_id'];

            let patient_name = "<?php
                                    echo urldecode(isset($_GET['patient_name']) ? $_GET['patient_name'] : "test");
                                    ?>";

            let yourDate = new Date();
            let creationDate = yourDate.toISOString().split('T')[0];
            let updateDate = yourDate.toISOString().split('T')[0];
            let problem_info = matchedfields_string
            let nurse_description = "Gaz değişiminde bozulma"
            let noc_output = "Hastanın oksijen satürasyonun %95’in üzerinde olması"
            let noc_indicator = $("input[type='radio'][name='noc_indicator']:checked").val();
            let noc_indicator_after = $("input[type='radio'][name='noc_indicator_after']:checked")
                .val();
            let evaluation = "";
            console.log("values init")

            if (noc_indicator == "5: Hastanın oksijen satürasyonunda bozulma yok") {
                evaluation +=
                    "Sorun çözümlendi:5 gösterge seçildiyse;yeni günde bakım planına bu tanıyı taşımayacak"
            } else {
                evaluation +=
                    "Sorun devam ediyor: 1-4 gösterge seçildiyse; yeni günde bakım planında tanımlı tanı olacak."
            }
            let nurse_attempt = "";
            let nurse_education = '';
            let collaborative_applications = '';

            var l1 = document.getElementById("nurse_attempt1");
            var l2 = document.getElementById("nurse_attempt2");
            var l3 = document.getElementById("nurse_attempt3");
            var l4 = document.getElementById("nurse_attempt4");
            var l5 = document.getElementById("nurse_attempt5");
            var l6 = document.getElementById("nurse_attempt6");
            var l7 = document.getElementById("nurse_attempt7");
            var l8 = document.getElementById("nurse_attempt8");
            var l9 = document.getElementById("nurse_attempt9");
            var l10 = document.getElementById("nurse_attempt10");
            var l11 = document.getElementById("nurse_attempt11");
            var l12 = document.getElementById("nurse_attempt12");
            var l13 = document.getElementById("nurse_attempt13");
            if (l1.checked == true) {
                var pl1 = document.getElementById("nurse_attempt1").value;
                nurse_attempt += pl1 + "/";
            }
            if (l2.checked == true) {
                var pl2 = document.getElementById("nurse_attempt2").value;
                nurse_attempt += pl2 + "/";
            }
            if (l3.checked == true) {
                var pl3 = document.getElementById("nurse_attempt3").value;
                nurse_attempt += pl3 + "/";
            }
            if (l4.checked == true) {
                var pl4 = document.getElementById("nurse_attempt4").value;
                nurse_attempt += pl4 + "/";
            }
            if (l5.checked == true) {
                var pl5 = document.getElementById("nurse_attempt5").value;
                nurse_attempt += pl5 + "/";
            }
            if (l6.checked == true) {
                var pl6 = document.getElementById("nurse_attempt6").value;
                nurse_attempt += pl6 + "/";
            }
            if (l7.checked == true) {
                var pl7 = document.getElementById("nurse_attempt7").value;
                nurse_attempt += pl7 + "/";
            }
            if (l8.checked == true) {
                var pl8 = document.getElementById("nurse_attempt8").value;
                nurse_education += pl8 + "/";
            }
            if (l9.checked == true) {
                var pl9 = document.getElementById("nurse_attempt9").value;
                nurse_education += pl9 + "/";
            }
            if (l10.checked == true) {
                var pl10 = document.getElementById("nurse_attempt10").value;
                nurse_education += pl10 + "/";
            }
            if (l11.checked == true) {
                var pl11 = document.getElementById("nurse_attempt11").value;
                nurse_education += pl11 + "/";
            }
            if (l12.checked == true) {
                var pl12 = document.getElementById("nurse_attempt12").value;
                nurse_education += pl12 + "/";
            }
            if (l13.checked == true) {
                var pl13 = document.getElementById("nurse_attempt13").value;
                collaborative_applications += pl13 + "/";
            }

            $.ajax({
                type: 'POST',
                url: '<?php echo $base_url; ?>/insertTanalar/tani13Insert.php',
                data: {
                    name: name,
                    surname: surname,
                    age: age,
                    form_num: form_num,
                    patient_id: patient_id,
                    patient_name: patient_name,
                    creation_date: creationDate,
                    update_date: updateDate,
                    problem_info: problem_info,
                    nurse_description: nurse_description,
                    noc_output: noc_output,
                    noc_indicator: noc_indicator,
                    noc_indicator_after: noc_indicator_after,
                    nurse_attempt: nurse_attempt,
                    nurse_education: nurse_education,
                    collaborative_applications: collaborative_applications,
                    evaluation: evaluation,
                    matchedfields_string: matchedfields_string,
                },
                success: function(data) {
                    console.log("something happened")
                    alert(data);
                    let url =
                        "<?php echo $base_url; ?>/taniReview/tani13Review.php?patient_id=" +
                        patient_id + "&patient_name=" + encodeURIComponent(
                            patient_name);
                    $("#content").load(url);
                },
                error: function(data) {
                    console.log(data)
                }
            });
        })
    });
    </script>

</body>

</html>