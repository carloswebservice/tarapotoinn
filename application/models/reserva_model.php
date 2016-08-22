<?php
	class reserva_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarReservas(){
			$this->db->select('*');
			$this->db->where('estadia.estado',1);
			$this->db->where('estadia.fechareserva is not null');
			$this->db->from('estadia');
			$this->db->join('cliente', 'cliente.codcliente = estadia.codcliente');

			$query = $this->db->get();
			return $query->result();
		}

		//Para Ver Reservas
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

        function Cuotas($codestadia){
            $this->db->select('*');
			$this->db->from('cuotaestadia');
            $this->db->join('estadia', 'estadia.codestadia = cuotaestadia.codestadia');
            $this->db->where(array("estadia.codestadia"=>$codestadia));

			$query = $this->db->get();
			return $query->result();
        }

		function MostrarTipoHabitacion(){
			$query = $this->db->get('tipohabitacion');
			return $query->result();
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

		function grabareserva(){
			$this->db->select('*');
			$this->db->where('dnicliente',$_POST["dni"]);
			$existe= $this->db->get('cliente')->result_array();

			if (count($existe)==0) {
				$this->db->select_max('codcliente');
			    $result= $this->db->get('cliente')->result_array();
			    $idcliente= $result[0]['codcliente']+1;

		        $datacliente = array(
		        		'codcliente' => $idcliente,
		                'codubigeo' => 1, //predefinido
		                'nombre' => $_POST["nombre"],
		                'appaterno' => $_POST["apellidop"],
		                'apmaterno' => $_POST["apellidom"],
		                'dnicliente' => $_POST["dni"],
		                'direccion' => $_POST["direccion"],
		                'email' => $_POST["email"],
		                'estado' => 1
		        );
		        $this->db->insert("cliente",$datacliente);
			}else{
				$idcliente=$existe[0]['codcliente'];
			}

            $data = array(
                'codcliente' => $idcliente,
                'codempleado' => 1,
                'fechaingreso' => $_POST["fechaing"],
                'fechasalida' => $_POST["fechasal"],
                'fechareserva' => $_POST["fechaing"],
                'estado' => 1
            );
            $this->db->insert("estadia",$data);
            $idestadia = $this->db->insert_id();
            
            $datadetalleestadia = array(
                'codcliente' => $idcliente,
                'codhabitacion' => $_POST["codhabi"],
                'codestadia' => $idestadia,
                'estado' => 1
            );
            $this->db->insert("detalleestadia",$datadetalleestadia);
        }


        function grabareservamobil(){
        	$query = $this->db->query("
				select codhabitacion from habitacion where estado=1 and codtipohabitacion=".$_POST['tipohabitaciones']." and codhabitacion not in(SELECT de.codhabitacion FROM  estadia e
				INNER JOIN detalleestadia de ON de.codestadia = e.codestadia
				WHERE fechareserva = '".$_POST['ingreso']."')
			");
			$data = $query->result_array();
			if (count($data)!=0) {
				$idhabitacion=$data[0]['codhabitacion'];

				$this->db->select('*');
				$this->db->where('dnicliente',$_POST["dni"]);
				$existe= $this->db->get('cliente')->result_array();

				if (count($existe)==0) {
					$this->db->select_max('codcliente');
				    $result= $this->db->get('cliente')->result_array();
				    $idcliente= $result[0]['codcliente']+1;

			        $datacliente = array(
			        		'codcliente' => $idcliente,
			                'codubigeo' => 1, //predefinido
			                'nombre' => $_POST["nombre"],
			                'appaterno' => $_POST["apellidop"],
			                'apmaterno' => $_POST["apellidom"],
			                'dnicliente' => $_POST["dni"],
			                'estado' => 1
			        );
			        $this->db->insert("cliente",$datacliente);
				}else{
					$idcliente=$existe[0]['codcliente'];
				}

	            $data = array(
	                'codcliente' => $idcliente,
	                'codempleado' => 1,
	                'fechaingreso' => $_POST["ingreso"],
	                'fechasalida' => $_POST["salida"],
	                'fechareserva' => $_POST["ingreso"],
	                'estado' => 1
	            );
	            $this->db->insert("estadia",$data);
	            $idestadia = $this->db->insert_id();
	            
	            $datadetalleestadia = array(
	                'codcliente' => $idcliente,
	                'codhabitacion' => $idhabitacion,
	                'codestadia' => $idestadia,
	                'estado' => 1
	            );
	            $this->db->insert("detalleestadia",$datadetalleestadia);
	            echo 'Reserva Realizada Correctamente';
			}else{
				echo 'No Hay Habitaciones Disponibles';
			}
        }
	}
?>