

function addMovie(movieID) {
    window.location.replace("./index.php?action=add&movie_id=" + movieID);
    return true;
}

function confirmCheckout() {
    if (confirm("Are you sure you want to checkout?")) {
        window.location.replace("./index.php?action=checkout");
    } else {
        return false;
    }
}

function confirmLogout() {
    if (confirm("Are you sure you want to logout?")) {
        window.location.replace("./logon.php?action=logoff");
        return true;
    } else {
        return false;
    }
}

function confirmRemove(title, movieID){
    if (confirm("Are you sure you want to remove this movie from your cart?")) {
        window.location.replace("./index.php?action=remove&movie_id=" + movieID);
        return true;
    } else {
        return false;
    }
}

function confirmCancel(form){
    alert("Are you sure you want to cancel the " + form + " form?");
    if(form === "search"){
        window.location.replace("./index.php");
    }
    else{
        window.location.replace("./logon.php");
    }
}

function validateCreateAccountForm(){
    var dispNameValue = document.getElementById("disp_name").value;
    var emailValue = document.getElementById("email").value;
    var confirm_email = document.getElementById('confirm_email').value;
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var confirm_password = document.getElementById('confirm_password').value;
    if (/\s/.test(emailValue)) {
        alert("Email cannot contain any spaces");
        return false;
    }
    if (/\s/.test(username)) {
        alert("Username cannot contain any spaces");
        return false;
    }
    if (/\s/.test(password)) {
        alert("Password cannot contain any spaces");
        return false;
    }
    if (/\s/.test(confirm_password)) {
        alert("Confirm Password field cannot contain any spaces");
        return false;
    }
    if (/\s/.test(confirm_email)) {
        alert("Confirm Email field cannot contain any spaces");
        return false;
    }
    if(emailValue !== confirm_email){
        alert("Email does not match the Confirm Email field");
        return false;
    }
    if(password !== confirm_password){
        alert("Password does not match the Confirm Password field");
        return false;
    }
    return true;
}

function displayMovieInformation(movieID) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("modalWindowContent").innerHTML= this.responseText;
            showModalWindow();
        }
    };
    xmlhttp.open("GET", "./movieinfo.php?movie_id=" + movieID, true);
    xmlhttp.send();

}

function showModalWindow()
{
    var modal = document.getElementById('modalWindow');
    var span = document.getElementsByClassName("close")[0];

    span.onclick = function()
    {
        modal.style.display = "none";
    };

    window.onclick = function(event)
    {
        if (event.target == modal)
        {
            modal.style.display = "none";
        }
    };

    modal.style.display = "block";
}

function changeMovieDisplay() {
    var selected = document.getElementById("select_order").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("shopping_cart").innerHTML= this.responseText;
        }
    };
    xmlhttp.open("GET", "./index.php?action=update&order=" + selected, true);
    xmlhttp.send();
}