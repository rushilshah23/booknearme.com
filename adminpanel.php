<?php

  $servername = "localhost";
  $username = "root";
  $password   = "";
  $database = "bookstore";

  $verified = false;
  $rejected = false;

  $conn = mysqli_connect($servername,$username,$password,$database);

  if(!$conn){
    die("sorry we failed to provide you information ". mysqli_connect_error());
  }else{
    echo  "connection successful";
  }


  if(isset($_GET['verified'])){
    $book_id = $_GET['verified'];
    $verify_sql = "Update  book_details set verifiedstatus = 'verified' where book_id = $book_id";
    $verify_result = mysqli_query($conn,$verify_sql);
  }

  if(isset($_GET['rejected'])){
    $book_id = $_GET['rejected'];
    $reject_sql = "Update  book_details set verifiedstatus = 'rejected' where book_id = $book_id";
    $reject_result = mysqli_query($conn,$reject_sql);
  }

  


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
      <table class="table table-hover" id="myTable">
        <thead>
          <tr>
            <th scope="col">Email-ID</th>
            <th scope="col">BookName</th>
            <th scope="col">Price</th>
            <th scope="col">Description</th>
            <th scope="col">image</th>
            <th scope="col">Category</th>
            <th scope="col">Allow</th>
          </tr>
        </thead>
        <tbody>
      
              <?php
                $query = "SELECT bd.*,sd.user_email,bc.book_category_name,bi.* from book_details bd INNER JOIN seller_details sd on bd.user_id=sd.user_id INNER JOIN book_category bc on bd.book_category_id = bc.book_category_id INNER JOIN book_images bi on bd.book_image_id = bi.book_image_id WHERE bd.verifiedstatus = 'pending' ORDER BY bd.book_applied_date;";
                $result = mysqli_query($conn,$query);
                if($result){
                 
                  while($row=mysqli_fetch_assoc($result)){
                    
                    echo "
                    <tr>
                      <th scope='row'>". $row['user_email']."</th>
                      <td>". $row['book_name']."</td>
                      <td>". $row['book_price']."</td>
                      <td>". $row['book_description']."</td>
                      <td><a href=". $row['book_image_location']." target='_blank'>". $row['book_image_display_name'] ."</a></td>
                      <td>". $row['book_category_name']."</td>
                      <td><button class='btn btn-sm btn-primary verified' id=v". $row['book_id'] ." name='verified'>Yes</button> <button class='btn btn-sm btn-primary rejected' id=r". $row['book_id'] ." name='reject'>No</button></td>
      
                    </tr>
                    ";
                  }
                }else{
                  echo "some issues in loading book categories";
                }
              
      
                ?>
      
        </tbody>
      </table>
    </div>




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script>
      $(document).ready( function () {
        $('#myTable').DataTable();
    } );
    </script>

    <script>
      verify = document.getElementsByClassName('verified');
      Array.from(verify).forEach((element)=>{
        element.addEventListener("click",(e)=>{
          book_id = e.target.id.substr(1,);
          console.log(book_id);
          if(confirm("Do you want to verify this book?")){
            window.location = `/bookstore/adminpanel.php?verified=${book_id}`;
          }else{
            console.log("back");
          }

        })
      })


      reject = document.getElementsByClassName('rejected');
      Array.from(reject).forEach((element)=>{
        element.addEventListener("click",(e)=>{
          book_id = e.target.id.substr(1,);
          console.log(book_id);
          if(confirm("Do you want to reject this book?")){
            window.location = `/bookstore/adminpanel.php?rejected=${book_id}`;
          }else{
            console.log("back");
          }

        })
      })
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>