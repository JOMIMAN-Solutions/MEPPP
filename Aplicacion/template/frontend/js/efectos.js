function mostrar(){
	if (document.getElementById('calendario').style.display == 'none') {
		document.getElementById('calendario').style.display = 'block';
		document.getElementById('btnCalendario').innerHTML="Ocultar proximos eventos<span class='glyphicon glyphicon-calendar'></span>";
		calendario();
	}else{
		document.getElementById('calendario').style.display = 'none';
		document.getElementById('btnCalendario').innerHTML = "Ver proximos eventos<span class='glyphicon glyphicon-calendar'></span>";
	} 
}