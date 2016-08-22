<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datosmaestros extends CI_Controller {
	
	public function index(){		
		$this->load->database('default');
		$this->load->model('Datosmaestros_model');

		$Informacion = $this->Datosmaestros_model->MostrarInformacion();
		$this->load->view("DatosMaestros/index.php",compact("Informacion"));
	}
	
	public function Cancelar(){
		$this->load->database('default');
		$this->load->model('Datosmaestros_model');

		$Informacion = $this->Datosmaestros_model->MostrarInformacion();
		echo json_encode($Informacion);
	}

	public function Guardar(){
		$this->load->database('default');
		$this->load->model('Datosmaestros_model');

		$Info= $this->Datosmaestros_model->Guardar($this->input->post("mision"),$this->input->post("vision"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> 
		<b> Informacion De La Empresa Actualizada Correctamente</b> </center>";
	}
}