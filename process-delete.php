<?php
require_once("config-students.php");
?>
<?php
session_start();
if (isset($_POST)) {



    $id = $_POST['id'];
    $email = $_POST['email'];
    $type = $_POST['type'];

    if($type == 'student'){

        $sql = "DELETE FROM students WHERE id = ? AND email = ? ";
        $smtminsert = $db->prepare($sql);
        $result = $smtminsert->execute([$id, $email]);
        $sql1 = "DELETE FROM patients WHERE id = ?";
        $smtminsert1 = $db->prepare($sql1);
        $result1 = $smtminsert1->execute([$id]);
        if ($result && $result1) {
            session_destroy();
            echo 'Başarılı';
        } else {
            echo 'Hata';
        }
    }
    else{
        
        $sql = "DELETE FROM teachers WHERE id = ? AND email = ? ";
        $smtminsert = $db->prepare($sql);
        $result = $smtminsert->execute([$id, $email]);
        $sql1 = "DELETE FROM patients WHERE id = ?";
        $smtminsert1 = $db->prepare($sql1);
        $result1 = $smtminsert1->execute([$id]);
        if ($result && $result1) {
            session_destroy();
            echo 'Başarılı';
        } else {
            echo 'Hataa';
        }
    }
} else
    echo 'no data';
