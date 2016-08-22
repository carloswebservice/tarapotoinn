<?php
	class concepto_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarConceptos(){
			$this->db->select('*');
			$this->db->from('conceptos');
			$this->db->join('tipomovimiento', 'tipomovimiento.codtipomovimiento = conceptos.codtipomovimiento');

			$query = $this->db->get();
			return $query->result();
		}

		function MostrarConcepto($cod){
			$query = $this->db->get_where('conceptos', array('codconcepto' => $cod));
			return $query->result();
		}

		function Nuevo(){
			$this->db->select_max('codconcepto');
			$query = $this->db->get('conceptos');
			return $query->result();
		}

		function TipoMovimientos(){
			$query = $this->db->get('tipomovimiento');
			return $query->result();
		}

		function Insertar($cod,$tipomov,$des){
			$data = array(
               'codconcepto' => $cod,
               'codtipomovimiento' => $tipomov,
               'descripcion' => $des
            );
			$this->db->insert('conceptos', $data);
		}

		function Modificar($cod,$tipomov,$des){
			$data = array(
               'codconcepto' => $cod,
               'codtipomovimiento' => $tipomov,
               'descripcion' => $des
            );
			$this->db->where('codconcepto', $cod);
			$this->db->update('conceptos', $data); 
		}

		function Eliminar($codigo){
			$this->db->delete('conceptos', array('codconcepto' => $codigo)); 
		}
	}
?>