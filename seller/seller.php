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
$sql_user_name_query="SELECT shopname FROM seller WHERE sellid='$seller_id'";



$h_query=mysqli_query($conn,$sql_user_name_query);

$res_name=mysqli_fetch_row($h_query);
// print_r($res_name);

    if(isset($_POST['submit']))
{
    $product_name = $_POST['product_name'];
    $product_price=$_POST['product_price'];
    $product_img=$_POST['product_link'];
    // $seller_id=(int)$_POST['seller_id'];


 $sql = "INSERT INTO `products`(`product_name`, `product_price`, `seller_id`,`imgLink`) VALUES ('$product_name','$product_price','$seller_id','$product_img')";

 $result = $conn->query($sql);

    if ($result == TRUE) {

      ?> <script>


      window.alert("new item created sucessfully");
      </script>

       
<?php

    }else{

      ?>
<script>


window.alert("<?php echo $conn->error; ?>");
</script>


<?php

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


<script src="https://cdn.tailwindcss.com"></script>

<body class="flex flex-col items-center justify-start h-screen bg-gray-900 w-screen gap-y-6">
<?php include('../components/NavbarSeller.php'); ?>
<h2 class="text-white mx-auto text-center rounded-sm">welcome <?php print_r($res_name[0]) ?></h2>
    <h1 class="p-5 bg-slate-800 text-white mx-auto text-center rounded-sm">sellers  product add page</h1>
        
    <form action="" method="POST" class="flex flex-col max-w-md gap-3 p-6 rounded-md shadow-md bg-white dark:text-gray-100">
    <input type="text" name="product_name" placeholder="product_name"/>
    <input type="number" name="product_price" placeholder="product_price"/>
    <input type="text" name="product_link" placeholder="product_img_link"/>
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
?>
    <div class="w-screen p-6 m-2 flex gap-y-6 gap-x-4 items-center bg-slate-500 text-white">
    <?php
    for ($i=0; $i <count($value); $i++) { ?>
      <div class="bg-gray-800 flex flex-col gap-y-4 items-center py-4 justify-start  w-1/5 rounded-lg">
     <div><?php echo $value[$i][1];  ?></div>
     <div><?php echo $value[$i][2];  ?></div>
     <div><?php echo $value[$i][3];  ?></div>

        <form action="" method="POST" >
            <input type="hidden" name="product_id" value="<?php echo $value[$i][0]; ?> "/>
            <button  class="rounded-md py-6 px-4 w-full text-center bg-black text-white" type="submit" name="delete" value="submit">delete item no <?php echo $value[$i][0] ?></button>
        </form>


    </div>





    <?php } ?> 
    </div>
    
    
    
    
    

</body>
</html>


<?php 

$conn -> close();




?>