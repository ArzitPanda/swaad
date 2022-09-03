<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php 
include("config.php");


if(isset($_POST['signup']))                                                                                                                                                                                                                                                           
{

$name=$_POST['buyername'];
$number=$_POST['buyernumber'];
$email=$_POST['buyeremail'];
$pin=$_POST['buyerpin'];
$address=$_POST['buyeraddress'];
$img="hello world";

$insert_q="INSERT INTO `buyer`(`buyername`,`buyerNumber`,`buyerEmail`,`buyerImg`,`buyerPin`,`buyerAdd`) VALUES ('$name','$number','$email','$img','$pin','$address')";

$result= $conn->query($insert_q);


if($result==TRUE)
{
    echo "ENTER SUCESSFULLY";
    $_SESSION['user_pin']=$pin;
    echo $_SESSION['user_pin'];
}
else
{
    echo "err";
}




}
if(isset($_POST['login']))
{
    $number=$_POST['buyernumber'];

    $user="SELECT * FROM swaad.buyer
    WHERE
    buyerNumber='$number'
    
    ";
$res=mysqli_query($conn,$user);
$result_obj= mysqli_fetch_row($res);
$_SESSION['userId']=$result_obj[0];
echo $_SESSION['userId'];
$_SESSION['userPin']=$result_obj[5];
$_SESSION['user_data']=$result_obj;
?>
<script>
    window.location.assign("index.php")
</script>


<?php
}

?>
<body>
    <div id="signup_div">
  <form action="" method="POST">
    <input type="text" placeholder="Enter your name" name="buyername"/>
    <input type="number" placeholder="Enter your number" name="buyernumber"/>
    <input type="text" placeholder="Enter your email" name="buyeremail"/>
    <input type="number" placeholder="Enter your pincode" name="buyerpin"/>
    <input type="text" placeholder="Enter your address" name="buyeraddress"/>
    <button type="submit" name="signup" value="submit">sign up</button>

  </form>
  <button id="login">already account</button>
  </div>
  
  <div id="login_div">
  <form action="" method="POST">
  

  <input type="number" placeholder="Enter your number" name="buyernumber"/>

    <button type="submit" name="login" value="login">login</button>

  </form>
  <button id="signup">create an account</button>
  </div>
  
  
   
</body>
<script>
const login= document.getElementById("login");
const signup= document.getElementById("signup");
const login_div= document.getElementById("login_div");
const signup_div= document.getElementById("signup_div");
login_div.style.display="none";
signup_div.style.display="block";




login.addEventListener('click',()=>{
    login_div.style.display="block";
    signup_div.style.display="none";

})


signup.addEventListener('click',()=>{

    login_div.style.display="none";
    signup_div.style.display="block";


})

</script>
</html>