<?php 
$error=[];
echo $_SERVER["REQUEST_METHOD"];
if($_SERVER["REQUEST_METHOD"]=="POST"){
    
require_once("config/db.php");

$product_name=(string)($_POST["product_name"]??"");
$qty=(int) ($_POST["qty"]??0);
$cost_price=(float) ($_POST["cost_price"]??0);
$sell_price=(float)($_POST["sell_price"]??0);
$url=$_FILES["url"]??null;

$imagepath="";
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
    $st=$pdo->prepare("INSERT INTO tblproduct(product_name,qty,cost_price,sell_price,url) VALUES(:product_name,:qty,:cost_price,:sell_price,:url)");

    $st->bindValue(":product_name",$product_name);
    $st->bindValue(":qty",$qty);
    $st->bindValue(":cost_price",$cost_price);
    $st->bindValue(":sell_price",$sell_price);
    $st->bindValue(":url",$imagepath);

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
<?php if(!empty($error)){?>
<div class="alert alert-danger alert-content">
    <ul>
        <?php foreach($error as $er){?>
        <li><?php echo $er?></li>
        <?php }?>
    </ul>
</div>
<?php }?>
<div class="form-content">
    <div class="form-box">
        <h2>បញ្ចូលទំនិញថ្មី</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label >ឈ្មោះទំនិញ</label>
            <input type="text" name="product_name" placeholder="បញ្ចូលឈ្មោះទំនិញ">
        </div>

        <div>
            <label for="qty">ចំនួន</label>
            <input type="number" name="qty"  id="qty" placeholder="0">
        </div>

        <div>
            <label>ថ្លៃលក់ ($)</label>
            <input type="text" name="sell_price" placeholder="0.00">
        </div>

        <div>
            <label>ថ្លៃដើម ($)</label>
            <input type="text" name="cost_price" placeholder="0.00">
        </div>

        <div>
                <label>រូបភាព</label> 
                <input type="file" name="url">
            </div>

        <button class="update-btn" type="submit">
            រក្សាទុកទំនិញ
        </button>
        <br><br>
            <a href="list.php" style="color: #666; text-decoration: none; font-size: 14px;">← ត្រឡប់ទៅបញ្ជីវិញ</a>
    </form>
    </div>
    
</div>
    
<?php require_once(__DIR__."/layout/footer.php") ?>