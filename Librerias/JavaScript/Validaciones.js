function Nada(e){
	tecla = e.keyCode || e.which; 
	base =/[]/; 
	teclado = String.fromCharCode(tecla).toLowerCase(); 
	return base.test(teclado); 
}

function Letras(e){
	tecla = e.keyCode || e.which; 
	base =/[a-zñ ]/; 
	teclado = String.fromCharCode(tecla).toLowerCase(); 
	return base.test(teclado); 
}

function Numeros(e){
	tecla = e.keyCode || e.which; 
	base =/[0-9]/; 
	teclado = String.fromCharCode(tecla).toLowerCase(); 
	return base.test(teclado); 
}

function NumerosLetras(e){
	tecla = e.keyCode || e.which; 
	base =/[0-9a-zñ. ]/; 
	teclado = String.fromCharCode(tecla).toLowerCase(); 
	return base.test(teclado); 
}

function LetrasCaracteres(e){
	tecla = e.keyCode || e.which; 
	base =/[+abo-]/; 
	teclado = String.fromCharCode(tecla).toLowerCase(); 
	return base.test(teclado); 
}

function Comprobantes(e){
	tecla = e.keyCode || e.which; 
	base =/[-0-9a-z]/; 
	teclado = String.fromCharCode(tecla).toLowerCase(); 
	return base.test(teclado); 
}

function NumerosCaracteres(e){
	tecla = e.keyCode || e.which; 
	base =/[0-9#]/; 
	teclado = String.fromCharCode(tecla).toLowerCase(); 
	return base.test(teclado); 
}

function NumerosPuntos(e){
	tecla = e.keyCode || e.which; 
	base =/[0-9.]/; 
	teclado = String.fromCharCode(tecla).toLowerCase(); 
	return base.test(teclado); 
}

function ValidarEmail(e) {
    tecla = e.keyCode || e.which; 
	base =/[0-9a-zñ@_.]/ 
	teclado = String.fromCharCode(tecla).toLowerCase(); 
	return base.test(teclado); 
}

