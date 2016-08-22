<?php
	class tipo_comprobante extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarTipoComprobantes(){
			$query = $this->db->get('tipocomprobante');
			return $query->result();
		}

		function MostrarTipoComprobante($cod){
			$query = $this->db->get_where('tipocomprobante', array('codtipocomprobante' => $cod));
			return $query->result();
		}

		function Nuevo(){
			$this->db->select_max('codtipocomprobante');
			$query = $this->db->get('tipocomprobante');
			return $query->result();
		}

		function Insertar($cod,$serie,$descrip){
			$data = array(
               'codtipocomprobante' => $cod,
               'serie' => $serie,
               'descripcion' => $descrip
            );
			$this->db->insert('tipocomprobante', $data);
		}

		function Modificar($cod,$serie,$descrip){
			$data = array(
				'serie' => $serie,
                'descripcion' => $descrip
            );
			$this->db->where('codtipocomprobante', $cod);
			$this->db->update('tipocomprobante', $data); 
		}

		function Eliminar($codigo){
			$this->db->delete('tipocomprobante', array('codtipocomprobante' => $codigo)); 
		}
	}
?>