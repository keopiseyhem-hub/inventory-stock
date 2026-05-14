<?php 
$proid=$_REQUEST["id"];
echo $proid;

require_once("./config/db.php");
$st=$pdo->prepare("Delete from tblproduct where id=:proid");
$st->bindValue(":proid",$proid);
$st->execute();
 header("Location:list.php")
?>