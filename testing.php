<?php


if(isset($_FILES['file']['name'])){
    echo "File name: " . $_FILES['file']['name'] . "<br>";
}else{
    echo "No file uploaded.";
}
?>