

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

function validateCreateAccountForm(){
    var nameValue = document.getElementById("uniqueID").value;
   alert()
}