<?php
session_start();
require_once('config-students.php');

$email = $_POST['email'];
$password = sha1(($_POST['password']));

$sql = "SELECT * FROM students WHERE email = ? AND password = ? LIMIT 1";
$smtmselect = $db->prepare($sql);
$result = $smtmselect->execute([$email, $password]);
if ($result) {
    $user = $smtmselect->fetch(PDO::FETCH_ASSOC);
    if ($smtmselect->rowCount() > 0) {
        $_SESSION['ebyrysUserLogin'] = $user;
        echo 'Başarılı';
    } else {
        echo 'Şifre veya mail yanlış';
    }
} else {
    echo 'Hata';
}
