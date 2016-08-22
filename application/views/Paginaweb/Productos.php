<html>
	<head>
		<meta charset="UTF-8">
		<title>Hotel Tarapoto</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0 ">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Librerias/plugins/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Pagina/css/estilos.css">
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
					    <li class="menus"><a href="nosotros"><span class="glyphicon glyphicon-star"></span> Nosotros</a></li>
					    <li class="menus"><a href="habitaciones"><span class="glyphicon glyphicon-home"></span> Habitaciones</a></li>					    
					    <li class="menus"><a href="tours"><span class="glyphicon glyphicon-plane"></span> Tours</a></li>
					    <li class="menus"><a href="productos"><span class="glyphicon glyphicon-shopping-cart"></span> Productos</a></li>
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
					<section class="post col-md-8">
						<article class="post clearfix">
							<a href="#" class="thumb pull-left">
								<img class="img-thumbnail" src="<?php echo base_url();?>Pagina/Imagenes/Bebidas/500ml.jpg" alt="">
							</a>
							<h3 class="post-title">
								Gaseosas
							</h3>
							<p class="contenido text-justify">
								Disfruta de las mejores marcas en bebidas refrescantes y efervescente para evitar la pérdida de dióxido de carbono. Se ofrecen diversas marcas de gaseosas como son: Inca Kola, Coca Cola, Sprite, Pepsi, Fanta, Kola Real, Maltin Power, entre otros y en los diversos tamaños
							</p>
						</article>
						<article class="post clearfix">
							<a href="#" class="thumb pull-left">
								<img class="img-thumbnail" src="<?php echo base_url();?>Pagina/Imagenes/Bebidas/ron.jpg" alt="">
							</a>
							<h3 class="post-title">
								Vinos y Licores
							</h3>
							
							<p class="contenido text-justify">
								Disfruta de nuestros vinos y licores  donde los patas y los buenos momentos se unen. 
							</p>
						</article>
						<article class="post clearfix">
							<a href="#" class="thumb pull-left">
								<img class="img-thumbnail" src="<?php echo base_url();?>Pagina/Imagenes/Bebidas/redbull.jpg" alt="">
							</a>
							<h3 class="post-title">
								Bebidas Energéticas
							</h3>
							
							<p class="contenido text-justify">
								Tenemos bebidas energizantes en las siguientes marcas: Monster Energy, Red Bul, entre otros.
							</p>
						</article>
						<article class="post clearfix">
							<a href="#" class="thumb pull-left">
								<img class="img-thumbnail" src="<?php echo base_url();?>Pagina/Imagenes/Bebidas/helados.jpg" alt="">
							</a>
							<h3 class="post-title">
								Helados
							</h3>
							<p class="contenido text-justify">
								Todos los sabores regionales. Ven y disfruta.
							</p>
						</article>
						<article class="clearfix">
							<a href="#" class="thumb pull-left">
								<img class="img-thumbnail" src="<?php echo base_url();?>Pagina/Imagenes/Bebidas/comida.jpg" alt="">
							</a>
							<h3 class="post-title">
								Gastronomia
							</h3>
							<p class="contenido text-justify">
							  Se encuentran una gran variedad de platos típicos que gozan de un gran prestigio nacional, por la preparación adecuada, los sabores agradables, los ingredientes que utiliza y por lo exótico de éstos.
							  								
							</p>
						</article>
					</section>
					<aside class="col-md-4 hidden-xs hidden-sm">
						<div id="fb-root"></div>
						<script>(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5";
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
						<div class="fb-page" data-href="https://www.facebook.com/hoteltarapotoinnoficial?fref=ts" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/hoteltarapotoinnoficial?fref=ts"><a href="https://www.facebook.com/hoteltarapotoinnoficial?fref=ts">Hotel Tarapoto Inn</a></blockquote></div></div>
						<center><h4 id="youtube">YouTube</h4></center>
						<iframe width="307" height="180" src="https://www.youtube.com/embed/g6p1mEJaz9A" frameborder="0" allowfullscreen></iframe>
						<h4>Articulos Recientes</h4>
						<a href="#" class="list-group-item">
							<h4 class="list-group-item-heading">Cartavio Superior</h4>
							<img src="<?php echo base_url();?>Pagina/Imagenes/Bebidas/superior_m.jpg" width="100%" height="120px">
							<p class="list-group-item-text">Ron Añejo. Tamaño: 1L. / 750ml. / 250ml. / 125ml. Vol Alc. 40%
                             Un ron de color ámbar intenso y con sabor a fino roble, avanillado y dulce. Ideal para tomarlo puro, con hielo, con ginger ale o cola.</p>
						</a>
						<a href="#" class="list-group-item">
							<h4 class="list-group-item-heading">Guarana</h4>
							<img src="<?php echo base_url();?>Pagina/Imagenes/Bebidas/guarana.jpg" width="100%" height="120px">
							<p class="list-group-item-text">Guaran Backus. Tamaño: 1L. / 750ml. / 250ml. / 125ml. Vol Alc. 40%
                             hecho con el fruto amazonico mas refrescante. Ideal para tomarlo puro.</p>
						</a>
					</aside>
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