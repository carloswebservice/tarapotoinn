<?php
	class reportes_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}

		function Movimientoslista(){
			$query = $this->db->query("	            
				select cli.nombre as nomc,cli.appaterno as app,cli.razonsocial as rz,c.codtipomovimiento as tipom,c.descripcion as concepto, tc.descripcion as comprobante,m.nrocomprobante,m.monto
				from movimientos as m inner join conceptos as c on(c.codconcepto=m.codconcepto)
	            inner join tipocomprobante as tc on(m.codtipocomprobante=tc.codtipocomprobante) 
	            inner join cliente as cli on (m.codcliente=cli.codcliente)
	            where m.estado='A' and m.fechamovimiento='".$_POST['fechahoy']."'
	        ");
	        return $query->result_array();	
		}
		
		function Estadias(){
			$this->db->select('*');
			$this->db->where('estadia.estado',1);
			$this->db->where('estadia.fechareserva is null');
			$this->db->from('estadia');
			$this->db->join('cliente', 'cliente.codcliente = estadia.codcliente');

			$query = $this->db->get();
			return $query->result();
		}

		function Estadias1(){
			$this->db->select('*');
			$this->db->where('estadia.estado',1);
			$this->db->where('estadia.fechareserva is null');
			$this->db->from('estadia');
			$this->db->join('cliente', 'cliente.codcliente = estadia.codcliente');

			$query = $this->db->get();
			return $query->result_array();
		}
		
		function Ventas(){
			$this->db->select('*');
			$this->db->where('ventas.estadoventa',1);
			$this->db->from('ventas');
			$this->db->join('cliente', 'cliente.codcliente = ventas.codcliente');

			$query = $this->db->get();
			return $query->result();
		}

		function Ventas1(){
			$this->db->select('*');
			$this->db->where('ventas.estadoventa',1);
			$this->db->from('ventas');
			$this->db->join('cliente', 'cliente.codcliente = ventas.codcliente');

			$query = $this->db->get();
			return $query->result_array();
		}

		function Compras(){
			$this->db->select('*');
			$this->db->where('compra.estadocompra',1);
			$this->db->from('compra');
			$this->db->join('proveedor', 'proveedor.codproveedor = compra.codproveedor');

			$query = $this->db->get();
			return $query->result();
		}
		
		function Compras1(){
			$this->db->select('*');
			$this->db->where('compra.estadocompra',1);
			$this->db->from('compra');
			$this->db->join('proveedor', 'proveedor.codproveedor = compra.codproveedor');

			$query = $this->db->get();
			return $query->result_array();
		}

		function Clientes(){
			$this->db->select('*');
			$this->db->where('cliente.estado',1);
			$this->db->from('cliente');
			$this->db->join('ubigeo', 'ubigeo.codubigeo = cliente.codubigeo');

			$query = $this->db->get();
			return $query->result();
		}

		function Clientes1(){
			$this->db->select('*');
			$this->db->where('cliente.estado',1);
			$this->db->from('cliente');
			$this->db->join('ubigeo', 'ubigeo.codubigeo = cliente.codubigeo');

			$query = $this->db->get();
			return $query->result_array();
		}
	}
?>