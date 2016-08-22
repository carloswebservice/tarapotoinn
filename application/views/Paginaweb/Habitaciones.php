<html>
	<head>
		<meta charset="UTF-8">
		<title>Hotel Tarapoto</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0 ">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Librerias/plugins/bootstrap/bootstrap.min.css">
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Pagina/css/estilos.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Pagina/css/stylelogin.css">

		<link rel="stylesheet" href="<?php echo base_url();?>Pagina/FechaHora/css/datepicker.css">
		

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
			var BASEURL="<?php echo base_url();?>";
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
					<div class="col-xs-12 col-sm-4 col-md-2 col-lg-6">
						<div id="carouselhotel" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carouselhotel" data-slide-to="0" class="active"></li>
								<li data-target="#carouselhotel" data-slide-to="1"></li>
								<li data-target="#carouselhotel" data-slide-to="2"></li>
								<li data-target="#carouselhotel" data-slide-to="3"></li>
								<li data-target="#carouselhotel" data-slide-to="4"></li>
								<li data-target="#carouselhotel" data-slide-to="5"></li>
							</ol>
							<div class="carousel-inner" role="listbox">
								<div class="item active">
									<img src="<?php echo base_url();?>imageneshotel/habitacion-simple.jpg" class="img-responsive">
								</div>
								<div class="item">
									<img src="<?php echo base_url();?>imageneshotel/habitacion-doble.jpg" class="img-responsive">
								</div>
								<div class="item">
									<img src="<?php echo base_url();?>imageneshotel/habitacion-triple.jpg" class="img-responsive">
								</div>
								<div class="item">
									<img src="<?php echo base_url();?>imageneshotel/habitacion-cuadruple.jpg" class="img-responsive">
								</div>
								<div class="item">
									<img src="<?php echo base_url();?>imageneshotel/habitacion-matrimonial.jpg" class="img-responsive">
								</div>
								<div class="item">
									<img src="<?php echo base_url();?>imageneshotel/habitacionsuit.jpg" class="img-responsive" id="Imagenes">
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-7 col-lg-2">
						<img src="<?php echo base_url();?>imageneshotel/reserva.jpg" alt="reserva onnline" width="100%">
						<br><br><br>

						<marquee direction="up" scrolldelay="500" height="140px"><h4 style="color: orange;text-align: justify">Reserva la habitación que necesitas de manera fácil y rápido</h4></marquee>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-7 col-lg-4">
						<h5 id="reservaciones">RESERVACIONES</h5>
						<form id="reservahoy" >
							<select class="form-control" name="tipohabitaciones" id="tipohabitaciones">
								<option value="hab">Seleccione ... </option>
								<?php foreach ($Informacion as $value): ?>
									<option value="<?php echo $value->codtipohabitacion; ?>"><?php echo $value->descripcion?></option>
			    		 		<?php endforeach ?>
							</select>
							<br>
							<input type="hidden" name="fechaactu" value="<?php echo date('d-m-Y'); ?>">
							<div class="form-group">
							    <input type="text" class="form-control" id="fechaingreso" name="fechaingreso" placeholder="Fecha Ingreso">
							</div>
							<div class="form-group">
							    <input type="text" class="form-control" id="fechasalida" name="fechasalida" placeholder="Fecha Salida">
							</div>
							<center><button type="button" onclick="return Asignando(this.form);" class="btn">Reservar Ahora</button></center>
						</form>
					</div>
				</div>
				<div style="height:15px;"></div>
				<div class="row text-center">
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<img id="h1" src="<?php echo base_url();?>imageneshotel/habitacion-simple.jpg" width="100%" height="200"/>
						<div class="contenthover">
							<div style="margin-top:-15px;"></div>
	    					<h4 style="color:orange; font-weight:bold;">
	    						Habitacion Simple
	    						<?php foreach ($Informacion as $value):
							     	if ($value->codtipohabitacion==1) {echo "Tarifa S/. ".$value->tarifaref;}
			    		 		endforeach ?>
	    					</h4>
						</div>
						<h4 class="service-heading">Habitación Simple</h4>
                    	<p align="justify" style="font-size:15px;">
                    		<?php foreach ($Informacion as $value):
							    if ($value->codtipohabitacion==1) {
							    	echo $value->informacion;
							    }
			    		 	endforeach ?>
                    	</p>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
	                    <img id="h2" src="<?php echo base_url();?>imageneshotel/habitacion-doble.jpg" width="100%" height="200">
	                    <div class="contenthover">
	                    	<div style="margin-top:-15px;"></div>
	    					<h4 style="color:orange; font-weight:bold;">
	    						Habitacion Doble
	    						<?php foreach ($Informacion as $value):
							     	if ($value->codtipohabitacion==2) {echo "Tarifa S/. ".$value->tarifaref;}
			    		 		endforeach ?>
	    					</h4>
						</div> 
                    	<h4 class="service-heading">Habitación Doble</h4>
                    	<p align="justify" style="font-size:15px;">
                    		<?php foreach ($Informacion as $value):
							    if ($value->codtipohabitacion==2) {
							    	echo $value->informacion;
							    }
			    		 	endforeach ?>
                    	</p>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
	                    <img id="h3" src="<?php echo base_url();?>imageneshotel/habitacion-triple.jpg" width="100%" height="200">
	                    <div class="contenthover">
	                    	<div style="margin-top:-15px;"></div>
	    					<h4 style="color:orange; font-weight:bold;">
	    						Habitacion Triple
	    						<?php foreach ($Informacion as $value):
							     	if ($value->codtipohabitacion==3) {echo "Tarifa S/. ".$value->tarifaref;}
			    		 		endforeach ?>
	    					</h4>
						</div>
                    	<h4 class="service-heading">Habitación Triple</h4>
                    	<p align="justify" style="font-size:15px;">
                    		<?php foreach ($Informacion as $value):
							    if ($value->codtipohabitacion==3) {
							    	echo $value->informacion;
							    }
			    		 	endforeach ?>
                    	</p>
					</div>
				</div>
				<div style="height:15px;"></div>
				<div class="row">
					<div class="col-md-4">
	                    <img id="h4" src="<?php echo base_url();?>imageneshotel/habitacion-cuadruple.jpg" width="100%" height="200">
	                    <div class="contenthover">
	    					<div style="margin-top:-15px;"></div>
	    					<h4 style="color:orange; font-weight:bold;">
	    						Habitacion Cuadruple
	    						<?php foreach ($Informacion as $value):
							     	if ($value->codtipohabitacion==4) {echo "Tarifa S/. ".$value->tarifaref;}
			    		 		endforeach ?>
	    					</h4>
						</div>
	                     
                    	<h4 class="service-heading">Habitación Cuadruple</h4>
                    	<p align="justify" style="font-size:15px;">
                    		<?php foreach ($Informacion as $value):
							    if ($value->codtipohabitacion==4) {
							    	echo $value->informacion;
							    }
			    		 	endforeach ?>
                    	</p>
                	</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
	                    <img id="h5" src="<?php echo base_url();?>imageneshotel/habitacion-matrimonial.jpg" width="100%" height="200">
	                    <div class="contenthover">
	    					<div style="margin-top:-15px;"></div>
	    					<h4 style="color:orange; font-weight:bold;">
	    						Habitacion Matrimonial
	    						<?php foreach ($Informacion as $value):
							     	if ($value->codtipohabitacion==6) {echo "Tarifa S/. ".$value->tarifaref;}
			    		 		endforeach ?>
	    					</h4>
						</div>
	                    	    
                    	<h4 class="service-heading">Habitación Matrimonial</h4>
                    	<p align="justify" style="font-size:15px;">
                    		<?php foreach ($Informacion as $value):
							    if ($value->codtipohabitacion==6) {
							    	echo $value->informacion;
							    }
			    		 	endforeach ?>
                    	</p>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
	                    <img id="h6" src="<?php echo base_url();?>imageneshotel/habitacionsuit.jpg" width="100%" height="200">
                    	<div class="contenthover">
	    					<div style="margin-top:-15px;"></div>
	    					<h4 style="color:orange; font-weight:bold;">
	    						Habitacion Suite
	    						<?php foreach ($Informacion as $value):
							     	if ($value->codtipohabitacion==5) {echo "Tarifa S/. ".$value->tarifaref;}
			    		 		endforeach ?>
	    					</h4>
						</div>

                    	<h4 class="service-heading">Habitación Siute</h4>
                    	<p align="justify" style="font-size:15">
                    		<?php foreach ($Informacion as $value):
							    if ($value->codtipohabitacion==5) {
							    	echo $value->informacion;
							    }
			    		 	endforeach ?>
                    	</p>
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
		<script src="<?php echo base_url();?>Pagina/FechaHora/js/bootstrap-datepicker.js"></script>

		<script src="<?php echo base_url();?>Librerias/JavaScript/Validaciones.js"></script>
		<script src="<?php echo base_url(); ?>Librerias/JavaScript/ValidarReserva.js"></script> 

		<script type="text/javascript">
			$(function(){
				$('#fechaingreso').datepicker();
				$('#fechasalida').datepicker();
			});
		</script>


		<div class="modal fade" id="AgregarCliente" tabindex="-1" role="dialog">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                    <h4 class="modal-title">
	                        <center><b> Hotel Tarapoto Inn - Agregar Cliente  </b></center>
	                    </h4>                       
	                </div>
	                <div class="modal-body">
	                    <form id="reservas1" method="POST">
	                    	<div id="aviso" style="color:orange; font-size:18px;padding:5px;"></div>
	                    	<div id="datos">
	                    		<input type="hidden" id="codhabi" name="codhabi">
	                    		<input type="hidden" id="fechaing" name="fechaing">
	                    		<input type="hidden" id="fechasal" name="fechasal">

								<div class="form-group">
									<div class="col-sm-6">
										<input type="text" maxlength="8" class="form-control" name="dni" id="dni" placeholder="DNI Cliente" onkeypress="return Numeros(event);">
									</div>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombres" onkeypress="return Letras(event);">
									</div>
								</div>
								<div style="height:45px">
								</div>
								<div class="form-group">
									<div class="col-sm-6">
										<input type="text" class="form-control" name="apellidop" id="apellidop" placeholder="Apellido P" onkeypress="return Letras(event);">
									</div>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="apellidom" id="apellidom" placeholder="Apellido M." onkeypress="return Letras(event);">
									</div>
								</div>
								<div style="height:30px">
								</div>
								<div class="form-group">
									<div class="col-sm-6">
										<input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion" >
									</div>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="email" id="email" placeholder="Email">
									</div>
								</div>
								<div style="height:30px">
								</div>
								<center><button type="button" onclick="return ReservarAhora(this.form);" class="btn">Generar Reserva</button></center>										
	                    		<div style="height:30px">
								</div>
	                    	</div>
	                    </form>
	                </div>
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
								       <input type="password" class="form-control" name="contra" id="contra">
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
	</body>
</html>