//This javascript code does the soft data validation, simply making sure
//data exists in required fields and the data is correct.

$(document).ready(function(){
	$("#submit").click(function(event){
		event.preventDefault();
		var name = $("#name").val();
		//Fetching Values from URL
		var first_name=$("#FirstName").val();
		var last_name=$("#InputLastName").val();
		var email=$("#InputEmailFirst").val();
		var email2=$("#InputEmailSecond").val();
		var password=$("#InputPasswordFirst").val();
		var password2=$("#InputPasswordSecond").val();
		var address_line1=$("#InputAddress").val();
		var address_line12=$("#InputAddress2").val();
		var city=$("#InputCity").val();
		var state=$("#InputState").val();
		var zip=$("#InputZip").val();
		var tier=$("#tierselect").val();
		var birthdate=$("#InputBirthdateFirst").val();
		var cc_number=$("#InputCC").val();
		var cc_expire=$("#InputCCExpire").val();
		var cc_cvv=$("#InputCCCVV").val();
		
		//Extra validation to make sure required fields are complete
		var data = $('form').serialize();
		if(first_name==''||last_name==''||email==''||email2==''||password==''||password2==''||address_line1==''||city==''||state==''||zip==''||tier==''||birthdate==''||cc_number==''||cc_expire==''||cc_cvv=='')
		{
			alert("Please Fill All Required Fields");
		}
		//Ensure emails match and are valid...
		else if ((email !== email2) || (validateEmail(email) == false))
		{
			alert("Please Make Sure the Emails Match and are Valid");
		}
		//Ensure passwords match and are valid...
		else if ((password !== password2) || (checkPassword(password) == false))
		{
			alert("Please make sure the passwords match and use only alphanumeric values (must be between 5 and 20 characters)");
		}
		//Ensure address is valid...
		else if (checkAddress(address_line1) == false)
		{
			alert("Please make sure the address is valid");
		}
		//Ensure city is valid...
		else if (checkCity(city) == false)
		{
			alert("Please make sure the city is valid");
		}
		//Ensure zip is valid...
		else if (checkZip(zip) == false)
		{
			alert("Please make sure the zip is valid");
		}
		//Ensure CC number looks right...
		else if (checkCC(cc_number) == false)
		{
			alert("Please make sure the credit card number is correct.");
		}
		//Ensure CC number looks right...
		else if (checkExp(cc_expire) == false)
		{
			//Do nothing, alerts are handles in the other functions
		}
		//Ensure CC CVV number looks right...
		else if (checkCVV(cc_cvv) == false)
		{
			alert("Please make sure the credit card CVV number is correct");
		}
		//else if all javascript validation rules are passed...
		else
		{
			// AJAX Code To Submit Form.
			$.post( '/ajaxsubmit.php', data, function( data ) {
				alert(String(data));
				//if the captcha was entered incorrectly...
				if (String(data).indexOf("reCAPTCHA") > -1)
				{
					Recaptcha.reload();
  					return false;
  				}
  				//if the email is already in use
  				else if (String(data).indexOf("Email") > -1)
  				{
  					Recaptcha.reload();
  					return false;
  				}
  				else
  				{
  					window.location.replace("http://rmsystem.org");
  				}
			});
		}
	});
});

//Used to validate user input email addresses.
function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 
//Used to validate password is between 5 and 20 characters and only alphanumeric
function checkPassword(password){
    var pattern = /^[a-zA-Z0-9_-]{5,20}$/;
    if(pattern.test(password)){
        return true;
    }else{
        return false;
    }
}
//Used to validate Address
function checkAddress(address){
    var pattern = /^[a-zA-Z\s\d\/]*\d[a-zA-Z\s\d\/]*$/;
    if(pattern.test(address)){
        return true;
    }else{
        return false;
    }
}
//Used to validate City (allows more than one letter or space)
function checkCity(city){
    var pattern = /[\w ]+/;
    if(pattern.test(city)){
        return true;
    }else{
        return false;
    }
}
//Used to validate Zip code (allows only numbers in a 5 - 4 pattern)
function checkZip(zip){
    var pattern = /(^\d{5}$)|(^\d{5}-\d{4}$)/;
    if(pattern.test(zip)){
        return true;
    }else{
        return false;
    }
}
//Used to validate CC # (allows only numbers that match patterns of Visa, Mastercard, AmEx, Discover, JCB)
function checkCC(cc_number){
    /*var pattern = /(^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$)/;
    if(pattern.test(cc_number)){
        return true;
    }else{
        return false;
    }*/
}
//Used to make sure expiration date is valid
function normalizeYear(year){
    // Century fix
    var YEARS_AHEAD = 20;
    if (year<100){
        var nowYear = new Date().getFullYear();
        year += Math.floor(nowYear/100)*100;
        if (year > nowYear + YEARS_AHEAD){
            year -= 100;
        } else if (year <= nowYear - 100 + YEARS_AHEAD) {
            year += 100;
        }
    }
    return year;
}
function checkExp(cc_expire){
    var match=cc_expire.match(/^\s*(0?[1-9]|1[0-2])\/(\d\d|\d{4})\s*$/);
    if (!match){
    	alert('Please make sure the credit card expiration date is entered correctly');
        return false;
    }
    var exp = new Date(normalizeYear(1*match[2]),1*match[1]-1,1).valueOf();
    var now=new Date();
    var currMonth = new Date(now.getFullYear(),now.getMonth(),1).valueOf();
    if (exp<=currMonth){
        alert('Credit Card is Expired');
        return false;
    } else {
        return true;
    };
}
//Used to validate CC CVV number (allows only numbers between 3 and 4 digits)
function checkCVV(cc_cvv){
    var pattern = /^[0-9]{3,4}$/;
    if(pattern.test(cc_cvv)){
        return true;
    }else{
        return false;
    }
}

//Used to validate CC number
function checkCC(cc){
    var pattern = /^((4\d{3})|(5[1-5]\d{2})|(6011)|(3[68]\d{2})|(30[012345]\d))[ -]?(\d{4})[ -]?(\d{4})[ -]?(\d{4}|3[4,7]\d{13})$/;
    if(pattern.test(cc)){
        return true;
    }else{
        return false;
    }
}