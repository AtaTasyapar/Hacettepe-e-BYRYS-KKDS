<?php
require_once("config-students.php");
?>
<?php
if (isset($_POST)) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $age = $_POST['age'];
    $not = $_POST['not'];
    $uyaran = $_POST['uyaran'];
    $nemlilik = $_POST['nemlilik'];
    $aktivite = $_POST['aktivite'];
    $hareket = $_POST['hareket'];
    $beslenme = $_POST['beslenme'];
    $surtunme = $_POST['surtunme'];
    $fileid = $_POST['vakaradio'];

    var_dump($uyaran);
    echo $name;
    $sql = "INSERT INTO patients (id ,name, surname, age, notlar, uyaran, nemlilik, aktivite, hareket, beslenme, surtunme, fileid) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
    $smtminsert = $db->prepare($sql);
    $result = $smtminsert->execute([
        $id, $name, $surname, $age, $not, $uyaran, $nemlilik, $aktivite, $hareket, $beslenme, $surtunme, $fileid
    ]);
    if ($result) {
        echo 'Başarılı';
    } else {
        echo $result;
    }
} else
    echo 'no data';
