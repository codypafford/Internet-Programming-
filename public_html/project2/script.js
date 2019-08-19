
group2 =
'<div id="group2">' +
    '<h2>Enter Your Paypal Account Information</h2>' +
'<label>Enter Your Email Address:<br>' +
'<input type="text" name="paypal_email" id="pp_email">' +
    '<br></label>' +
    '<label>Enter Your Password:<br>' +
'<input type="text" name="paypal_pwd" id="paypwd">' +
    '<br></label>' +
    '</div>';

group1 =
'<div id="group1" >' +
    '<h2>Enter Your Credit Card Information</h2>' +
'<label>First Name:<br>'+
'<input type="text" name="firstname" id="fname" required>' +
'<br>' + '</label>' +
'<label>Last Name:<br>' +
'<input type="text" name="lastname" id="lname" required>' +
'<br></label>' +
'<label>Address:<br>' +
'<input type="text" name="address" id="address" required>' +
'<br></label>' +
'<label>City:<br>' +
'<input type="text" name="city" id="city" required>' +
'<br></label>' +
'<label>Zip Code:<br>' +
'<input type="text" name="zip" id="zip" required>' +
'<br></label>' +
'<label>Email Address:<br>' +
'<input type="text" name="email" id="email" required>' +
'<br></label>' +
'<label>Name on Card:<br>' +
'<input type="text" name="name_on_card" id="name_on_card" required>' +
'<br>' + '</label>' +
'<label>Card Number:<br>' +
'<input type="text" name="card_number" id="card_number" required>' +
'<br></label>' +
'<label>' +
'<a href="https://en.wikipedia.org/wiki/Card_security_code" target="_blank">CVV2/CVC:</a><br>' +
'<input type="text" name="CVV" required id="CVV"></label>' +
    '<br><br>' +

    '<label>Select State:<br>' +
'<select id="state">' +
    '<option value="default">Select State</option>' +
'<option value="AL">Alabama</option>' +
    '<option value="AK">Alaska</option>' +
    '<option value="AZ">Arizona</option>' +
    '<option value="AR">Arkansas</option>' +
    '<option value="CA">California</option>' +
    '<option value="CO">Colorado</option>' +
    '<option value="CT">Connecticut</option>' +
    '<option value="DE">Delaware</option>' +
    '<option value="DC">District Of Columbia</option>' +
    '<option value="FL">Florida</option>' +
    '<option value="GA">Georgia</option>' +
    '<option value="HI">Hawaii</option>' +
    '<option value="ID">Idaho</option>' +
    '<option value="IL">Illinois</option>' +
    '<option value="IN">Indiana</option>' +
    '<option value="IA">Iowa</option>' +
    '<option value="KS">Kansas</option>' +
    '<option value="KY">Kentucky</option>' +
    '<option value="LA">Louisiana</option>' +
    '<option value="ME">Maine</option>' +
    '<option value="MD">Maryland</option>' +
    '<option value="MA">Massachusetts</option>' +
    '<option value="MI">Michigan</option>' +
    '<option value="MN">Minnesota</option>' +
    '<option value="MS">Mississippi</option>' +
    '<option value="MO">Missouri</option>' +
    '<option value="MT">Montana</option>' +
    '<option value="NE">Nebraska</option>' +
    '<option value="NV">Nevada</option>' +
    '<option value="NH">New Hampshire</option>' +
    '<option value="NJ">New Jersey</option>' +
    '<option value="NM">New Mexico</option>' +
    '<option value="NY">New York</option>' +
    '<option value="NC">North Carolina</option>' +
    '<option value="ND">North Dakota</option>' +
    '<option value="OH">Ohio</option>' +
    '<option value="OK">Oklahoma</option>' +
    '<option value="OR">Oregon</option>' +
    '<option value="PA">Pennsylvania</option>' +
    '<option value="RI">Rhode Island</option>' +
    '<option value="SC">South Carolina</option>' +
    '<option value="SD">South Dakota</option>' +
    '<option value="TN">Tennessee</option>' +
    '<option value="TX">Texas</option>' +
    '<option value="UT">Utah</option>' +
    '<option value="VT">Vermont</option>' +
    '<option value="VA">Virginia</option>' +
    '<option value="WA">Washington</option>' +
    '<option value="WV">West Virginia</option>' +
    '<option value="WI">Wisconsin</option>' +
    '<option value="WY">Wyoming</option>' +
    '</select></label><br><br>' +

'<label>Date:<br>' +
'<input type="month" id="date" name="month" min="2017-01" max="2020-12" value="2019-04">' +
    '</label>' +
    '<br>' +
    '<br>' +
    '</div>';



