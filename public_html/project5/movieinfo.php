<?php
session_start(); // Connect to the existing session
require_once '/home/common/dbInterface.php'; // Add database functionality
processPageRequest(); // Call the processPageRequest() function
?>

<?php
function createMessages($movieId){
    /*to be used in movie_info.html */
    $movieData = getMovieData($movieId);
    $title = $movieData["Title"];
    $year = $movieData["Year"];
    $rating = $movieData["Rating"];
    $runtime = $movieData["Runtime"];
    $genre = $movieData["Genre"];
    $actors = $movieData["Actors"];
    $director = $movieData["Director"];
    $writer = $movieData["Writer"];
    $plot = $movieData["Plot"];
    if(is_null($movieData)){
        $plot = "Invalid Movie ID";
    }
    ob_start(); // Create an output buffer
    require_once './templates/movie_info.html';
    $message = ob_get_contents(); // Get the contents of the output buffer
    ob_end_clean(); // Clear the output buffer
    echo $message;

}


function processPageRequest(){
    if (!isset($_SESSION['disp_name']))
    {
        header('Location: logon.php');
    }
    if (isset($_GET) and isset($_GET['movie_id'])) {

        createMessages($_GET['movie_id']);
    }
    else{
        createMessages(0);
    }
}

?>

<script type="text/javascript" src="script.js"></script>

