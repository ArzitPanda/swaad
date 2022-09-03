<?php 
include('config.php');



$seller_userid=$_SESSION['user'];


$sql_q="SELECT  * FROM orders
INNER JOIN
products
ON
orders.product_id=products.product_id
INNER JOIN
buyer
ON
orders.buyer_id=buyer.buyerId
WHERE
products.seller_id='$seller_userid'";



$mod_res= mysqli_query($conn,$sql_q);
$res= mysqli_fetch_all($mod_res);
echo json_encode($res);






?>