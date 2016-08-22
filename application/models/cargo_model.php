<?php
	class cargo_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarCargos(){
			$query = $this->db->get('cargo');
			return $query->result();
		}

		function MostrarCargo($cod){
			$query = $this->db->get_where('cargo', array('codcargo' => $cod));
			return $query->result();
		}

		function ValidarCargo($cod){
			$this->db->where('codcargo',$cod);
			$this->db->from('empleado');
			return $this->db->count_all_results();
		}

		function Nuevo(){
			$this->db->select_max('codcargo');
			$query = $this->db->get('cargo');
			return $query->result();
		}

		function Insertar($cod,$descrip){
			$data = array(
               'codcargo' => $cod,
               'descripcion' => $descrip
            );
			$this->db->insert('cargo', $data);
		}

		function Modificar($cod,$descrip){
			$data = array(
               'descripcion' => $descrip
            );
			$this->db->where('codcargo', $cod);
			$this->db->update('cargo', $data); 
		}

		function Eliminar($codigo){
			$this->db->delete('cargo', array('codcargo' => $codigo)); 
		}
	}
?>