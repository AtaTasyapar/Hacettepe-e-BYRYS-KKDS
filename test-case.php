<?php
session_start();
if (!isset($_SESSION['userlogin'])) {
    header('Location: index.php');
}


require_once('./config-students.php');
$task_id = $_GET['task_id'];
$sql = 'SELECT * FROM task WHERE task_name = "testCase"';
$stmt = $db->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($rows) {
    $lastTask = $rows[count($rows) - 1];
    $sql = 'SELECT * FROM uploads WHERE file_name = :assoc_file';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':assoc_file', $lastTask["assoc_file"], PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($rows) {
        $testcase = $rows[count($rows) - 1];
        $base64String = $testcase['base64'];
    } else {
        echo 'No matching uploads found.';
    }
}
    $student_id = $_SESSION['userlogin']['id'];
    $type = $_SESSION['userlogin']['type'];
    if($type === 'student'){
        $sql = 'SELECT * FROM students WHERE id = :id';
    }else{
        $sql = 'SELECT * FROM teachers WHERE id = :id';
    }
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $student_id);
    $result = $stmt->execute();
    if($result){
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        $student_name = $student['name'] . ' ' . $student['surname'];
        $student_email = $student['email'];
        $student_group = $student['student_group'];
    }
    else{
        echo 'error';
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
       #back{
            font-weight: bold;
            border: 1px solid grey;
            background-color: rgb(146, 146, 246);
            color: white;
        }
        /* input{
            width: 20px;
            height: 20px;
            margin-right: 5px;
        } */
        .overlay{
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 13%;
            width: 100%;
            height: 100%;
            z-index: 999;
        }
        #risk-container{
            position: absolute;
            z-index: 1000;
            width: 50%;
            border: 2px solid black;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 15px;
            padding-bottom: 30px;
            border-radius: 10px;
        }
        #noc-form{
            position: absolute;
            z-index: 1000;
            width: 75%;
            border: 2px solid black;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 15px;
            padding-bottom: 30px;
            border-radius: 10px;
        }
        label{
            margin-left: 5px;
        }

        .input-section{
            margin-bottom: 20px;
        }
        .error{
            color: red;
            display: none;
        }
        @media (max-width: 768px) {
  .flex-container {
    flex-direction: column;
    justify-content: center;
  }
}
</style>
<body style="background-color: white;">
    <div id="noc-form" style="display : none">
        <h5 class="text-center" style="border-bottom : 2px solid grey">Bakım Planı</h5>
        <div style="display: flex; flex-wrao : wrap" class='flex-container'>    
            <div class="mb-2 mt-2">
                <h6 style="">Hemşirelik Tanısı</h6>
                <textarea name="patient_data" rows="4" cols="20"></textarea>
            </div>
            <div class="mb-2 mt-2">
            <h6 class="username-label">Beklenen Hasta Sonuçları (NOC):</h6>
            <textarea name="noc" rows="4" cols="20"></textarea>
        </div>
        <div class="mb-2 mt-2">
            <h6 class="username-label">Hemşirelik Girişimleri (NIC)</h6>
            <textarea name="nic" rows="4" cols="20"></textarea>
        </div>
        <div class="mb-2 mt-2">
            <h6 class="username-label">Değerlendirme (NOC)</h6>
            <textarea name="noc_assessment" rows="4" cols="20"></textarea>
        </div>
    </div>
        <input type="button" id="noc-submit" style="margin:0 auto" value="submit" class="btn btn-success">
    </div>
    <div id="risk-container" style="display: none;">
        <h5 class="text-center"></h5>
        <button class="btn btn-success" id="close-risk">Proceed</button>
    </div>
    <div class="overlay" style="display: none;"></div>


    <div class="container-fluid mt-5 w-75 p-4" style="background-color: white; aspect-ratio: 1;" >
        <button class="btn mb-4" id="back">Back</button>
        <iframe src=<?php echo $base64String?> frameborder="0" class='w-100 mb-5' style='height:100%' ></iframe>
        
        <div class="input-section">
        <h5 class="username-label">UYARANIN ALGILANMA¬SI
            Basınca karşı oluşan rahatsızlığın algılanması.
            </h5>
            <h6 class="error">Please select one option</h6>

            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="1" name="stimulus_detection">
                <label >1. TAMAMEN
                    YETERSİZ:
                    Ağrılı uyaranlara yanıt
                    vermiyor (İnleme, algılama). Bilinçsizliğe bağlı olarak vücudunda ağrı odaklarını
                    hissedemiyor.
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="2" name="stimulus_detection">
                <label >
                    2. ÇOK
                    YETERSİZ:
                    Yalnız ağrılı
                    uyaranlara yanıt veriyor. Rahatsızlığını inleme ile belli
                    edebiliyor.                    
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="3" name="stimulus_detection">
                <label >3. BİRAZ YETERLİ:
                    Sözlü uyaranlara yanıt veriyor. Sürekli iletişim kurulamıyor. Hastanın yatak İçinde çevrilmesi gerekiyor                    
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="4" name="stimulus_detection">
                <label >4. TAMAMEN
                    YETERLİ:
                    Sözlü uyaranlara
                    yanıt veriyor. Duyu kusuru yok.                    
                    </label>
            </div>
        </div>

        <div class="input-section">
        <h5 class="username-label">NEMLİLİK
