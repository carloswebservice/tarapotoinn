<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SistemaHotelero extends CI_Controller {
	public function index(){
		$this->load->database('default');
		$this->load->model('Datosmaestros_model');

		$Alertas = $this->Datosmaestros_model->Alertas();

		$FinEstadias = $this->Datosmaestros_model->FinEstadia();
		$NumFinEstadias = $this->Datosmaestros_model->NumFinEstadia();
		$EstadiasTerminadas = $this->Datosmaestros_model->EstadiasTerminadas();

		$ProductosExeso = $this->Datosmaestros_model->ProductosExeso();
		$ProductosDeficet = $this->Datosmaestros_model->ProductosDeficet();

		$this->load->view("SistemaHotelero/index.php",compact("Alertas","FinEstadias","NumFinEstadias","EstadiasTerminadas","ProductosExeso","ProductosDeficet"));
	}
}