function show(x,y) {
	var a = document.getElementById(x);
	var b = document.getElementById(y);

	if(a.style.display == 'none' && b.style.display == 'none'){
		a.style.display = 'block';
	}

	else if (a.style.display == 'none' && b.style.display == 'block') {
		b.style.display = 'none';
		a.style.display = 'block';
	}
	
	else {
		a.style.display = 'none';
	}
}
