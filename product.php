<?php 
include("config.php");
// echo $_SERVER['REQUEST_URI'];
$url= $_SERVER['REQUEST_URI'];

$urlcomp= parse_url($url,PHP_URL_QUERY);


parse_str($urlcomp,$parse);
// print_r($parse);

echo $parse['id'];

$product_id= $parse['id'];

$product_query="SELECT * FROM products WHERE product_id='$product_id'";


$mod_query=mysqli_query($conn,$product_query);

$res= mysqli_fetch_object($mod_query);





var_dump($res);



if(isset($_POST['visit'])) {

echo "hello world";
echo $_POST['product'];


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
    <?php 


echo $_SESSION['userId'];
            echo $res->product_name;
    
    
    
    ?>

    
    <div>
</body>
</html>