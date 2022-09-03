<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "Panda@2001";
$dbname = "swaad";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,3306);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$user_null_error="";

if($_SESSION['user'])
{


    $seller_id=$_SESSION['user'];


    if(isset($_POST['submit']))
{
    $product_name = $_POST['product_name'];
    $product_price=$_POST['product_price'];
    // $seller_id=(int)$_POST['seller_id'];


 $sql = "INSERT INTO `products`(`product_name`, `product_price`, `seller_id`) VALUES ('$product_name','$product_price',$seller_id)";

 $result = $conn->query($sql);

    if ($result == TRUE) {

      echo "New record created successfully.";

    }else{

      echo "Error:". $sql . "<br>". $conn->error;

    } 


   








}


if(isset($_POST['delete']))
{

$id=$_POST['product_id'];
$delete_query = " DELETE FROM products WHERE product_id='$id'; ";

$result=$conn->query($delete_query);


if($result)
{
    echo "record deleted successfully.";
}



}





}

else
{
    $user_null_error="user is not present";
}








?>




<body>
    <h1>sellers product add page</h1>

    <form action="" method="POST">
    <input type="text" name="product_name" placeholder="product_name"/>
    <input type="number" name="product_price" placeholder="product_price"/>
    <!-- <input type="hidden" name="product_name"  value=""/> -->
        <button type="submit" name="submit" value="submit">click me</button>
    </form>
    <h1><?php echo $user_null_error?></h1>
    
    <?php 
    
    $sql3="SELECT * FROM swaad.products
INNER JOIN swaad.seller
ON 
products.seller_id=seller.sellid
WHERE
products.seller_id='$seller_id'";

$res=mysqli_query($conn,$sql3);
$value= mysqli_fetch_all($res);
    
    for ($i=0; $i <count($value); $i++) { ?>
      <div>
     <div><?php echo $value[$i][1];  ?></div>
     <div><?php echo $value[$i][2];  ?></div>
     <div><?php echo $value[$i][3];  ?></div>

        <form action="" method="POST" >
            <input type="hidden" name="product_id" value="<?php echo $value[$i][0]; ?> "/>
            <button type="submit" name="delete" value="submit">delete item no <?php echo $value[$i][0] ?></button>
        </form>


    </div>





    <?php } ?> 
    
    
    
    
    
    

</body>
</html>


<?php 

$conn -> close();




?>