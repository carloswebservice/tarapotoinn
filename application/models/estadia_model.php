<?php
	class estadia_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}

		function VistaEstadia($cod){
			$this->db->select('*');
			$this->db->where('estadia.codestadia',$cod);
			$this->db->from('estadia');
			$this->db->join('cliente', 'cliente.codcliente = estadia.codcliente');

			$query = $this->db->get();
			return $query->result();
		}

		function VistaDetalleEstadia($codestadia){
            $this->db->select('*');
			$this->db->from('detalleestadia');
			$this->db->join('cliente', 'cliente.codcliente = detalleestadia.codcliente');
            $this->db->join('habitacion', 'habitacion.codhabitacion = detalleestadia.codhabitacion');
            $this->db->where(array("detalleestadia.codestadia"=>$codestadia));

			$query = $this->db->get();
			return $query->result();
        }

        function VistaListaConsumos($codestadia){
			$this->db->select('*');
			$this->db->from('consumos');
            $this->db->join('producto', 'producto.codproducto = consumos.codproducto');
            $this->db->where(array("consumos.codestadia"=>$codestadia));

			$query = $this->db->get();
			return $query->result();

        }

        function Cuotas($codestadia){
            $this->db->select('*');
			$this->db->from('cuotaestadia');
            $this->db->join('estadia', 'estadia.codestadia = cuotaestadia.codestadia');
            $this->db->where(array("estadia.codestadia"=>$codestadia));

			$query = $this->db->get();
			return $query->result();
        }

        function ListaProductos(){
            $this->db->select('*');
			$this->db->from('producto');
            $this->db->where(array("estado"=>1));

			$query = $this->db->get();
			return $query->result();
        }

        function Vercantidad($codpro){
		    $query = $this->db->get_where('producto', array('codproducto' => $codpro));
			return $query->result();
		}

		function grabaconsumos(){
			foreach ($_POST['idproductoconsumo'] as $key => $value) {
				if ($_POST['pagarahora']=='no') {
					$data = array(
		               'codestadia' => $_POST['estadia'],
		               'codproducto' => $_POST['idproductoconsumo'][$key],
		               'cantidad' => $_POST['cantidadconsumo'][$key],
		               'precio' => $_POST['precioconsumo'][$key],
		               'igv' => $_POST['igvconsumo'][$key],
		               'estado' =>1 
		            );
				}else{
					$data = array(
		               'codestadia' => $_POST['estadia'],
		               'codproducto' => $_POST['idproductoconsumo'][$key],
		               'cantidad' => $_POST['cantidadconsumo'][$key],
		               'precio' => $_POST['precioconsumo'][$key],
		               'igv' => $_POST['igvconsumo'][$key],
		               'estado' =>0
		            );
				}
				$this->db->insert('consumos', $data);

				$query = $this->db->get_where('producto', array('codproducto' => $_REQUEST['idproductoconsumo'][$key]))->result_array();
		    	$actual= $query[0]['stockactual'];
				$data1 = array(
	               'stockactual' => $actual-$_POST['cantidadconsumo'][$key]
	            );
				$this->db->where('codproducto', $_POST['idproductoconsumo'][$key]);
				$this->db->update('producto', $data1);
			}

			if ($_POST['pagarahora']=='no') {
				$query = $this->db->get_where('estadia', array('codestadia' => $_POST['estadia']))->result_array();
			   	$actual= $query[0]['total'];
				$data1 = array(
		            'total' => $actual+$_POST['total']
	            );
				$this->db->where('codestadia', $_POST['estadia']);
				$this->db->update('estadia', $data1);

				//En Cual Cuota Va Ir

	            $this->db->select_max('nrocuota');
	            $this->db->where('codestadia',$_POST['estadia']);
				$nrocuota = $this->db->get('cuotaestadia')->result_array();
				$cuota= $nrocuota[0]['nrocuota'];

				//Obteniendo el monto de esa cuota
				$this->db->select('*');
	            $this->db->where('codestadia',$_POST['estadia']);
	            $this->db->where('nrocuota',$cuota);
				$montocuota = $this->db->get('cuotaestadia')->result_array();
				$monto= $montocuota[0]['monto'];
				//Añadimos A La Cuota
				$data1 = array(
		            'monto' => $monto+$_POST['total'],
		            'estado' =>1
	            );
	            
				$this->db->where('codestadia', $_POST['estadia']);
				$this->db->where('nrocuota', $cuota);
				$this->db->update('cuotaestadia', $data1);
			}
			echo "Consumo Realizado Correctamente";
        }

		function MostrarEstadias(){
			$this->db->select('*');
			$this->db->where('estadia.estado',1);
			$this->db->where('estadia.fechareserva is null');
			$this->db->from('estadia');
			$this->db->join('cliente', 'cliente.codcliente = estadia.codcliente');

			$query = $this->db->get();
			return $query->result();
		}

		function HabilitarHab($cod){
            $data = array(
	            'estado' => 1
	        );
			$this->db->where('codhabitacion', $cod);
			$this->db->update('habitacion', $data);
		}
		function TerminarEstadia($cod){
            $data = array(
               'estado' => 0
            );
			$this->db->where('codestadia', $cod);
			$this->db->update('detalleestadia', $data);

			$data = array(
               'estado' => 0
            );
			$this->db->where('codestadia', $cod);
			$this->db->update('estadia', $data);

			$query = $this->db->query("select distinct(de.codhabitacion) as codhabitacion
			from estadia as e inner join detalleestadia as de on(e.codestadia=de.codestadia)
			where e.codestadia=".$cod);
			$result= $query->result_array();
			foreach ($result as $key => $value) {
				$data = array(
		            'estado' => 1
		        );
				$this->db->where('codhabitacion', $result[$key]['codhabitacion']);
				$this->db->update('habitacion', $data);
			}
		}


		function UbigeoDep(){
			$query = $this->db->query("select distinct departamento,ubidepartamento from ubigeo");
			return $query->result();
		}

		function UbigeoPro($dep){
			$query = $this->db->query("select distinct provincia,ubiprovincia from ubigeo where ubidepartamento='".$dep."'");
			return $query->result();
		}

		function UbigeoDis($dep,$pro){
			$query = $this->db->query("select distrito,ubidistrito from ubigeo where ubiprovincia='".$pro."' and ubidepartamento='".$dep."'");
			return $query->result();
		}

		function TraerClientes(){
			$query = $this->db->query("select *from cliente where estado=1 and codcliente<>10");
			return $query->result();
		}

		function GrabaNuevoCliente(){
			//Obteniendo nuevo cod cliente
			if ($_POST["tipocliente"]=="persona"){
				$query = $this->db->get_where('cliente', array('dnicliente' => $_POST["dnicli"]));
		    	$buscar = $query->result();
			}else{
				$query = $this->db->get_where('cliente', array('ruc' => $_POST["ruc"]));
		    	$buscar = $query->result();
			}
			
			if (count($buscar)==0) {
				$this->db->select_max('codcliente');
			    $result= $this->db->get('cliente')->result_array();
			    $idcliente= $result[0]['codcliente']+1;

			    //Obteniendo el ubigeo
			    $this->db->where('ubidepartamento',$_POST['departamento']);
			    $this->db->where('ubiprovincia',$_POST['provincia']);
			    $this->db->where('ubidistrito',$_POST['distrito']);
			    $result= $this->db->get('ubigeo')->result_array();
			    $idubigeo= $result[0]['codubigeo'];

			    if ($_POST["tipocliente"]=="persona") {
					$data = array(
		                'codcliente' => $idcliente,
		                'dnicliente' => $_POST["dnicli"],
		                'codubigeo' => $idubigeo,
		                'nombre' => $_POST["nom"],
		                'appaterno' => $_POST["apep"],
		                'apmaterno' => $_POST["apem"],
		                'direccion' => $_POST["dire"],
		                'email' => $_POST["correoelec"],
		                'estado' => 1
		            );
				}else{
					$data = array(
		                'codcliente' => $idcliente,
		                'codubigeo' => $idubigeo,
		                'ruc' => $_POST["ruc"],
		                'razonsocial' => $_POST["razons"],
		                'direccion' => $_POST["dire"],
		                'email' => $_POST["correoelec"],
		                'estado' => 1
		            );
				}
				$this->db->insert("cliente",$data);
				return "Cliente Registrado Correctamente";
			}else{
				return "Cliente Ya Existe";
			}
		}

		//Para Visualizar Estadia
		function ClienteEstadia($codestadia){
			$this->db->select('*');
			$this->db->from('estadia');
			$this->db->join('cliente', 'cliente.codcliente = estadia.codcliente');
            $this->db->where(array("estadia.codestadia"=>$codestadia));
			$query = $this->db->get();
			return $query->result();
		}
        function DetalleEstadia($codestadia){
            $this->db->select('*');
			$this->db->from('detalleestadia');
			$this->db->join('cliente', 'cliente.codcliente = detalleestadia.codcliente');
            $this->db->join('habitacion', 'habitacion.codhabitacion = detalleestadia.codhabitacion');
            $this->db->where(array("detalleestadia.codestadia"=>$codestadia));
			$query = $this->db->get();
			return $query->result_array();
        }

		function MostrarTipoComprobantes(){
			$query = $this->db->get('tipocomprobante');
			return $query->result();
		}

		function MostrarFormaPago(){
			$query = $this->db->get('formapagos');
			return $query->result();
		}

		function MostrarTipoHabitacion(){
			$query = $this->db->get('tipohabitacion');
			return $query->result();
		}

		function BuscaHab($cod,$reserva,$fecha){
			if($reserva==1){
				$query = $this->db->query(
					"select *from habitacion where estado=1 and codtipohabitacion=".$cod." and codhabitacion not in(SELECT de.codhabitacion FROM  estadia e
					INNER JOIN detalleestadia de ON de.codestadia = e.codestadia
					WHERE e.estado=1 and e.fechareserva = '".$fecha."')"
		        );
			}else{
				$query = $this->db->query("
		            select *from habitacion where estado=1 and codtipohabitacion="+$cod
		        );
			}
			return $query->result();
		}

		function Precio($cod){
			$query = $this->db->get_where('habitacion', array('codhabitacion' => $cod));
			return $query->result();
		}

		function ExisteCliente($cod){
			$query = $this->db->get_where('cliente', array('dnicliente' => $cod));
			return $query->result();
		}

		function MostrarClientes(){
			$query = $this->db->get('cliente');
			return $query->result();
		}


		function EliminarHab($hab,$est){
			$this->db->where('codhabitacion', $hab);
			$this->db->where('codestadia', $est);
			$this->db->delete('detalleestadia');
		}

		function VerEstadia($cod){
			$this->db->where('codestadia',$cod);
			$this->db->from('estadia');
			return $this->db->count_all_results();
		}


        function grabaestadia(){

            if(isset($_POST["procesareserva"])){
                  $fechareserva = $_POST["fechaingreso"];
                //$fechasalida  = NULL;

                   $data = array(
                        'codcliente' => $_POST["codcliente"],
                        'codempleado' => $_POST["codempleado"],
                        'fechaingreso' => $_POST["fechaingreso"],
                        'horaingreso' => $_POST["horaingreso"],
                        'horasalida' => $_POST["horasalida"],
                        'fechasalida' => $_POST["fechasalida"],
                        'tipodepago' => $_POST["pago"],
                        'total' => $_POST["totalestadia"],
                        'fechareserva' => $fechareserva,
                        'estado' => 1
                    );
            }else{
                $fechasalida = $_POST["fechasalida"];
                //$fechareserva = NULL;
                 $data = array(
                        'codcliente' => $_POST["codcliente"],
                        'codempleado' => $_POST["codempleado"],
                        'fechaingreso' => date('Y-m-d'),
                        'fechasalida' => $fechasalida,
                        'horaingreso' => date('H:i'),
                        'horasalida' => $_POST["horasalida"],
                        'tipodepago' => $_POST["pago"],
                        'total' => $_POST["totalestadia"],
                        'estado' => 1
                    );

            }


            $this->db->insert("estadia",$data);

            //print $this->db->last_query();exit();


            $idestadia = $this->db->insert_id();

            foreach ($_POST["dnid"] as $key => $value) {
                $idcliente = $_POST["idcliented"][$key];
                if($idcliente == ""){
	                //si no existe el cliente lo creamos y recuperamos su id
	                $datacliente = array(
	                    'codubigeo' => 1, //predefinido
	                    'nombre' => $_POST["nombresd"][$key],
	                    'appaterno' => $_POST["apellidopd"][$key],
	                    'apmaterno' => $_POST["apellidomd"][$key],
	                    'dnicliente' => $value,
	                    'estado' => 1
	                );

	                $this->db->insert("cliente",$datacliente);
	                // echo $this->db->last_query(); exit();
	                $idclienter = $this->db->insert_id();
                }else{
                    //si existe el cliente solo tomamos el id
                    $idclienter = $idcliente;
                }

                //grabamos el detalle de la estadia
                $datadetalleestadia = array(
                    'codcliente' => $idclienter,
                    'codhabitacion' => $_POST["codehabd"][$key],
                    'codestadia' => $idestadia,
                    'precio' => $_POST["preciodd"][$key],
                    'estado' => 1
                );
                $this->db->insert("detalleestadia",$datadetalleestadia);

                //cambiamos de estado a las habitaciones XD
              if(!isset($_POST["procesareserva"])){
                       foreach($_POST["codehabd"] as $val){
                            $data = array("estado" => 0);
                            $this->db->update('habitacion', $data, array('codhabitacion' => $val));
                        }

               }


            }

            //Para las Cuotas
			if($_POST["pago"] == "1"){
                $arraydata = array(
                    "codestadia" => $idestadia,
                    "nrocuota" =>  1,
                    "monto" => $_POST["totalestadia"],
                    "fecha" => date('d-m-Y'),
                    "monto_cobrado" => 0,
                    "estado" => 1
                );
                $this->db->insert("cuotaestadia",$arraydata);
            }else{
            	foreach($_POST["idcuota"] as $key => $value){
                    $arraydata = array(
                        "codestadia" => $idestadia,
                        "nrocuota" =>  $_POST['idcuota'][$key],
                        "monto" => $_POST['montocuota'][$key],
                        "fecha" => $_POST['fechavence'][$key],
                        "monto_cobrado" => 0,
                        "estado" => 1
                    );
                    $this->db->insert("cuotaestadia",$arraydata);
                }
            }
        }

        //Esta parte estaba guardando en la base de datos
		function InsertandoEstadia($cod,$fechasalida,$horasalida){
			//Actualizando Estadia Al Sistema
			$data = array(
               'fechaingreso' => date('d-m-Y'),'horaingreso' => date('H:i'),
               'fechasalida' => $fechasalida,'horasalida' => $horasalida,'estado' => 1
            );
			$this->db->where('codestadia', $cod);
			$this->db->update('estadia', $data);

			//Actualizando Detalle Estadia Al Sistema
			$data = array(
               'estado' => 1
            );
			$this->db->where('codestadia', $cod);
			$this->db->update('detalleestadia', $data);
		}

		//Insertando Estadia Con Estado 3 Temporalmente
		function RegistroEstadia($estadia,$cliente,$empleado){
			$data = array(
               'codestadia' => $estadia,'codcliente' => $cliente,'codempleado' => $empleado,
               'fechaingreso' => date('d-m-Y'),'horaingreso' => date('H:i'),'estado' => 3
            );
			$this->db->insert('estadia', $data);
		}

		function InsertandoDetalleEstadia($_R){
			//Insertando Temporalmente Detalle Estadia
			foreach ($_R['idclientes'] as $key => $value) {
				$data = array(
	               'codestadia' => $_R['codnuevaestadia'],'codcliente' => $_R['idclientes'][$key],
	               'codhabitacion' => $_R['codhabitacion'],'precio' => $_R['precio'],'estado' =>3
	            );
				$this->db->insert('detalleestadia', $data);
			}

			//Actualizamos Temporalmente La Habitacion A Estado 0
			$data = array('estado' => 0);
            $this->db->where('codhabitacion', $_REQUEST['codhabitacion']);
			$this->db->update('habitacion', $data);
		}

		function InsertarCuotas($codestadia,$cuota,$monto,$fecha,$estado){
			$data = array(
               'codestadia' => $codestadia,'cuota' => $cuota,'monto' => $monto,
               'fechavencimiento' => $fecha,'estado' => $estado
            );
			$this->db->insert('cuotaestadia', $data);
		}

		function HabilitarHabitacion($codestadia){
			$this->db->distinct();
			$this->db->select('codhabitacion');
			$this->db->where('dnicliente',$cod);
			$this->db->from('detalleestadia');
			$this->db->join('estadia', 'estadia.codestadia = detalleestadia.codestadia');
			$this->db->join('habitacion', 'habitacion.codhabitacion = detalleestadia.codhabitacion');

			$query = $this->db->get();
			return $query->result();
		}

		function VerCliente($cod){
			$this->db->where('dnicliente',$cod);
			$this->db->from('cliente');
			return $this->db->count_all_results();
		}
		function RegistroCliente($dni,$nom,$app,$apm){
			$this->db->select_max('codcliente');
		    $result= $this->db->get('cliente')->result_array();
		    $cod= $result[0]['codcliente']+1;

			$data = array(
               'codcliente' => $cod,'dnicliente' => $dni,'nombre' => $nom,'appaterno' => $app,'apmaterno' => $apm,'codubigeo' => 1,'estado' => 1
            );
			$this->db->insert('cliente', $data);
		}

		function MostrarDetalleEstadia($codestadia,$codhabitacion){
			$this->db->where('codestadia', $codestadia);
			$this->db->where('codhabitacion', $codhabitacion);
			$this->db->from('vistadetalleestadia');

			$query = $this->db->get();
			return $query->result();
		}

		function MostrarHabitacionesEstadia($cod){
			$query = $this->db->get_where('listahabitaciones', array('codestadia' => $cod));
			return $query->result();
		}

		function MostrarHabitaciones(){
			$query = $this->db->get('habitacion');
			return $query->result();
		}

		function NuevaE(){
			$this->db->select_max('codestadia');
			$query = $this->db->get('estadia');
			return $query->result();
		}

		function Seleccionado($cod){
			$query = $this->db->get_where('articulo', array('codarticulo' => $cod));
			return $query->result();
		}
	}
?>
