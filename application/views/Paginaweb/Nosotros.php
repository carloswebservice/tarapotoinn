<html>
	<head>
		<meta charset="UTF-8">
		<title>Hotel Tarapoto</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0 ">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Librerias/plugins/bootstrap/bootstrap.min.css">
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Pagina/css/estilos.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Pagina/css/contacto.css">
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
					<img src="<?php echo base_url();?>/imageneshotel/fondo2.jpg" class="img-responsive img-rounded">
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
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-6">						
						<div id="carouselbanco" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carouselbanco" data-slide-to="0" class="active"></li>
								<li data-target="#carouselbanco" data-slide-to="1"></li>
								<li data-target="#carouselbanco" data-slide-to="2"></li>
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
							</div>
						</div>						
					</div>		
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-2">
					<marquee direction="up" scrolldelay="500" height="220px"><h4 style="color: orange;text-align: justify">El Hotel está ubicado en la Plaza de Armas de Tarapoto, zona segura e iluminada, donde podrá encontrar tiendas, restaurants de todo tipo y precio, cabinas de Internet, tiendas de artesanía, servicios de transporte y mucho más...</h4></marquee>
					</div>
					<div class="hidden-xs hidden-sm hidden-md col-lg-4">
						<div id="fb-root"></div>
						<script>(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5";
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
						<div class="fb-page" data-href="https://www.facebook.com/hoteltarapotoinnoficial?fref=ts" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/hoteltarapotoinnoficial?fref=ts"><a href="https://www.facebook.com/hoteltarapotoinnoficial?fref=ts">Hotel Tarapoto Inn</a></blockquote></div></div>
					</div>			
				</div>
				<div style="height:15px;"></div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
						<p class="color1 text-justify" style="font-size:16px">
							<?php foreach ($Informacion as $value):echo $value->historia;
							 endforeach ?>
						</p>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
					<iframe width="100%" height="174" src="https://www.youtube.com/embed/g6p1mEJaz9A" frameborder="0" allowfullscreen></iframe>
				</div>
				</div>
				<div style="height:15px;"></div>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
						<a href="#" class="thumb pull-left">
							<img class="img-thumbnail img-responsive" src="<?php echo base_url();?>imageneshotel/Vision.jpg" alt="">
						</a>
						<p class="text-justify" style="font-size:16px">
							<?php foreach ($Informacion as $value):echo $value->vision; endforeach ?>
						</p>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
						<a href="#" class="thumb pull-left">
							<img class="img-thumbnail img-responsive" src="<?php echo base_url();?>imageneshotel/Mision.jpg" alt="">
						</a>
						<p class="text-justify" style="font-size:16px">
							<?php foreach ($Informacion as $value):echo $value->mision; endforeach ?>
						</p>				
					</div>			
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
						
						<form id="contacto">
							<center><h3>CONTÁCTENOS</h3></center>
							<div class="form-group">
                                <input type="text" class="form-control" placeholder="Ingrese nombre" id="name">
                              
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Ingrese email" id="email">
                           
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Ingrese telefono" id="phone">
                             
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Ingrese mensaje" id="message"></textarea>
                               
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn">Enviar Mensaje</button>
                            </div>
						</form>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-5">
						<div id="fb-root"></div>
						<script>(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5";
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
						<div class="fb-comments" data-href="https://www.facebook.com/hoteltarapotoinnoficial?fref=ts" data-width="100%" data-numposts="5"></div>


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
		</div>

		<script src="<?php echo base_url();?>Librerias/plugins/jquery/jquery.js"></script>
		<script src="<?php echo base_url();?>Librerias/plugins/bootstrap/bootstrap.min.js"></script>
		
		<script src="<?php echo base_url();?>Pagina/js/Hover.js"></script>
		<script src="<?php echo base_url();?>Pagina/js/Validar.js"></script>
	</body>
</htm>