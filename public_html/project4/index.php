<?php
    session_start();
    require_once '/home/common/mail.php'; // Add email functionality to program
    processPageRequest(); // Call the processPageRequest() function

?>

<?php
function processPageRequest()
{
    if (isset($_GET) and isset($_GET['action'])) {
        if ($_GET['action'] === 'add'){
            addMovieToCart($_GET['movie_id']);
        }
        elseif ($_GET['action'] === 'checkout'){
            checkout($_SESSION['disp_name'], $_SESSION['email']);
        }
        elseif ($_GET['action'] === 'remove'){
            removeMovieFromCart($_GET['movie_id']);
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
    $array = readMovieData();
    array_push($array, $movieID);
   // var_dump($array);
    writeMovieData($array);
    displayCart();
}
?>

<?php
function displayCart(){
    readMovieData();
    require_once('templates/cart_form.html');
}
?>

<?php
function readMovieData()
{
    $file = array_map('str_getcsv', file('./data/cart.db'));
    return $file != null ? $file[0] : [];
}
?>

<?php
function removeMovieFromCart($movieID){
    $array = readMovieData();
    $pos = array_search($movieID, $array);
    unset($array[$pos]);
    writeMovieData($array);
    displayCart();
}
?>

<?php
function writeMovieData($array)
{
    $file = implode(",", $array);
    file_put_contents("./data/cart.db", $file);
}
?>


<?php
function checkout($name,$address){
    $file = file_get_contents('./data/cart.db');
    $myArray = explode(',', $file);
    $count = count($myArray);
    $mail_id = "151588291";
    $p1 = "<h1>$count  movie(s) in your shopping cart!</h1>";
    $myarray = readMovieData();
    $p2 = "";
    $message = "";
    foreach ($myarray as $value) {
        $movie = file_get_contents("http://www.omdbapi.com/?apikey=dba1e6b3&i=" . $value . "&type=movie&r=json");
        $array = json_decode($movie, true);
        $img = $array["Poster"];
        $movie_id = $array["movie_id"];
        $title = $array["Title"];
        $year = $array["Year"];
        $url = "https://www.imdb.com/title/" . $array['imdbID'];
       // echo $url;
        $p2 = "<tr><td><img src='$img' width='50' height='70' ></td ><td><a href='$url' target='_blank'> $title ( $year ) </a></td></tr>";
        $message = $message . $p2;
    }
    $message = $p1. "<table border='1'><tr><th>Poster</th><th>Title(year)</th>" . $message . "</tr></table>";

    $result = sendMail($mail_id, $address, $name, "Your Receipt From myMovies!", $message);
    echo $result;
    header('Location: logon.php');
}
?>