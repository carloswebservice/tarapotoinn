<body>
	<script src="<?php echo base_url();?>Librerias/JavaScript/Validaciones.js"></script>
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarDatosMaestros.js"></script>
	<div class="container" style="width:100%;">
		<center><h5 style="font-size:15px;"><b> Informacion Del Hotel Tarapoto Inn </b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

		<form  class="form-horizontal" id="ForDatosMaestros">
			<div class="form-group">			
				<div class="col-md-6">
					<center><label class="control-label">Misión Del Hotel</label></center><br>
					<textarea class="form-control" disabled="disabled" name="mision" id="mision" style="width:350px; height:230px;resize:none;text-align:justify;">
						<?php foreach ($Informacion as $value):echo $value->mision; endforeach ?>
					</textarea>
				</div>
				<div class="col-md-6">
					<center><label class="control-label">Visión Del Hotel</label></center><br>
					<textarea class="form-control" disabled="disabled" name="vision" id="vision" style="width:350px; height:230px;resize:none;text-align:justify;">
						<?php foreach ($Informacion as $value): echo $value->vision; endforeach ?>
					</textarea>
				</div>
			</div>
			<div class="row">
				<center>
					<button type="button" class="btn btn-success btn-xs" id="EditarC" onclick="Editar();">
			    	<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Editar </button> 

					<button type="button" class="btn btn-info btn-xs" id="GuardarC" disabled="disabled" onclick="return Guardar(this.form);">
				   	<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button> 

					<button type="button" class="btn btn-danger btn-xs" id="CancelarC" disabled="disabled" onclick="Cancelar();">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>			    	
				</center>
			</div>					
		</form>

		<div style="width: 100%;height: 1px; background-color: #D8D8D8; margin-top:-10px;"></div> <br>
	</div>		
</body>