<!-- insert book query -->
<!-- INSERT INTO `book_details` (`book_id`, `user_id`, `book_name`, `book_publisher`, `book_category_id`, `book_price`, `book_description`, `book_image`, `book_applied_date`) VALUES (NULL, '1', 'The Fountainhead', 'Red books', '8', '300', 'famous novel by ayn rand', 0xffd8ffe000104a46494600010100000100010000fffe001f436f6d70726573736564206279206a7065672d7265636f6d7072657373ffdb008400020202020202030303030404030404050504040505080606060606080c0709070709070c0b0d0a0a0a0d0b130f0d0d0f1316121112161a18181a2120212c2c3b01020202020202030303030404030404050504040505080606060606080c0709070709070c0b0d0a0a0a0d0b130f0d0d0f1316121112161a18181a2120212c2c3bffc2001108011600b903012200021101031101ffc4001e0000000603010100000000000000000000000506070809010204030affda0008010100000000acf000000000000000000f2744b7cfc3979bd47aedd9aefebb7b8f23f683618d1e73ae0e44bedd40d0acbbbbbf732d36f4dd8edc63b6436e56e6b9301d7f69b5efe761b52f67ec0b2d65d53bc0af8e7e98cf6483ef61e73b8f1aa227d144143c3fa9bb6c9395477c7f366b2398adbe71eb225651d2d01ae7[...] -->


<?php

  require "partials/_dbconnect.php";
  session_start();

  // $servername = "localhost";
  // $username = "root";
  // $password   = "";
  // $database = "bookstore";

  // $conn = mysqli_connect($servername,$username,$password,$database);

  // if(!$conn){
  //   die("sorry we failed to provide you information ". mysqli_connect_error());
  // }else{
  //   session_start();
  //   echo var_dump($_SESSION['user_id']);
  // }

  if(isset($_SESSION['loggedin']) || (($_SESSION['loggedin'])!=false)){
    
  }else{
    echo"security bug";
    header("location:/bookstore/loginsystem/loginpage.php");
    exit;
  }

  // if ($_SERVER['REQUEST_METHOD']=='POST'){
  if (isset($_POST['submit'])){


    $bookname = $_POST["bookname"];
    $userid = $_SESSION["user_id"];
    $bookpublisher= $_POST["publisher"];
    $price= $_POST["price"];
    $bookcategoryid = $_POST["bookcategory"];
    // $getbookcategorynamequery = "select book_category_name from book_category where book_category_id = '$bookcategoryid';";
    // $bookcategoryid= mysqli_query($conn,$getbookcategoryidquery);
    // $bookimage= $_POST['uploadimage'];
    // $bookimage= file_get_contents($_FILES[$_POST['bookcategory']]['tmp_name']);
    $description = $_POST['bookdescription'];


    $image = $_FILES['uploadimage'];
    $image_name = $_FILES['uploadimage']['name'];
    $image_temp = $_FILES['uploadimage']['tmp_name'];
    $image_size = $_FILES['uploadimage']['size'];
    $image_error = $_FILES['uploadimage']['error'];
    $image_type = $_FILES['uploadimage']['type'];

    $image_ext = explode('.',$image_name);
    $image_ext_actual = strtolower(end($image_ext));
    $allowed_image_format = array('jpeg','jpg','png');

    $image_newname;
    $image_destination;
    $bookimageid;

    if(in_array($image_ext_actual,$allowed_image_format)){
      if($image_error === 0){
        if($image_size<50000){
          $image_newname = uniqid('',true).".".$image_ext_actual;
          $image_destination = 'assets/images/'.$image_newname;


          $bookimagesql = "INSERT INTO book_images (book_image_name, book_image_display_name, book_image_extension,book_image_size,book_image_Location) VALUES ('$image_newname','$image_name','$image_ext_actual', '$image_size','$image_destination')";
          $bookinsertion_result = mysqli_query($conn, $bookimagesql);
      
          // if($bookinsertion_result){
            
            $getbookimageid = "select book_image_id from book_images where book_image_name = '$image_newname' and book_image_location = '$image_destination'; ";
            $getbookimageidresult = mysqli_query($conn,$getbookimageid);
                        while($row=mysqli_fetch_assoc($getbookimageidresult)){
      
                          $bookimageid = $row['book_image_id']; 
              
            }
            echo "$bookimageid";
            echo "$bookcategoryid";
            // echo "$getbookcategoryidquery";
      
                  // inserting query
                  $sql = "insert into book_details (user_id,book_name,book_publisher,book_price,book_category_id,book_image_id,book_description) values ('$userid','$bookname','$bookpublisher','$price','$bookcategoryid','$bookimageid','$description');";
                  $insertresult = mysqli_query($conn,$sql);
                  if($insertresult){
                    echo "submitted successfully";
                  }else{
                    echo "submission failure";
                  }




          move_uploaded_file($image_temp,$image_destination);
          
        }else{
          echo "image file should be less then 10MB";
        }

      }else{
        echo "There was some error uploading the image";
      }
    }else{
      echo "invalid image format";
    }



    // }
    
      


  }



  // edit book details

  if(isset($_POST["edit"])){

    $bookidEdit = $_POST["bookidEdit"];

    $bookname = $_POST["booknameEdit"];
    $userid = $_SESSION["user_id"];
    $bookpublisher= $_POST["publisherEdit"];
    $price= $_POST["priceEdit"];
    $bookcategoryid = $_POST["bookcategoryEdit"];
    // $getbookcategorynamequery = "select book_category_name from book_category where book_category_id = '$bookcategoryid';";
    // $bookcategoryid= mysqli_query($conn,$getbookcategoryidquery);
    // $bookimage= $_POST['uploadimage'];
    // $bookimage= file_get_contents($_FILES[$_POST['bookcategory']]['tmp_name']);
    $description = $_POST['bookdescriptionEdit'];


    $image = $_FILES['uploadimageEdit'];
    $image_name = $_FILES['uploadimageEdit']['name'];
    $image_temp = $_FILES['uploadimageEdit']['tmp_name'];
    $image_size = $_FILES['uploadimageEdit']['size'];
    $image_error = $_FILES['uploadimageEdit']['error'];
    $image_type = $_FILES['uploadimageEdit']['type'];

    $image_ext = explode('.',$image_name);
    $image_ext_actual = strtolower(end($image_ext));
    $allowed_image_format = array('jpeg','jpg','png');

    $image_newname;
    $image_destination;
    $bookimageid;

    $getoldimagedetailsquery = "Select * from book_image INNER JOIN book_details where book_details.book_id = $bookidEdit ";
    $resultgetoldimagedetailsquery = mysqli_query($conn,$getoldimagedetailsquery);
    

    if(in_array($image_ext_actual,$allowed_image_format)){
      if($image_error === 0){
        if($image_size<50000){
          $image_newname = uniqid('',true).".".$image_ext_actual;
          $image_destination = 'assets/images/'.$image_newname;


          $bookimagesql = "INSERT INTO book_images (book_image_name, book_image_display_name, book_image_extension,book_image_size,book_image_Location) VALUES ('$image_newname','$image_name','$image_ext_actual', '$image_size','$image_destination')";
          $bookinsertion_result = mysqli_query($conn, $bookimagesql);
      
          // if($bookinsertion_result){
            
            $getbookimageid = "select book_image_id from book_images where book_image_name = '$image_newname' and book_image_location = '$image_destination'; ";
            $getbookimageidresult = mysqli_query($conn,$getbookimageid);
                        while($row=mysqli_fetch_assoc($getbookimageidresult)){
      
                          $bookimageid = $row['book_image_id']; 
              
            }
            echo "$bookimageid";
            echo "$bookcategoryid";
            // echo "$getbookcategoryidquery";
      
                  // inserting query
                  $sql = "insert into book_details (user_id,book_name,book_publisher,book_price,book_category_id,book_image_id,book_description) values ('$userid','$bookname','$bookpublisher','$price','$bookcategoryid','$bookimageid','$description');";
                  $insertresult = mysqli_query($conn,$sql);
                  if($insertresult){
                    echo "updated successfully";
                  }else{
                    echo "updation failure";
                  }




          move_uploaded_file($image_temp,$image_destination);
          
        }else{
          echo "image file should be less then 10MB";
        }

      }else{
        echo "There was some error uploading the image";
      }
    }else{
      echo "invalid image format";
    }
    
  }





?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />

  <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

  <title>Seller Account</title>
</head>

<body>
  <?php
        require "partials/_navbar.php";
  ?>




          <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
          Launch demo modal
        </button> -->

        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit book info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="/bookstore/selleraccount.php" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="bookidEdit" id="bookidEdit">
                  <div class="form-group">
                    <label for="booknameEdit">Book Name</label>
                    <input type="text" class="form-control" id="booknameEdit" name="booknameEdit" aria-describedby="booknameEdit">
                  </div>
                  <div class="form-group">
                    <label for="publisherEdit">Publisher</label>
                    <input type="text" class="form-control" id="publisherEdit" name="publisherEdit" aria-describedby="publisherEdit>
                  </div>
                  <div class=" form-group col-lg-3">
                    <label for="priceEdit">Price</label>
                    <input type="number" class="form-control" id="priceEdit" name="priceEdit" aria-describedby="priceEdit>
                  </div>
            
                  <div class=" input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="bookcategoryEdit">Choose Category</label>
                    </div>
                    <select class="custom-select" id="bookcategoryEdit" name="bookcategoryEdit">
            
                      <?php
                      $query = "SELECT * FROM `book_category`";
                      $result = mysqli_query($conn,$query);
                      if($result){
                      //  echo "<option value=".$row['book_category_id']." selected>Choose...</option>";
                        while($row=mysqli_fetch_assoc($result)){
                          
                          echo "<option value=". $row['book_category_id'] ." selected>". $row['book_category_name'] ."</option>";
                        }
                      }else{
                        echo "some issues in loading book categories";
                      }
                    
            
                      ?>
            
                    </select>
                  </div>
            
            
                  <div class="form-group">
                    <label for="uploadimageEdit">Upload Book Image</label>
                    <input type="file" class="form-control-file" id="uploadimageEdit" name="uploadimageEdit">
                  </div>
                  <div class="form-group">
                    <label for="bookdescriptionEdit">Book Description</label>
                    <textarea class="form-control" id="bookdescriptionEdit" name="bookdescriptionEdit" rows="3"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary" name="edit" value="edit">Edit</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>


  <div class="conatiner my-4 mx-4">


    <div class="py-1">
      <h2>Add New Book</h2>
    </div>
    <form action="/bookstore/selleraccount.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="bookname">Book Name</label>
        <input type="text" class="form-control" id="bookname" name="bookname" aria-describedby="bookname">
      </div>
      <div class="form-group">
        <label for="publisher">Publisher</label>
        <input type="text" class="form-control" id="publisher" name="publisher" aria-describedby="publisher>
      </div>
      <div class=" form-group col-lg-3">
        <label for="price">Price</label>
        <input type="number" class="form-control" id="price" name="price" aria-describedby="price>
      </div>

      <div class=" input-group mb-3">
        <div class="input-group-prepend">
          <label class="input-group-text" for="bookcategory">Choose Category</label>
        </div>
        <select class="custom-select" id="bookcategory" name="bookcategory">

          <?php
          $query = "SELECT * FROM `book_category`";
          $result = mysqli_query($conn,$query);
          if($result){
           echo "<option selected>Choose...</option>";
            while($row=mysqli_fetch_assoc($result)){
              
              echo "<option value=". $row['book_category_id'] .">". $row['book_category_name'] ."</option>";
            }
          }else{
            echo "some issues in loading book categories";
          }
        

          ?>

        </select>
      </div>


      <div class="form-group">
        <label for="uploadimage">Upload Book Image</label>
        <input type="file" class="form-control-file" id="uploadimage" name="uploadimage">
      </div>
      <div class="form-group">
        <label for="bookdescription">Book Description</label>
        <textarea class="form-control" id="bookdescription" name="bookdescription" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
    </form>
  </div>


  <div class="container">
    <table class="table table-hover" id="myTable">
      <thead>
        <tr>
          <th scope="col">BookName</th>
          <th scope="col">Publisher</th>
          <th scope="col">Category</th>
          <th scope="col">Price</th>
          <th scope="col">Image</th>
          <th scope="col">Date uploaded</th>
          <th scope="col">Description</th>
          <th scope="col">Action</th>
        </tr>
      </thead>

      <tbody>
        <?php

        $sql = "SELECT book_details.book_name, book_details.book_id, book_details.book_publisher, book_category.book_category_name, book_details.book_price, book_images.book_image_location, book_images.book_image_display_name, book_images.book_image_name, book_details.book_description,book_details.book_applied_date from book_details INNER JOIN book_category on book_details.book_category_id = book_category.book_category_id INNER JOIN book_images on book_details.book_image_id = book_images.book_image_id where book_details.user_id = '{$_SESSION['user_id']}';";
        $result = mysqli_query($conn,$sql); 
        if (mysqli_num_rows($result) > 0) { 
        while ($row= mysqli_fetch_assoc($result)) {
          echo" 
            <tr>
              <td>". $row['book_name'] ."</td>
              <td>". $row['book_publisher'] ."</td>
              <td>". $row['book_category_name'] ."</td>
              <td>". $row['book_price'] ."</td>
              <td><a href='".$row['book_image_location']."' target= '_blank'>".$row['book_image_display_name']."</a></td>
              <td>". $row['book_applied_date'] ."</td>
              <td>". $row['book_description'] ."</td>
              <td><button class='btn btn-sm btn-primary edit' id= ". $row['book_id'] .">Edit</button> <a href='/delete' class='delete'>Delete</a></td>
              
            </tr>
          ";
        }
      }
    ?>
    
      </tbody>
    </table>
  </div>









  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
    crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script>
      $(document).ready( function () {
        $('#myTable').DataTable();
    } );
    </script>

    <script>
      let edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element)=>{
        element.addEventListener("click",(e)=>{
          tr = e.target.parentNode.parentNode;
          console.log(tr);
          bookname = tr.getElementsByTagName("td")[0].innerText;
          publisher = tr.getElementsByTagName("td")[1].innerText;
          category = tr.getElementsByTagName("td")[2].innerText;
          
          price = tr.getElementsByTagName("td")[3].innerText;
          book_image =  tr.getElementsByTagName("td")[4].innerText;
          description = tr.getElementsByTagName("td")[6].innerText;
          bookidEdit = e.target.id;
          console.log(e.target.id);

          booknameEdit.value = bookname;
          publisherEdit.value = publisher;
          bookcategoryEdit.value = category;
          priceEdit.value = price;
          bookdescriptionEdit.value = description;
          // uploadimageEdit.value = book_image;
          $('#editModal').modal('toggle');
        })
      })
    </script>
</body>

</html>