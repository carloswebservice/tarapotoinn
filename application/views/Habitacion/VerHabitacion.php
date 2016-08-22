<style type="text/css">
	#navegar > li > a {
		position: relative;
		display: block;
	    padding: 5px 5px;
	    box-shadow: 0 2px 1px rgba(0, 0, 0, .05);
	}
</style>
<body>
	<script src="<?php echo base_url();?>Librerias/JavaScript/Validaciones.js"></script>
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarHabitacion.js"></script> 
	<div class="container" style="width:100%;">	 <br>	
		<div>
		  	<ul class="nav nav-tabs nav-justified" role="tablist" id="navegar">
		    	<li role="presentation" class="active"><a href="#verhabitaciones" role="tab" data-toggle="tab" style="color:black;"><span class="glyphicon glyphicon-home"></span> Habitacion</a></li>
		    	<li role="presentation"><a href="#agregar" role="tab" data-toggle="tab" style="color:black;"><span class="glyphicon glyphicon-plus-sign"></span> Articulo A La Habitacion</a></li>
		    </ul>

		  	<div class="tab-content">
		  		<!-- Para Ver La Estadia -->
			    <div role="tabpanel" class="tab-pane active" id="verhabitaciones"> <br> <br>
			    	<form  class="form-horizontal" id="Ver">
			    		<?php foreach ($Habitacion as $value){ 
			    				$codigo=$value->codhabitacion;
								$nrohabitacion=$value->nrohabitacion;
								$tarifa=$value->precio;
								$tipohabitacion=$value->descripcion;
						} ?>
						<div class="form-group" >
							<input type="hidden" name="codigo" value="<?php echo $codigo;?>"> 
							<label class="col-md-3 control-label">Num Habitacion</label>
							<div class="col-md-2">
								<input type="text" class="form-control" placeholder="<?php echo $nrohabitacion; ?>" onkeypress="return Nada(event)">
							</div>

							<label class="col-md-1 control-label">Tarifa</label>
							<div class="col-md-2 has-info has-feedback">
								<input type="text" class="form-control" placeholder="<?php echo $tarifa; ?>" onkeypress="return Nada(event)">
								<span class="glyphicon glyphicon-usd txt-default form-control-feedback"></span>
							</div>

							<div class="col-md-4">
								<input type="text" class="form-control" placeholder="<?php echo $tipohabitacion?>" onkeypress="return Nada(event)">
							</div>
						</div>

			            <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

						<div class="form-group">
							<table id="tablacuotas">
								<thead>
									<tr>
										<th> # </th>
										<th> Articulo </th>
										<th> Accion </th>
									</tr>
								</thead>
								<tbody>
									<?php $cont=0;
									foreach ($DetalleHabi as $value): $cont=$cont+1;?>
										<tr>
											<td><center> <?php echo $cont; ?></center></td>
											<td><center> <?php echo $value->descripcionart; ?></center></td>
											<td><center> 
												<a href="#"><span class="glyphicon glyphicon-remove" onclick="EliminarAH(<?php echo $codigo;?>,<?php echo $value->codarticulo;?>)"></span></a>
											</center></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</form>
					<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
					<div class="row">
						<center>
							<button type="button" class="btn btn-danger btn-xs" id="CancelarC" onclick="Cancelar();">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>			    	
						</center>
					</div>
			    </div>

			    <!-- Para Ver Las Cuotas-->
			    <div role="tabpanel" class="tab-pane" id="agregar"> <br><br>
			    		<form class="form-horizontal" id="articulosnuevo" method="POST">
			    				<input type="hidden" name="codhabitacion" value="<?php echo $codigo;?>"> 
								<div class="form-group">
									<label class="col-md-5 control-label">Actualizar La Tarifa</label>
									<div class="col-md-2 has-info has-feedback">
										<input type="text" class="form-control" name="tarifa" value="<?php echo $tarifa; ?>" onkeypress="return Numeros(event)">
										<span class="glyphicon glyphicon-usd txt-default form-control-feedback"></span>
									</div>
								</div>
								<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
								<div class="form-group">
									<label class="col-md-4 control-label">Articulos En Esta Habitacion</label>
									<div class="col-md-4">
										<div class="input-group">
											<input type="text" class="form-control" name="articulo" id="articulo" placeholder=" Buscar Articulo"
											onkeypress="return Nada(event);" data-toggle="popover" data-placement="bottom" data-content="Buscar Producto">
											<input type="hidden"name="codarticulo" id="codarticulo">

											<div class="input-group-addon">
											    <a href="#Articulos" data-toggle="modal" id="Buscar">
											    <span class="glyphicon glyphicon-search" style="color:#6E6E6E;"></span></a> 
											</div>
										</div>
									</div>
									<div class="col-md-1">
										<button type="button" class="btn btn-success btn-xs" onclick="return Agregar(this.form);">
									   	<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Agregar</button> 
									</div>
								</div>

								<div class="form-group">
									<table id="tablaarticulos">
										<thead>
											<tr>
												<th> Codigo </th>
												<th> Descripcion </th>
												<th> Accion </th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>
								</div>

								<div class="row">
									<center>
										<button type="button" class="btn btn-info btn-xs" id="GuardarC" onclick="return Actualizar(this.form);">
									   	<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button> 

										<button type="button" class="btn btn-danger btn-xs" id="CancelarC" onclick="Cancelar();">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>			    	
									</center>
								</div>
						</form>
			    </div>

		  	</div>
		</div>
	</div>


	<div class="modal fade" id="Articulos" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			    <div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        	<h4 class="modal-title">
			        		<center><b> Hotel Tarapoto Inn - Lista De Articulos </b></center>
			        	</h4>			        	
			    </div>
			    <div class="modal-body">
					<table class="table table-hover" id="TablaHabitacion">
						<thead>
								<tr>
									<th><center> Codigo </center></th>
									<th><center> Descripcion </center></th>
									<th><center> Accion </center></th>
								</tr>
						</thead>
						<tbody>
							<?php foreach ($Articulos as $value): ?>
								<tr>
									<td><center> <?php echo $value->codarticulo; ?></center></td>
									<td><center> <?php echo $value->descripcionart; ?></center></td>
									<td> <center> <a href="#" onclick='Seleccionado(<?php echo $value->codarticulo;?>);' data-dismiss="modal">
									<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a></center></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
			    </div>
			</div>
		</div>
	</div>
</body>

<style type="text/css">

	#tablacuotas{
		width: 97%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tablacuotas th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablacuotas td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablaarticulos{
		width: 97%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tablaarticulos th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablaarticulos td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}

	#tablahabitacion{
		width: 97%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tablahabitacion th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablahabitacion td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	label{
		font-size: 13px;
	}
</style>