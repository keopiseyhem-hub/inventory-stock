<?php
//connection using pdo
$port=3306;
$dbname='inventorystock';
$user='root';
$pwd='';
$pdo=new PDO("mysql:host=localhost;port=$port;dbname=$dbname",$user,$pwd);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

echo "connect";
?>