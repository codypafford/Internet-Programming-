<?php
    session_start();
    require_once '/home/common/mail.php'; // Add email functionality to program
    require_once '/home/common/dbInterface.php'; // Add database functionality
    processPageRequest(); // Call the processPageRequest() function

?>

<?php
function processPageRequest()
{
    if (!isset($_SESSION['disp_name'])){
        echo "<br>display name not set.";
        header('Location: ./logon.php');

    }
    if (isset($_GET) and isset($_GET['action'])) {
        if ($_GET['action'] === 'add'){
            addMovieToCart($_GET['movie_id']);
            echo displayCart(); // The echo is very important
        }
        elseif ($_GET['action'] === 'checkout'){
            checkout($_SESSION['disp_name'], $_SESSION['email']);
        }
        elseif ($_GET['action'] === 'remove'){
            removeMovieFromCart($_GET['movie_id']);
            echo displayCart(); // The echo is very important
        }elseif ($_GET['action'] === 'update'){
            updateMovieListing($_GET["order"]);
        }
    }
    else{
        displayCart();
    }
}
?>

<?php
function addMovieToCart($movieID){
   // print_r($movieID);
   // $array = readMovieData();
    $result = movieExistsInDB($movieID);
    if($result == 0){
        $movie = file_get_contents("http://www.omdbapi.com/?apikey=dba1e6b3&i=" . $movieID . "&type=movie&r=json");
        $array = json_decode($movie, true);
        /* examples below may or may not work*/
        $poster = $array["Poster"];
        $title = $array["Title"];
        $year = $array["Year"];
        $rating = $array["Rated"];
        $runtime = $array["Runtime"];
        $genre = $array["Genre"];
        $actors = $array["Actors"];
        $director = $array["Director"];
        $writer = $array["Writer"];
        $plot = $array["Plot"];
        $ID_of_movie_added_to_db = addMovie($movieID, $title, $year, $rating, $runtime, $genre, $actors, $director, $writer, $plot, $poster);
      //  echo " id of movie added to DB is->" . $ID_of_movie_added_to_db;
      //  echo "<br>";
      //  echo "user ID->" . $_SESSION["ID"];
        addMovieToShoppingCart($_SESSION["ID"], $ID_of_movie_added_to_db);
    }
    else{
        $movie = file_get_contents("http://www.omdbapi.com/?apikey=dba1e6b3&i=" . $result . "&type=movie&r=json");
        $array = json_decode($movie, true);
        /* examples below may or may not work*/
        $poster = $array["Poster"];
        $title = $array["Title"];
        $year = $array["Year"];
        $rating = $array["Rated"];
        $runtime = $array["Runtime"];
        $genre = $array["Genre"];
        $actors = $array["Actors"];
        $director = $array["Director"];
        $writer = $array["Writer"];
        $plot = $array["Plot"];
        $ID_of_movie_added_to_db = addMovie($movieID, $title, $year, $rating, $runtime, $genre, $actors, $director, $writer, $plot, $poster);
      //  echo " id of movie added to DB is->" . $ID_of_movie_added_to_db;
      //  echo "<br>";
      //  echo "user ID->" . $_SESSION["ID"];
        addMovieToShoppingCart($_SESSION["ID"], $ID_of_movie_added_to_db);
    }
  //  array_push($array, $movieID);
   // var_dump($array);
  //  writeMovieData($array);
    displayCart();
}
?>

<?php
function displayCart($forEmail=false){
   /* readMovieData();*/
    $movie_count = countMoviesInCart($_SESSION["ID"]);
    if ($movie_count == "False"){
        echo "Invalid user ID";
    }
    $movie_list = createMovieList($forEmail);
    if ($forEmail == TRUE){
        $email_msg = "Hello, " . $_SESSION['disp_name']  . "<br><br>" . "Thanks for shopping with myMovies Express!<br>";
        $email_msg .= "<div id='shopping_cart'>$movie_list</div>";
        return $email_msg;
    }
    ob_start(); // Create an output buffer
    require_once './templates/cart_form.html';
    $message = ob_get_contents(); // Get the contents of the output buffer
    ob_end_clean(); // Clear the output buffer
    return $message;
}
?>

<?php/*
function readMovieData()
{
    $file = array_map('str_getcsv', file('./data/cart.db'));
    return $file != null ? $file[0] : [];
}*/
?>

<?php
function removeMovieFromCart($movieID){
   /* $array = readMovieData();*/
    $result = removeMovieFromShoppingCart($_SESSION["ID"], $movieID);
  /*  echo "True or False: Movie was removed from shopping cart->" . $result;*/
   /* $pos = array_search($movieID, $array);*/
   /* unset($array[$pos]);
    writeMovieData($array);*/
    displayCart();
}
?>

<?php/*
function writeMovieData($array)
{
    $file = implode(",", $array);
    file_put_contents("./data/cart.db", $file);
}*/
?>



<?php
function checkout($name,$address){

    $mail_id = "151588291";
    $email_message = displayCart(true);
   /* $email_message = "email message";*/
    $result = sendMail($mail_id, $address, $name, "Your Receipt From myMovies!", $email_message);
    if ($result == 0){
        echo "Thank you for using myMovies Express. A receipt was sent to your email.";
    }
    else{
        echo "ERROR in server: Please Try Again.";
    }

}
?>

<?php
function updateMovieListing($order){
    $_SESSION["order"] = $order;
    $result = createMovieList(false);
    echo $result;
}
?>

<?php
function createMovieList($forEmail=false){
    /*check if cart order is stored in session*/
    /*for testing lets say cart order == 0*/
//    if(isset($_SESSION['order'])){
//        echo "order is set";
//        $cart = getMoviesInCart($_SESSION["ID"], $_SESSION["order"]);
//
//    }else{
//        $cart = getMoviesInCart($_SESSION["ID"]);
//    }
    $cart_order = 3;
    if (isset($_SESSION["order"])){
        $cart = getMoviesInCart($_SESSION["ID"], $_GET["order"]);
    }
    else{
        $cart = getMoviesInCart($_SESSION["ID"]);
    }
    ob_start(); // Create an output buffer
    require_once './templates/movie_list.html';
    $message = ob_get_contents(); // Get the contents of the output buffer
    ob_end_clean(); // Clear the output buffer
    return $message;

}
?>