Vücudun
Nemliliği.
            </h5>
            <h6 class="error">Please select one option</h6>

            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="1" name="body_humidity">
                <label >1. SÜREKLİ ISLAK:
                    Deri, ter, İdrar, gaita ile
                    sürekli ıslak, her
                    çevrildiğinde ıslaklık
                    hissediliyor
                    
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="2" name="body_humidity">
                <label >
                    2. ÇOK ISLAK:
                    Deri çoğu zaman
                    ıslak. Her vardiyada çarşafların bir kez değiştirilmesi gerekiyor.
                    
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="3" name="body_humidity">
                <label >3. BAZEN ISLAK:
                    Deri bazen ıslak.
                    çarşafların ıslandıkça
                    değiştirilmesi
                    gerekiyor.
                                      
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="4" name="body_humidity">
                <label >4. NADİREN
                    ISLAK:
                    Deri genellikle
                    kuru, çarşafların
                    rutin olarak
                    değiştirilmesi
                    gerekiyor.                                        
                    </label>
            </div>
        </div>
        <div class="input-section">
        <h5 class="username-label">AKTIVITE
            Fiziksel
            Aktivitenin
            Derecesi.            
            </h5>
            <h6 class="error">Please select one option</h6>

            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="1" name="physical_activity">
                <label >1. YATAĞA
                    BAĞIMLI:
                    Her türlü bakım
                    gereksinimi yatakta
                    karşılanıyor.                    
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="2" name="physical_activity">
                <label >
                    2. SANDALYEYE
                    BAĞIMLI: Çok az
                    yürüyebiliyor.
                    Sandalyeye
                    oturabilmesi için
                    yardım gerekiyor.
                    Kendi ağırlığını
                    kaldırmakta güçlük
                    çekiyor.
                    
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="3" name="physical_activity">
                <label >3. BAZEN
                    YÜRÜYEBİLİYOR:
                    Yardımla veya
                    yardımsız kısa
                    mesafede
                    yürüyebiliyor. Her
                    vardiyada çoğu zaman
                    yatakta veya
                    sandalyede oturuyor
                    
                                      
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="4" name="physical_activity">
                <label >4. SIK SIK
                    YÜRÜYEBİLİYOR: Günde en
                    az iki defa oda
                    dışına
                    çıkabiliyor. Oda
                    içinde 2 saatte bir
                    yürüyebiliyor.
                                           
                    </label>
            </div>
        </div>
        <div class="input-section">
        <h5 class="username-label">HAREKET
            Pozisyonunu
            Değiştirme ve
            Kontrol edebilme.
            
            </h5>
            <h6 class="error">Please select one option</h6>

            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="1" name="mobility_confidence">
                <label>1. TAMAMEN
                    HAREKETSİZ:
                    Yardımsız pozisyon
                    değiştiremiyor
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="2" name="mobility_confidence">
                <label>
                    2. ÇOK
