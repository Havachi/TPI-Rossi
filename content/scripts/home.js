

function showSMNavbar(){
	var x = document.getElementById("sidebar");
	x.classList.add("width-toggle")
}
function hideSMNavbar(){
	var x = document.getElementById("sidebar");
	x.classList.remove("width-toggle")
}

function showmodal(){
	var modal = document.getElementById('product-modal');

	modal.style.display = 'block';
}
function hidemodal(){
	var modal = document.getElementById('product-modal');
	modal.style.display = "none";
}
