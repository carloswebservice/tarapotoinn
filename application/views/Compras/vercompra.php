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
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarCompra.js"></script> 
	<div class="container" style="width:100%;">	 <br>	
		<div>
		  	<ul class="nav nav-tabs nav-justified" role="tablist" id="navegar">
		    	<li role="presentation" class="active"><a href="#vercompras" role="tab" data-toggle="tab" style="color:black;"><span class="glyphicon glyphicon-shopping-cart"></span> Compra</a></li>
		    	<li role="presentation"><a href="#cuotas" role="tab" data-toggle="tab" style="color:black;"><span class="glyphicon glyphicon-eye-open"></span> Ver Cuotas</a></li>
		    </ul>

		  	<div class="tab-content">
		  		<!-- Para Ver La Estadia -->
			    <div role="tabpanel" class="tab-pane active" id="vercompras"> <br> <br>
			    	<form  class="form-horizontal" id="Ver">
			    		<?php foreach ($Compras as $value){ 
								if ($value->tipodepago==1) { 
									$pago="AL CONTADO";
								}else{
									$pago="A CREDITO";							
								}
								$proveedor=$value->razonsocial;
								$fechacompra=$value->fechacompra;
								$factura=$value->nrofactura;
								$igv=$value->igv;
								$direccion=$value->direccion;
								$total=$value->importe;
						} ?>

						<div class="form-group">
							<label class="col-md-2 control-label">Proveedor</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="cliente" id="cliente" onkeypress="return Nada(event);" placeholder="<?php echo $proveedor; ?>">
							</div>
							<label class="col-sm-2 control-label">Direccion</label>
			                <div class="col-sm-4">
			                    <input type="text" id="horaingreso" class="form-control" placeholder="<?php echo $direccion?>" onkeypress="return Nada(event);">
			                </div>
			            </div>
			            <div class="form-group">
			                <label class="col-sm-2 control-label">Fecha Compra</label>
			                <div class="col-sm-3">
			                    <input type="text" id="horaingreso" class="form-control" placeholder="<?php echo $fechacompra?>" onkeypress="return Nada(event);">
			                </div>

			                <label class="col-sm-2 control-label">Nro Factura</label>
			                <div class="col-sm-2">
			                    <input type="text" id="fechasalida" name="fechasalida" class="form-control" placeholder="<?php echo $factura?>" onkeypress="return Nada(event);">
			                </div>
			            </div>
			            <div class="form-group">
			                <label class="col-sm-2 control-label">Tipo De Pago</label>
			                <div class="col-sm-3">
			                    <input type="text" id="horaingreso" class="form-control" placeholder="<?php echo $pago?>" onkeypress="return Nada(event);">
			                </div>

			                <label class="col-sm-2 control-label">Monto Total S/.</label>
			                <div class="col-sm-2">
			                    <input type="text" id="fechasalida" name="fechasalida" class="form-control" placeholder="<?php echo $total?>" onkeypress="return Nada(event);">
			                </div>

			                <label class="col-sm-1 control-label">IGV</label>
			                <div class="col-sm-2">
			                    <input type="text" id="IGV" name="IGV" class="form-control" placeholder="<?php echo $igv?>" onkeypress="return Nada(event);">
			                </div>
			            </div>

			            <div class="form-group">
			                <table id="tabladetallecompra">
								<thead>
									<tr>
										<th> Producto </th>
										<th> Cantidad </th>
										<th> Precio Uni </th>
										<th> Subtotal</th>
										<th> IGV 18% </th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($DetalleCompra as $value): ?>
										<tr>
											<td><center> <?php echo $value->descripcion; ?></center></td>
											<td><center> <?php echo $value->cantidad; ?></center></td>
											<td><center> <?php echo $value->precio; ?></center></td>
											<td><center> <?php echo $value->precio*$value->cantidad; ?></center></td>
											<td><center> <?php echo $value->igv; ?></center></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
			            </div>

			            <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
						<div class="row">
							<center>
								<button type="button" class="btn btn-danger btn-xs" id="CancelarC" onclick="Cancelar();">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>			    	
							</center>
						</div>
					</form>
			    </div>

			    <!-- Para Ver Las Cuotas-->
			    <div role="tabpanel" class="tab-pane" id="cuotas"> <br><br>
			    	<form class="form-horizontal">
			    		<div class="form-group">
							<table id="tablacuotas">
								<thead>
									<tr>
										<th> # Cuota </th>
										<th> Fecha Vencimiento </th>
										<th> Monto Total </th>
										<th> Total Cobrado </th>
										<th> Saldo </th>
										<th> Estado </th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($Cuotas as $value): ?>
										<tr>
											<td><center> <?php echo $value->nrocuota; ?></center></td>
											<td><center> <?php echo $value->fechavencimiento; ?></center></td>
											<td><center> <?php echo $value->monto; ?></center></td>
											<td><center> <?php echo $value->monto_pagado; ?></center></td>
											<td><center> <?php echo $value->monto-$value->monto_pagado; ?></center></td>
											<?php 
												if(($value->monto-$value->monto_pagado)==0){
													echo "<td><center> Cancelado</center></td>";
												}else{
													echo "<td><center> Falta Cancelar</center></td>";
												}
											?>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
						<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
						<div class="row">
							<center>
								<button type="button" class="btn btn-danger btn-xs" id="CancelarC" onclick="Cancelar();">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>			    	
							</center>
						</div>
			    	</form>
			    </div>

		  	</div>
		</div>
	</div>

</body>

<style type="text/css">
	#tabladetallecompra{
		width: 80%;
		border:1px solid #D8D8D8;
		border-collapse: collapse;
		margin:auto;
	}
	#tabladetallecompra th{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}
	#tabladetallecompra td{
		border:1px solid #D8D8D8;
		padding:5px 10px;
		font-size: 13px;
		text-align: center; 
	}

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
	label{
		font-size: 13px;
	}
</style>