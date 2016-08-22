<body>
	<script src="<?php echo base_url();?>Librerias/JavaScript/Reportes.js"></script>
	<div class="container" style="width:100%;"> <br>
		<div class="row">
			<div class="col-md-3">
				<img src="<?php echo base_url();?>imageneshotel/logo.jpg" height="60" width="200">
			</div>
			<div class="col-md-6">
				<center><h5 style="font-size:15px;"><b> Lista de Ventas </b></h5></center>
			</div>
			<div class="col-md-3">
				<center><a href="<?php echo base_url();?>Reportes/ImprimirVentas" target="_blank" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-print"></span> Imprimir</a></center>
			</div>
		</div>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

		<table class="table table-hover table-condensed" id="tablaventas">
			<thead>
				<tr>
					<th><center> # </center></th>
					<th><center> Cliente </center></th>
					<th><center> Fecha Venta </center></th>
					<th><center> S/. IGV </center></th>
					<th><center> S/. Total </center></th>
				</tr>
			</thead>
			<tbody>
				<?php $cont=0;
					foreach ($Ventas as $value): ?>
						<tr>
							<td><center> <?php echo $value->codventas; ?></center></td>
							<?php 
								if ($value->razonsocial==null) { ?>
									<td><center> <?php echo $value->nombre.' '.$value->appaterno.' '.$value->apmaterno; ?></center></td>
								<?php }else{ ?>
									<td><center> <?php echo $value->razonsocial; ?></center></td>
								<?php }
							?>
							<td><center> <?php echo $value->fechaventa; ?></center></td>
							<td><center> <?php echo $value->igv; ?></center></td>
							<td><center> <?php echo $value->importe; ?></center></td>
	                    </tr>
					<?php endforeach 
				?>
			</tbody>
		</table>
	</div>
</body>

<style type="text/css">
	#tablaventas{
		width: 100%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tablaventas th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tablaventas td{
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