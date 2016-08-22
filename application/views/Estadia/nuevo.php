
<body>
    
    <script src="<?php echo base_url();?>Librerias/plugins/xchart/exporting.js"></script>
    <script src="<?php echo base_url(); ?>Librerias/JavaScript/ValidarEstadia.js"></script>
    <script src="<?php echo base_url(); ?>Librerias/JavaScript/Validaciones.js"></script>
    
    
    <div class="container" style="width:100%;">
        <center><h5 style="font-size:15px;"><b> Registro De Una Nueva Estadia </b></h5></center>
        <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

        <form  class="form-horizontal" id="ForEstadia">
            <?php foreach ($Nuevo as $value):
                session_start();
                $cod=$value->codestadia;
            endforeach ?>
            <div class="form-group">
                <input type="hidden" name="codempleado" value="<?php echo $_SESSION['idempleado'];?>">
                <input type="hidden" name="codestadia" id="codestadia" value="<?php echo $cod+1;?>">

               
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" name="cliente" id="cliente" placeholder="Buscar Cliente" onkeypress="return Nada(event);"
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

                <label id="fr" class="col-sm-1 control-label">Fecha</label>
                <div class="col-sm-3">
                    <input type="date" name="fechaingreso" id="fechaingreso" class="form-control"  min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>"
                   disabled>
                </div>

                <label id="hr" class="col-sm-1 control-label">Hora</label>
                <div class="col-sm-3">
                    <input type="time" name="horaingreso" id="horaingreso" class="form-control" data-toggle="popover" value="<?php echo date('H:i'); ?>"
                     disabled>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3">
                    <select id="pago" name="pago" class="form-control" data-toggle="popover"
                    data-placement="bottom" data-content="Seleccione Pago">
                        <option value="pago">Tipo De Pago</option>
                        <option value="1">Contado</option>
                        <option value="2">Credito</option>
                    </select>
                </div>
                <?php
                    $fecha1 = strtotime ( '+1 day' , strtotime ( date('Y-m-d') ) ) ;
                    $fecha1 = date ( 'Y-m-d' , $fecha1);
                ?>
                <label class="col-sm-2 control-label">Fecha Salida</label>
                <div class="col-sm-3">
                    <input type="date" id="fechasalida" name="fechasalida" class="form-control" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $fecha1;?>" data-toggle="popover"
                    data-placement="bottom" data-content="Selecione Fecha Valida">
                </div>

                <label class="col-sm-1 control-label">Hora</label>
                <div class="col-sm-3">
                    <input type="time" id="horasalida" name="horasalida" class="form-control" value="<?php echo date('H:i'); ?>" data-toggle="popover"
                    data-placement="bottom" data-content="Selecione Hora Valida">
                </div>
            </div>

            <div class="form-group" id="Credito">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="debetotal" id="debetotal" placeholder="Saldo:" onkeypress="return Nada(event);" style="border-color:red;">
                </div>
                <div class="col-md-1">
                    <a href="" onclick="Scoring();" data-toggle="modal" class="btn btn-warning btn-xs">Calificacion</a>
                </div>

                <label class="col-md-2 control-label">N° Cuotas</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="nrocuotas" id="nrocuotas"
                    data-toggle="popover" data-placement="bottom" data-content="Ingrese numero de cuotas">
                </div>

                <label class="col-md-2 control-label">Intervalo&nbsp;Dias</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="intervalodias" id="intervalodias" onkeypress="return Numeros(event);"
                    maxlength="3" data-toggle="popover" data-placement="bottom" data-content="Dias">
                </div>
            </div>

            <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

            <div class="form-group">
                <label class="col-md-8 control-label"><center> Lista De Habitaciones En Esta Estadia</center></label>
                <div class="col-md-3">
                    <button type="button" class="btn btn-info btn-xs" onclick="return Asignando(this.form);">
                    <span class="glyphicon glyphicon-plus-sign"></span> Asignar Habitacion</button>
                </div>
            </div>

            <div class="form-group" id="HabEstadia">
                <table id="listahabitacion">
                    <thead>
                        <tr>
                            <th><center> # Habitacion </center></th>
                            <th><center> # Personas </center></th>
                            <th><center> Precio </center></th>
                            <th><center> Accion </center></th>
                        </tr>
                    </thead>
                    <tbody id="HabEstadiaD" >

                    </tbody>
                </table> <br>
                <div class="form-group">
                    <label class="col-sm-7 control-label">Total&nbsp;S/.</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" value="0" name="totalestadia" id="totalestadia" onkeypress="return NumerosPuntos(event)" maxlength="10">
                    </div>
                </div>
            </div>

            <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>
            <div class="row">
                <center>
                    <label>
                      <input type="checkbox" id="procesareserva" name="procesareserva"  value="1"> Procesar Como Reserva
                    </label> &nbsp;&nbsp;&nbsp;
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


    <!-- Para Scoring-->
    <div class="modal fade" id="Scoring" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-body">
                    
                    <div id="scoring" style="width: 40%;"></div>
                </div>
            </div>
        </div>
    </div>


    <!-- Alquilar Habitacion -->
    <div class="modal fade" id="Asignar" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <center><b> Hotel Tarapoto Inn - Alquilar Habitacion </b></center>
                    </h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="Form_DetalleEstadia">
                        <input type="hidden" name="codempleado">
                        <input type="hidden" name="codnuevaestadia" id="codnuevaestadia" value="<?php echo $cod+1;?>">

                        <div class="form-group">
                            <input type="hidden" name="codestadianueva" value="<?php echo $cod +1;?>" >
                            <label class="col-md-3 control-label">Tipo Habitacion</label>
                            <div class="col-md-2">
                                <select id="tipohabitacion" name="tipohabitacion" class="form-control"
                                        data-toggle="popover" data-placement="bottom" data-content="Seleccione Tipo Habitacion">
                                    <option value="tipohab">Seleccione ... </option>
                                    <?php foreach ($TipoHabitaciones as $value): ?>
                                        <option value="<?php echo $value->codtipohabitacion; ?>"><?php echo $value->descripcion; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <label class="col-md-1 control-label">Hab.</label>
                            <div class="col-md-2">
                                <select id="codhabitacion" name="codhabitacion" class="form-control" data-toggle="popover"
                                        data-placement="bottom" data-content="Seleccione Habitacion">
                                    <option value="codhabit"> Numero ... </option>
                                </select>
                            </div>

                            <label class="col-md-1 control-label">Precio</label>
                            <div class="col-md-2 has-default has-feedback">
                                <input type="text" class="form-control" name="precio" id="precio"
                                       data-toggle="popover" data-placement="bottom" data-content="Ingrese Tarifa">
                                <span class="glyphicon glyphicon-usd txt-default form-control-feedback"></span>
                            </div>
                        </div>
                        <center><h5 style="font-size:15px;"><b> Datos Del Cliente </b></h5></center>
                        <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

                        <div class="form-group">
                            <label class="col-md-3 control-label">DNI Cliente</label>
                            <div class="col-md-2">
                                <input type="hidden" id="idcliente" name="idcliente" value="">
                                <input type="text" class="form-control" name="dni" id="dni" onkeypress="return Numeros(event)"
                                       maxlength="8" data-toggle="popover" data-placement="bottom" data-content="DNI Cliente">
                            </div>

                            <label class="col-md-3 control-label">Nombre Cliente</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="nombre" id="nombre" onkeypress="return Letras(event)"
                                       data-toggle="popover" data-placement="bottom" data-content="Buscar Nombre">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Apellido Paterno</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="apellidop" id="apellidop" onkeypress="return Letras(event)"
                                    data-toggle="popover" data-placement="bottom" data-content="Buscar Apellido">
                            </div>

                            <label class="col-md-2 control-label">Apellido Materno</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="apellidom" id="apellidom" onkeypress="return Letras(event)"
                                    data-toggle="popover" data-placement="bottom" data-content="Buscar Apellido">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                                <div style="margin-left:160px; font-size:25px;" id="bandera">
                                    <span class="glyphicon glyphicon-flag" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success btn-xs" onclick="return AgregarPersonas(this.form);">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Agregar </button>
                            </div>
                        </div>

                        <div id="ClienteHabitacion">
                            <table id="ListaClientes">
                                <thead>
                                    <tr>
                                        <th><center> DNI Cliente </center></th>
                                        <th><center> Nombre </center></th>
                                        <th><center> Apellidos </center></th>
                                        <th><center> Accion </center></th>
                                    </tr>
                                </thead>
                                <tbody id="ListaClientesD">

                                </tbody>
                            </table> <br>
                            <div class="form-group">
                                <label class="col-md-10 control-label"></label>
                                <div class="col-md-2">
                                    <center>
                                        <button type="button" class="btn btn-info btn-xs" onclick="return GuardandoHabitacion(this.form);">
                                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Aceptar </button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                    <table id="TablaClientes">
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
                                <input type="text" class="form-control" name="dire" id="dire" onkeypress="return NumerosLetras(event)"
                                    maxlength="30" data-toggle="popover" data-placement="bottom" data-content="Ingrese Direccion">
                            </div>

                            <label class="col-sm-2 control-label">Correo Electronico</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="correoelec" id="correoelec" onkeypress="return ValidarEmail(event)"
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
