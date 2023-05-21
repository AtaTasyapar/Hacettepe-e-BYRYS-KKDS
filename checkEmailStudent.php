<?php
require_once("config-students.php");

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $sql = "SELECT * FROM students WHERE email = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        echo 'exists';
    } else {
        echo 'not-exists';
    }
} else {
    echo 'no data';
}
?>