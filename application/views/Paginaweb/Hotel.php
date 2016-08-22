<html>
	<head>
		<meta charset="UTF-8">
		<title>Hotel Tarapoto</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0 ">
		<link rel="icon" href="<?php echo base_url();?>Librerias/hotel.png" type="image/x-icon" />
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
					<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
						<div id="carouselbanco" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carouselbanco" data-slide-to="0" class="active"></li>
								<li data-target="#carouselbanco" data-slide-to="1"></li>
								<li data-target="#carouselbanco" data-slide-to="2"></li>
								<li data-target="#carouselbanco" data-slide-to="3"></li>
							</ol>

							<div class="carousel-inner" role="listbox">
								<div class="item active">
									<img src="<?php echo base_url();?>imageneshotel/slide1.jpg" class="img-responsive" id="Imagenes">
								</div>
								<div class="item">
									<img src="<?php echo base_url();?>imageneshotel/slide2.jpg" class="img-responsive" id="Imagenes">
								</div>
								<div class="item">
									<img src="<?php echo base_url();?>imageneshotel/slide3.jpg" class="img-responsive" id="Imagenes">
								</div>
								<div class="item">
									<img src="<?php echo base_url();?>imageneshotel/slide4.jpg" class="img-responsive" id="Imagenes">
								</div>
							</div>

							<a class="left carousel-control" href="#carouselbanco" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#carouselbanco" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>		
					<div class="col-xs-12 col-sm-4 col-md-6 col-lg-3">
						<h4 id="actividad"><marquee>HOTEL TARAPOTO INN</marquee></h4>
						<div style="height: 2px; background-color: #4d4d4d; margin-top:-5px;"></div>
						<a href="#" class="event"><span class="glyphicon glyphicon-folder-open"></span> Conferencias</a>
						<a class="event"><span class="glyphicon glyphicon-glass"></span> Eventos</a>
						<a class="event"><span class="glyphicon glyphicon-tag"></span> Promociones</a>
						<a class="event"><span class="glyphicon glyphicon-flag"></span> Celebraciones</a>
					</div>
					<div class="col-xs-12 hidden-sm hidden-md col-lg-3 hidden-sm">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.2590802312425!2d-76.36232208563693!3d-6.488841365245601!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91ba0c08893535cb%3A0x99ad097213b0bfd7!2sHotel+Tarapoto+Inn!5e0!3m2!1ses!2spe!4v1444571703417" width="100%" height="32%" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
						<figure>
						    <a href="<?php echo base_url();?>paginaweb/habitaciones">
							    <figcaption>
							     	<h2>
							     		<a href="<?php echo base_url();?>paginaweb/habitaciones">
							     			Habitación simple: Perfectas para 1 persona [ TARIFA: S/ 
							     			<?php foreach ($Informacion as $value):
							     		 		if ($value->codtipohabitacion==1) {echo $value->tarifaref;}
			    		 		 			endforeach ?> ]
							     		</a>
							     	</h2>
							     	<a href="<?php echo base_url();?>paginaweb/habitaciones"><h3>HABITACIONES</h3></a>
							     	<a href="<?php echo base_url();?>paginaweb/habitaciones">
							     		<P style="text-align:justify; padding:7px;">
							     		 	<?php foreach ($Informacion as $value):
							     		 		if ($value->codtipohabitacion==1) {
							     		 			$info = substr($value->informacion, 0, 140)." ...";
							     		 			$imagen= $value->imagen;
													echo $info;
							     		 		}
			    		 		 			endforeach ?>
							     		</P>
							     		</a>
							    </figcaption>
						    </a>
						    <a href="#"><img src="<?php echo base_url();?>imageneshotel/<?php echo $imagen ?>" width="100%" height="99"></a>
						</figure>						
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
						<figure>
						    <a href="<?php echo base_url();?>paginaweb/habitaciones">
							    <figcaption>
							     	<h2>
							     		<a href="<?php echo base_url();?>paginaweb/habitaciones">
							     			Habitación doble: Perfecta para 2 personas [ TARIFA: S/ 
							     			<?php foreach ($Informacion as $value):
							     		 		if ($value->codtipohabitacion==2) {echo $value->tarifaref;}
			    		 		 			endforeach ?> ]  
							     		</a>
							     	</h2>
							     	<a href="<?php echo base_url();?>paginaweb/habitaciones"><h3>HABITACIONES</h3></a>
							     	<a href="<?php echo base_url();?>paginaweb/habitaciones">
							     		<P style="text-align:justify; padding:7px;">
							     		 	<?php foreach ($Informacion as $value):
							     		 		if ($value->codtipohabitacion==2) {
							     		 			$info = substr($value->informacion, 0, 140)." ...";
							     		 			$imagen= $value->imagen;
													echo $info;
							     		 		}
			    		 		 			endforeach ?>
							     		</P>
							     	</a>
							    </figcaption>
						     </a>
						    <a href="#"><img src="<?php echo base_url();?>imageneshotel/<?php echo $imagen ?>" width="100%" height="99"></a>
						</figure>						
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
						<figure>
						    <a href="Habitaciones.php">
							    <figcaption>
							     	<h2><a href="<?php echo base_url();?>paginaweb/habitaciones">
							     		Habitación triple: Perfecta para 3 personas [ TARIFA: s/ 
							     		<?php foreach ($Informacion as $value):
							     		 	if ($value->codtipohabitacion==3) {echo $value->tarifaref;}
			    		 		 		endforeach ?> ]
							     	</a></h2>
							     	<a href="<?php echo base_url();?>paginaweb/habitaciones"><h3>HABITACIONES</h3></a>
							     	<a href="<?php echo base_url();?>paginaweb/habitaciones">
							     		<P style="text-align:justify; padding:7px;">
							     		 	<?php foreach ($Informacion as $value):
							     		 		if ($value->codtipohabitacion==3) {
							     		 			$info = substr($value->informacion, 0, 140)." ..."; 
							     		 			$imagen= $value->imagen;
													echo $info;
							     		 		}
			    		 		 			endforeach ?>
							     		</P>
							     	</a>
							    </figcaption>
						    </a>
						    <a href="#"><img src="<?php echo base_url();?>imageneshotel/<?php echo $imagen ?>" width="100%" height="99"></a>
						</figure>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
						<figure>
						    <a href="<?php echo base_url();?>paginaweb/habitaciones">
							    <figcaption>
							     	<h2><a href="<?php echo base_url();?>paginaweb/habitaciones">
							     		Habitación matrimonial: perfectas para parejas [ TARIFA: S/ 
							     		<?php foreach ($Informacion as $value):
							     		 	if ($value->codtipohabitacion==6) {echo $value->tarifaref;}
			    		 		 		endforeach ?>]
							     	</a></h2>
							     	<a href="<?php echo base_url();?>paginaweb/habitaciones"><h3>HABITACIONES</h3></a>
							     	<a href="<?php echo base_url();?>paginaweb/habitaciones">
							     		<P style="text-align:justify; padding:7px;">
							     		 	<?php foreach ($Informacion as $value):
							     		 		if ($value->codtipohabitacion==6) {
							     		 			$info = substr($value->informacion, 0, 140)." ...";
							     		 			$imagen= $value->imagen;
													echo $info;
							     		 		}
			    		 		 			endforeach ?>
							     		</P>
							     	</a>
							    </figcaption>
						     </a>
						    <a href="#"><img src="<?php echo base_url();?>imageneshotel/<?php echo $imagen ?>" width="100%" height="99"></a>
						</figure>
					</div>
				</div>
				<div style="height:20px;"></div>
				<div class="row">
					<section class="col-md-8" id="margen">
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
							<div class="panel panel-default">
								<div class="vista">
									<img src="<?php echo base_url();?>Pagina/Imagenes/Hotel/camioneta.jpg" width="100%" height="175">  
					                <div class="mascara">  
					                    <h2>CAMIONETA PARA EXCURSIONES</h2>  
					                    <p>Camioneta para excursion para 20 pasajeros</p>   
					                </div>
					            </div>
					        </div>
				        </div>							
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
							<div class="panel panel-default" >
								<div class="vista">
									<img src="<?php echo base_url();?>Pagina/Imagenes/hotel/sala.jpg" width="100%" height="175">  
					                <div class="mascara">  
					                    <h2>SALA DE CAPACITACIÓN</h2>  
					                    <p>Ofrecemos 2 salas de capacitación...</p>  
					                </div>
					            </div>
					        </div>
						</div>						
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
							<div class="panel panel-default">
								<div class="vista">
									<img src="<?php echo base_url();?>Pagina/Imagenes/Hotel/sala2.jpg" width="100%" height="175">  
					                <div class="mascara">  
					                    <h2>SALA DE ESPERA SEGUNDO PISO</h2>  
					                    <p>Sala de espera totalmente totalmente amobladas...</p>  
					                </div>
					            </div>
					        </div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="panel panel-default" >
								<div class="vista">
									<img src="<?php echo base_url();?>Pagina/Imagenes/Bebidas/ron.jpg" width="100%" height="175">  
					                <div class="mascara">  
					                    <h2>RON CARTAVIO</h2>  
					                    <p>Nuevo Ron Cartavio BLACK BARREL, el sabor intenso y brillo perfecto que esperabas.</p>  
					                    <a href="<?php echo base_url();?>paginaweb/Productos" class="informacion">Leer Más</a>  
					                </div>
					            </div>
					        </div>
						</div>	
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="panel panel-default" >
								<div class="vista">
									<img src="<?php echo base_url();?>Pagina/Imagenes/Bebidas/comida.jpg" width="100%" height="175">  
					                <div class="mascara">  
					                    <h2>GASTRONOMIA</h2>  
					                    <p>Ofrecemos diversos platos tipicos de nuestra region, buen servicio  y  comodidad.</p>  
					                    <a href="<?php echo base_url();?>paginaweb/Productos" class="informacion">Leer Más</a>  
					                </div>
					            </div>
					        </div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="panel panel-default" >
								<div class="vista">
									<img src="<?php echo base_url();?>Pagina/Imagenes/Bebidas/pilsen.jpg" width="100%" height="175">  
					                <div class="mascara">  
					                    <h2>Cervezas</h2>  
					                    <p>Ofrecemos cervezas en diferentes marcas: Pilsen callao, Cusqueña, Cristal, Backus</p>  
					                    <a href="<?php echo base_url();?>paginaweb/Productos" class="informacion">Leer Más</a>  
					                </div>
					            </div>
					        </div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="panel panel-default" >
								<div class="vista">
									<img src="<?php echo base_url();?>Pagina/Imagenes/Bebidas/helados.jpg" width="100%" height="175">  
					                <div class="mascara">  
					                    <h2>HELADOS</h2>  
					                    <p>Disfruta de nuestros deliciosos y refrescantes helados de pura fruta regional...</p>  
					                    <a href="<?php echo base_url();?>paginaweb/Productos" class="informacion">Leer Más</a>  
					                </div>
					            </div>
					        </div>
						</div>
				    </section>
				    <aside class="col-xs-12 hidden-sm col-md-4">
				    	<div id="fb-root"></div>
						<script>(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5";
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
						<div class="fb-page" data-href="https://www.facebook.com/hoteltarapotoinnoficial?fref=ts" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/hoteltarapotoinnoficial?fref=ts"><a href="https://www.facebook.com/hoteltarapotoinnoficial?fref=ts">Hotel Tarapoto Inn</a></blockquote></div></div>
						
						<div style="height:5px;"></div>  	
						<iframe width="100%" height="163" src="https://www.youtube.com/embed/k9_ayfeNcdE" frameborder="0" allowfullscreen></iframe>
						<div style="height:8px;"></div>
						<iframe width="100%" height="163" src="https://www.youtube.com/embed/g6p1mEJaz9A" frameborder="0" allowfullscreen></iframe>				
				    </aside>
				</div>					
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
						<img id="d1" src="<?php echo base_url();?>imageneshotel/city.jpg" width="100%" height="170" />
						<div class="contenthover">
	    					<h3>CITY TOURS</h3>
	    					<p>Se visitara la fábrica de chocolates “La Orquídea”, en la zona de Partido Alto...</p>
	    					<p><a href="<?php echo base_url();?>paginaweb/Tours" class="mybutton">Saber mas >></a></p>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
						<img id="d2" src="<?php echo base_url();?>imageneshotel/laguna.jpg" width="100%" height="170" />
						<div class="contenthover">
	    					<h3>LAGUNA AZUL</h3>
	    					<p> La aventura comienza en la laguna azul... </p>
	    					<p><a href="<?php echo base_url();?>paginaweb/Tours" class="mybutton">Saber mas >></a></p>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
						<img id="d3" src="<?php echo base_url();?>imageneshotel/catarata.jpg" width="100%" height="170" />
						<div class="contenthover">
	    					<h3>CATARATAS</h3>
	    					<p>Desde Tarapoto a 45 Minutos por auto  llegando al Distrito de San Antonio... </p>
	    					<p><a href="<?php echo base_url();?>paginaweb/Tours" class="mybutton">Saber mas >></a></p>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
						<img id="d4" src="<?php echo base_url();?>imageneshotel/canotaje.jpg" width="100%" height="170" />
						<div class="contenthover">
	    					<h3>CANOTAJE</h3>
	    					<p>Esta aventura se inicia desde el poblado de San Miguel de Río Mayo... </p>
	    					<p><a href="<?php echo base_url();?>paginaweb/Tours" class="mybutton">Saber mas >></a></p>
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

			<footer>
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-5">
						<a href="https://www.facebook.com/hoteltarapotoinnoficial?fref=ts" target="_blank"><img id="imgred"src="<?php echo base_url();?>imageneshotel/facebook.png"></a>
						<a href="https://twitter.com/?lang=es" target="_blank"><img id="imgred" src="<?php echo base_url();?>imageneshotel/twitter.png"></a>
						<a href="https://accounts.google.com/ServiceLogin?service=mail&continue=https://mail.google.com/mail/&hl=es#identifier"><img id="imgred" src="<?php echo base_url();?>imageneshotel/google.png"></a>
						<a href="https://www.youtube.com/watch?v=g6p1mEJaz9A" target="_blank"><img id="imgred" src="<?php echo base_url();?>imageneshotel/youtube.png"></a>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
						<p id="Telefono">Jr. Jimenez Pimentel N° 115 - Tarapoto / Telefono : 42-524213</p>
					</div>
				</div>
			</footer>
		</div>
		<script src="<?php base_url();?>Librerias/plugins/jquery/jquery.js"></script>
		<script src="<?php base_url();?>Librerias/plugins/bootstrap/bootstrap.min.js"></script>
		
		<script src="<?php base_url();?>Pagina/js/Hover.js"></script>
		<script src="<?php base_url();?>Pagina/js/Validar.js"></script>
	</body>
</htm>