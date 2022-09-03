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






?>


    <nav>
        <div class="flex items-center justify-between w-1/5">
            <svg class="w-10 h-10 object-contain" viewBox="0 0 559 825" height="49" width="34" fill="#fc8019"><path fill-rule="evenodd" clip-rule="evenodd" d="M542.92 388.542C546.805 366.526 542.355 349.598 530.881 340.76C513.621 327.466 487.698 320.236 425.954 320.236C380.271 320.236 331.225 320.286 310.268 320.275C308.322 319.894 301.285 317.604 301.02 309.112L300.734 174.289C300.727 165.779 307.531 158.857 315.943 158.839C324.369 158.825 331.204 165.723 331.211 174.226C331.211 174.226 331.421 247.414 331.441 273.424C331.441 275.936 332.892 281.8 338.549 283.328C375.43 293.267 561.865 285.999 558.967 251.804C543.147 109.96 424.476 0 280.394 0C235.021 0 192.065 10.9162 154.026 30.2754C62.9934 77.5955 -1.65904 173.107 0.0324268 283.43C1.23215 361.622 52.2203 500.605 83.434 521.234C97.8202 530.749 116.765 527.228 201.484 527.228C239.903 527.228 275.679 527.355 293.26 527.436C295.087 527.782 304.671 530.001 304.671 538.907L304.894 641.393C304.915 649.907 298.104 656.826 289.678 656.829C281.266 656.843 274.434 649.953 274.42 641.446C274.42 641.446 275.17 600.322 275.17 584.985C275.17 581.435 275.424 575.339 265.178 570.727C231.432 555.553 121.849 564.712 115.701 581.457C113.347 587.899 125.599 612.801 144.459 644.731C170.102 685.624 211.889 747.245 245.601 792.625C261.047 813.417 268.77 823.813 280.467 824.101C292.165 824.389 300.514 814.236 317.213 793.928C383.012 713.909 516.552 537.663 542.92 388.542Z" fill="url(#paint0_linear_19447_66107)"></path><defs><linearGradient id="paint0_linear_19447_66107" x1="445.629" y1="63.8626" x2="160.773" y2="537.598" gradientUnits="userSpaceOnUse"><stop stop-color="#FF993A"></stop><stop offset="1" stop-color="#F15700"></stop></linearGradient></defs></svg>
            <div class="flex text-3xl items-center">your address</div>
    </div>
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
    foreach ($result as $row)
    {
        ?>    

<div class="shadow-sm flex items-center justify-center border-2 flex-col">
    <a href=<?php echo "product.php?id=".$row['product_id']; ?>>
<div>
        <?php
        echo $row['product_name'];
        
        ?>
</div>

<div>
        <?php
        echo $row['product_price'];
        
        ?>
</div>

<div>
        <?php
        echo $row['shopname'];
        
        ?>
</div>

<form action="" method="POST">
        <button type="submit" name="ADD_TO_CART" value="add_to_cart" class="bg-slate-800 text-white">add to cart</button>
        <input type="hidden" name="user" value=<?php echo $_SESSION['userId'];?> />
        <input type="hidden" name="product" value=<?php echo  $row['product_id']?> />
        <input type="hidden" name="seller_id" value=<?php echo  $row['seller_id']?> />


</form>
<form action="product.php" method="POST">
        <button type="submit" name="visit" value="add_to_cart" class="bg-red-800 text-white">visit</button>
        <input type="hidden" name="user" value=<?php echo $_SESSION['userId'];?> />
        <input type="hidden" name="product" value=<?php echo  $row['product_id']?> />
        <input type="hidden" name="seller_id" value=<?php echo  $row['seller_id']?> />


</form>

    </a>


</div>



     <?php 
    }
    ?>

    </nav>
</body>
</html>