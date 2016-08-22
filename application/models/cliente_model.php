<?php
	class cliente_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarClientes(){
			$query = $this->db->get_where('cliente', array('estado' => 1));
			return $query->result();
		}

		function UbigeoDepartamentos(){
			$query = $this->db->query("select distinct departamento,ubidepartamento from ubigeo");
			return $query->result();
		}

		function validardni($cod){
			$query = $this->db->query("select dnicliente from cliente where dnicliente='".$cod."'");
			return $query->result();
		}

		function validarRUC($cod){
			$query = $this->db->query("select ruc from cliente where ruc='".$cod."'");
			return $query->result();
		}

		function UbigeoProv($dep){
			$query = $this->db->query("select distinct provincia,ubiprovincia from ubigeo where ubidepartamento='".$dep."'");
			return $query->result();
		}

		function UbigeoDis($dep,$pro){
			$query = $this->db->query("select distrito,ubidistrito from ubigeo where ubiprovincia='".$pro."' and ubidepartamento='".$dep."'");
			return $query->result();
		}

		function MostrarCliente($cod){
			$query = $this->db->query("select * FROM cliente join ubigeo on cliente.codubigeo = ubigeo.codubigeo where codcliente ='".$cod."'");
			return $query->result();
		}

		function UbigeoProvincia(){
			$query = $this->db->query("select distinct provincia,ubiprovincia from ubigeo");
			return $query->result();
		}

		function UbigeoDistrito(){
			$query = $this->db->query("select distinct distrito,ubidistrito from ubigeo");
			return $query->result();
		}

		function ValidarCliente($cod){
			$query = $this->db->query("
				select codcliente as Codigo from estadia where codcliente='".$cod."' and estado='1' 
				union all 
				select codcliente as Codigo from ventas where codcliente='".$cod."' and estadoventa='1';
			");
			return $query->result();
		}
		function ValidarCliente1($cod){
			$query = $this->db->query("
				select e.codcliente as Codigo from estadia as e inner join cuotaestadia as ce on(e.codestadia=ce.codestadia)
				where e.codcliente='".$cod."' and ce.estado=1
				union all 
				select codcliente as Codigo from ventas as v inner join cuotasventas as cv on(v.codventas=cv.codventas)
				where codcliente='".$cod."' and cv.estado=1
			");
			return $query->result();
		}

		function TraerClientes(){
				$query = $this->db->query("select * from cliente where razonsocial is null and estado=1");
				return $query->result();	
		}

		function TraerEmpresas(){
				$query = $this->db->query("select * from cliente where razonsocial is not null and estado=1 and not codcliente=10");
				return $query->result();	
		}

		function NuevoC(){
			$this->db->select_max('codcliente');
			$query = $this->db->get('cliente'); 
			return $query->result();
		}

		function GuadarCliente(){
			//Obteniendo nuevo cod cliente
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
	                'dnicliente' => $_POST["dni"],
	                'codubigeo' => $idubigeo,
	                'nombre' => $_POST["nombre"],
	                'appaterno' => $_POST["apellidop"],
	                'apmaterno' => $_POST["apellidom"],
	                'direccion' => $_POST["direccion"],
	                'telefono' => $_POST["telefono"],
	                'email' => $_POST["email"],
	                'estadocivil' => $_POST["estadocivil"],
	                'celular' => $_POST["celular"],
	                'rpm' => $_POST["rpm"],
	                'gruposanguineo' => $_POST["gruposanguineo"],
	                'fechanacimiento' => $_POST["fecha"],
	                'sexo' => $_POST["sexo"],
	                'zonareferencial' => $_POST["zona"],
	                'gradoinstruccion' => $_POST["grado"],
	                'estado' => 1
	            );          
			}else{
				$data = array(
	                'codcliente' => $idcliente,
	                'codubigeo' => $idubigeo,               
	                'ruc' => $_POST["ruc"],
	                'razonsocial' => $_POST["razons"],      
	                'direccion' => $_POST["direccion"],
	                'telefono' => $_POST["telefono"],
	                'email' => $_POST["email"],
	                'celular' => $_POST["celular"],
	                'rpm' => $_POST["rpm"],
	                'zonareferencial' => $_POST["zona"],
	                'estado' => 1
	            ); 
			}
			$this->db->insert("cliente",$data);
		}

		function ModificarCliente($cod){
		    $result= $this->db->get('cliente')->result_array();

		    //Obteniendo el ubigeo
		    $this->db->where('ubidepartamento',$_POST['departamento']);
		    $this->db->where('ubiprovincia',$_POST['provincia']);
		    $this->db->where('ubidistrito',$_POST['distrito']);
		    $result= $this->db->get('ubigeo')->result_array();
		    $idubigeo= $result[0]['codubigeo'];

			if ($_POST["accion"]=="") {
				$data = array(
	                'dnicliente' => $_POST["dni"],
	                'codubigeo' => $idubigeo,
	                'nombre' => $_POST["nombre"],
	                'appaterno' => $_POST["apellidop"],
	                'apmaterno' => $_POST["apellidom"],
	                'direccion' => $_POST["direccion"],
	                'telefono' => $_POST["telefono"],
	                'email' => $_POST["email"],
	                'estadocivil' => $_POST["estadocivil"],
	                'celular' => $_POST["celular"],
	                'rpm' => $_POST["rpm"],
	                'gruposanguineo' => $_POST["gruposanguineo"],
	                'fechanacimiento' => $_POST["fecha"],
	                'sexo' => $_POST["sexo"],
	                'zonareferencial' => $_POST["zona"],
	                'gradoinstruccion' => $_POST["grado"],
	            );          
			}else{
				$data = array(
	                'codubigeo' => $idubigeo,     
	                'ruc' => $_POST["ruc"],
	                'razonsocial' => $_POST["razons"],      
	                'direccion' => $_POST["direccion"],
	                'telefono' => $_POST["telefono"],
	                'email' => $_POST["email"],
	                'celular' => $_POST["celular"],
	                'rpm' => $_POST["rpm"],
	                'zonareferencial' => $_POST["zona"],
	            ); 
			}
			$this->db->where('codcliente', $cod);
			$this->db->update('cliente', $data);
		}

		function Eliminar($codigo){
			$data = array(
               'estado' => 0
            );
			$this->db->where('codcliente', $codigo);
			$this->db->update('cliente', $data);  
		}
	}
?>