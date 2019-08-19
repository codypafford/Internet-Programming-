
<?php
require_once '/home/common/mail.php'; // Add email functionality
require_once '/home/common/dbInterface.php'; // Add database functionality
processPageRequest(); // Call the processPageRequest() function
?>


<?php
function displayLoginForm($message = "")
{
    $Color = "blue";
    require_once('templates/logon_form.html');
    echo '<div style="Color:'.$Color.'">'.$message.'</div>';

}

?>

<?php
function authenticateUsername($username, $password)
{
    $result = validateUser($username, $password);
    if (is_null($result)){
        echo 'Sample Is Null';
        $error_message = "USERNAME AND/OR PASSWORD IS INVALID!";
        displayLoginForm($error_message);
    }else{
        session_start();
        var_dump($result);
       // $_SESSION["ID"] = value from array
       // $_SESSION["disp_name"] = value from array
       // $_SESSION["email"] = value from array
        echo 'Sample Is Not Null and returned a value!';
    }


   /* $file = file_get_contents(__DIR__ . '/data/credentials.db');
    $myArray = explode(',', $file);
    $cr_usrname = $myArray[0];
    $cr_passwrd = $myArray[1];
    $cr_dispname = $myArray[2];
    $cr_email = $myArray[3];

    if ($username == $cr_usrname and $password == $cr_passwrd){
        // Start the session
        session_start();
        $_SESSION["disp_name"] = $cr_dispname;
        $_SESSION["email"] = $cr_email;
        //redirect to index.php page
        header('Location: index.php');
    }
    else{
        $err_msg = "Username and/or Password do not match";
        displayLoginForm($err_msg);
    }*/

}
?>

<?php
function processPageRequest()
{
    unset ($_SESSION["disp_name"]);
    unset ($_SESSION["email"]);
    $username = $password = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = test_input($_POST["username"]);
        $password = test_input($_POST["password"]);
        authenticateUsername($username,$password);

    } else {
        displayLoginForm("");
    }
}

?>

<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!-- NEWEST FUNCTIONS ADDED FOR PROJECT 5------------------------------------------------------------------------- -->
<?php
function createAccount($username, $password, $displayName, $emailAddress)
{
    $result = addUser($username, $password, $displayName, $emailAddress);
    // if result is 1 to infinity, that is the user ID
    //if result is 0, then the provided username already exists
    if ((int)$result > 0){
        $userId = $result;
        sendValidationEmail($userId, $displayName, $emailAddress);
    }
    else{
        $error_message = "THE PROVIDED USERNAME ALREADY EXISTS";
        displayLoginForm($error_message);
    }
}
?>

<?php
function displayCreateAccountForm()
{
    require_once 'templates/';
}
?>

<?php
function displayForgotPasswordForm()
{

}
?>

<?php
function displayResetPasswordForm($userId)
{

}
?>

<?php
function resetPassword($userId, $password)
{

}
?>

<?php
function sendForgotPasswordEmail($username)
{

}
?>

<?php
function sendValidationEmail($userId, $displayName, $emailAddress)
{

}
?>

<?php
function validateAccount($userId)
{

}
?>





