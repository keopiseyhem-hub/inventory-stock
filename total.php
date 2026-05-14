<?php 
require_once("config/db.php");
$stmt=$pdo->prepare("select * from tblproduct order by create_at desc");
$stmt-> execute();
$prolist=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<?php require_once(__DIR__."/layout/header.php") ;
$cost_total=0;
$sell_total=0; ?>
<!-- Main Content Section -->
<div class="main-content">
    <h2>📦 របាយការណ៍ទឹកប្រាក់នៃទំនិញ</h2>
    
    <a href="add.php" class="add-btn">+ បន្ថែមទំនិញថ្មី</a>

    <table>
        <thead>
            <tr>
                <th>រូបភាព</th>
                <th>លរ</th>
                <th>ឈ្មោះទំនិញ</th>
                <th>ចំនួនស្តុក</th>
                <th>ថ្លៃលក់</th>
                <th>ថ្លៃលក់សរុប</th>
                <th>ថ្លៃដើម</th>
                <th>ថ្លៃដើមសរុប</th>
                <th>ប្រាក់ចំណេញ</th>
                <th>ស្ថានភាព</th>
                <th>សកម្មភាព</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($prolist as $key=>$doc){
                $cost_total=$doc["qty"] * $doc["cost_price"];
                $sell_total=$doc["qty"] * $doc["sell_price"];
                ?>
            <tr>  
                 <!-- id="row_<?php echo $doc['id'] ?>" -->
                <td class="center"> <img style="width: 100px;" src="<?php echo $doc['url']?>" alt="img"></td>
                <td><?php echo $key+1 ?></td>
                <td><?php echo $doc["product_name"]?></td>
                <td><?php echo $doc["qty"]?></td>
                <td>$<?php echo number_format($doc['sell_price'], 2) ?></td>
                <td>$<?php echo number_format($sell_total,2)?></td>
                <td>$<?php echo number_format($doc["cost_price"],2)?></td>
                <td>$<?php echo number_format($cost_total,2) ?></td>
                <td>$<?php echo number_format(($sell_total-$cost_total),2)?></td>
                <td class="status-ok">
                    <?php if($doc["qty"]>5){?>
                        <p>មានស្ទុក</p>
                    <?php }
                     elseif($doc["qty"]<=0){ ?>
                        <p style="color: red;">អស់ស្ទុក</p>
                    <?php }
                     else{?>
                        <p style="color: #af9e02;">ជិតអស់ស្ទុក</p>
                    <?php }?>
                </td>
                <td>
                    <div class="action-container">
                <a href="edit.php?id=<?php echo $doc['id']?>" class="btn-update"> <i class="fa fa-solid fa-pen-to-square"></i>កែប្រែ </a>
                <button class="btn-delete" onclick="confirmDelete()"><i class="fa fa-solid fa-trash-can"></i>លុប</button>

                    </div>
            </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once(__DIR__."/layout/footer.php")?>




