<?php
    session_start();
    function getmodulos(){
        $CI =& get_instance();
        $CI->load->database('default');
        $id = $_SESSION['codcargo'];

        $modulos = $CI->db->get_where("modulos",array("estado"=> "A","mod_padre"=>0))->result_array();
        $permisos = $CI->db->get_where("permisos",array("codcargo" => $id ))->result_array();

        $arrp = array();
        foreach ($permisos as $key => $value) {
            $arrp[] = $value["modulo_id"];
        }
        $html = ' <ul class="nav main-menu"> ';
        foreach ($modulos as $key => $value) {
            if(in_array($value["id"],$arrp)){
                $html.= "<li class='dropdown'><a href='#' class='dropdown-toggle'>";
                $html .= '<span class="glyphicon '.$value["mod_icono"].'" aria-hidden="true"></span>';
                $html .= '<span class="hidden-xs"><b> '.$value["mod_descripcion"]."</b></span>".cargapadre($value["id"],$arrp,$CI);
                $html.=  "</a></li>";
            }
        }
        $html .= "</ul>";
        print $html;
    }

    function cargapadre($idpadre,$arrp,$CI){
        $CI->load->database('default');
        $modulos = $CI->db->get_where("modulos",array("estado"=> "A","mod_padre"=>$idpadre))->result_array();

        $html = '<ul class="dropdown-menu">';
        foreach ($modulos as $key => $value) {
            if(in_array($value["id"],$arrp)){
                $html .= "<li><a href='#' id='".$value["mod_url"]."' >".$value["mod_descripcion"]."</a></li>";
            }
        }
        $html .= "</ul>";
        return  $html;
    }
    if (isset($_SESSION['usuario'])){ ?>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<title>Tarapoto Inn</title>
			<meta name="description" content="description">

			<link rel="icon" href="<?php echo base_url();?>Librerias/hotel.png" type="image/x-icon" />
			<link href="<?php echo base_url();?>Librerias/plugins/bootstrap/bootstrap.css" rel="stylesheet">
			<link href="<?php echo base_url();?>Librerias/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
			<link href="<?php echo base_url();?>Librerias/CSS/style_v2.css" rel="stylesheet">

			<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Librerias/CSS/DataTable.css">
			<script type="text/javascript">
				var BASEURL="<?php echo base_url(); ?>";
			</script>
			<style type="text/css">
				#contenidoge{
					width: 80%;
					margin: auto;
					margin-left: 162px;
				}
				#barra{
					width: 76.1%;
					margin: auto;
					margin-left: 162px;
					background: #A4A4A4;
				}
			</style>
		</head>
	<body>
	<div id="contenidoge">
		<header class="navbar" id="barra" >
			<div class="container-fluid expanded-panel">
				<div class="row">
					<div id="logo" class="col-xs-12 col-sm-7">
						<a href="#" style="font-family:forte;">Hotel Tarapoto Inn</a>
					</div>
					<div id="top-panel" class="col-xs-12 col-sm-5">
						<div class="row">
							<div class="col-xs-4 col-sm-12 top-panel-right">
								<ul class="nav navbar-nav pull-right panel-menu">
									<li class="hidden-xs">
										<a href="#AlertasSistema" data-toggle="modal" class="modal-link">
											<span class="glyphicon glyphicon-bell" aria-hidden="true" style="color:#fff; font-size:18px;"></span>
											<span class="badge" style="color:orange;">
												<?php
													echo count($Alertas);
					                            ?>
											</span>
										</a>
									</li>
									<li class="hidden-xs">
										<a href="#FinEstadias" data-toggle="modal" class="modal-link">
											<span class="glyphicon glyphicon-calendar" aria-hidden="true" style="color:#fff; font-size:18px;"></span>
											<span class="badge" style="color:orange;">
												<?php
													echo $NumFinEstadias;
					                            ?>
											</span>
										</a>
									</li>
									<li class="hidden-xs">
										<a href="#AlertaProductos" data-toggle="modal" class="modal-link">
											<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true" style="color:#fff; font-size:18px;"></span>
											<span class="badge" style="color:orange;">
												<?php
													echo count($ProductosDeficet)+count($ProductosExeso);
					                            ?>
											</span>
										</a>
									</li>
									<li><a href="#" style="color:#585858;"> <b> <?php echo $_SESSION['usuario']; ?></b> </a></li>
									<li class="dropdown">
									    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								       	aria-expanded="false"> <span class="glyphicon glyphicon-lock" aria-hidden="true" style="color:#585858;"></span> &nbsp;</a>
										<ul class="dropdown-menu">
											<li><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Ver Perfil</a></li>
									        <li><a href="<?php echo base_url();?>paginaweb/cerrarsession"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Cerrar Sesion</a></li>
									    </ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div id="main" class="container-fluid">
			<div class="row">
				<div id="sidebar-left" class="col-xs-2 col-sm-2">
                <?php  echo getmodulos(); ?>
				</div>

				<div id="content" class="col-xs-12 col-sm-9">
					<div id="ContenidoPrincipal">
						<div style="height:100px;"></div>
						<center>
							<h2>Bienvenido Usuario --- Sistema Hotel Tarapoto Inn</h2> <br><br>
							<img src="<?php echo base_url();?>imageneshotel/logo.jpg" width="400" height="250">
						</center>
						<div style="height:100px;"></div>
					</div>
				</div>

				<!-- Alertas de sistema-->
				<div class="modal fade" id="AlertasSistema" tabindex="-1" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">
									<center> <b>Avisos De Cuotas Pendientes </b></center>
								</h4>
							</div>
							<div class="modal-body">
								<div style="height:300px;padding:10px;overflow-y:scroll;">
								<?php foreach ($Alertas as $value):
									if ($value->razonsocial=='') {
										echo "<div style='margin-top:-10px;'></div>";
		                            	echo "<div class='alert alert-warning' style='padding:5px;color:black;'>";
		                            	echo "<span class='glyphicon glyphicon-warning-sign' style='color:#DBA901'></span>
		                            		A <strong>$value->nombre $value->appaterno (DNI: $value->dnicliente)</strong>
		                            		le falta cancelar la <strong> cuota $value->nrocuota</strong> que venció el $value->fecha,
		                            		Por la  $value->concepto del dia $value->fechaconcepto";
		                            	echo "</div>";
									}else{
										echo "<div style='margin-top:-10px;'></div>";
		                            	echo "<div class='alert alert-warning' style='padding:5px;color:black;'>";
		                            	echo "<span class='glyphicon glyphicon-warning-sign' style='color:#DBA901'></span>
		                            		A la empresa <strong>$value->nombre $value->appaterno (DNI: $value->dnicliente)</strong>
		                            		le falta cancelar la <strong> cuota $value->nrocuota</strong> que venció el $value->fecha,
		                            		Por la  $value->concepto del dia $value->fechaconcepto";
		                            	echo "</div>";
									}
	                            endforeach ?>
	                            </div>
							</div>
						</div>
					</div>
				</div>

				<!-- Fin de estadia del sistema-->
				<div class="modal fade" id="FinEstadias" tabindex="-1" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">
									<center> <b>Lista De Estadias Que Terminan Hoy </b></center>
								</h4>
							</div>
							<div class="modal-body">
								<div style="height:300px;padding:10px;overflow-y:scroll;">
								<?php foreach ($FinEstadias as $value){
									if ($value->razonsocial=='') {
										echo "<div style='margin-top:-10px;'></div>";
		                            	echo "<div class='alert alert-warning' style='padding:5px;color:black;'>";
		                            	echo "<span class='glyphicon glyphicon-warning-sign' style='color:#DBA901'></span>
		                            		La Estadia De <strong>$value->nombre $value->appaterno $value->apmaterno </strong> con DNI <strong>$value->dnicliente;</strong> Termina Hoy A Las <strong>$value->horasalida </strong>";
		                            	echo "</div>";
									}else{
										echo "<div style='margin-top:-10px;'></div>";
		                            	echo "<div class='alert alert-warning' style='padding:5px;color:black;'>";
		                            	echo "<span class='glyphicon glyphicon-warning-sign' style='color:#DBA901'></span>
			                            	La Estadia De La Empresa <strong>$value->razonsocial </strong> con RUC <strong>$value->ruc;</strong> Termina Hoy A Las <strong>$value->horasalida </strong>";
		                            	echo "</div>";
									}
	                            }
	                            $can=count($EstadiasTerminadas);
	                            if ($can>0) {
	                            	echo "<center><h5>Estadias Que Terminaron ...</h5></center>";
	                            	foreach ($EstadiasTerminadas as $value) {
		                             	if ($value->razonsocial=='') {
											echo "<div style='margin-top:-10px;'></div>";
			                            	echo "<div class='alert alert-danger' style='padding:5px;color:black;'>";
			                            	echo "<span class='glyphicon glyphicon-warning-sign'></span>
			                            		La Estadia De <strong>$value->nombre $value->appaterno $value->apmaterno </strong> con DNI <strong>$value->dnicliente;</strong> Terminó el <strong>$value->fechasalida </strong>";
			                            	echo "</div>";
										}else{
											echo "<div style='margin-top:-10px;'></div>";
			                            	echo "<div class='alert alert-danger' style='padding:5px;color:black;'>";
			                            	echo "<span class='glyphicon glyphicon-warning-sign' ></span>
				                            	La Estadia De La Empresa <strong>$value->razonsocial </strong> con RUC <strong>$value->ruc;</strong> Terminó el <strong>$value->fechasalida </strong>";
			                            	echo "</div>";
										}
		                            }
	                            } ?>
	                            </div>
							</div>
						</div>
					</div>
				</div>

				<!-- Para Comprar Productos-->
				<div class="modal fade" id="AlertaProductos" tabindex="-1" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">
									<center> <b>Avisos De Productos </b></center>
								</h4>
							</div>
							<div class="modal-body">
								<div style="height:300px;padding:10px;overflow-y:scroll;">
									<?php foreach ($ProductosDeficet as $value){
										echo "<div style='margin-top:-10px;'></div>";
		                            	echo "<div class='alert alert-warning' style='padding:5px;color:black;'>";
		                            	echo "<span class='glyphicon glyphicon-warning-sign' style='color:#DBA901'></span>
		                            		Se recomienda comprar mas <strong>$value->descripcion;</strong>
		                            		Tan solo hay en Stock un Total de <strong> $value->stockactual</strong>";
		                            	echo "</div>";
	                            	} ?>
	                            	<?php foreach ($ProductosExeso as $value){
										echo "<div style='margin-top:-10px;'></div>";
		                            	echo "<div class='alert alert-warning' style='padding:5px;color:black;'>";
		                            	echo "<span class='glyphicon glyphicon-warning-sign' style='color:#DBA901'></span>
		                            		Se recomienda no comprar mas <strong>$value->descripcion;</strong>
		                            		Tiene un alto Stock de este producto";
		                            	echo "</div>";
	                            	} ?>
	                            </div>
							</div>
						</div>
					</div>
				</div>

				<!-- Mensaje De Alerta-->
				<div class="modal fade" id="Alerta" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">
									<center> <div id="Mensaje"></div> </center>
								</h5>
							</div>
							<div class="modal-body">
								<center>
									<button type="button" class="btn btn-info btn-xs"onclick="Actualizando()">
								   	<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Aceptar</button>
							   	</center>
							</div>
						</div>
					</div>
				</div>

				<div class="modal fade" id="Alerta1" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">
									<center> <div id="Mensaje1"></div> </center>
								</h5>
							</div>
							<div class="modal-body">
								<center>
									<button type="button" class="btn btn-info btn-xs"onclick="Actualizando1()">
								   	<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Aceptar</button>
							   	</center>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<script src="<?php echo base_url();?>Librerias/plugins/jquery/jquery.min.js"></script>
		<script src="<?php echo base_url();?>Librerias/plugins/jquery-ui/jquery-ui.min.js"></script>

		<script src="<?php echo base_url();?>Librerias/plugins/bootstrap/bootstrap.min.js"></script>

		<script src="<?php echo base_url();?>Librerias/plugins/tinymce/tinymce.min.js"></script>
		<script src="<?php echo base_url();?>Librerias/plugins/tinymce/jquery.tinymce.min.js"></script>
		<script src="<?php echo base_url();?>Librerias/js/devoops.js"></script>

		<script src="<?php echo base_url();?>Librerias/plugins/xchart/highcharts.js"></script>


		<script src="<?php echo base_url();?>Librerias/JavaScript/DataTable.js"></script>

		<script type="text/javascript">
				var baseurl="<?php echo base_url();?>";
				$(function(){
					$('#Habitacion').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Habitacion");
					});

	                $('#Reserva').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Reserva");
					});

					$('#TipoHabitacion').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"TipoHabitacion");
					});
					$('#Categoria').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Categoria");
					});
					$('#Cargo').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Cargo");
					});
					$('#Empleado').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Empleado");
					});
					$('#TipoComprobante').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"TipoComprobante");
					});
					$('#Articulo').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Articulo");
					});
					$('#FormaPago').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"FormaPago");
					});
					$('#TipoMovimiento').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"TipoMovimiento");
					});
					$('#TipoProducto').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"TipoProducto");
					});
					$('#Proveedor').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Proveedor");
					});
					$('#Producto').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Producto");
					});
					$('#Cliente').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Cliente");
					});
					$('#Estadia').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Estadia");
					});
					$('#NuevoConsumo').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Estadia");
					});
					$('#Venta').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Venta");
					});
					$('#Compra').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Compra");
					});
					$('#Conceptos').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Conceptos");
					});
					$('#Caja').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Caja");
					});
					$('#Movimiento').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Movimiento");
					});
					$('#VerMovimiento').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Movimiento/VerMovimiento");
					});
					$('#DatosMaestros').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"DatosMaestros");
					});
					$('#reporestadias').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Reportes/estadias");
					});
					$('#reporventas').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Reportes/ventas");
					});
					$('#reporcompras').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Reportes/compras");
					});
					$('#reporclientes').on('click',function(){
						$("#ContenidoPrincipal").load(baseurl+"Reportes/clientes");
					});

                    $('#Permisos').on('click',function(){
                        $("#ContenidoPrincipal").load(baseurl+"Permisos");
                    });

				});
			</script>
		</body>
	</html>
    <?php } else {
        header("location: ./");
    }
?>
