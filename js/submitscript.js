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
		
		// Returns successful data submission message when the entered information is stored in database.
		var data = $('form').serialize();
		if(first_name==''||last_name==''||email==''||email2==''||password==''||password2==''||address_line1==''||city==''||state==''||zip==''||tier==''||birthdate==''||cc_number==''||cc_expire==''||cc_cvv=='')
		{
			alert("Please Fill All Required Fields");
		}
		else
		{
			// AJAX Code To Submit Form.
			$.post( '/ajaxsubmit.php', data, function( data ) {
				alert(data);
  				window.location.replace("http://rmsystem.org");
			});
		}
		return false;
	});
});