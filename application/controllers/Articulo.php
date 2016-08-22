<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articulo extends CI_Controller {
	
	public function index(){		
		$this->load->database('default');
		$this->load->model('Articulo_model');
		$Categorias = $this->Articulo_model->MostrarCategorias();
		$Articulos = $this->Articulo_model->MostrarArticulos();
		$this->load->view("Articulo/index.php",compact("Articulos","Categorias"));
	}
	
	public function Nuevo(){
		$this->load->database('default');
		$this->load->model('Articulo_model');

		$NuevoArticulo= $this->Articulo_model->Nuevo();
		echo json_encode($NuevoArticulo);
	}

	public function Modificando(){
		$this->load->database('default');
		$this->load->model('Articulo_model');

		$Articulo= $this->Articulo_model->MostrarArticulo($this->input->post("modificar"));
		echo json_encode($Articulo);
	}

	public function Guardar(){
		$this->load->database('default');
		$this->load->model('Articulo_model');

		$NuevoEmpleado= $this->Articulo_model->Insertar($this->input->post("codarticulo"),$this->input->post("categoria"),
			$this->input->post("descripcion"),1);
		echo "<center><span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Articulo Registrado Correctamente </b> </center>";
	}

	public function Modificar(){
		$this->load->database('default');
		$this->load->model('Articulo_model');

		$NuevoCargo= $this->Articulo_model->Modificar($this->input->post("codarticulo"),$this->input->post("categoria"),
			$this->input->post("descripcion"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Articulo Modificado Correctamente </b> </center>";
	}

	public function Eliminar(){
		$this->load->database('default');
		$this->load->model('Articulo_model');
		
		$NuevoEmpleado= $this->Articulo_model->Eliminar($this->input->post("eliminar"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Articulo Eliminado Correctamente </b> </center>";	
	}
}