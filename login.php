<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<?php
 //

error_reporting(0);
include("config.php");
$_SESSION['userId']=NULL;
$_SESSION['userPin']=NULL;
$_SESSION['user_data']=NULL;

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

<body class="flex flex-col items-center justify-start h-screen bg-gray-900 w-screen gap-y-32">
<?php
require('./components/Navbar.php');

?>

    <div id="signup_div">
  
  <form action="" method="POST" class="flex flex-col max-w-md gap-3 p-6 rounded-md shadow-md bg-white dark:text-gray-100">
    <input type="text" placeholder="Enter your name" name="buyername"/>
    <input type="number" placeholder="Enter your number" name="buyernumber"/>
    <input type="text" placeholder="Enter your email" name="buyeremail"/>
    <input type="number" placeholder="Enter your pincode" name="buyerpin"/>
    <input type="text" placeholder="Enter your address" name="buyeraddress"/>
    <button type="submit" name="signup" value="submit" class="px-6 py-2 rounded-sm shadow-sm bg-violet-400 text-gray-900">sign up</button>

  </form>

  <button id="login" class="text-white ">already account</button>
  </div>
  
  <div id="login_div">
  <form action="" method="POST" class="flex flex-col max-w-md gap-3 p-6 rounded-md shadow-md bg-white dark:text-gray-100">
  

  <input type="number" placeholder="Enter your number" name="buyernumber"/>

    <button type="submit" name="login" value="login" class="px-6 py-2 rounded-sm shadow-sm bg-violet-400 text-gray-900">login</button>

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