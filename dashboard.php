<?php require_once(__DIR__."/layout/header.php");
      require("./config/db.php");
$st_pro=$pdo->prepare("select count(*) as total_product from tblproduct");
$st_pro->execute();
$total_product=$st_pro->fetch(PDO::FETCH_ASSOC);

$st_lowstock=$pdo->prepare("select count(*) as lowstock from tblproduct where qty <= 5 and qty>0");
$st_lowstock->execute();
$low_stock=$st_lowstock->fetch(PDO::FETCH_ASSOC);

$st_outstock=$pdo->prepare("select count(*) as outstock from tblproduct where qty=0 ");
$st_outstock->execute();
$out_stock=$st_outstock->fetch(PDO::FETCH_ASSOC);


$st_grand_cost_total=$pdo->prepare("select sum(qty * cost_price) as grand_cost from tblproduct");
$st_grand_cost_total->execute();
$grand_cost_total=$st_grand_cost_total->fetch(PDO::FETCH_ASSOC);

$st_grand_sell_total=$pdo->prepare("select sum(qty * sell_price) as grand_sell from tblproduct");
$st_grand_sell_total->execute();
$grand_sell_total=$st_grand_sell_total->fetch(PDO::FETCH_ASSOC);
?>

<div class="main-content">
    <h1>របាយការណ៍សង្ខេប</h1>
    
    <div class="cards">
        <a href="list.php">
            <div class="card" style="border-bottom: 5px solid #0c0fddb7;">
                <div>
                    <h3>ទំនិញសរុប</h3>
                    <p style="color: #0c0fddb7;"><?php echo $total_product['total_product']?>  មុខ</p>
                </div>
                
            </div>
        </a>

        <a href="outstock.php">
            <div class="card" style="border-bottom: 5px solid #e74c3c;">
                <div>
                    <h3>អស់ពីស្តុក</h3>
                    <p style="color: #e74c3c;"><?php echo $out_stock["outstock"]?> មុខ</p>
                </div>
                <div>
                    <h3>ជិតអស់ពីស្តុក</h3>
                    <p style="color: #e74c3c;"><?php echo $low_stock["lowstock"]?> មុខ</p>
                </div>
                
            </div>
        </a>

        <a href="total.php">
            <div class="card" style="border-bottom: 5px solid #2ecc71;">
                <div>
                    <h3>ថ្លៃដើមសរុបនៃទំនិញទាំងអស់</h3>
                    <p style="color: #2ecc71;">$ <?php echo $grand_cost_total["grand_cost"]?></p>
                </div>    
                <div>
                    <h3>ថ្លៃលក់សរុបនៃទំនិញទាំងអស់</h3>
                    <p style="color: #2ecc71;">$ <?php echo $grand_sell_total["grand_sell"]?></p>
                </div> 

            </div>
        </a>
    </div>
</div>

<?php require_once(__DIR__."/layout/footer.php")?>