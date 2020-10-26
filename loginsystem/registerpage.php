<?php
    $successalert = false;
    $failurealert = false;
    $failure_error = "";
    $thispage = "registerpage";

    // if($_SERVER["REQUEST_METHOD"]=="POST"){

        if(isset($_POST['signupsubmit'])){
            require '../partials/_dbconnect.php';
  
            $email = $_POST["email"];
            $password = $_POST["password"];
            $cpassword = $_POST["cpassword"];
            $phoneNo = $_POST["phoneNo"];
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $location = $_POST["location"];
            $university = $_POST["university"];
            $exists = false;
            
            $exists_query = "select * from seller_details where user_email = '$email'";
            $exists_query_result = mysqli_query($conn,$exists_query);
            $exists_num = mysqli_num_rows($exists_query_result);
            if($exists_num > 0){
                $exists = true;
                $failurealert = true;
                $failure_error = "EmailId already exists";
               

            }

            else if($password == $cpassword && $exists==false){
                if(strlen($phoneNo)==10){
                    $password_hash = password_hash($password,PASSWORD_DEFAULT);
                    $createuser_query = "insert into seller_details (user_email,user_password,user_phone_no,user_fname,user_lname,user_location,user_university) values ('$email','$password_hash','$phoneNo','$firstName','$lastName','$location','$university');";
                    $createuser_query_result = mysqli_query($conn,$createuser_query);
                    if($createuser_query_result){
                        $successalert = true;
                        // header("location:/bookstore/loginsystem/loginpage.php");
                    }else{
                        $failurealert = true;
                        $failure_error = "Something went wrong while creating user";
                    }
                }else{
                    $failurealert = true;
                    $failure_error = "enter valid phone no";
                }
            }
            
            else{
                $failurealert = true;
                $failure_error = "passwords didn't matched";
             
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
     <title>Register Page</title>
</head>
<body>
    <?php

        $thispage = "register";
    
        require '../partials/_navbar.php';
    ?>

    <?php
        if($successalert){
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congratulations</strong> your account has been created and you can login
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





    <h1 class = "text-center p-2">Sign up as seller on booknearme.com</h1>
    <div class="container">
    <form action = "/bookstore/loginsystem/registerpage.php" method="POST">
    <div class="form-group col-md-6 ">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="email" name="email">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group col-md-6">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="form-group col-md-6">
        <label for="cpassword">Confirm Password</label>
        <input type="password" class="form-control" id="cpassword" name="cpassword">
    </div>
    <div class="form-group col-md-6">
        <label for="firstName">First Name</label>
        <input type="text" class="form-control" id="firstName" aria-describedby="firstName" name="firstName">
        
    </div>
    <div class="form-group col-md-6">
        <label for="lastName">Last Name</label>
        <input type="text" class="form-control" id="lastName" aria-describedby="lastName" name="lastName">
        
    </div>
    <div class="form-group col-md-6">
        <label for="phoneNo">PhoneNo</label>
        <input type="tel" class="form-control" id="phoneNo" name="phoneNo">
    </div>
    <div class="form-group col-md-6">
        <label for="location">Your Location</label>
        <input type="text" class="form-control" id="location" aria-describedby="location" name="location">
       
    </div>
    <div class="form-group col-md-6">
        <label for="university">University</label>
        <input type="text" class="form-control" id="university" aria-describedby="university" name="university">
        
    </div>

    <button type="submit" class="btn btn-primary col-md-6" id = "signupsubmit" name = "signupsubmit">Sign Up</button>
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