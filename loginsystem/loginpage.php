<?php
    $successalert = false;
    $failurealert = false;
    $failure_error = "";

    // if($_SERVER["REQUEST_METHOD"]=="POST"){

        if(isset($_POST['loginsubmit'])){
            require '../partials/_dbconnect.php';
            
            $accountType = $_POST["accountType"];
            $email = $_POST["email"];
            $password = $_POST["password"];


            if($accountType==2){

                $loginuser_query = "select * from seller_details where user_email = '$email'";
                $loginuser_query_result = mysqli_query($conn,$loginuser_query);
                $num = mysqli_num_rows($loginuser_query_result);
                if($num == 1){
                    while($row = mysqli_fetch_assoc($loginuser_query_result)){
                        if(password_verify($password,$row['user_password'])){
                            $successalert = true;
                            $userid_query = "select user_id from seller_details where user_email = '$email'";
                            $userid_query_result = mysqli_query($conn,$userid_query);
                            if($userid_query_result!=false){
                                $user_details = mysqli_fetch_array($userid_query_result);
                                session_start();
                                $_SESSION['loggedin'] = true;
                                $_SESSION['email'] = $email;
                                $_SESSION['user_id'] = $user_details['user_id'];
                                $_SESSION['accountType'] = $accountType;
                                header("location:../selleraccount.php");
                            }else{
                                $failurealert = true;
                                $failure_error = "fail to receive user id";
                            }

                        }else{
                            $failurealert = true;
                            $failure_error = "invalid credentials";
                        }
                    }


                }
                else{
                    $failurealert = true;
                    $failure_error = "invalid credentials";
                }

            }else if($accountType==1){


                $loginuser_query = "select * from buyer_details where user_email = '$email'";
                $loginuser_query_result = mysqli_query($conn,$loginuser_query);
                $num = mysqli_num_rows($loginuser_query_result);
                if($num == 1){
                    while($row = mysqli_fetch_assoc($loginuser_query_result)){
                        if(password_verify($password,$row['user_password'])){
                            $successalert = true;
                            $userid_query = "select user_id from buyer_details where user_email = '$email'";
                            $userid_query_result = mysqli_query($conn,$userid_query);
                            if($userid_query_result!=false){
                                $user_details = mysqli_fetch_array($userid_query_result);
                                session_start();
                                $_SESSION['loggedin'] = true;
                                $_SESSION['email'] = $email;
                                $_SESSION['user_id'] = $user_details['user_id'];
                                $_SESSION['accountType'] = $accountType;
                                header("location:../buyeraccount.php");
                            }else{
                                $failurealert = true;
                                $failure_error = "fail to receive user id";
                            }

                        }else{
                            $failurealert = true;
                            $failure_error = "invalid credentials";
                        }
                    }


                }
                else{
                    $failurealert = true;
                    $failure_error = "invalid credentials";
                }
            }else if($accountType==3){
                $loginuser_query = "select * from seller_details where user_email = '$email'";
                $loginuser_query_result = mysqli_query($conn,$loginuser_query);
                $num = mysqli_num_rows($loginuser_query_result);
                if($num == 1){
                    while($row = mysqli_fetch_assoc($loginuser_query_result)){
                        if(password_verify($password,$row['user_password'])){
                            $successalert = true;
                            $userid_query = "select user_id from seller_details where user_email = '$email'";
                            $userid_query_result = mysqli_query($conn,$userid_query);
                            if($userid_query_result!=false){
                                $user_details = mysqli_fetch_array($userid_query_result);
                                session_start();
                                $_SESSION['loggedin'] = true;
                                $_SESSION['email'] = $email;
                                $_SESSION['user_id'] = $user_details['user_id'];
                                // $_SESSION['accountType'] = $accountType;
                                $_SESSION['accountType'] = $user_details['accountType'];

                                header("location:../adminpanel.php");
                            }else{
                                $failurealert = true;
                                $failure_error = "fail to receive user id";
                            }

                        }else{
                            $failurealert = true;
                            $failure_error = "invalid credentials";
                        }
                    }


                }
                else{
                    $failurealert = true;
                    $failure_error = "invalid credentials";
                }
            }

      
        


 

        }


    // }
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
     <title>Login Page</title>
</head>
<body>
    <?php
    $thispage = "login";
    
        require '../partials/_navbar.php';
    ?>

    <?php
        if($successalert){
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congratulations</strong> Login successful
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ';

        }
        if($failurealert){
            echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Error</strong> '. $failure_error .'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ';


        }

    ?>





    <h1 class = "text-center p-2">Login</h1>
    <div class="container">
    <form action = "/bookstore/loginsystem/loginpage.php" method="POST">

    <div class="input-group mb-3 col-md-6">
    <div class="input-group-prepend">
        <label class="input-group-text" for="accountType">Account Type</label>
    </div>
    <select class="custom-select" id="accountType" name="accountType">
        <option selected>Choose...</option>
        <option value="1" selected>Buyer</option>
        <option value="2">Seller</option>
        <option value="3">Admin</option>


    </select>
    </div>


    <div class="form-group col-md-6 ">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="email" name="email">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group col-md-6">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <button type="submit" class="btn btn-primary col-md-6" id = "loginsubmit" name = "loginsubmit">Log in</button>
    </form>
    </div>


            <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>
</html>