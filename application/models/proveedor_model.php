<?php
	class proveedor_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarProveedores(){
			$query = $this->db->get_where('proveedor', array('estado' => 1));
			return $query->result();
		}

		function MostrarProveedor($cod){
			$query = $this->db->get_where('proveedor', array('codproveedor' => $cod));
			return $query->result();
		}

		function Nuevo(){
			$this->db->select_max('codproveedor');
			$query = $this->db->get('proveedor');
			return $query->result();
		}

		function validarRUC($cod){
			$query = $this->db->query("select ruc from proveedor where ruc='".$cod."'");
			return $query->result();
		}

		function Insertar($cod,$razon,$ruc,$dir,$email,$telf,$cel,$rpm,$rpc,$zona,$estado){
			$data = array(
               'codproveedor' => $cod,'razonsocial' => $razon,'ruc' => $ruc,'direccion' => $dir,'email' => $email,
               'telefono' => $telf,'celular' => $cel,'rpm' => $rpm,'rpc' => $rpc,'zonareferencial' => $zona,'estado' => $estado
            );
			$this->db->insert('proveedor', $data);
		}

		function Modificar($cod,$razon,$ruc,$dir,$email,$telf,$cel,$rpm,$rpc,$zona){
			$data = array(
               'razonsocial' => $razon,'ruc' => $ruc,'direccion' => $dir,'email' => $email,'telefono' => $telf,'celular' => $cel,
               'rpm' => $rpm,'rpc' => $rpc,'zonareferencial' => $zona
            );
			$this->db->where('codproveedor', $cod);
			$this->db->update('proveedor', $data); 
		}

		function ValidarProveedor($cod){
			$query = $this->db->query("
				select e.codproveedor as Codigo from compra as e inner join cronogramapagos as ce on(e.codcompra=ce.codcompra)
				where e.codproveedor='".$cod."' and ce.estado=1
			");
			return $query->result();
		}

		function Eliminar($codigo){
			$data = array(
               'estado' => 0
            );
			$this->db->where('codproveedor', $codigo);
			$this->db->update('proveedor', $data);  
		}
	}
?>