HAREKETSİZ:
Vücut ve ekstremice
pozisyonunda hafif
değişiklik
yapabiliyor.Kendiliğinden  Pozisyonunu değiştiremiyor.
 
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="3" name="mobility_confidence">
                <label >3. AZ HAREKETLİ:
                    Vücut ve
                    ekstrem İtelerinde sık,
                    ancak hafif değişiklik
                    yapabiliyor.
                    
                                      
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="4" name="mobility_confidence">
                <label >4.
                    HAREKETLİ:
                    Pozisyonunu
                    yardımsız
                    sıklıkla
                    değiştirebiliyor.
                                                          
                    </label>
            </div>
        </div>
        <div class="input-section">
        <h5 class="username-label">BESLENME
            Beslenme alışkanlığı.
            </h5>
            <h6 class="error">Please select one option</h6>

            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="1" name="feeding_habit">
                <label>1. ÇOK YETERSİZ:
                    Asla öğününün tamamını yiyemiyor. Nadiren verilen yemeğin 1/3'ünü yiyebiliyor. 2 öğün ya da daha az protein alabiliyor (Et ve süt ürünleri) Sıvı alımı az. Ağızdan sıvı desteği alamıyor. 5günden fazla süredir IV ve berrak diyet alıyor.
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="2" name="feeding_habit">
                <label >
                    2.YETERSIZ:
Verilen yemeğin
yarısını, nadiren tamamını yiyebiliyor. Günde
3 defa protein bazen
destekleyici ek gıda alabiliyor. Uygun
diyetin tüp ile
verilen besinin
birazını alabiliyor

                    
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="3" name="feeding_habit">
                <label >3. YETERLİ:
                    öğünün yarısından
                    fazlasını yiyebiliyor. Günde 4 kez protein alabiliyor. Ara sıra
                    öğünü reddediyor.
                    Verilmişse ek diyeti ya da Total
                    parenteral beslenmeyi 
                    alabiliyor.
                    
                                      
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="4" name="feeding_habit">
                <label >4. ÇOK İYİ:
                    Her öğünü
                    çoğunlukla yiyor, öğünleri reddetmiyor.
                    Günde 4 defa
                    protein alabiliyor.
                    Genellikle öğün
                    aralarında yiyor.
                    Ek gıda
                    gerekmiyor.
                                                         
                    </label>
            </div>
        </div>
        <div class="input-section">
        <h5 class="username-label">SÜRTÜNME
            VETAHRİŞ
            </h5>
            <h6 class="error">Please select one option</h6>

            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="1" name="friction_control">
                <label >SORUN 1: Hareket ederken çok fazla yardıma gereksinimi var. Çarşafta kaydırmaksızın tamamen kaldırılması  olanaksız. Sıklıkla
                    sandalyeden ya da
                    yataktan aşağı kayıyor.
                    Yeniden pozisyon
                    vermede çok fazla
                    yardıma gereksinimi
                    var. Sertlik, kontraktür
                    ya da huzursuzluk
                    sürekli sürtünmeye yol
                    açabiliyor
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="2" name="friction_control">
                <label>
                    2. OLASI SORUN Çok az yardımla az ve güçsüz hareket yapabiliyor. Hareket sırasında deri, çarşafa sandalyeye ya da diğer
                    malzemelere
                    sürtünüyor.
                    Genellikle yatak ve
                    sandalyede pozisyonunu
                    sürdürüyor, fakat
                    bazen kayıyor.
                    
                    
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio"  value="3" name="friction_control">
                <label >3. SORUN YOK Yatak ve sandalyede bağımsız hareket edebiliyor. Kendini kaldırabilmek için, yeterli kas gücü var. Yatak ya da
                    sandalyede her zaman
                    uygun pozisyonda
                    duruyor.                 
                    </label>
            </div>
        </div>
        
        <button type="submit" id="submit" class="btn btn-success">Submit</button>


    </div>

    </body>
