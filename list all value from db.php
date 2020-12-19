<?php

$db = new PDO('mysql:host=localhost;dbname=datatest','root','');
$id = $_GET['id'];
$result = $db->prepare("SELECT * FROM user_test where id=:id LIMIT 1");
$result->bindValue(":id", $id);
$result->execute();
$row = $result->fetch();
echo $id;


?>