<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cargo extends CI_Controller {
	
	public function index(){		
		$this->load->database('default');
		$this->load->model('Cargo_model');

		$Cargos = $this->Cargo_model->MostrarCargos();
		$this->load->view("Cargo/index.php",compact("Cargos"));
	}
	
	public function Nuevo(){
		$this->load->database('default');
		$this->load->model('Cargo_model');

		$NuevoCargo= $this->Cargo_model->Nuevo();
		echo json_encode($NuevoCargo);
	}

	public function Modificando(){
		$this->load->database('default');
		$this->load->model('Cargo_model');

		$Carg= $this->Cargo_model->MostrarCargo($this->input->post("modificar"));
		echo json_encode($Carg);
	}

	public function Guardar(){
		$this->load->database('default');
		$this->load->model('Cargo_model');

		$NuevoCargo= $this->Cargo_model->Insertar($this->input->post("codcargo"),$this->input->post("descripcion"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Cargo Insertado Correctamente </b> </center>";
	}

	public function Modificar(){
		$this->load->database('default');
		$this->load->model('Cargo_model');

		$NuevoCargo= $this->Cargo_model->Modificar($this->input->post("codcargo"),$this->input->post("descripcion"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Cargo Modificado Correctamente </b> </center>";
	}

	public function Eliminar(){
		$this->load->database('default');
		$this->load->model('Cargo_model');

		$Carg= $this->Cargo_model->ValidarCargo($this->input->post("eliminar"));

		if ($Carg==0) {
			$NuevoCargo= $this->Cargo_model->Eliminar($this->input->post("eliminar"));
			echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Cargo Eliminado Correctamente </b> </center>";
		}else{
			echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> No Puede Eliminar Este Cargo </b> </center>";
		}		
	}
}