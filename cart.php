<?php 
include("config.php");


echo $_SESSION['userId'];
$buyer=$_SESSION['userId'];

$swql_cart="SELECT * FROM cart WHERE buyer_id=$buyer";


$mod_res= mysqli_query($conn,$swql_cart);
$result= mysqli_fetch_all($mod_res);


foreach($result as $res)
{
        print_r($res);
$result = $res[1];
echo $result;
$query= "SELECT * FROM  products WHERE product_id ='$result'" ;
$mod_res= mysqli_query($conn,$query);

$productDetails=mysqli_fetch_row($mod_res);
echo "<br/>";
print_r($productDetails);

echo "<br/>";


}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

+    <body>
    <form method="post" action="Redirect.php">

          <button type="submit" name="submit">proceed to buy</button>

</form>
</body>
</html>