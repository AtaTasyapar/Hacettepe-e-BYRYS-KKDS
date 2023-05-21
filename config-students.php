<?php
$db_user = "admin";
$db_pass = "12345678";
$db_name = "ebyrys_db";
$db_host = "ebyrys.cpcbxswdfvjg.eu-central-1.rds.amazonaws.com";
$db = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset-utf8', $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);