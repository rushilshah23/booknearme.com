<?php

if(isset($_SESSION['loggedin']) || (($_SESSION['loggedin'])!=false) && ($_SESSION['accountType']==1)){
    
}else{
  echo"security bug";
  // header("location:/bookstore/loginsystem/loginpage.php");
  header("location:/bookstore/index.php");

  exit;
}
?>

