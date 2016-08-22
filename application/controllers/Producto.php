<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto extends CI_Controller {

	public function index(){
		$this->load->database('default');
		$this->load->model('Producto_model');
		$TipoProductos = $this->Producto_model->MostrarTipoProductos();
		$Productos = $this->Producto_model->MostrarProductos();
		$this->load->view("Producto/index.php",compact("Productos","TipoProductos"));
	}

	public function Nuevo(){
		$this->load->database('default');
		$this->load->model('Producto_model');

		$NuevoEmpleado= $this->Producto_model->Nuevo();
		echo json_encode($NuevoEmpleado);
	}

	public function Modificando(){
		$this->load->database('default');
		$this->load->model('Producto_model');
		
		$Emplea= $this->Producto_model->MostrarProducto($this->input->post("modificar"));
		echo json_encode($Emplea);
	}

	public function Guardar(){
		$this->load->database('default');
		$this->load->model('Producto_model');

		$NuevoEmpleado= $this->Producto_model->Insertar($this->input->post("codproducto"),$this->input->post("descripcion"),
			$this->input->post("tipoproducto"),$this->input->post("stockmin"),$this->input->post("stockact"),
			$this->input->post("stockmax"),$this->input->post("igv"),$this->input->post("precio"),1);
		echo "<center><span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Producto Registrado Correctamente </b> </center>";
	}

	public function Modificar(){
		$this->load->database('default');
		$this->load->model('Producto_model');

		$NuevoCargo= $this->Producto_model->Modificar($this->input->post("codproducto"),$this->input->post("descripcion"),
			$this->input->post("tipoproducto"),$this->input->post("stockmin"),$this->input->post("stockact"),
			$this->input->post("stockmax"),$this->input->post("igv"),$this->input->post("precio"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Producto Modificado Correctamente </b> </center>";
	}

	public function Eliminar(){
		$this->load->database('default');
		$this->load->model('Producto_model');

		$NuevoEmpleado= $this->Producto_model->Eliminar($this->input->post("eliminar"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Producto Eliminado Correctamente </b> </center>";
	}
}
