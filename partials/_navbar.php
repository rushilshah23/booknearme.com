<?php
$loggedin =false;



   
    if((isset($_SESSION["loggedin"])) && $_SESSION["loggedin"]==true){
        $loggedin = true;
    }

?>

<?php
    echo'    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/bookstore/index.php">booknearme.com</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item';if($thispage=="home"){echo ' active';}echo '">
                <a class="nav-link" href="/bookstore/index.php">Home <span class="sr-only">(current)</span></a>
            </li>';
        if($loggedin==false){
            echo '
            <li class="nav-item';if($thispage=="login"){echo ' active';}echo'">
                <a class="nav-link" href="/bookstore/loginsystem/loginpage.php">Login</a>
            </li>
            <li class="nav-item';if($thispage=="register"){echo ' active';}echo'">
                <a class="nav-link" href="/bookstore/loginsystem/registerpage.php">Register</a>
            </li>';
        }else if($loggedin == true){
            echo'
            <li class="nav-item">
                <a class="nav-link" href="/bookstore/loginsystem/logoutpage.php">Logout</a>
            </li>
            ';
        }



        echo '
            </ul>
            <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search a book" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        </nav>';

    ?> 
