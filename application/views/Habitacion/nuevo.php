<style type="text/css">
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
	label{
		font-size: 13px;
	}
</style>
<body>
	<script src="<?php echo base_url();?>Librerias/JavaScript/Validaciones.js"></script>
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarHabitacion.js"></script> 

	<div class="container" style="width:100%;">
		<center><h5 style="font-size:15px;"><b> Registro De Una Nueva Habitacion </b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

		<form  class="form-horizontal" id="ForHabitacion">
			<?php foreach ($Nuevo as $value): 
				$cod=$value->codhabitacion;
			endforeach ?>
			<input type="hidden" name="codhabitacion" id="codhabitacion" value="<?php echo $cod+1;?>">

			<div class="form-group" >
				<label class="col-md-3 control-label">Num Habitacion</label>
				<div class="col-md-2">
					<input type="text" class="form-control" name="numero" id="numero" onkeyup="nrohabitacion(this)" onkeypress="return Numeros(event)"
						maxlength="5" data-toggle="popover" data-placement="bottom" data-content="Ingrese Numero">
				</div>

				<label class="col-md-1 control-label">Tarifa</label>
				<div class="col-md-2 has-info has-feedback">
					<input type="text" class="form-control" name="tarifa" id="tarifa" onkeypress="return NumerosPuntos(event)"
						maxlength="8"data-toggle="popover" data-placement="bottom" data-content="Ingrese Tarifa">
					<span class="glyphicon glyphicon-usd txt-default form-control-feedback"></span>
				</div>

				<div class="col-md-3">
					<select id="tipohabitacion" name="tipohabitacion" class="form-control" 
						data-toggle="popover" data-placement="bottom" data-content="Seleccione Tipo Habitacion">
						<option value="tipohabitacion">Tipo Habitacion</option>
						<?php foreach ($TipoHabitaciones as $value): ?>
							<option value="<?php echo $value->codtipohabitacion;?>"><?php echo $value->descripcion; ?></option>
						<?php endforeach ?>
					</select>
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
					<button type="button" class="btn btn-info btn-xs" id="GuardarC" onclick="return Guardar(this.form);">
				   	<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button> 

					<button type="button" class="btn btn-danger btn-xs" id="CancelarC" onclick="Cancelar();">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>			    	
				</center>
			</div>
		</form>
	</div>

	<!-- Modal que carga articulos disponible -->
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