<?php
	class datosmaestros_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarInformacion(){
			$query = $this->db->get('informacion');
			return $query->result();
		}

		function Guardar($mision,$vision){
			$data = array(
               'mision' => $mision,
               'vision' => $vision
            );
			$this->db->update('informacion', $data);
		}


		//Para Alertas, Mensajes Notificaciones

		function Alertas(){
			
			$query = $this->db->query("
				select 'estadia' as concepto,c.*,e.fechaingreso as fechaconcepto,ce.*
				from cuotaestadia as ce inner join estadia as e on(e.codestadia=ce.codestadia)
					inner join cliente as c on(e.codcliente=c.codcliente)
				where ce.fecha < '".date('d-m-Y')."' and ce.estado=1

				union all

				select 'venta' as concepto,c.*,v.fechaventa as fechaconcepto,cv.*
				from cuotasventas as cv inner join ventas as v on(v.codventas=cv.codventas)
					inner join cliente as c on(v.codcliente=c.codcliente)
				where cv.fecha < '".date('d-m-Y')."' and cv.estado=1"
			);
			return $query->result();
		}

		function FinEstadia(){
			//select *from estadia where fechasalida ='2015-11-18'
			$this->db->select('*');
			$this->db->where('estadia.fechasalida', date('d-m-Y'));
			$this->db->where('estadia.estado', 1);
			$this->db->from('estadia');
			$this->db->join('cliente', 'cliente.codcliente = estadia.codcliente');

			$query = $this->db->get();

			return $query->result();
		}



		function EstadiasTerminadas(){
			$query = $this->db->query("
				select *from estadia as e inner join cliente as c on(e.codcliente=c.codcliente) where e.estado=1 and e.fechasalida <'".date('d-m-Y')."'
			");
			return $query->result();
		}

		function NumFinEstadia(){
			$this->db->select('*');
			$this->db->where('fechasalida', date('d-m-Y'));
			$this->db->where('estado', 1);
			$this->db->from('estadia');
			return $this->db->count_all_results();
		}

		function Mensajes(){
			$query = $this->db->get('informacion');
			return $query->result();
		}


		function ProductosExeso(){
			$query = $this->db->query("select *from producto where stockactual>=stockmaximo");
			return $query->result();
		}
		function ProductosDeficet(){
			$query = $this->db->query("select *from producto where stockactual<=stockminimo");
			return $query->result();
		}
	}
?>