<?php
session_start();
require_once "./config-students.php";
require_once './lib/PHPMailer/src/PHPMailer.php';
require_once './lib/PHPMailer/src/SMTP.php';
require_once './lib/PHPMailer/src/Exception.php';
if (isset($_POST)) { 
    $email = $_POST['email'];
    function generateRandomCode($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $code;
    }
    $code = generateRandomCode();
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'muhammadfaizan41000@gmail.com';
    $mail->Password = 'edqslczsnkuktntb';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('muhammadfaizan41000@gmail.com', 'e-BYRYS');
    $mail->addAddress($email, '');
    $mail->Subject = 'E-BYRYS';
    $mail->Body = 'Verify your account with the code below: ' . $code;

    try {
        $mail->send();
        echo $code;
    } catch (Exception $e) {
        echo 'Email could not be sent: ', $mail->ErrorInfo;
    }


  
} else
    echo 'server error';
?>