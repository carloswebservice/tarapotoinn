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
				background-color: #A4A4A4;
				box-shadow: 100px 50px 200px 100px #E6E6E6 inset;
			}
			#contenedor{
				width: 40%;
				background-color: #F2F2F2;
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
						<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Login Para Configuracion SGBD
					</h3></center>
				</div>			
			</div> <br>

			<form action="" method="POST" class="form-horizontal">
				<div class="form-group">
				    <label class="col-md-4 control-label"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Desarrollador</label>
				    <div class="col-md-8">
					    <input type="text" class="form-control" name="desarrollador">
					</div>
				</div> 
				<div class="form-group">
				    <label class="col-md-4 control-label"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Contraseña</label>
				    <div class="col-md-8">
				       <input type="text" class="form-control" name="clave">
				    </div>
				</div> <br>
				<div class="form-group">
				    <div class="col-md-12">
				       <center><button type="submit" class="btn btn-success">
				    	<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Iniciar Configuracion</button></center>
				    </div>
				</div> 
			</form>
		</div>
	</body>
</html>