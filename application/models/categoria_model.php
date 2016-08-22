<?php
	class categoria_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarCategoria(){
			$query = $this->db->get('categoria');
			return $query->result();
		}

		function MostrarCategorias($cod){
			$query = $this->db->get_where('categoria', array('codcategoria' => $cod));
			return $query->result();
		}

		function Nuevo(){
			$this->db->select_max('codcategoria');
			$query = $this->db->get('categoria');
			return $query->result();
		}

		function Insertar($cod,$descrip){
			$data = array(
               'codcategoria' => $cod,
               'descripcion' => $descrip
            );
			$this->db->insert('categoria', $data);
		}

		function Modificar($cod,$descrip){
			$data = array(
               'descripcion' => $descrip
            );
			$this->db->where('codcategoria', $cod);
			$this->db->update('categoria', $data); 
		}

		function Eliminar($codigo){
			$this->db->delete('categoria', array('codcategoria' => $codigo)); 
		}
	}
?>