<?php
	class articulo_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarArticulos(){
			$this->db->select('articulo.codarticulo,articulo.descripcionart,categoria.descripcion');
			$this->db->where('articulo.estado',1);
			$this->db->from('articulo');
			$this->db->join('categoria', 'categoria.codcategoria = articulo.codcategoria');

			$query = $this->db->get();
			return $query->result();
		}

		function MostrarCategorias(){
			$query = $this->db->get('categoria');
			return $query->result();
		}

		function MostrarArticulo($cod){
			$query = $this->db->get_where('articulo', array('codarticulo' => $cod));
			return $query->result();
		}

		function Nuevo(){
			$this->db->select_max('codarticulo');
			$query = $this->db->get('articulo');
			return $query->result();
		}

		function Insertar($cod,$cat,$desc,$estado){
			$data = array(
               'codarticulo' => $cod,'codcategoria' => $cat,'descripcionart' => $desc,'estado' => $estado
            );
			$this->db->insert('articulo', $data);
		}

		function Modificar($cod,$cat,$desc){
			$data = array(
               'codcategoria' => $cat,'descripcionart' => $desc
            );
			$this->db->where('codarticulo', $cod);
			$this->db->update('articulo', $data); 
		}

		function Eliminar($codigo){
			$data = array(
               'estado' => 0
            );
			$this->db->where('codarticulo', $codigo);
			$this->db->update('articulo', $data);  
		}
	}
?>