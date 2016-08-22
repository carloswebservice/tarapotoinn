<?php
	class tipo_movimiento extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarTipoMovimientos(){
			$query = $this->db->get('tipomovimiento');
			return $query->result();
		}

		function MostrarTipoMovimiento($cod){
			$query = $this->db->get_where('tipomovimiento', array('codtipomovimiento' => $cod));
			return $query->result();
		}

		function Nuevo(){
			$this->db->select_max('codtipomovimiento');
			$query = $this->db->get('tipomovimiento');
			return $query->result();
		}

		function Insertar($cod,$descrip){
			$data = array(
               'codtipomovimiento' => $cod,
               'descripcionmov' => $descrip
            );
			$this->db->insert('tipomovimiento', $data);
		}

		function Modificar($cod,$descrip){
			$data = array(
               'descripcionmov' => $descrip
            );
			$this->db->where('codtipomovimiento', $cod);
			$this->db->update('tipomovimiento', $data); 
		}

		function Eliminar($codigo){
			$this->db->delete('tipomovimiento', array('codtipomovimiento' => $codigo)); 
		}
	}
?>