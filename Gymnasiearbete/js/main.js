function validate() {
	pw1 = document.getElementById('password1').value;
	pw2 = document.getElementById('password2').value
	
	valid = document.getElementById('status');

	if (pw1 == "" || pw2 == ""){
		valid.style.display ='none';
	} else{
		if (pw1 == pw2) {
			valid.src = 'img/check.png';
			valid.style.display ='block';
		} else{
			valid.src = 'img/error.png';
			valid.style.display ='block';
		}	
	}
}
var n=1;
setInterval("slide()", 4000);
function slide() {
    n = n + 1;
 	if (n > 4){
  	n = 1;
 }
 document.getElementById('slideshow').src ='img/'+ n + '.png';
}
function regi() {
	var show = document.getElementById('register');

	if (show.style.display == 'block') {
		show.style.display = 'none';
	} else{
		show.style.display = 'block';
	}
}
