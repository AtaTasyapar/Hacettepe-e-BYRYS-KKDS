<?php
session_start();
require_once('./config-students.php');
$type = isset($_SESSION['ebyrysUserLogin']['type']) ? $_SESSION['ebyrysUserLogin']['type'] : '';
$student_id = $type == 'student' ? $_SESSION['ebyrysUserLogin']['id'] : $_POST['student_id'];
$testcase = '';
$sql = 'SELECT * FROM testcase WHERE student_id = :id';
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $student_id);
$result = $stmt->execute();

if($result){
    $testcase = $stmt->fetch(PDO::FETCH_ASSOC);
}else{
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
            margin-bottom: 20px;
        }
        label{
            margin-left: 5px;
        }

</style>
<body>
<div class="container-fluid mt-5 w-75 p-4" style="background-color: white; aspect-ratio: 1;" >
        <button class="btn mb-4" id="back">Iptal</button>        
        <div class="input-section">
        <h5 class="username-label">UYARANIN ALGILANMA¬SI
            Basınca karşı oluşan rahatsızlığın algılanması.
            </h5>
            <h6 class="error">Lütfen bir seçenek seçin</h6>

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
            <h6 class="error">Lütfen bir seçenek seçin</h6>

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
            <h6 class="error">Lütfen bir seçenek seçin</h6>

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
            <h6 class="error">Lütfen bir seçenek seçin</h6>

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
            <h6 class="error">Lütfen bir seçenek seçin</h6>

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
            <h6 class="error">Lütfen bir seçenek seçin</h6>

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
            <div class="align-items-start mb-2">
                <h5>Total: <?php echo $testcase['total']?></h5>
                <h5>
                    <?php
                        if($testcase['total'] < 12){
                            echo 'Yüksek Risk';
                        }
                        else if($testcase['total'] < 14){
                            echo 'Orta Risk';
                        }
                        else {
                            echo 'Düşük Risk';
                        }
                    ?>
                </h5>
            </div>
        </div>


        <div class="container-fluid mt-5 w-75 p-4" style="background-color: white; aspect-ratio: 1;">
            <h2>Bakım Planı</h2>
            <h6 class="mb-2">Hemşirelik Tanısı: <?php  echo $testcase['patient_data'] ?></h6>
            <h6 class="mb-2">Beklenen Hasta Sonuçları (NOC): <?php  echo $testcase['noc'] ?></h6>
            <h6 class="mb-2">Hemşirelik Girişimleri (NIC): <?php  echo $testcase['nic'] ?></h6>
            <h6 class="mb-2">Değerlendirme (NOC): <?php  echo $testcase['noc_assessment'] ?></h6>
        </div>
    </div>
</body>
<script>
    $('input[name="stimulus_detection"][value=<?php echo $testcase['stimulus_detection']?>]').prop('checked', true);
    $('input[name="body_humidity"][value=<?php echo $testcase['body_humidity']?>]').prop('checked', true);
    $('input[name="physical_activity"][value=<?php echo $testcase['physical_activity']?>]').prop('checked', true);
    $('input[name="mobility_confidence"][value=<?php echo $testcase['mobility_confidence']?>]').prop('checked', true);
    $('input[name="feeding_habit"][value=<?php echo $testcase['feeding_habit']?>]').prop('checked', true);
    $('input[name="friction_control"][value=<?php echo $testcase['friction_control']?>]').prop('checked', true);
    $('#back').click(function(){
        $('#content').load('teacher-main.php')
    })
</script>
</html>