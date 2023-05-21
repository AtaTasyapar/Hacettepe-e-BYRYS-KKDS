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

$patient_id = '';
$notlar = '';
$uyaran = '';
$nemlilik = '';
$aktivite = '';
$hareket = '';
$beslenme = '';
$surtunme = '';
$fileid = '';

if (isset($_GET['patient_id'])) {
    $patient_id = $_GET['patient_id'];
    $notlar = $_GET['notlar'];
    $uyaran = $_GET['uyaran'];
    $nemlilik = $_GET['nemlilik'];
    $aktivite = $_GET['aktivite'];
    $hareket = $_GET['hareket'];
    $beslenme = $_GET['beslenme'];
    $surtunme = $_GET['surtunme'];
    $fileid = $_GET['fileid'];
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
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>




</head>

<body style="background-color:white">
    <div class="container-fluid pt-4 px-4">
        <div class="send-patient">
            <div class="patients-table text-center rounded p-4" id="patients-table">

                <div class="d-flex align-items-center flex-column justify-content-between mb-4">
                    <?php
                    require('config-students.php');
                    $sql = "SELECT * FROM  vakalar where id = ?";
                    $smtmselect = $db->prepare($sql);
                    $result = $smtmselect->execute([$fileid]);
                    if ($result) {
                        $vaka = $smtmselect->fetch(PDO::FETCH_ASSOC);
                        $vakapdf = $vaka["filename"];
                        $basePath = $vakapdf;
                        $fileLoc = strpos($basePath, 'vakalar');
                        $filePath = substr($basePath, $fileLoc);
                        if (file_exists($filePath)) {
                            echo "
                            <iframe id='iframepdf' class='iframepdf' runat='server' src=" . $filePath . " title=''></iframe>";
                        }
                    } else {
                        echo 'Hata';
                    }

                    ?>
                    <form>
                        <h1 class="braden-header">Braden Parametreleri</h1>

                        <p class="braden-label">Uyaranın Algılanması</p>

                        <div class="checkbox-wrapper">
                            <div class="checkboxes">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="uyaranradio" id="uyaranradio" value="option1">
                                    <label class="form-check-label" for="uyaranradio">
                                        <span class="checkbox-header"> Skor 1: Tamamen Yetersiz </span>
                                        Ağrılı uyaranlara yanıt vermiyor.
                                        Bilinçsizliğe bağlı olarak vücudunda ağrı odaklarını hissedemiyor.</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="uyaranradio" id="uyaranradio" value="option2">
                                    <label class="form-check-label" for="uyaranradio">
                                        <span class="checkbox-header"> Skor 2: Çok Yetersiz </span>
                                        Yalnız ağrılı uyaranlara yanıt veriyor.
                                        Rahatsızlığını inleme ile belli edebiliyor.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="uyaranradio" id="uyaranradio" value="option3">
                                    <label class="form-check-label" for="uyaranradio">
                                        <span class="checkbox-header"> Skor 3: Biraz Yeterli </span>
                                        Sözlü uyaranlara yanıt veriyor.
                                        Sürekli iletişim kurulamıyor.
                                        Hastanın yatak İçinde çevrilmesi gerekiyor.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="uyaranradio" id="uyaranradio" value="option4">
                                    <label class="form-check-label" for="uyaranradio">
                                        <span class="checkbox-header"> Skor 4: Tamamen Yeterli </span>
                                        Sözlü uyaranlara yanıt veriyor.
                                        Duyu kusuru yok.
                                    </label>
                                </div>
                            </div>
                        </div>
                        <p class="braden-label">Nemlilik</p>

                        <div class="checkbox-wrapper">

                            <div class="checkboxes">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="nemlilikradio" id="nemlilikradio1" value="option1">
                                    <label class="form-check-label" for="nemlilikradio1">
                                        <span class="checkbox-header"> Skor 1: Sürekli Islak </span>
                                        Deri, ter, İdrar, gaita ile sürekli ıslak. Her çevrildiğinde ıslaklık
                                        hissediliyor.
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="nemlilikradio" id="nemlilikradio2" value="option2">
                                    <label class="form-check-label" for="nemlilikradio2">
                                        <span class="checkbox-header"> Skor 2: Çok Islak </span>
                                        Deri çoğu zaman ıslak.
                                        Her vardiyada çarşafların bir kez değiştirilmesi gerekiyor.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="nemlilikradio" id="nemlilikradio3" value="option3">
                                    <label class="form-check-label" for="nemlilikradio3">
                                        <span class="checkbox-header"> Skor 3: Bazen Islak </span>
                                        Deri bazen ıslak.
                                        Çarşafların ıslandıkça değiştirilmesi gerekiyor.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="nemlilikradio" id="nemlilikradio4" value="option4">
                                    <label class="form-check-label" for="nemlilikradio4">
                                        <span class="checkbox-header"> Skor 4: Nadiren Islak</span>
                                        Deri genellikle kuru.
                                        Çarşafların rutin olarak değiştirilmesi gerekiyor
                                    </label>
                                </div>
                            </div>
                        </div>

                        <p class="braden-label">Aktivite</p>

                        <div class="checkbox-wrapper">

                            <div class="checkboxes">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="aktiviteradio" id="aktiviteradio1" value="option1">
                                    <label class="form-check-label" for="aktiviteradio1">
                                        <span class="checkbox-header"> Skor 1: Yatağa Bağımlı </span>
                                        Her türlü bakım gereksinimi yatakta karşılanıyor.
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="aktiviteradio" id="aktiviteradio2" value="option2">
                                    <label class="form-check-label" for="aktiviteradio2">
                                        <span class="checkbox-header"> Skor 2: Sandalyeye Bağımlı </span>
                                        Çok az yürüyebiliyor.
                                        Sandalyeye oturabilmesi için yardım gerekiyor.
                                        Kendi ağırlığını kaldırmakta güçlük çekiyor.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="aktiviteradio" id="aktiviteradio3" value="option3">
                                    <label class="form-check-label" for="aktiviteradio3">
                                        <span class="checkbox-header"> Skor 3: Bazen Yürüyebiliyor </span>
                                        Yardımla veya yardımsız kısa mesafede yürüyebiliyor.
                                        Her vardiyada çoğu zaman yatakta veya sandalyede oturuyor.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="aktiviteradio" id="aktiviteradio4" value="option4">
                                    <label class="form-check-label" for="aktiviteradio4">
                                        <span class="checkbox-header"> Skor 4: Sık Sık Yürüyebiliyor</span>
                                        Günde en az iki defa oda dışına çıkabiliyor.
                                        Oda içinde 2 saatte bir yürüyebiliyor.
                                    </label>
                                </div>
                            </div>
                        </div>


                        <p class="braden-label">Hareket</p>

                        <div class="checkbox-wrapper">

                            <div class="checkboxes">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="hareketradio" id="hareketradio1" value="option1">
                                    <label class="form-check-label" for="hareketradio1">
                                        <span class="checkbox-header"> Skor 1: Tamamen Hareketsiz</span>
                                        Yardımsız pozisyon değiştiremiyor.
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="hareketradio" id="hareketradio2" value="option2">
                                    <label class="form-check-label" for="hareketradio2">
                                        <span class="checkbox-header"> Skor 2: Çok Hareketsiz </span>
                                        Vücut ve ekstremite pozisyonunda hafif değişiklik yapabiliyor.
                                        Kendiliğinden pozisyonunu değiştiremiyor.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="hareketradio" id="hareketradio3" value="option3">
                                    <label class="form-check-label" for="hareketradio3">
                                        <span class="checkbox-header"> Skor 3: Az Hareketli </span>
                                        Vücut ve ekstremitelerinde sık, ancak hafif değişiklik yapabiliyor.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="hareketradio" id="hareketradio4" value="option4">
                                    <label class="form-check-label" for="hareketradio4">
                                        <span class="checkbox-header"> Skor 4: Hareketli</span>
                                        Pozisyonunu yardımsız sıklıkla değiştirebiliyor.
                                    </label>
                                </div>
                            </div>
                        </div>

                        <p class="braden-label">Beslenme</p>

                        <div class="checkbox-wrapper">

                            <div class="checkboxes">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="beslenmeradio" id="beslenmeradio1" value="option1">
                                    <label class="form-check-label" for="beslenmeradio1">
                                        <span class="checkbox-header"> Skor 1: Çok Yetersiz</span>
                                        Asla öğününün tamamını yiyemiyor.
                                        Nadiren verilen yemeğin 1/3'ünü yiyebiliyor.
                                        İki öğün ya da daha az protein alabiliyor (Et ve süt ürünleri).
                                        Sıvı alımı az. Ağızdan sıvı desteği alamıyor.
                                        Beş günden fazla süredir IV ve berrak diyet alıyor.
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="beslenmeradio" id="beslenmeradio2" value="option2">
                                    <label class="form-check-label" for="beslenmeradio2">
                                        <span class="checkbox-header"> Skor 2: Yetersiz </span>
                                        Verilen yemeğin yarısını, nadiren tamamını yiyebiliyor.
                                        Günde 3 defa protein, bazen destekleyici ek gıda alabiliyor.
                                        Uygun diyetin tüp ile verilen besinin birazını alabiliyor.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="beslenmeradio" id="beslenmeradio3" value="option3">
                                    <label class="form-check-label" for="beslenmeradio3">
                                        <span class="checkbox-header"> Skor 3: Yeterli</span>
                                        Öğünün yarısından fazlasını yiyebiliyor.
                                        Günde 4 kez protein alabiliyor.
                                        Ara sıra öğünü reddediyor.
                                        Verilmişse ek diyet ya da total parenteral beslenme alıyor </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="beslenmeradio" id="beslenmeradio4" value="option4">
                                    <label class="form-check-label" for="beslenmeradio4">
                                        <span class="checkbox-header"> Skor 4: Çok İyi</span>
                                        Her öğünü çoğunlukla yiyor, öğünleri reddetmiyor.
                                        Günde 4 defa protein alabiliyor.
                                        Genellikle öğün aralarında yiyor.
                                        Ek gıda gerekmiyor. </label>
                                </div>
                            </div>
                        </div>

                        <p class="braden-label">Sürtünme Ve Tahriş</p>

                        <div class="checkbox-wrapper">

                            <div class="checkboxes">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="surtunmeradio" id="surtunmeradio1" value="option1">
                                    <label class="form-check-label" for="surtunmeradio1">
                                        <span class="checkbox-header"> Skor 1: Sorun </span>
                                        Hareket ederken çok fazla yardıma gereksinimi var.
                                        Çarşafta kaydırmaksızın tamamen kaldırılması olanaksız.
                                        Sıklıkla sandalyeden ya da yataktan aşağı kayıyor.
                                        Yeniden pozisyon vermede çok fazla yardıma gereksinimi var.
                                        Sertlik, kontraktür ya da huzursuzluk sürekli sürtünmeye yol açabiliyor.
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="surtunmeradio" id="surtunmeradio2" value="option2">
                                    <label class="form-check-label" for="surtunmeradio2">
                                        <span class="checkbox-header"> Skor 2: Olası Sorun </span>
                                        Çok az yardımla az ve güçsüz hareket yapabiliyor.
                                        Hareket sırasında deri, çarşafa sandalyeye ya da diğer malzemelere sürtünüyor.
                                        Genellikle yatak ve sandalyede pozisyonunu sürdürüyor, fakat bazen kayıyor.
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="surtunmeradio" id="surtunmeradio3" value="option3">
                                    <label class="form-check-label" for="surtunmeradio3">
                                        <span class="checkbox-header"> Skor 3: Sorun Yok</span>
                                        Yatak ve sandalyede bağımsız hareket edebiliyor.
                                        Kendini kaldırabilmek için, yeterli kas gücü var.
                                        Yatak ya da sandalyede her zaman uygun pozisyonda duruyor. </label>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="form-control m-auto" name="update" id="update" value="Güncelle">
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        var patient_id = "<?php echo $_GET['patient_id'] ?>";
        var notlar = "<?php echo $_GET['notlar'] ?>";
        var uyaran = "<?php echo $_GET['uyaran'] ?>";
        var nemlilik = "<?php echo $_GET['nemlilik'] ?>";
        var aktivite = "<?php echo $_GET['aktivite'] ?>";
        var hareket = "<?php echo $_GET['hareket'] ?>";
        var beslenme = "<?php echo $_GET['beslenme'] ?>";
        var surtunme = "<?php echo $_GET['surtunme'] ?>";
        var fileid = "<?php echo $_GET['fileid'] ?>";
        $('input[name=uyaranradio]').each(function() {
            if ($(this).val() == uyaran) {
                $(this).prop('checked', true);
            }
        });
        $('input[name=nemlilikradio]').each(function() {
            if ($(this).val() == nemlilik) {
                $(this).prop('checked', true);
            }
        });
        $('input[name=aktiviteradio]').each(function() {
            if ($(this).val() == aktivite) {
                $(this).prop('checked', true);
            }
        });
        $('input[name=hareketradio]').each(function() {
            if ($(this).val() == hareket) {
                $(this).prop('checked', true);
            }
        });
        $('input[name=beslenmeradio]').each(function() {
            if ($(this).val() == beslenme) {
                $(this).prop('checked', true);
            }
        });
        $('input[name=surtunmeradio]').each(function() {
            if ($(this).val() == surtunme) {
                $(this).prop('checked', true);
            }
        });



        $('#update').click(function(e) {
            e.preventDefault();
            let id = <?php

                        $userid = $_SESSION['userlogin']['id'];
                        echo $userid
                        ?>;
            let uyaran = $('input[name=uyaranradio]:checked').val();
            let nemlilik = $('input[name=nemlilikradio]:checked').val();
            let aktivite = $('input[name=aktiviteradio]:checked').val();
            let hareket = $('input[name=hareketradio]:checked').val();
            let beslenme = $('input[name=beslenmeradio]:checked').val();
            let surtunme = $('input[name=surtunmeradio]:checked').val();
            let patient_id = "<?php echo $_GET['patient_id'] ?>";

            $.ajax({
                type: 'POST',
                url: 'formUpdate.php',
                data: {
                    patient_id: patient_id,
                    uyaran: uyaran,
                    nemlilik: nemlilik,
                    aktivite: aktivite,
                    hareket: hareket,
                    beslenme: beslenme,
                    surtunme: surtunme
                },
                success: function(data) {
                    alert(data);
                    location.reload()
                },
                error: function(data) {
                    Swal.fire({
                        'title': 'Hata',
                        'text': 'Hata',
                        'type': 'error'
                    })
                }
            })

        });
    </script>

    </script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Template Javascript -->
    <script src="main.js"></script>
</body>

</html>
