
<html>
	<head>
		<meta charset="UTF-8">
		<title>Hotel Tarapoto</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0 ">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Librerias/plugins/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Pagina/css/estilos.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Pagina/css/ejemplo1.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Pagina/css/stylelogin.css">

		<script type="text/javascript">
			function Validar(obj){
				if(obj.nombre.value==""){
					$('#nombre').focus();
					alert("Ingrese Nombre Usuario"); return 0;
				}
				if(obj.contra.value==""){
					$('#contra').focus();
					alert("Ingrese Contraseña Usuario"); return 0;
				}
				obj.submit();
			}
		</script>
	</head>
	<body>
		<div class="container" id="Contenedor-1">
			<div style="height:5px;"></div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
					<img src="<?php echo base_url();?>imageneshotel/fondo2.jpg" class="img-responsive img-rounded">
				</div>
				<div class="hidden-xs hidden-sm  hidden-md col-lg-4 col-lg-pull-1">
					<img src="<?php echo base_url();?>imageneshotel/informes.png" class="img-rounded">
					<div class="caja-redes">
					   <a href="https://www.youtube.com/watch?v=g6p1mEJaz9A" target="_blank"><img src="<?php echo base_url();?>imageneshotel/youtube.png" title="Siguenos en YouTube"></a>
					   <a href="https://www.facebook.com/hoteltarapotoinnoficial?fref=ts" target="_blank"><img src="<?php echo base_url();?>imageneshotel/facebook.png" title="Siguenos en facebook"></a>
					   <a href="https://twitter.com/?lang=es" target="_blank"><img src="<?php echo base_url();?>imageneshotel/twitter.png" title="Siguenos en twitter"></a>
					   <a href="https://accounts.google.com/ServiceLogin?service=mail&continue=https://mail.google.com/mail/&hl=es#identifier" target="_blank"><img src="<?php echo base_url();?>imageneshotel/google.png" title="Siguenos en google+"></a>
					</div>
				</div>
			</div>
			<div style="height:5px;"></div>
			<nav class="navbar navbar-default" id="BarraNavegacion">
				<div class="navbar-header">
				    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#MenuHotel" aria-expanded="false">
					    <span class="sr-only">Tarapoto Inn</span>
					    <span class="icon-bar"></span>
					    <span class="icon-bar"></span>
					    <span class="icon-bar"></span>
				    </button>
				    <a href="<?php echo base_url();?>" class="navbar-brand" style="font-size:20px;font-weight: bold;color:orange;">Tarapoto Inn</a>
				</div>
				<div class="collapse navbar-collapse" id="MenuHotel">
				    <ul class="nav navbar-nav">
					    <li class="menus"><a href="<?php echo base_url();?>paginaweb/nosotros"><span class="glyphicon glyphicon-star"></span> Nosotros</a></li>
					    <li class="menus"><a href="<?php echo base_url();?>paginaweb/habitaciones"><span class="glyphicon glyphicon-home"></span> Habitaciones</a></li>					    
					    <li class="menus"><a href="<?php echo base_url();?>paginaweb/tours"><span class="glyphicon glyphicon-plane"></span> Tours</a></li>
					    <li class="menus"><a href="<?php echo base_url();?>paginaweb/productos"><span class="glyphicon glyphicon-shopping-cart"></span> Productos</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
					    <li >
					    	<a style="font-size:16px" href="#Login" data-toggle="modal" role="button" ><span class="glyphicon glyphicon-user"></span><strong> Login</strong> </span></a>
					   	</li>
					</ul>
				</div>
			</nav>
			<div id="contenedor-2">
				<div class="row">
					<div class="col-md-4">
	                    <img src="<?php echo base_url();?>imageneshotel/catarata.jpg" width="100%" height="200">                 
                    	<h4 class="service-heading">TOURS CATARATAS DE AHUASHIYACU</h4>
                    	<p>El lugar es impresionante también por la flora, entre la que destaca una gran variedad de orquídeas y helechos. Se puede observar mariposas, insectos y aves en la zona. Además se pueden practicar diferentes deportes como el buceo y nado.</p>
                    	<p><strong>Precio: s/ 54.00</strong></p>
                	</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
	                    <img src="<?php echo base_url();?>imageneshotel/canotaje.jpg" width="100%" height="200">
	                       
                    	<h4 class="service-heading">CANOTAJE EN EL RIO MAYO</h4>
                    	<p>Esta aventura de canotaje se inicia desde el poblado de San Miguel de Río Mayo hasta Maceda en balsa inflable dirigida por guías experimentados y navegantes de nuestros ríos, que irán por rápidos, disfrutando de maravillosos paisajes y pura adrenalina.</p>
						<p><strong>Precio: s/ 70.00</strong></p>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
	                    <img src="<?php echo base_url();?>imageneshotel/castillo.jpg" width="100%" height="200">
	                    
                    	<h4 class="service-heading">CASTILLO DE LAMAS</h4>
                    	<p>Habitaciones acogedoras y de relax  ideales para viajes en grupo o en familia. Tres camas de 1 1/2 plaza. TV cable color. Aire acondicionado y/o ventilador.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
	                    <img src="<?php echo base_url();?>imageneshotel/city.jpg" width="100%" height="200">                 
                    	<h4 class="service-heading">CITY TOURS</h4>
                    	<p>Se visitara la fábrica de chocolates “La Orquídea”, en la zona de Partido Alto, podrá ver el proceso de fabricación de los chocolates y adquirir esto productos orgánicos de calidad mundial. Paseo y recorrido por los distritos de Morales, Banda de Shilcayo, y Tarapoto. También otras opciones en la ciudad.</p>
                		<p><strong>Precio: S/ 85.00</strong></p>
                	</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
	                    <img src="<?php echo base_url();?>imageneshotel/caminata.jpg" width="100%" height="200">
	                       
                    	<h4 class="service-heading">CAMINATA TAMUSHAL</h4>
                    	<p>De Tarapoto a 20 minutos  hasta la garita de control, donde se inicia la caminata de aproximadamente 3 a 4  horas para llegar a la primera cascada, cruzando 28 veces el rio Shilcayo,  llegando a ver diversas cascadas y disfrutando de la flora y fauna silvestre. Incluye: Transporte, guiado, entrada y refrigerio.</p>
                    	<p><strong>Precio: s/ 150.00</strong></p>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
	                    <img src="<?php echo base_url();?>imageneshotel/laguna.jpg" width="100%" height="200">
	                    
                    	<h4 class="service-heading">TOURS lAGUNA AZUL</h4>
                    	<p>Habitaciones acogedoras y de relax  ideales para viajes en grupo o en familia. Tres camas de 1 1/2 plaza. TV cable color. Aire acondicionado y/o ventilador.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
	                    <img src="<?php echo base_url();?>imageneshotel/nv.jpg" width="100%" height="200">                 
                    	<h4 class="service-heading">NATURA VIVA</h4>
                    	<p>Habitaciones perfectas para una persona, contiene: Baño propio, Cama 1.5 plaza, TV cable color, Aire acondicionado y/o Ventilador, Internet Wi-Fi Muebles, lamparitas, cuadros Anexo Telefónico.
                    	 3 toallas, papel higienico y jabón. Desayuno de cortesía.</p>
                	</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
	                    <img src="<?php echo base_url();?>imageneshotel/llano.jpg" width="100%" height="200">
	                       
                    	<h4 class="service-heading">DESCUBRIENDO EL LLANO AMAZONICO</h4>
                    	<p>A 2 ½ horas de Tarapoto. Se visitara la iglesia, al malecón del rio  Huallaga, seguido es el traslado al Hotel Rio Huallaga donde es el almuerzo con una vista panorámica al Rio . Luego es el traslado al puerto para el paseo en bote y conocer los tres ríos: Shanusi, Huallaga y Paranapura, dependiendo de las condiciones meteorológicas se visitara el lago Sanango. En hora oportuna traslado a Tarapoto.</p>
						<p><strong>Precio: s/ 140.00</strong></p>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
	                    <img src="<?php echo base_url();?>imageneshotel/baños.jpg" width="100%" height="200">
	                    
                    	<h4 class="service-heading">ALTO MAYO: FULL DAY</h4>
                    	<p>Habitaciones acogedoras y de relax  ideales para viajes en grupo o en familia. Tres camas de 1 1/2 plaza. TV cable color. Aire acondicionado y/o ventilador.</p>
					</div>
				</div>					
			</div>

			<!-- Para Logearse-->
			<div class="modal fade" id="Login" tabindex="-1" role="dialog">
		        <div class="modal-dialog modal-sm">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <h4 class="modal-title"><center><b> Login Usuario </b></center></h4>                       
		                </div>
		                <div class="modal-body">
		                    <form method="POST" class="form-horizontal" action="<?php echo base_url();?>paginaweb/login" id="loginadmin">
								<div class="form-group">
								    <label class="col-md-4 control-label"><span class="glyphicon glyphicon-user" style="font-size:13px;"></span> User</label>
								    <div class="col-md-8">
									    <input type="text" class="form-control" name="nombre" id="nombre">
									</div>
								</div> 
								<div class="form-group">
								    <label class="col-md-4 control-label"><span class="glyphicon glyphicon-lock" style="font-size:13px;"></span> Clave</label>
								    <div class="col-md-8">
								       <input type="text" class="form-control" name="contra" id="contra">
								    </div>
								</div>
								<div class="form-group">
								    <div class="col-md-12">
								        <center>
								       		<button type="button" class="btn btn-success" onclick="Validar(this.form);">
								    		<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Aceptar</button>
								    		<button type="button" data-dismiss="modal" class="btn btn-danger">
								    		<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Cancelar</button>
								    	</center>
								    </div>
								</div> 
							</form>
		                </div>
		            </div>
		        </div>
			</div>

			<footer>
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-5">
						<a href="https://www.facebook.com/hoteltarapotoinnoficial?fref=ts" target="_blank"><img id="imgred"src="<?php echo base_url();?>imageneshotel/facebook.png"></a>
						<a href="#"><img id="imgred" src="<?php echo base_url();?>imageneshotel/twitter.png"></a>
						<a href="#"><img id="imgred" src="<?php echo base_url();?>imageneshotel/google.png"></a>
						<a href="#"><img id="imgred" src="<?php echo base_url();?>imageneshotel/youtube.png"></a>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
						<p id="Telefono">Jr. Jimenez Pimentel N° 115 - Tarapoto / Telefono : 42-524213</p>
					</div>
				</div>
			</footer>
		</div>
		<script src="<?php echo base_url();?>Librerias/plugins/jquery/jquery.js"></script>
		<script src="<?php echo base_url();?>Librerias/plugins/bootstrap/bootstrap.min.js"></script>
		
		<script src="<?php echo base_url();?>Pagina/js/Hover.js"></script>
		<script src="<?php echo base_url();?>Pagina/js/Validar.js"></script>
	</body>
</htm>