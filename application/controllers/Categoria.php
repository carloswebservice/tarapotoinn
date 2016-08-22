<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria extends CI_Controller {
	
	public function index(){		
		$this->load->database('default');
		$this->load->model('Categoria_model');

		$Categorias = $this->Categoria_model->MostrarCategoria();
		$this->load->view("Categoria/index.php",compact("Categorias"));
	}
	
	public function Nuevo(){
		$this->load->database('default');
		$this->load->model('Categoria_model');

		$NuevoTipoHab= $this->Categoria_model->Nuevo();
		echo json_encode($NuevoTipoHab);
	}

	public function Modificando(){
		$this->load->database('default');
		$this->load->model('Categoria_model');

		$TipoHab= $this->Categoria_model->MostrarCategorias($this->input->post("modificar"));
		echo json_encode($TipoHab);
	}

	public function Guardar(){
		$this->load->database('default');
		$this->load->model('Categoria_model');

		$NuevoTipoHab= $this->Categoria_model->Insertar($this->input->post("codcategoria"),$this->input->post("descripcion"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Categoria Insertado Correctamente </b> </center>";
	}

	public function Modificar(){
		$this->load->database('default');
		$this->load->model('Categoria_model');

		$NuevoTipoHab= $this->Categoria_model->Modificar($this->input->post("codcategoria"),$this->input->post("descripcion"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Categoria Modificado Correctamente </b> </center>";
	}

	public function Eliminar(){
		$this->load->database('default');
		$this->load->model('Categoria_model');

		$NuevoTipoHab= $this->Categoria_model->Eliminar($this->input->post("eliminar"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Categoria Eliminado Correctamente </b> </center>";
	}
}