<html>
	<head>
		<meta charset="UTF-8"> <title>Tarapoto Inn</title>

		<link rel="stylesheet" href="<?php base_url();?>Librerias/Bootstrap/css/bootstrap.min.css">
		<script src="<?php echo base_url();?>Librerias/Bootstrap/js/Jquery.js"></script>
		<script src="<?php echo base_url();?>Librerias/Bootstrap/js/bootstrap.min.js"></script>

		<script src="<?php echo base_url();?>Librerias/Bootstrap/BoottrapMultiselect/js/bootstrap-multiselect.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Librerias/Bootstrap/BoottrapMultiselect/css/Bootstrap-multiselect.css">

		<script src="<?php echo base_url();?>Librerias/Validar.js"></script>
		
		<style type="text/css">
			body{
				background-color: #F2F2F2;
			}
			#contenedor{
				width: 50%;
				background-color: #F2F2F2;
				box-shadow: 0px 20px 150px 50px #A4A4A4;
				border-radius: 10px;
			}
		</style>
	</head>

	<body>
		<div style="height:100px;"></div>
		<div class="container" id="contenedor">
			<div class="row">
				<div class="modal-header">
					<center><h3>
						<span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Configuracion De Motor De Base De Datos
					</h3></center>
				</div>			
			</div> <br>

			<form action="" method="POST" class="form-horizontal">
				<div class="form-group">
				    <label class="col-sm-3 control-label">Motor De BD</label>
				    <div class="col-sm-9">
				       <select id="driver" name="driver" class="form-control">
				       		<option value="gestor">Seleccione Su Gestor</option>
						    <option value="mysql">Gestor MySQL</option>
							<option value="postgres">Gestor PostgreSQL</option>
							<option value="mssql">Gestor SQL Server</option>
							<option value="oracle">Gestor Oracle</option>
						</select>
					</div>
				</div>
				<div class="form-group">
				    <label class="col-sm-3 control-label">Host</label>
				    <div class="col-sm-9">
				       <input type="text" class="form-control" name="host">
					</div>
				</div> 
				<div class="form-group">
				    <label class="col-sm-3 control-label">Usuario</label>
				    <div class="col-sm-9">
				       <input type="text" class="form-control" name="user">
				    </div>
				</div> 
				<div class="form-group">
				    <label class="col-sm-3 control-label">Contraseña</label>
				    <div class="col-sm-9">
					    <input type="text" class="form-control" name="password">
					</div>
				</div> 
				<div class="form-group">
				    <label class="col-md-3 control-label">Base De Datos</label>
				    <div class="col-md-9">
				       <input type="text" class="form-control" name="basedatos">
				    </div>
				</div> <br>
				<div class="form-group">
					<div class="col-md-6">
				      <center><button type="button" id="Tes" class="btn btn-danger">
				    	<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Probar Tes De Conexion</button></center>
				    </div>
				    <div class="col-md-6">
				       <center><button type="submit" class="btn btn-success">
				    	<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Aceptar Configuracion</button></center>
				    </div>
				</div> 
			</form>
		</div>
	</body>
</html>