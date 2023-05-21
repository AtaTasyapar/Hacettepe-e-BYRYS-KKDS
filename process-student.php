<?php
require_once("config-students.php");
?>
<?php
if (isset($_POST)) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = sha1(($_POST['password']));
    



    $sql = "INSERT INTO students (name, surname, email, password) VALUES(?,?,?,?)";
    $smtminsert = $db->prepare($sql);
    $result = $smtminsert->execute([$name, $surname, $email, $password]);
    if ($result) {
        echo 'Başarılı';
    } else {
        echo 'Hata';
    }
} else
    echo 'no data';
