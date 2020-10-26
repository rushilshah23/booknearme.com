<?php
    $successalert = false;
    $failurealert = false;
    $failure_error = "";

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
            if($password == $cpassword && $exists==false){
                if(strlen($phoneNo)==10){
                    $createuser_query = "insert into seller_details (user_email,user_password,user_phone_no,user_fname,user_lname,user_location,user_university) values ('$email','$password','$phoneNo','$firstName','$lastName','$location','$university');";
                    $createuser_query_result = mysqli_query($conn,$createuser_query);
                    if($createuser_query_result){
                        $successalert = true;
                    }else{
                        $failurealert = true;
                        $failure_error = "Something went wrong while creating user";
                    }
                }else{
                    $failurealert = true;
                    $failure_error = "enter valid phone no";
                }
            }else{
                $failurealert = true;
                $failure_error = "passwords didn't matched";
             
            }

        }


    // }
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>
<body>
    <?php
    
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

</body>
</html>