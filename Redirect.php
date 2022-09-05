


<?php

include('config.php');
if(isset($_POST['submit']))
{
$user= $_SESSION['userId'];

$sql_cart="SELECT * FROM  cart WHERE buyer_id='$user'";



$mod_res= mysqli_query($conn,$sql_cart);
$res= mysqli_fetch_all($mod_res);
foreach($res as $row)
{
$sql="INSERT INTO orders(`product_id`,`quantity`,`buyer_id`,`status_order`) VALUES ('$row[1]','$row[2]','$row[3]',1)";


$res=$conn->query($sql);
if($res)
{

echo "added ";

}

$sql_delete="DELETE FROM cart WHERE buyer_id='$user'";
$res=$conn->query($sql_delete);


}





}




?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <div>

        hello redirect page 
        your orders are


   </div> 
</body>
</html>