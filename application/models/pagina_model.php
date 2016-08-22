<?php
	class pagina_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}

		function InformacionHabitaciones(){
			$query = $this->db->get('tipohabitacion');
			return $query->result();
		}

		function MostrarInformacion(){
			$query = $this->db->get('informacion');
			return $query->result();
		}

		function logear($user,$clave){
			$this->db->where('usuario',$user);
			$this->db->where('clave',$clave);
			$this->db->from('empleado');
			$query = $this->db->get();
			return $query->result_array();
		}
	}
?>