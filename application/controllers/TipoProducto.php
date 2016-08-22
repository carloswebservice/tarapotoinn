<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipoproducto extends CI_Controller {
	
	public function index(){		
		$this->load->database('default');
		$this->load->model('Tipo_Producto');

		$TipoProductos = $this->Tipo_Producto->MostrarTipoProductos();
		$this->load->view("TipoProducto/index.php",compact("TipoProductos"));
	}
	
	public function Nuevo(){
		$this->load->database('default');
		$this->load->model('Tipo_Producto');

		$NuevoTipoHab= $this->Tipo_Producto->Nuevo();
		echo json_encode($NuevoTipoHab);
	}

	public function Modificando(){
		$this->load->database('default');
		$this->load->model('Tipo_Producto');

		$TipoHab= $this->Tipo_Producto->MostrarTipoProducto($this->input->post("modificar"));
		echo json_encode($TipoHab);
	}

	public function Guardar(){
		$this->load->database('default');
		$this->load->model('Tipo_Producto');

		$NuevoTipoHab= $this->Tipo_Producto->Insertar($this->input->post("codtipoproducto"),$this->input->post("descripcion"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Tipo Producto Insertado Correctamente </b> </center>";
	}

	public function Modificar(){
		$this->load->database('default');
		$this->load->model('Tipo_Producto');

		$NuevoTipoHab= $this->Tipo_Producto->Modificar($this->input->post("codtipoproducto"),$this->input->post("descripcion"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Tipo Producto Modificado Correctamente </b> </center>";
	}

	public function Eliminar(){
		$this->load->database('default');
		$this->load->model('Tipo_Producto');

		$NuevoTipoHab= $this->Tipo_Producto->Eliminar($this->input->post("eliminar"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Tipo Producto Eliminado Correctamente </b> </center>";
	}
}