function validation() {

	var email = document.getElementById("email").value;
	var pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

	var male = document.getElementById("male");
	var female = document.getElementById("female");

	var zip = document.getElementById("zip").value;

	if (!email.match(pattern)) {
		alert("Email is invaild!");
		return false;
	}
	else if ((!male.checked) && (!female.checked)) {
		alert("Gender is invaild!");
		return false;
	}
	else if(isNaN(zip)) {
		alert("ZIP code is invaild!");
		return false;
	}else if (zip.length != 5){
		alert("ZIP code need 5 digits!");
		return false;
	}

	return true;
}

