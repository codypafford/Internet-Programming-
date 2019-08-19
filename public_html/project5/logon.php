<?php
require_once '/home/common/mail.php'; // Add email functionality
require_once '/home/common/dbInterface.php'; // Add database functionality
processPageRequest(); // Call the processPageRequest() function
?>


<?php
function displayLoginForm($message = "")
{
    $Color = "red";
    require_once('templates/logon_form.html');
    echo '<div style="Color:' . $Color . '">' . $message . '</div>';

}

?>

<?php
function authenticateUsername($username, $password)
{
    $result = validateUser($username, $password);
    if (is_null($result)) {

        $error_message = "USERNAME AND/OR PASSWORD IS INVALID!";
        displayLoginForm($error_message);
    } else {

        session_start();
      //  var_dump($result);
        $_SESSION["ID"] = $result["ID"];

        $_SESSION["disp_name"] = $result["DisplayName"];
        $_SESSION["email"] = $result["Email"];
        header('Location:  index.php');
    }


}

?>

<?php
function processPageRequest()
{
    unset ($_SESSION["disp_name"]);
    unset ($_SESSION["email"]);
    unset ($_SESSION["ID"]);
    // session_destroy();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST) and isset($_POST['action'])) {
            if ($_POST['action'] === 'create') {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $displayName = $_POST['disp_name'];
                $emailAddress = $_POST['email'];
             //   echo $emailAddress;
             //   echo $username;
             //   echo $password;
             //   echo $displayName;

                createAccount($username, $password, $displayName, $emailAddress);
            }
            if ($_POST['action'] === 'forgot') {
                $username = $_POST['username'];
                sendForgotPasswordEmail($username);
            }
            if ($_POST['action'] === 'login') {
                $username = $_POST['username'];
                $password = $_POST['password'];
                authenticateUsername($username, $password);
            }
            if ($_POST['action'] === 'reset') {
                // verify that this is really how to get these values
                echo "<br>";
               // print_r($_POST);
                $userId = $_POST['user_id'];
               // echo "[".$userId . ']';
                $password = $_POST['password'];
                resetPassword($userId, $password);
            }
        }
        //  $username = test_input($_POST["username"]);
        //  $password = test_input($_POST["password"]);
        //  authenticateUsername($username,$password);

    } else if (!empty($_GET)) {

        if (isset($_GET) and isset($_GET['action'])) {
            if ($_GET['action'] === 'validate') {
                $userId = $_GET['user_id'];
                validateAccount($userId);
            }
            if ($_GET['action'] === 'logoff') {
                displayLoginForm("You have been logged out"); ///testtttt
            }
        }
        if (isset($_GET['form'])) {

            if ($_GET['form'] === 'create') {

                displayCreateAccountForm();
            }
            if ($_GET['form'] === 'forgot') {
                displayForgotPasswordForm();
            }
            if ($_GET['form'] === 'reset') {
                $userId = $_GET['user_id'];

                displayResetPasswordForm($userId);
            }
        }

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
 //   echo "<br>" . $result . " is the id of create account";
    // if result is 1 to infinity, that is the user ID
    //if result is 0, then the provided username already exists
    if ((int)$result > 0) {
        $userId = $result;
        sendValidationEmail($userId, $displayName, $emailAddress);
       // displayLoginForm("Validation email sent to your inbox");  /////testttttt
    } else {
        $error_message = "THE PROVIDED USERNAME ALREADY EXISTS";
        displayLoginForm($error_message);
    }
}

?>

<?php
function displayCreateAccountForm()
{
   // echo "its reaching";
    require_once 'templates/create_form.html';
}

?>

<?php
function displayForgotPasswordForm()
{
    require_once 'templates/forgot_form.html';
}

?>

<?php
function displayResetPasswordForm($userId)
{
    require_once 'templates/reset_form.html';
}

?>

<?php
function resetPassword($userId, $password)
{
   // echo "user id inside of resetPassword -> ". $userId;
    $result = resetUserPassword($userId, $password);
    if ($result) {
        $message = "Password Successfully Reset";
        displayLoginForm($message);
    } else {
        $message = "Password is the same as previous password or ID does not exist";
        displayLoginForm($message);
    }
}

?>

<?php
function sendForgotPasswordEmail($username)
{
    $result_array = getUserData($username);
    if (!is_null($result_array)) {
        $mail_id = "151588291";
      //  var_dump($result_array);
        $email = $result_array["Email"];
        $name = $result_array["DisplayName"];
        $userID = $result_array["ID"];
        $url = "http://139.62.210.181/~pc435524/project5/logon.php?form=reset&user_id=" . $userID;

        $email_message = "<h1>myMovies Xpress!</h1>";
        $email_message = $email_message . "Hello, " . $name . "<br>";
        $email_message = $email_message . "<br> Click the following link to reset your password:<br>" . "<a href='$url'>Reset Password</a>";
        $result = sendMail($mail_id, $email, $name, "Reset Your Password", $email_message);
        if ($result != 0){
            echo "SERVER ERROR: Email was not sent. Please try again.";
        }else{
            echo "A Password reset has been sent to your email inbox.";

        }
    }
    else{
        echo "Email was not sent. Invalid Username.";
    }

}

?>

<?php
function sendValidationEmail($userId, $displayName, $emailAddress)
{
    $mail_id = "151588291";
    $url = "http://139.62.210.181/~pc435524/project5/logon.php?action=validate&user_id=" . $userId; // the link to include
    $message = "<h1>myMovies Xpress!</h1><br>";
    $message = $message . "Hello, " . $displayName . " Welcome to myMovies Xpress!";
    $message = $message . "<br>" . "You must validate your email address by clicking on the following link:";
    $message = $message . "<br>" . "<a href='$url'>Click here</a>";
    $result = sendMail($mail_id, $emailAddress, $displayName, "myMovies! Account Validation", $message);
    if ($result == 0){
        displayLoginForm("Validation email sent to your inbox.");
    }



}

?>

<?php
function validateAccount($userId)
{
    $result = activateAccount($userId);
    if ($result) {
        displayLoginForm("Account created successfully");
    } else {
        displayLoginForm("ERROR: Account was not created");
    }
}

?>