function validateDate(dateSelect) {

    dateSelect = dateSelect.toString();

    let dateYear = dateSelect.split("-")[0];

    let dateMonth = dateSelect.split("-")[1];

    let nowdate = new Date();

    nowdate.setHours(0, 0, 0, 0);

    if (dateYear < nowdate.getFullYear().toString()) {
        alert("Date selected is less than today's year. Pick a further out date.")
        return false;
    } else {
        if (dateYear == nowdate.getFullYear().toString()) {
            const nowMonth = nowdate.getMonth();
            if (dateMonth <= (nowMonth + 1)) {
                alert("Date selected is less than or equal to today's date. Pick a further out date.");
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }
}

function validateEmail(email) {
    console.log(email + "is email");
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var isValid = re.test(String(email).toLowerCase());
    if (!isValid) {
        alert("Not a valid email address")
    }
    return isValid;
}

function validateState(state) {

    if (state == "default") {
        alert("Must choose a valid state");
        return false;
    }
    return true;

}

function validatePassword(pwd, minLength) {
    if (pwd.length < minLength) {
        alert("Password must be at least 8 characters");
        return false;
    }
    return true;
}

function validateForm() {


    var minLength = 8;
    var minZipLength = 5;
    var minCVVLength = 3;


    let selectedRB;
    var radios = document.getElementsByName('pay');

    for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
            selectedRB = radios[i].value;
            break;
        }
    }


    if (selectedRB == "credit card") {
         var fname = document.getElementById('fname').value;
         var lname = document.getElementById('lname').value;
         var address = document.getElementById('address').value;
         var city = document.getElementById('city').value;
         var zip = document.getElementById('zip').value;
         var email = document.getElementById('email').value;
         var nameOnCard = document.getElementById('name_on_card').value;
        var cardNumber = document.getElementById('card_number').value;
        var CVV = document.getElementById('CVV').value;
        var state = document.getElementById('state').value;
        var dateSelect = document.getElementById('date').value;
        if (!validateCreditCard(cardNumber)) {
            return false;
        }
        if (!validateDate(dateSelect)) {
            return false;
        }

        if (!validateEmail(email)) {
            return false;
        }

        if (!validateState(state)) {
            return false;
        }

        if(!validateControl(zip, minZipLength, "zip code")){
            return false;
        }
        if (!validateControl(CVV, minCVVLength, "CVV2/CVC code")){
            return false;
        }

    } else {
        var userEmail = document.getElementById('pp_email').value;
        var pwd = document.getElementById('paypwd').value;

        if (!validateEmail(userEmail)) {
            return false;
        }

        if (!validatePassword(pwd, minLength)) {
            return false;
        }


    }
    return false;

}

function testLength(cardNumber, req_length, exactLength) {
    var length = cardNumber.length;

    if (length > req_length) {
        alert("Card number contains too many characters")
    } else if (length < req_length) {
        alert("Card number does not contain enough characters")
    } else {
        exactLength = true;
    }

    return exactLength;
}

function testNumber(input, name) {
    if (isNaN(input)) {
        alert(name + " contains invalid character");
        return false;
    }

    return true;
}

function validateCreditCard(cardNumber) {
    var req_length;

    cardNumber = cardNumber.replace(/ /g, '');
    const firstDigit = cardNumber.charAt(0);

    let name = "Card";

    if (!testNumber(cardNumber, name)) {
        return false;
    }

    if (firstDigit != 3 && firstDigit != 4 && firstDigit != 5 && firstDigit != 6) {
        alert("Number is not valid. Card number must begin with a 3,4,5, or 6");
        return false;
    }


    if (cardNumber.startsWith("3")) {
        req_length = 15;
    } else if (cardNumber.startsWith("4")) {
        req_length = 16;
    } else if (cardNumber.startsWith("5")) {
        req_length = 16;
    } else if (cardNumber.startsWith("6")) {
        req_length = 16;
    }

    var exactLength = false;

    return testLength(cardNumber, req_length, exactLength);


}

function updateForm() {

    var radios = document.getElementsByName('pay');


    let selectedRB;
    for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
            selectedRB = radios[i].value;
            break;
        }
    }

    if (selectedRB == "pay pal") {
        document.getElementById("form_p2_group").innerHTML = group2;


    /*    var x= document.createElement("INPUT");
        x.setAttribute("type", "text");
        x.setAttribute("placeholder", "Name");
        x.setAttribute("class", "someInput");
        x.setAttribute("required", true);
        document.body.appendChild(x);
        document.getElementById('group1').style.display = "none";
        document.getElementById('group2').style.display = 'block';

        document.getElementById('fname').disabled = true;
        document.getElementById('lname').disabled = true;
        document.getElementById('address').disabled = true;
        document.getElementById('city').disabled = true;
        document.getElementById('zip').disabled = true;
        document.getElementById('cc_email').disabled = true;
        document.getElementById('name_on_card').disabled = true;
        document.getElementById('card_number').disabled = true;
        document.getElementById('CVV').disabled = true;
        document.getElementById('state').disabled = true;
        document.getElementById('date').disabled = true;


        document.getElementById('pp_email').disabled = false;
        document.getElementById('paypwd').disabled = false;
*/

    } else {

        document.getElementById("form_p2_group").innerHTML = group1;
       /* document.getElementById('group1').style.display = "block";
        document.getElementById('group2').style.display = 'none';

        document.getElementById('fname').disabled = false;
        document.getElementById('lname').disabled = false;
        document.getElementById('address').disabled = false;
        document.getElementById('city').disabled = false;
        document.getElementById('zip').disabled = false;
        document.getElementById('cc_email').disabled = false;
        document.getElementById('name_on_card').disabled = false;
        document.getElementById('card_number').disabled = false;
        document.getElementById('CVV').disabled = false;
        document.getElementById('state').disabled = false;
        document.getElementById('date').disabled = false;

        document.getElementById('pp_email').disabled = true;
        document.getElementById('paypwd').disabled = true;*/


    }
}

function validateControl(input, min, name) {
    if (input.length < min) {
        alert(name + " does not contain enough characters");
        return false;
    } else if (input.length > min) {
        alert(name + " contains too many characters");
        return false;
    }

    return testNumber(input, name);
}
