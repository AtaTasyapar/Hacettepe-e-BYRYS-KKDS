<?php
require_once("config-students.php");

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Check in the students table
    $sql = "SELECT * FROM students WHERE email = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $sql2 = "SELECT * FROM teachers WHERE email = ?";
    $stmt2 = $db->prepare($sql2); 
    $stmt2->execute([$email]);
    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    if ($result || $result2) {
        echo 'exists';
    } else {
        echo 'not-exists';
    }
} else {
    echo 'no data';
}
?>