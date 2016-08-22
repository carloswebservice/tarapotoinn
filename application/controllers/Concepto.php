<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Concepto extends CI_Controller {
	
	public function index(){		
		$this->load->database('default');
		$this->load->model('Concepto_model');

		$TipoMovimientos = $this->Concepto_model->TipoMovimientos();
		$Conceptos = $this->Concepto_model->MostrarConceptos();
		$this->load->view("Concepto/index.php",compact("Conceptos","TipoMovimientos"));
	}
	
	public function Nuevo(){
		$this->load->database('default');
		$this->load->model('Concepto_model');

		$NuevoConcep= $this->Concepto_model->Nuevo();
		echo json_encode($NuevoConcep); 
	}

	public function Guardar(){
		$this->load->database('default');
		$this->load->model('Concepto_model');

		$NuevoConcep= $this->Concepto_model->Insertar($this->input->post("codconcepto"),$this->input->post("tipomovimiento"),$this->input->post("descripcion"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Concepto Insertado Correctamente </b> </center>";
	}

	public function Modificando(){
		$this->load->database('default');
		$this->load->model('Concepto_model');

		$NuevoConcep= $this->Concepto_model->MostrarConcepto($this->input->post("modificar"));
		echo json_encode($NuevoConcep);
	}

	public function Modificar(){
		$this->load->database('default');
		$this->load->model('Concepto_model');

		$NuevoConcep= $this->Concepto_model->Modificar($this->input->post("codconcepto"),$this->input->post("tipomovimiento"),$this->input->post("descripcion"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Concepto Modificado Correctamente </b> </center>";
	}

	public function Eliminar(){
		$this->load->database('default');
		$this->load->model('Concepto_model');

		$NuevoConcep= $this->Concepto_model->Eliminar($this->input->post("eliminar"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Concepto Eliminado Correctamente </b> </center>";
	}
}