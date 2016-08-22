<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FormaPago extends CI_Controller {
	
	public function index(){		
		$this->load->database('default');
		$this->load->model('FormaPago_model');

		$FormaPagos = $this->FormaPago_model->MostrarFormapagos();
		$this->load->view("FormaPago/index.php",compact("FormaPagos"));
	}
	
	public function Nuevo(){
		$this->load->database('default');
		$this->load->model('FormaPago_model');

		$NuevoTipoHab= $this->FormaPago_model->Nuevo();
		echo json_encode($NuevoTipoHab);
	}

	public function Modificando(){
		$this->load->database('default');
		$this->load->model('FormaPago_model');

		$TipoHab= $this->FormaPago_model->MostrarFormapago($this->input->post("modificar"));
		echo json_encode($TipoHab);
	}

	public function Guardar(){
		$this->load->database('default');
		$this->load->model('FormaPago_model');

		$NuevoTipoHab= $this->FormaPago_model->Insertar($this->input->post("codformapago"),$this->input->post("descripcion"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Forma Pago Insertado Correctamente </b> </center>";
	}

	public function Modificar(){
		$this->load->database('default');
		$this->load->model('FormaPago_model');

		$NuevoTipoHab= $this->FormaPago_model->Modificar($this->input->post("codformapago"),$this->input->post("descripcion"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Forma Pago Modificado Correctamente </b> </center>";
	}

	public function Eliminar(){
		$this->load->database('default');
		$this->load->model('FormaPago_model');

		$NuevoTipoHab= $this->FormaPago_model->Eliminar($this->input->post("eliminar"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Forma Pago Eliminado Correctamente </b> </center>";
	}
}