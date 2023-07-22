<?php
require_once('./config-students.php');
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
} else {
    echo 'No matching tasks found.';
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
        label{
            margin-left: 5px;
        }

        .input-section{
            margin-bottom: 20px;
        }
</style>
<body style="background-color: white;">
    <div class="container-fluid mt-5 w-75 p-4" style="background-color: white; aspect-ratio: 1;" >
        <button class="btn mb-4" id="back">Back</button>
        <iframe src=<?php echo $base64String?> frameborder="0" class='w-100 mb-5' style='height:100%' ></iframe>
        
        <div class="input-section">
        <h5 class="username-label">UYARANIN ALGILANMA¬SI
            Basınca karşı oluşan rahatsızlığın algılanması.
            </h5>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio" style="width:20px;height:20px" value="1" name="">
                <label >1. TAMAMEN
                    YETERSİZ:
                    Ağrılı uyaranlara yanıt
                    vermiyor (İnleme, algılama). Bilinçsizliğe bağlı olarak vücudunda ağrı odaklarını
                    hissedemiyor.
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio" style="width:20px;height:20px" value="2" name="">
                <label >
                    2. ÇOK
                    YETERSİZ:
                    Yalnız ağrılı
                    uyaranlara yanıt veriyor. Rahatsızlığını inleme ile belli
                    edebiliyor.                    
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio" style="width:20px;height:20px" value="3" name="">
                <label >3. BİRAZ YETERLİ:
                    Sözlü uyaranlara yanıt veriyor. Sürekli iletişim kurulamıyor. Hastanın yatak İçinde çevrilmesi gerekiyor                    
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio" style="width:20px;height:20px" value="4" name="">
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
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio" style="width:20px;height:20px" value="1" name="">
                <label >1. SÜREKLİ ISLAK:
                    Deri, ter, İdrar, gaita ile
                    sürekli ıslak, her
                    çevrildiğinde ıslaklık
                    hissediliyor
                    
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio" style="width:20px;height:20px" value="2" name="">
                <label >
                    2. ÇOK ISLAK:
                    Deri çoğu zaman
                    ıslak. Her vardiyada çarşafların bir kez değiştirilmesi gerekiyor.
                    
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio" style="width:20px;height:20px" value="3" name="">
                <label >3. BAZEN ISLAK:
                    Deri bazen ıslak.
                    çarşafların ıslandıkça
                    değiştirilmesi
                    gerekiyor.
                                      
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio" style="width:20px;height:20px" value="4" name="">
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
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio" style="width:20px;height:20px" value="1" name="">
                <label >1. YATAĞA
                    BAĞIMLI:
                    Her türlü bakım
                    gereksinimi yatakta
                    karşılanıyor.                    
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio" style="width:20px;height:20px" value="2" name="">
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
                <input type="radio" style="width:20px;height:20px" value="3" name="">
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
                <input type="radio" style="width:20px;height:20px" value="4" name="">
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
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio" style="width:20px;height:20px" value="1" name="">
                <label>1. TAMAMEN
                    HAREKETSİZ:
                    Yardımsız pozisyon
                    değiştiremiyor
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio" style="width:20px;height:20px" value="2" name="">
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
                <input type="radio" style="width:20px;height:20px" value="3" name="">
                <label >3. AZ HAREKETLİ:
                    Vücut ve
                    ekstrem İtelerinde sık,
                    ancak hafif değişiklik
                    yapabiliyor.
                    
                                      
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio" style="width:20px;height:20px" value="4" name="">
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

            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio" style="width:20px;height:20px" value="1" name="">
                <label>1. ÇOK YETERSİZ:
                    Asla öğününün tamamını yiyemiyor. Nadiren verilen yemeğin 1/3'ünü yiyebiliyor. 2 öğün ya da daha az protein alabiliyor (Et ve süt ürünleri) Sıvı alımı az. Ağızdan sıvı desteği alamıyor. 5günden fazla süredir IV ve berrak diyet alıyor.
                    </label>
            </div>
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio" style="width:20px;height:20px" value="2" name="">
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
                <input type="radio" style="width:20px;height:20px" value="3" name="">
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
                <input type="radio" style="width:20px;height:20px" value="4" name="">
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
            <div class="d-flex flex-row align-items-start mb-2">
                <input type="radio" style="width:20px;height:20px" value="1" name="">
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
                <input type="radio" style="width:20px;height:20px" value="2" name="">
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
                <input type="radio" style="width:20px;height:20px" value="3" name="">
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
</script>
</html>
