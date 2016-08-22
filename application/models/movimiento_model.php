<?php
	class movimiento_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarCargos(){
			$query = $this->db->get('cargo');
			return $query->result();
		}

		function TraerVentas($cod){
			$this->db->select('cliente.nombre,cliente.appaterno,cliente.direccion,ventas.codventas,ventas.importe,ventas.fechaventa,ventas.estadoventa');
			$this->db->where('cliente.dnicliente',$cod);
			$this->db->from('ventas');
			$this->db->join('cliente', 'cliente.codcliente = ventas.codcliente');

			$query = $this->db->get();			
			return $query->result();
		}

		function TraerCuotas($cod){
			$this->db->select('*');
			$this->db->where('cuotasventas.codventas',$cod);
			$this->db->from('cuotasventas');

			$query = $this->db->get();			
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