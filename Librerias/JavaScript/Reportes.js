function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}

function Ver(codestadia){
    $("#ContenidoPrincipal").load(BASEURL + "Reserva/VerReserva",{id:codestadia});
}