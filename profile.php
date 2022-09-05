<?php 
error_reporting(0);
include("config.php");


// print_r($_SESSION['user_data']);


$curr_user=$_SESSION['user_data'];



?>



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
require("./components/Navbar.php");
?>
<body  class="flex flex-col items-center justify-start h-screen bg-gray-900 w-screen gap-y-32">
  
<form action="" method="POST" class="flex flex-col max-w-md gap-3 p-6 rounded-md shadow-md bg-white dark:text-gray-100">
    <input type="text" placeholder="Enter your name" value=<?php echo $curr_user[1] ?> name="buyername"/>
    <input type="number" placeholder="Enter your number" name="buyernumber" value=<?php echo $curr_user[2] ?> />
    <input type="text" placeholder="Enter your email" name="buyeremail" value=<?php echo $curr_user[3] ?> />
    <input type="number" placeholder="Enter your pincode" name="buyerpin" value=<?php echo $curr_user[5] ?> />
    <input type="text" placeholder="Enter your address" name="buyeraddress" value=<?php echo $curr_user[4] ?> />
    <button type="submit" name="signup" value="submit" class="px-6 py-2 rounded-sm shadow-sm bg-violet-400 text-gray-900">edit&submit</button>

  </form>


</body>
</html>