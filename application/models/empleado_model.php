<?php
	class empleado_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarEmpleados(){
			$this->db->select('empleado.codempleado,empleado.dniempleado,empleado.nombre,empleado.appaterno,empleado.apmaterno,empleado.celular,cargo.descripcion');
			$this->db->where('estado',1);
			$this->db->from('empleado');
			$this->db->join('cargo', 'cargo.codcargo = empleado.codcargo');

			$query = $this->db->get();
			return $query->result();
		}

		function MostrarCargos(){
			$query = $this->db->get('cargo');
			return $query->result();
		}

		function MostrarEmpleado($cod){
			$query = $this->db->get_where('empleado', array('codempleado' => $cod));
			return $query->result();
		}

		function ValidarCargo($cod){
			$this->db->where('codcargo',$cod);
			$this->db->from('empleado');
			return $this->db->count_all_results();
		}

		function validardni($cod){
			$query = $this->db->query("select dniempleado from empleado where dniempleado='".$cod."'");
			return $query->result();
		}

		function Nuevo(){
			$this->db->select_max('codempleado');
			$query = $this->db->get('empleado');
			return $query->result();
		}

		function Insertar($cod,$dni,$dir,$nom,$apep,$apem,$email,$telf,$cel,$zona,$cargo,$scivil,$sexo,$estado){
			$data = array(
               'codempleado' => $cod,'dniempleado' => $dni,'direccion' => $dir,'nombre' => $nom,'appaterno' => $apep,
               'apmaterno' => $apem,'email' => $email,'telefono' => $telf,'celular' => $cel,'zonareferencial' => $zona,
               'codcargo' => $cargo,'estadocivil' => $scivil,'sexo' => $sexo,'estado' => $estado
            );
			$this->db->insert('empleado', $data);
		}

		function Modificar($cod,$dni,$dir,$nom,$apep,$apem,$email,$telf,$cel,$zona,$cargo,$scivil,$sexo){
			$data = array(
               'dniempleado' => $dni,'direccion' => $dir,'nombre' => $nom,'appaterno' => $apep,'apmaterno' => $apem,
               'email' => $email,'telefono' => $telf,'celular' => $cel,'zonareferencial' => $zona,
               'codcargo' => $cargo,'estadocivil' => $scivil,'sexo' => $sexo
            );
			$this->db->where('codempleado', $cod);
			$this->db->update('empleado', $data); 
		}

		function Eliminar($codigo){
			$data = array(
               'estado' => 0
            );
			$this->db->where('codempleado', $codigo);
			$this->db->update('empleado', $data);  
		}
	}
?>