<script>
   $('#back').click(function (e) { 
        e.preventDefault();
     $('#content').load('course.php');
    });

    $('#submit').click(function (e) { 
        e.preventDefault();
        $('.error').css('display', 'none');

        if ($('input[name="stimulus_detection"]:checked').length === 0) {
        // Find the nearest error
        $('input[name="stimulus_detection"]').closest('.input-section').find('.error').css('display', 'block');

        // Scroll to the error
        $('html, body').animate({
            scrollTop: $('input[name="stimulus_detection"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }
    if ($('input[name="body_humidity"]:checked').length === 0) {
        // Find the nearest error
        $('input[name="body_humidity"]').closest('.input-section').find('.error').css('display', 'block');

        // Scroll to the error
        $('html, body').animate({
            scrollTop: $('input[name="body_humidity"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }
    if ($('input[name="physical_activity"]:checked').length === 0) {
        // Find the nearest error
        $('input[name="physical_activity"]').closest('.input-section').find('.error').css('display', 'block');

        // Scroll to the error
        $('html, body').animate({
            scrollTop: $('input[name="physical_activity"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }
    if ($('input[name="mobility_confidence"]:checked').length === 0) {
        // Find the nearest error
        $('input[name="mobility_confidence"]').closest('.input-section').find('.error').css('display', 'block');

        // Scroll to the error
        $('html, body').animate({
            scrollTop: $('input[name="mobility_confidence"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }
    if ($('input[name="feeding_habit"]:checked').length === 0) {
        // Find the nearest error
        $('input[name="feeding_habit"]').closest('.input-section').find('.error').css('display', 'block');

        // Scroll to the error
        $('html, body').animate({
            scrollTop: $('input[name="feeding_habit"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }
    if ($('input[name="friction_control"]:checked').length === 0) {
        // Find the nearest error
        $('input[name="friction_control"]').closest('.input-section').find('.error').css('display', 'block');

        // Scroll to the error
        $('html, body').animate({
            scrollTop: $('input[name="friction_control"]').closest('.input-section').find('.error').offset().top - 200
        }, 500);
        return;
    }
        
    

        var student_id = <?php echo $student_id ?>;
        var student_name = <?php echo json_encode($student_name) ?>;
        var student_email = <?php echo json_encode($student_email) ?>;
        var student_group = <?php echo json_encode($student_group) ?>;
        var stimulus_detection = $('input[name="stimulus_detection"]:checked').val();
        var body_humidity = $('input[name="body_humidity"]:checked').val();
        var physical_activity = $('input[name="physical_activity"]:checked').val();
        var mobility_confidence = $('input[name="mobility_confidence"]:checked').val();
        var feeding_habit = $('input[name="feeding_habit"]:checked').val();
        var friction_control = $('input[name="friction_control"]:checked').val();
        var total = parseInt(stimulus_detection) + parseInt(body_humidity) + parseInt(physical_activity) + parseInt(mobility_confidence) + parseInt(feeding_habit) + parseInt(friction_control);
        
        $.ajax({
            type: "POST",
            url: "braden-handler.php",
            data: {
            task_id : <?php echo $task_id ?>,
            student_id: student_id,
            student_name: student_name,
            student_email: student_email,
            student_group: student_group,
            stimulus_detection: stimulus_detection,
            body_humidity: body_humidity,
            physical_activity: physical_activity,
            mobility_confidence: mobility_confidence,
            feeding_habit: feeding_habit,
            friction_control: friction_control,
            total: total
            },
            success: function (response) {
                alert('success');
                var riskFactor = '';
                if(total < 12){
                    riskFactor = 'Yüksek Risk';
                }else if(total < 14){
                    riskFactor = 'Orta Risk';
                }else{
                    riskFactor = 'Düşük Risk';
                }
                $('#risk-container').find('h5').text(riskFactor);
                //scroll top
                $('html, body').animate({
                    scrollTop: 0
                }, 500);
                $('.overlay').show();
                $('#risk-container').show();
                $('body').css('overflow', 'hidden');
            }
        });
    });

    $('#close-risk').click(function(e){
        console.log('risk button clicked')
        e.preventDefault();
        $('#risk-container').hide();
        $('#noc-form').show();
    })

    $('#noc-submit').click(function(e){
        e.preventDefault();
        var patient_data = $('textarea[name="patient_data"]').val().trim() || 'N/A';
        var noc = $('textarea[name="noc"]').val().trim() || 'N/A';
        var nic =$('textarea[name="patient_data"]').val().trim() || 'N/A';
        var noc_assessment = $('textarea[name="noc_assessment"]').val().trim() || 'N/A';
        console.log(patient_data, noc, nic, noc_assessment)
        var student_id = <?php echo $student_id ?>;
        $.ajax({
            type: "POST",
            url: "noc_handler.php",
            data: {
                patient_data: patient_data,
                noc: noc,
                nic: nic,
                noc_assessment: noc_assessment,
                student_id: student_id
            },
            success: function (response) {
                alert(response);
                $('#noc-form').hide();
                $('.overlay').hide();
                $('body').css('overflow', 'auto');
                $('#content').load('course.php');  
                $('#content').load('course.php');
                
            }
        });
    })

</script>
</html>
