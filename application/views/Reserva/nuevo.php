
<body>
    <script src="<?php echo base_url(); ?>Librerias/JavaScript/ValidarReserva.js"></script> 
    <script src="<?php echo base_url(); ?>Librerias/JavaScript/Validaciones.js"></script> 

    <div class="container" style="width:100%;">
        <center><h5 style="font-size:15px;"><b> Registrar Nueva Reserva </b></h5></center>
        <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

        <form  class="form-horizontal" id="ForEstadia">
            <div class="form-group">
                <input type="hidden" name="codempleado" value="2">

                <label class="col-md-1 control-label">Cliente</label>
                <div class="col-md-5">
                    <div class="input-group">
                        <input type="text" class="form-control" name="cliente" id="cliente" onkeypress="return Nada(event);"
                            data-toggle="popover" data-placement="bottom" data-content="Buscar Cliente">
                        <input type="hidden"name="codcliente" id="codcliente">
                        <div class="input-group-addon">
                            <a href="#Clientes" onclick="TraerClientes();" data-toggle="modal" id="Buscar">
                            <span class="glyphicon glyphicon-search" style="color:#6E6E6E;"></span></a> 
                        </div>
                        <div class="input-group-addon">
                            <a href="#AgregarCliente" data-toggle="modal" id="AgregarOtroCliente">
                            <span class="glyphicon glyphicon-plus-sign" style="color:#6E6E6E;"></span></a> 
                        </div>
                    </div>
                </div>

                <label class="col-sm-1 control-label">Fecha</label>
                <div class="col-sm-2">
                    <input type="text" id="fechaingreso" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                    readonly="true" >
                </div>

                <label class="col-sm-1 control-label">Hora</label>
                <div class="col-sm-2">
                    <input type="time" id="horaingreso" class="form-control" value="<?php echo date('H:i'); ?>" 
                    readonly="true" >
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Fecha Futura De Ingreso</label>
                <div class="col-sm-3">
                    <input input type="date" id="fechasalida" name="fechasalida" class="form-control" min="<?php echo date('Y-m-d'); ?>" data-toggle="popover" 
                    data-placement="bottom" data-content="Selecione Fecha Valida">
                </div>

                <label class="col-sm-1 control-label">Hora</label>
                <div class="col-sm-3">
                    <input type="time" id="horasalida" name="horasalida" class="form-control" data-toggle="popover" 
                    data-placement="bottom" data-content="Selecione Hora Valida">
                </div>
            </div>
            <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

            <div class="form-group">
                <label class="col-md-8 control-label"><center> Lista De Habitaciones Reservadas</center></label>
                <div class="col-md-3">
                    <button type="button" class="btn btn-info btn-xs" onclick="return Asignando(this.form);">
                    <span class="glyphicon glyphicon-plus-sign"></span> Reservar Habitacion</button> 
                </div>
            </div>
            
            <div class="form-group" id="HabEstadia">
                <table id="listahabitacion">
                    <thead>
                        <tr>
                            <th><center> Tipo Habitacion </center></th>
                            <th><center> # Habitacion </center></th>
                            <th><center> Precio </center></th>
                            <th><center> Accion </center></th>
                        </tr>
                    </thead>
                    <tbody id="HabEstadiaD" >
                        
                    </tbody>
                </table> <br>
            </div>

            <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
            <div class="row">
                <center>
                    <button type="button" class="btn btn-info btn-xs" id="GuardarC" onclick="return Guardar(this.form);">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button> 

                    <button type="button" class="btn btn-danger btn-xs" id="CancelarC" onclick="Cancelar();">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>                   
                </center>
            </div>
                <!-- Cronograma Previo-->
            <div class="modal fade" id="ListaCuotas" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                <center><b> Previa Lista De Cuotas </b></center>
                            </h4>                       
                        </div>
                        <div class="modal-body">
                            <table id="tablacuotas">
                                <thead>
                                    <th>Nro Cuota</th>
                                    <th>Monto</th>
                                    <th>Fecha Vencimiento</th>
                                </thead>
                                <tbody></tbody>
                            </table><br>

                            <center>
                                <button type="button" class="btn btn-info btn-xs" onclick="return AhoraMandaGuardar(this.form);">
                                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Ahora Guardar</button> 

                                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </form>         
    </div>

    <!-- Para Buscar Clientes-->
    <div class="modal fade" id="Clientes" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <center><b> Hotel Tarapoto Inn - Lista De Clientes </b></center>
                    </h4>                       
                </div>
                <div class="modal-body">
                    <table id="TablaCliente">
                            <thead>
                                <tr>
                                    <th><center> DNI Cliente / RUC Empresa </center></th>
                                    <th><center> Cliente / Empresa </center></th>
                                    <th><center> Accion </center></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--Agregar Cliente-->
    <div class="modal fade" id="AgregarCliente" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <center><b> Hotel Tarapoto Inn - Agregar Cliente  </b></center>
                    </h4>                       
                </div>
                <div class="modal-body">
                    <form  class="form-horizontal" id="ForNuevoCliente">
                        <div class="form-group">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-4">
                                <label style="font-size:16px;">
                                    <input type="radio" name="tipocliente" id="persona" checked value="persona">
                                    Cliente Persona
                                  </label>           
                            </div>
                            <div class="col-sm-4">
                                <label style="font-size:16px;">
                                    <input type="radio" name="tipocliente" id="empresa" value="empresa">
                                    Cliente Empresa
                                  </label>
                            </div>                     
                        </div>

                        <div id="clientepersona">
                            <center><h5 style="font-size:15px;"><b> Datos Del Cliente </b></h5></center>
                            <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">DNI Cliente</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="dnicli" id="dnicli" onkeypress="return Numeros(event)"
                                        maxlength="8" data-toggle="popover" data-placement="bottom" data-content="Ingrese DNI Correcto">
                                </div>

                                <label class="col-sm-3 control-label">Nombres</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="nom" id="nom" onkeypress="return Letras(event)"
                                        maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Nombre">               
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Apellido Paterno</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="apep" id="apep" onkeypress="return Letras(event)"
                                        maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Apellido">               
                                </div>

                                <label class="col-sm-2 control-label">Apellido Materno</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="apem" id="apem" onkeypress="return Letras(event)"
                                        maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Apellido">
                                </div>
                            </div>
                        </div>
                        <div id="clienteempresa">
                            <center><h5 style="font-size:15px;"><b> Datos De La Empresa </b></h5></center>
                            <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">RUC</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="ruc" id="ruc" onkeypress="return Numeros(event)"
                                        maxlength="11" data-toggle="popover" data-placement="bottom" data-content="Ingrese RUC Correcto">
                                </div>

                                <label class="col-sm-3 control-label">Razon Social</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="razons" id="razons" onkeypress="return Letras(event)"
                                        maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Razon Social">               
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Direccion</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="dire" id="dire" onkeypress="return Letras(event)"
                                    maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Direccion">               
                            </div>

                            <label class="col-sm-2 control-label">Correo Electronico</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="correoelec" id="correoelec" onkeypress="return Letras(event)"
                                    maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Correo">
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
                        <div class="form-group">
                            <center>
                                <button type="button" class="btn btn-info btn-xs" onclick="return GuardarCliente(this.form);">
                                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button> 

                                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">
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
    table{
        width: 97%;
        border:1px solid #D8D8D8;
        border-collapse: collapse;
        margin:auto;
    }
    table th{
        border:1px solid #D8D8D8;
        padding:5px 10px;
        font-size: 13px;
        text-align: center; 
    }
    table td{
        border:1px solid #D8D8D8;
        padding:5px 10px;
        font-size: 13px;
        text-align: center; 
    }
    #TablaClientes{
        width: 100%;
        border:1px solid #D8D8D8;
        border-collapse: collapse;
        margin:auto;
    }
    #TablaClientes th{
        border:1px solid #D8D8D8;
        padding:5px 10px;
        font-size: 13px;
        text-align: center; 
    }
    #TablaClientes td{
        border:1px solid #D8D8D8;
        padding:5px 10px;
        font-size: 13px;
        text-align: center; 
    }
    label{
        font-size: 13px;
    }
</style>