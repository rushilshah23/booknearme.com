<?php
    include "partials/_dbconnect.php";
    $thispage = "home";


    // <!-- fetch books from backend -->




?>

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
    session_start();
        require "partials/_navbar.php";
        $row;
        $fetch_books_query = "SELECT * from book_details INNER JOIN book_images on book_details.book_image_id = book_images.book_image_id where book_details.verifiedstatus = 'verified' and book_details.soldstatus = '0' ";

        $no_of_books;
        $no_of_slides;
        $fetch_books_query_result = mysqli_query($conn,$fetch_books_query);
        $no_of_books = mysqli_num_rows($fetch_books_query_result) ;
        $no_of_slides = ceil(($no_of_books/4) + ceil(($no_of_books/4) - ($no_of_books/4)));
      
        // while($row = mysqli_fetch_array($fetch_books_query_result,MYSQLI_ASSOC)){
        //     echo "<h1> ".$row['book_id']." - ". $row['book_name']."</h1>";
            
        //     //  $row['book_id'] ;
        // }
        echo "<h1> ".$no_of_books."</h1>";
        echo "<h1> ".$no_of_slides."</h1>";

        // $no_of_books  = $no_of_books -1;
    ?>

    <!-- Carousel -->
    <!-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="assets/pagemedia/books.jpg" alt="First slide" />
                <div class="carousel-caption d-none d-md-block">
                    <h5>Why to buy new book if you have one near you?</h5>
                    <p>Get books around your location or at your university</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="assets/pagemedia/books4.jpg" alt="Second slide" />
                <div class="carousel-caption d-none d-md-block">
                    <h5>Why to buy new book if you have one near you?</h5>
                    <p>Get books around your location or at your university</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="assets/pagemedia/book-bg.jpg" alt="Third slide" />
                <div class="carousel-caption d-none d-md-block">
                    <h5>Why to buy new book if you have one near you?</h5>
                    <p>Get books around your location or at your university</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div> -->






    <!-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://source.unsplash.com/2600x900/?bookstore,books" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://source.unsplash.com/2600x900/?reading,library" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://source.unsplash.com/2600x900/?novel,science,books" class="d-block w-100" alt="...">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div> -->



    <!-- End of carousel -->







    <h3 style="text-align: center; padding-top: 0.5rem">BOOKS NEAR YOU</h3>

    <?php
      $book_count = 0;
      $count = 1;




      echo "<div class='container carousel-inner no-padding'>";
        for($i=0;$i<$no_of_slides;$i++){
            echo "<div class='carousel-item "; if($i==0){echo " active'";} echo ">";
            // echo "<div class='carousel-item active>";

            for($j=0;$j<4;$j++){
                while($row = mysqli_fetch_array($fetch_books_query_result,MYSQLI_ASSOC)){
                
                if($book_count != $no_of_books){
                    echo "
                    <div class='col-xs-3 col-sm-3 col-md-3'>
                    <div class='card' style='width: 18rem'>
                      <img class='card-img-top' src=".$row['book_image_location']." alt='Card image cap' />
                      <div class='card-body'>
                        <h5 class='card-title'>".$row['book_name']." </h5>
                        <h6 class='card-title'>".$row['book_publisher']."</h6>
                        <p class='card-text'>
                         Price: ".$row['book_price']."
                        </p>
                        <a href='/bookstore/productpage.php?book_id=".$row['book_id']."' class='btn btn-primary'>View Book</a>
                      </div>
                    </div>
                  </div>
                    
                    ";
                    $count=$count+1;
                    $book_count = $book_count + 1;
                }
            }
            echo "
            
            
            </div>";
        }
        
      }
      echo "</div>";

      ?>




    <a class='carousel-control-prev' href='#carouselExampleControls' role='button' data-slide='prev'>
        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
        <span class='sr-only'>Previous</span>
    </a>
    <a class='carousel-control-next' href='#carouselExampleControls' role='button' data-slide='next'>
        <span class='carousel-control-next-icon' aria-hidden='true'></span>
        <span class='sr-only'>Next</span>
    </a>
    </div>







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
</body>

</html>