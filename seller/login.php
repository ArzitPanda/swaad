<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
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


if(isset($_POST['signup']))
{
    
    // $seller_id=(int)$_POST['seller_id'];
    $shop_name=$_POST['shop_name'];
    $shop_add=$_POST['shop_add'];
    $shop_pin=$_POST['shop_pin'];
    $shop_name_owner=$_POST['shop_name_owner'];
    $shop_email=$_POST['shop_email'];

 $sql = "INSERT INTO `seller`(`shopname`,`fulladd`,`pincode`,`seller_name`,`seller_email`) VALUES ('$shop_name','$shop_add','$shop_pin','$shop_name_owner','$shop_email')";

 $result = $conn->query($sql);

    if ($result == TRUE) {

      echo "New record created successfully.";

$sql2="SELECT sellid FROM swaad.seller
WHERE swaad.seller.seller_email='$shop_email'";



$res=mysqli_query($conn,$sql2);
$value= mysqli_fetch_all($res);





$_SESSION['user'] =$value[0][0];

echo "session: " . $_SESSION['user'] ;





    }else{

      echo "Error:". $sql . "<br>". $conn->error;

    } 




}


if(isset($_POST['login']))
{

$email=$_POST['shop_email'];
$sql_q= "SELECT * FROM SELLER WHERE seller_email='$email'";
$res=mysqli_query($conn,$sql_q);
$seller=mysqli_fetch_object($res);


print_r($seller);

$_SESSION['user'] =$seller->sellid;
header("seller.php",true);
}



?>


        <form action="" method="POST">

                <input type="text" name="shop_name" placeholder="enter your shop name"></input>
                <input type="text" name="shop_add" placeholder="enter your shop full address"></input>
                <input type="number" name="shop_pin" placeholder="enter your shop pincode"></input>
                <input type="text" name="shop_name_owner" placeholder="enter your name"></input>
                <input type="text" name="shop_email" placeholder="enter your email"></input>
                    <button type="submit" name="signup" value="submit">sign up</button>


        </form>


        <form action="" method="post" >


        <input type="text" name="shop_email" placeholder="enter your email"></input>

        <button type="submit" name="login" value="login">login</button>



        </form>



</body>


</html>