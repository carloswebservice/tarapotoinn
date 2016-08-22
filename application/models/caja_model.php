<?php
	class caja_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarCaja(){
			$query = $this->db->get('caja');
			return $query->result();
		}

		function Nuevo(){
			$this->db->select_max('codcaja');
			$query = $this->db->get('caja');
			return $query->result();
		}

		function Modificar($cod){
			$data = array(
               'estadocaja' => '1'
            );
			$this->db->where('codcaja', $cod);
			$this->db->update('caja', $data); 
		}

		function Cerrar($cod){
			$data = array(
               'estadocaja' => '0'
            );
			$this->db->where('codcaja', $cod);
			$this->db->update('caja', $data); 
		}
	}
?>