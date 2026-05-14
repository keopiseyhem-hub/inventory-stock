<?php 
echo $_SERVER["REQUEST_METHOD"];
$error=[];
require_once("./config/db.php");

if($_SERVER["REQUEST_METHOD"]=="GET"){
    $proid=$_REQUEST["id"];
if(!$proid){
    header("Location: list.php");
}
if($proid){
    $st=$pdo->prepare("select * from tblproduct where id=:proid");
    $st->bindValue(":proid",$proid);
    $st->execute();
    $proDoc=$st->fetch(PDO::FETCH_ASSOC);
}
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
$product_name=(string)($_POST["product_name"]??"");
$qty=(int) ($_POST["qty"]??0);
$cost_price=(float) ($_POST["cost_price"]??0);
$sell_price=(float)($_POST["sell_price"]??0);
$url=$_FILES["url"]??null;
$proid=$_POST["id"]??0;

$imagepath=$_REQUEST["oldimg"];
if($url&& !empty($url['tmp_name'])){
    $imagepath="imgs/".date("Ymd").randomname(8).$url["name"];
    move_uploaded_file($url["tmp_name"],$imagepath);
}
elseif(empty( $product_name)){
    $error[]="អ្នកត្រូវបញ្ចូលឈ្មោះទំនិញជាមុនសិន!";
}
elseif($cost_price<=0){
    $error[]="អ្នកត្រូវបញ្ចូលថ្លៃដើមជាមុនសិន";
}
elseif($sell_price<=0){
    $error[]="អ្នកត្រូវបញ្ចូលថ្លៃលក់ជាមុនសិន";
}
if(empty($error)){
    $st=$pdo->prepare("UPDATE tblproduct SET product_name=:product_name,qty=:qty,cost_price=:cost_price,sell_price=:sell_price,url=:url WHERE id=:proid");

    $st->bindValue(":product_name",$product_name);
    $st->bindValue(":qty",$qty);
    $st->bindValue(":cost_price",$cost_price);
    $st->bindValue(":sell_price",$sell_price);
    $st->bindValue(":url",$imagepath);
    $st->bindValue(":proid",$proid);

    $st->execute();

    header("Location:list.php");

}
}
function randomname(int $n){
    $strname="";
    $character="1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPPQRSTUVWXYZ";
    for($i=0;$i<=$n;$i++){
        $int=rand(0,strlen($character-1));
        $strname=$character[$int];
    }
    return $strname;
}
?>

<?php require_once(__DIR__."/layout/header.php") ?>
<div class="form-content">
    <div class="form-box">

        <?php if(!empty($error)){?>
<div class="alert alert-danger alert-content">
    <ul>
        <?php foreach($error as $er){?>
        <li><?php echo $er?></li>
        <?php }?>
    </ul>
</div>
<?php }?>

        <h2>📝 កែប្រែព័ត៌មានទំនិញ</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <input type="hidden" name="id" value="<?php echo $proDoc["id"]?>">
            
            <label>ឈ្មោះទំនិញ:</label>
            <input type="text" name="product_name" value="<?php echo $proDoc["product_name"]?>">   <!-- បង្ហាញតម្លៃចាស់ -->
            
            <label>ចំនួន:</label>
            <input type="number" name="qty" value="<?php echo $proDoc["qty"]?>">
            
            <label>ថ្លៃលក់ ($):</label>
            <input type="text" name="sell_price" value="<?php echo $proDoc["sell_price"]?>">

            <label>ថ្លៃដើម ($):</label>
            <input type="text" name="cost_price" value="<?php echo $proDoc["cost_price"]?>">

            <label for="img" class="form-label">រូបភាព</label> 
            <input type="file" name="url" id="img" >
            <input type="hidden" name="oldimg" value="<?php echo $proDoc["url"]?>">
            <img style="width:200px; margin:30px 0;" src="<?php echo $proDoc["url"]?>" alt="">
            
            <button type="submit" class="update-btn" >ធ្វើបច្ចុប្បន្នភាព (Update)</button> 
            <!-- onclick="alert('ទិន្នន័យត្រូវបានធ្វើបច្ចុប្បន្នភាព!')" -->
            <br><br>
            <a href="list.php" style="color: #666; text-decoration: none; font-size: 14px; margin-top:10px;">← ត្រឡប់ទៅបញ្ជីវិញ</a>
            </div>
        </form>
    </div>
</div>
    
<?php require_once(__DIR__."/layout/footer.php") ?>

