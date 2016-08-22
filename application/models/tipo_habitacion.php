<?php
	class tipo_habitacion extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarTipoHabitaciones(){
			$query = $this->db->get('tipohabitacion');
			return $query->result();
		}

		function MostrarTipoHabitacion($cod){
			$query = $this->db->get_where('tipohabitacion', array('codtipohabitacion' => $cod));
			return $query->result();
		}

		function Nuevo(){
			$this->db->select_max('codtipohabitacion');
			$query = $this->db->get('tipohabitacion');
			return $query->result();
		}

		function Insertar($cod,$descrip,$img){
			$data = array(
               'codtipohabitacion' => $cod,
               'descripcion' => $descrip,
               'imagen' =>$img
            );
			$this->db->insert('tipohabitacion', $data);
		}

		function do_upload()
		{
			
		}	

		function Modificar($cod,$descrip){
			$data = array(
               'descripcion' => $descrip
            );
			$this->db->where('codtipohabitacion', $cod);
			$this->db->update('tipohabitacion', $data); 
		}

		function Eliminar($codigo){
			$this->db->delete('tipohabitacion', array('codtipohabitacion' => $codigo)); 
		}
	}
?>