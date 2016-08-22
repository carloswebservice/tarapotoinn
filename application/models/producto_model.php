<?php
	class producto_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarProductos(){
			$query = $this->db->get_where('producto', array('estado' => 1));
			return $query->result();
		}

		function MostrarTipoProductos(){
			$query = $this->db->get('tipoproducto');
			return $query->result();
		}

		function MostrarProducto($cod){
			$query = $this->db->get_where('producto', array('codproducto' => $cod));
			return $query->result();
		}

		function Nuevo(){
			$this->db->select_max('codproducto');
			$query = $this->db->get('producto');
			return $query->result();}

		function Insertar($cod,$des,$tipopro,$min,$act,$max,$igv,$precio,$estado){
			$data = array(
               'codproducto' => $cod,'descripcion' => $des,'codtipoproducto' => $tipopro,'stockminimo' => $min,
               'stockactual' => $act,'stockmaximo' => $max,'cobrarigv' => $igv,'precio' => $precio,'estado' => $estado
            );
			$this->db->insert('producto', $data);
		}

		function Modificar($cod,$des,$tipopro,$min,$act,$max,$igv,$precio){
			$data = array(
               'descripcion' => $des,'codtipoproducto' => $tipopro,'stockminimo' => $min,
               'stockactual' => $act,'stockmaximo' => $max,'cobrarigv' => $igv,'precio' => $precio
            );
			$this->db->where('codproducto', $cod);
			$this->db->update('producto', $data); 
		}

		function Eliminar($codigo){
			$data = array(
               'estado' => 0
            );
			$this->db->where('codproducto', $codigo);
			$this->db->update('producto', $data);  
		}
	}
?>