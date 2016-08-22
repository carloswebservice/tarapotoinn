<?php
	class formapago_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarFormapagos(){
			$query = $this->db->get('formapagos');
			return $query->result();
		}

		function MostrarFormapago($cod){
			$query = $this->db->get_where('formapagos', array('codformapago' => $cod));
			return $query->result();
		}

		function Nuevo(){
			$this->db->select_max('codformapago');
			$query = $this->db->get('formapagos');
			return $query->result();
		}

		function Insertar($cod,$descrip){
			$data = array(
               'codformapago' => $cod,
               'descripcion' => $descrip
            );
			$this->db->insert('formapagos', $data);
		}

		function Modificar($cod,$descrip){
			$data = array(
               'descripcion' => $descrip
            );
			$this->db->where('codformapago', $cod);
			$this->db->update('formapagos', $data); 
		}

		function Eliminar($codigo){
			$this->db->delete('formapagos', array('codformapago' => $codigo)); 
		}
	}
?>