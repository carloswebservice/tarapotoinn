<?php
	class tipo_producto extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarTipoProductos(){
			$query = $this->db->get('tipoproducto');
			return $query->result();
		}

		function MostrarTipoProducto($cod){
			$query = $this->db->get_where('tipoproducto', array('codtipoproducto' => $cod));
			return $query->result();
		}

		function Nuevo(){
			$this->db->select_max('codtipoproducto');
			$query = $this->db->get('tipoproducto');
			return $query->result();
		}

		function Insertar($cod,$descrip){
			$data = array(
               'codtipoproducto' => $cod,
               'descripcion' => $descrip
            );
			$this->db->insert('tipoproducto', $data);
		}

		function Modificar($cod,$descrip){
			$data = array(
               'descripcion' => $descrip
            );
			$this->db->where('codtipoproducto', $cod);
			$this->db->update('tipoproducto', $data); 
		}

		function Eliminar($codigo){
			$this->db->delete('tipoproducto', array('codtipoproducto' => $codigo)); 
		}
	}
?>