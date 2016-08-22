var baseurl="http://localhost/SistemaTarapotoInn/";
$(function(){	
	$('#Tes').on('click',function(){
		alert("chevere");
	});	
	$('#driver').multiselect();

	$('#TipoHabitacion').on('click',function(){
		alert("correcto");
		$("#ContenidoPrincipal").load(baseurl+"TipoHabitacion");
	});
	$('#Habitacion').on('click',function(){
		$("#ContenidoPrincipal").load(baseurl+"TipoHabitacion");
	});
});