<?php
	class habitacion_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarHabitaciones(){
			$this->db->select('*');
			$this->db->from('habitacion');
			$this->db->join('tipohabitacion', 'tipohabitacion.codtipohabitacion = habitacion.codtipohabitacion');

			$query = $this->db->get();
			return $query->result();
		}

		function MostrarHabitacion($cod){
			$query=$this->db->query(
				"select *from habitacion as h inner join tipohabitacion as th on(h.codtipohabitacion=th.codtipohabitacion)
				where codhabitacion=".$cod
			);
			return $query->result();
		}

		function MostrarDetalleHabitacion($cod){
			$query=$this->db->query(
				"select a.codarticulo,a.descripcionart from articuloporhabitacion as ah inner join articulo as a on(ah.codarticulo=a.codarticulo)
				where ah.codhabitacion=".$cod
			);
			return $query->result();
		}

		function MostrarTipoHabitaciones(){
			$query = $this->db->get('tipohabitacion');
			return $query->result();
		}

		function validarhabitacion($cod){
			$query = $this->db->query("select nrohabitacion from habitacion where nrohabitacion='".$cod."'");
			return $query->result();
		}

		function MostrarDisponibles(){
			$query = $this->db->get_where('articulo', array('estado' => 1));
			return $query->result();
		}

		function EliminarArticulo($hab,$art){
			$this->db->where('codhabitacion', $hab);
			$this->db->where('codarticulo', $art);
			$this->db->delete('articuloporhabitacion');

			$data = array(
		        'estado' => 1           
		    );
		    $this->db->where('codarticulo', $art);
			$this->db->update('articulo', $data); 
		}

		function NuevaH(){
			$this->db->select_max('codhabitacion');
			$query = $this->db->get('habitacion');
			return $query->result();
		}

		function Seleccionado($cod){
			$query = $this->db->get_where('articulo', array('codarticulo' => $cod));
			return $query->result();
		}

		function MostrarDetalle($codigo){
			$query = $this->db->get_where('detallehab', array('codhabitacion' => $codigo));
			return $query->result();
		}

		function InsertandoHabitacion($_P){

			$data = array(
               'codhabitacion' => $_REQUEST['codhabitacion'],'nrohabitacion' => $_REQUEST['numero'],'precio' => $_REQUEST['tarifa'],
               'codtipohabitacion' => $_REQUEST['tipohabitacion'],'estado' =>1
            );
			$this->db->insert('habitacion', $data); 

			//Insertando Detalle Ventas
			foreach ($_REQUEST['idarticulo'] as $key => $value) {
				$data = array(
	               'codhabitacion' => $_REQUEST['codhabitacion'],'codarticulo' => $_REQUEST['idarticulo'][$key]            
	            );
				$this->db->insert('articuloporhabitacion', $data);

				$data = array(
	               'estado' => 0           
	            );
	            $this->db->where('codarticulo', $_REQUEST['idarticulo'][$key]);
				$this->db->update('articulo', $data); 
			}		
		}

		function ActualizandoHabitacion($_P){
			$data = array(
               'precio' => $_REQUEST['tarifa']
            );
            $this->db->where('codtipohabitacion',$_REQUEST['codhabitacion']);
			$this->db->update('habitacion', $data); 

			//Insertando Detalle Ventas
			if (isset($_REQUEST['idarticulo'])) {
				foreach ($_REQUEST['idarticulo'] as $key => $value) {
					$data = array(
		               'codhabitacion' => $_REQUEST['codhabitacion'],'codarticulo' => $_REQUEST['idarticulo'][$key]            
		            );
					$this->db->insert('articuloporhabitacion', $data);
					$data = array(
		               'estado' => 0           
		            );
		            $this->db->where('codarticulo', $_REQUEST['idarticulo'][$key]);
					$this->db->update('articulo', $data); 
				}	
			}	
		}
	}
?>