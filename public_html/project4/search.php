<?php
    session_start(); // Connect to the existing session
    processPageRequest(); // Call the processPageRequest() function
?>

<?php
function processPageRequest()
{
    if (!empty($_POST)) {
        $searchString = $_POST["keyword"];
        displaySearchResults($searchString);
    } else {
        displaySearchForm();
    }
}
?>


<?php
    function displaySearchResults($searchString)
    {
        $results = file_get_contents('http://www.omdbapi.com/?apikey=dba1e6b3&s=' . urlencode($searchString) . '&type=movie&r=json');
        $array = json_decode($results, true)["Search"];
        require_once('templates/results_form.html');
        //print_r($array);

    }
?>

<?php
function displaySearchForm()
{
    require_once('templates/search_form.html');
}
?>
