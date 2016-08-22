<body>
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarHabitacion.js"></script> 	
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
</body>