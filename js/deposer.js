function validerFormulaire() {
	var titre = document.getElementById("titre").value;
	var description = document.getElementById("description").value;
	
	if (titre == "") {
		alert("Veuillez saisir un titre pour votre annonce.");
		return false;
	}
	
	if (description == "") {
		alert("Veuillez saisir une description pour votre annonce.");
		return false;
	}
	
	return true;
}
