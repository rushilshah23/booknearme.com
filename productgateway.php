<?php
include "partials/_dbconnect.php";
session_start();
if(isset($_POST['buyBtn'])){
    
    $book_id = $_POST['buyBtn'];
    $buyer_id = $_SESSION['user_id'];
    if(isset($_SESSION['loggedin']) || (($_SESSION['loggedin'])!=false) && ($_SESSION['accountType']==1)){
            $order_query = "insert into order_details (buyer_id,book_id) values($buyer_id,$book_id);";
            $book_sell_query = "update book_details set soldstatus = 1 where book_id = $book_id";

            $order_query_result = mysqli_query($conn,$order_query);
            if($order_query_result){
                $book_sell_query_result = mysqli_query($conn,$book_sell_query);
                if($book_sell_query_result){
                    header("location:/bookstore/index.php");
                }else{
                    echo"there was an error while buying this item";
                }
            }
        
    }else{
      echo"security bug";
      header("location:/bookstore/loginsystem/loginpage.php");
      exit;
    }
    
}

?>