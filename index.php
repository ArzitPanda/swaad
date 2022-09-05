<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
<body>


<?php 
error_reporting(0);
    include('config.php');
$pin=$_SESSION['userPin'];
$pin_mod=substr($pin,0,5);
echo "is is mod".$pin_mod."<br/>";
// echo $_SESSION['userPin']. "\n";
echo $_SESSION['userId'];


if(isset($_POST['ADD_TO_CART']))
{      
    $products1=$_POST['product'];
    $user1=$_POST['user'];
  


 if( $_SESSION['sellercode']==NULL)
 {



   $_SESSION['sellercode'] = $_POST['seller_id']; 
   $sql = "INSERT INTO `cart`(`produt_id`,`quantity`,`buyer_id`) VALUES ('$products1',1,'$user1')";
   echo "execute";
   $res=$conn->query($sql);
  


}







  else  if($_SESSION['sellercode']==$_POST['seller_id'])
    {   echo "seller_id".$_POST['seller_id'];
       echo 'sessioned seller_id'.$_SESSION['sellercode'];
        $exist = "SELECT * FROM cart WHERE produt_id='$products1' AND buyer_id='$user1'";
    
        $result_1=mysqli_query($conn,$exist);
        $stmt=mysqli_fetch_all($result_1);
        print_r($stmt);


        if(count($stmt)==1)
        {
            echo $_SESSION['sellercode'];
            echo "hello world if";
            $sql="UPDATE cart
            SET
            quantity=quantity+1
            WHERE
            produt_id='$products1' AND buyer_id=$user1";
            $res=$conn->query($sql);

        }
        else
        {
            echo $_SESSION['sellercode'];
            echo " else";
            $sql = "INSERT INTO `cart`(`produt_id`,`quantity`,`buyer_id`) VALUES ('$products1',1,'$user1')";
            echo "execute";
            $res=$conn->query($sql);
        }
// produt_id=8 AND buyer_id=1; 


        }

    
    else
    {

        echo "last else execute";
        $sqlDelete="DELETE from cart WHERE  buyer_id='$user1'";
        $res=$conn->query($sqlDelete);
        $_SESSION['sellercode']=$_POST['seller_id'];
        $sql_insert=   $sql = "INSERT INTO `cart`(`produt_id`,`quantity`,`buyer_id`) VALUES ('$products1',1,'$user1')";
        
        
    }


}




include("./components/Navbar.php");

?>

<section>
	<div class="bg-violet-400">
		<div class="container flex flex-col items-center px-4 py-16 pb-24 mx-auto text-center lg:pb-56 md:py-32 md:px-10 lg:px-32 text-gray-900">
			<h1 class="text-5xl font-bold leading-none sm:text-6xl xl:max-w-3xl text-gray-900">Explore amazing food product</h1>
			<p class="mt-6 mb-8 text-lg sm:mb-12 xl:max-w-3xl text-gray-900">umm kill the hunger by ordering some food</p>
			<div class="flex flex-wrap justify-center">
				<button type="button" class="px-8 py-3 m-2 text-lg font-semibold rounded bg-gray-800 text-gray-50">Order Now</button>
				<button type="button" class="px-8 py-3 m-2 text-lg border rounded border-gray-700 text-gray-900">Explore</button>
			</div>
		</div>
	</div>
	<img src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8NHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60" alt="" class="w-3/6 object-contain mx-auto mb-12 -mt-20 rounded-lg shadow-md lg:-mt-40 bg-gray-500">
</section>

    <nav>
    <h1 class="text-xl font-bold leading-none sm:text-3xl xl:max-w-xl text-center text-white mx-auto bg-slate-900 rounded mb-2">Try now</h1>
    <?php 
    
        $query="SELECT * FROM products
        INNER JOIN
        seller
        ON
        products.seller_id=seller.sellid
        WHERE
        FLOOR(pincode/10)='$pin_mod'
        ";

        $result=$conn->query($query);
    // print_r($result);


    echo '<div class="flex w-4/5 mx-auto py-5 flex-wrap flex-row gap-6 p-x-3 bg-slate-300 items-center justify-around ">';
    
    foreach ($result as $row)
    {

        // $print_r($row);
        ?>    

<div class="shadow-sm flex items-center justify-center border-2 flex-col w-1/5 ">
    <a href=<?php echo "product.php?id=".$row['product_id']; ?>>
    <div class="max-w-xs rounded-md shadow-md bg-gray-900 text-gray-100">
	<img src="<?php echo $row['imgLink'] ?>" alt="" class="object-cover object-center w-full rounded-t-md h-36 bg-gray-500">
	<div class="flex flex-col justify-between p-6 space-y-8">
		<div class="space-y-2">
			<h2 class="text-xl font-semibold tracking-wide"><?php
        echo $row['product_name']." ".$row['shopname'];
        
        ?></h2>
			<p class="text-gray-100">₹<?php
        echo $row['product_price'];
        
        ?></p>
		</div>
		
	</div>
</div>

<form action="" method="POST">
        <button type="submit" name="ADD_TO_CART"  value="add_to_cart" class="flex items-center justify-center w-full p-3 font-semibold tracking-wide rounded-md  addtocart bg-violet-400 text-gray-900">add to cart</button>
        <input type="hidden" name="user" value=<?php echo $_SESSION['userId'];?> />
        <input type="hidden" name="product" value=<?php echo  $row['product_id']?> />
        <input type="hidden" name="seller_id" value=<?php echo  $row['seller_id']?> />


</form>


    </a>


</div>



     <?php 
    }
    echo "</div>";
    ?>

    </nav>
</body>
</html>