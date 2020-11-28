



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/index.css" />
    <title>booknearyou.com</title>
</head>

<body>
    <?php
    require "partials/_dbconnect.php";
    session_start();
        
        include "partials/_navbar.php";
        $book_id = $_GET['book_id'];
        $book_details_query = "Select * from  book_details where book_id = $book_id";
        $book_details_query_result = mysqli_query($conn, $book_details_query);
        while($row = mysqli_fetch_assoc($book_details_query_result)){
            $book_name = $row['book_name'];
            $book_publisher = $row['book_publisher'];
            $book_price = $row['book_price'];
            $book_description = $row['book_description'];
            $book_image_id = $row['book_image_id'];
            $book_applied_date = $row['book_applied_date'];
        $book_image_location_query = "Select * from book_images where book_image_id = $book_image_id";
        $book_image_location_query_result = mysqli_query($conn,$book_image_location_query);
        while($row1 = mysqli_fetch_assoc($book_image_location_query_result)){
            $book_image_location = $row1['book_image_location'];
            }
        }
        

        echo '
        <div class="container">
            <div class="m-5 p-1">
                <div class="card mb-3" style="max-width: 740px;">
                    <div class="row no-gutters">
                      <div class="col-md-4 ">
                        <img src="'. $book_image_location .'" width="500px" class="card-img" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">'.$book_name.'-'.$book_publisher.'</h5>
                          <p class="card-text">'.$book_description.'</p>
                          <p class="card-text"><small class="text-muted">Book available from - '.substr($book_applied_date,0,10).'</small></p>
                          <form action="/bookstore/productgateway.php" method="post">
                          <button class="btn btn-primary" type="submit" name="buyBtn" id="buyBtn" value="'.$book_id.'">
                              BUY
                          </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
        

        
        ';


    ?>







    <!-- <div class="footer"></div> -->
    <?php require "partials/_footer.php"; ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->

    <!-- <script>
        let buyBtn  = document.getElementById("buyBtn");
        Array.from(buyBtn).forEach(element)=>{
            element.addEventListener("click",(e)=>{

            })
        }
    </script> -->
</body>

</html>