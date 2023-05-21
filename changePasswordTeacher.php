<?php
require_once("config-students.php");
?>
<?php
if (isset($_POST)) {
    $email = $_POST['email'];
    $password = sha1(($_POST['password']));
    $sql = "UPDATE teachers SET password = ? WHERE email = ?";
    $smtmupdate = $db->prepare($sql);
    $result = $smtmupdate->execute([ $password,$email]);
    if($result){
        echo 'success';
    }
    else{
        echo 'hata';
    }

} else
    echo 'no data'; 