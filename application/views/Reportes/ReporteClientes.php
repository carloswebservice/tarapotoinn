<body>
	<script src="<?php echo base_url();?>Librerias/JavaScript/Reportes.js"></script>
	<div class="container" style="width:100%;"> <br>
		<div class="row">
			<div class="col-md-3">
				<img src="<?php echo base_url();?>imageneshotel/logo.jpg" height="60" width="200">
			</div>
			<div class="col-md-6">
				<center><h5 style="font-size:15px;"><b> Lista De Clientes Del </b></h5></center>
			</div>
			<div class="col-md-3">
				<center><a href="<?php echo base_url();?>Reportes/ImprimirClientes" target="_blank" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-print"></span> Imprimir</a></center>
			</div>
		</div>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

		<table class="table table-hover table-condensed" id="tablaclientes">
			<thead>
				<tr>
					<th><center> # </center></th>
					<th><center> DNI / RUC </center></th>
					<th><center> Cliente / Empresa </center></th>
					<th><center> Direccion </center></th>
					<th><center> Celular </center></th>
					<th><center> Telefono </center></th>
				</tr>
			</thead>
			<tbody>
				<?php $cont=0;
					foreach ($Clientes as $value): ?>
						<tr>
							<td><center> <?php $cont++; echo $cont; ?></center></td>
							<?php 
							if ($value->ruc==null) { ?>
									<td><center> <?php echo $value->dnicliente; ?></center></td>
								<?php }else{ ?>
									<td><center> <?php echo $value->ruc; ?></center></td>
								<?php }
							?>
							<?php 
							if ($value->razonsocial==null) { ?>
									<td><center> <?php echo $value->nombre.' '.$value->appaterno.' '.$value->apmaterno; ?></center></td>
								<?php }else{ ?>
									<td><center> <?php echo $value->razonsocial; ?></center></td>
								<?php }
							?>
							<td><center> <?php echo $value->direccion; ?></center></td>
							<td><center> <?php echo $value->celular; ?></center></td>
							<td><center> <?php echo $value->telefono; ?></center></td>
	                    </tr>
					<?php endforeach 
				?>
			</tbody>
		</table>
	</div>
</body>

<style type="text/css">
	#tablaclientes{
		width: 100%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tablaclientes th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablaclientes td{
		border:1px solid #D8D8D8;
		padding-top:2px;
		padding-bottom: 0px!important;
		font-size: 13px;
		text-align: center; 
	}
	label{
		font-size: 13px;
	}
</style>