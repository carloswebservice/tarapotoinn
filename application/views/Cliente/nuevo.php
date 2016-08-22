<body>
	<script src="<?php echo base_url();?>Librerias/JavaScript/Validaciones.js"></script>
	<script src="<?php echo base_url();?>Librerias/JavaScript/ValidarCliente.js"></script> 

	<div class="container" style="width:100%;">
		<center><h5 style="font-size:15px;"><b> Registro De Un Nuevo Cliente </b></h5></center>
		<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

		<form  class="form-horizontal" id="ForCliente">
			<div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-4">
                    <label style="font-size:16px;">
                        <input type="radio" name="tipocliente" id="persona" checked value="persona"> Cliente Persona
                    </label>           
                </div>
                <div class="col-sm-4">
                    <label style="font-size:16px;">
                        <input type="radio" name="tipocliente" id="empresa" value="empresa"> Cliente Empresa
                    </label>
                </div>                     
            </div>
			<input type="hidden" class="form-control" name="codcliente" id="codcliente" disabled="disabled" >

			<div class="tab-content">
				<div id="clientepersona">
                    <center><h5 style="font-size:15px;"><b> Datos Del Cliente </b></h5></center>
                    <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Numero DNI</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" name="dni" id="dni" onkeyup="dnicliente(this)" onkeypress="return Numeros(event)"
								maxlength="8" data-toggle="popover" data-placement="bottom" data-content="Ingrese DNI">				
						</div>
                        <label class="col-sm-1 control-label">Nombres</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="nombre" id="nombre" onkeypress="return Letras(event)"
								maxlength="30" data-toggle="pomaxlength="8" over" data-placement="bottom" data-content="Ingrese Nombre">
						</div>
						<label class="col-sm-1 control-label">Sexo</label>
						<div class="col-sm-2">
							<select id="sexo" name="sexo" class="form-control" data-toggle="popover" 
							data-placement="bottom" data-content="Seleccione Sexo">
								<option value="sexo">Elegir...</option>
							    <option value="masculino">Masculino</option>
							    <option value="femenino">Femenino</option>
							</select>
						</div>
                    </div>
                    <div class="form-group">
						<label class="col-sm-2 control-label">Ap. Paterno</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="apellidop" id="apellidop" onkeypress="return Letras(event)"
								maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Apellido">				
						</div>
						<label class="col-sm-3 control-label">Grupo Sanguineo</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="gruposanguineo" id="gruposanguineo" onkeypress="return LetrasCaracteres(event)"
								maxlength="3" data-toggle="popover" data-placement="bottom" data-content="Ingrese Grupo"
								value="" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"> 
						</div>
                    </div>
                    <div class="form-group">
                    	<label class="col-sm-2 control-label">Ap. Materno</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="apellidom" id="apellidom" onkeypress="return Letras(event)"
								maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Apellido">
						</div>
						<label class="col-sm-3 control-label">Grado Instruccion</label>
						<div class="col-sm-3">
							<select id="grado" name="grado" class="form-control" 
							data-toggle="popover" data-placement="bottom" data-content="Seleccione Grado">
								<option value="grado">Seleccione ... </option>
							    <option value="Profesional">Profesional</option>
							    <option value="Tecnico">Tecnico</option>
							    <option value="Otro">Otro</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Estado Civil</label>
						<div class="col-sm-3">
							<select id="estadocivil" name="estadocivil" class="form-control" 
							data-toggle="popover" data-placement="bottom" data-content="Seleccione Estado">
								<option value="estadocivil">Seleccione ... </option>
							    <option value="Soltero">Soltero(a)</option>
							    <option value="Casado">Casado(a)</option>
							    <option value="Divorciado">Divorciado(a)</option>
							    <option value="Viudo">Viudo(a)</option>
							</select>				
						</div>
						<label class="col-sm-3 control-label">Fecha Nacimiento</label>
						<div class="col-sm-3">
							<input type="date" class="form-control" name="fecha" id="fecha" max="<?php echo date('Y-m-d'); ?>"
								data-toggle="popover" data-placement="bottom" data-content="Ingrese Fecha">				
						</div>
					</div>
					<div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>	
                </div>   

				<div id="clienteempresa">
                    <center><h5 style="font-size:15px;"><b> Datos De La Empresa </b></h5></center>
                    <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">RUC</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" name="ruc" id="ruc"  onkeyup="RUCempresa(this)" onkeypress="return Numeros(event)"
								maxlength="11" data-toggle="popover" data-placement="bottom" data-content="Ingrese RUC">
						</div>
                        <label class="col-sm-3 control-label">Razon Social</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="razons" id="razons" onkeypress="return Letras(event)"
                                maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Razon Social">               
                        </div>
                    </div>
                </div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Celular</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" name="celular" id="celular" onkeypress="return Numeros(event)"
							maxlength="9" data-toggle="popover" data-placement="bottom" data-content="Ingrese # Celular">
					</div>
					<label class="col-sm-3 control-label">Email</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="email" id="email" onkeypress="return ValidarEmail(event)"
							maxlength="35" data-toggle="popover" data-placement="bottom" data-content="Ingrese Email Valido">		
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">RPM</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" name="rpm" id="rpm" onkeypress="return NumerosCaracteres(event)"
							maxlength="10" data-toggle="popover" data-placement="bottom" data-content="Ingrese RPM">				
					</div>
					<label class="col-sm-3 control-label">Direccion</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="direccion" id="direccion" onkeypress="return NumerosLetras(event)"
							maxlength="35" data-toggle="popover" data-placement="bottom" data-content="Ingrese direccion">
					</div>
				</div>
									
				<div class="form-group">
					<label class="col-sm-2 control-label">Telefono</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" name="telefono" id="telefono" onkeypress="return Numeros(event)"
							maxlength="6" data-toggle="popover" data-placement="bottom" data-content="Ingrese # Telefono">
					</div>
					<label class="col-sm-3 control-label">Zona Ref.</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="zona" id="zona" onkeypress="return Letras(event)"
							maxlength="35" data-toggle="popover" data-placement="bottom" data-content="Ingrese Zona">
					</div>
				</div>		

				<div class="form-group">
                    <label class="col-sm-2 control-label">Ubigeo</label>
                    <div class="col-sm-3">
                        <select class="form-control" name="departamento" id="departamento">
                            <option value="departamento"> DEPARTAMENTO</option>
                            <?php foreach ($Departamentos as $value): ?>
                                <option value="<?php echo $value->ubidepartamento; ?>"><?php echo $value->departamento; ?></option>
                            <?php endforeach ?>
                        </select>     
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" name="provincia" id="provincia">
                            <option value="provincia"> PROVINCIA</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" name="distrito" id="distrito">
                            <option value="distrito"> DISTRITO</option>
                        </select>
                    </div>
                </div>
                <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
			</div>
        
			<div class="row">
				<center>
					<button type="button" class="btn btn-info btn-xs" id="GuardarE" onclick="return Guardar(this.form);">
				   	<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button> 

					<button type="button" class="btn btn-danger btn-xs" id="CancelarE" onclick="Cancelar();">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>			    	
				</center>
			</div>		
		</form>	
	</div>
</body>