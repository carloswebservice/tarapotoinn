<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TipoComprobante extends CI_Controller {
	
	public function index(){		
		$this->load->database('default');
		$this->load->model('Tipo_Comprobante');

		$TipoComprobantes = $this->Tipo_Comprobante->MostrarTipoComprobantes();
		$this->load->view("TipoComprobante/index.php",compact("TipoComprobantes"));
	}
	
	public function Nuevo(){
		$this->load->database('default');
		$this->load->model('Tipo_Comprobante');

		$NuevoTipoC= $this->Tipo_Comprobante->Nuevo();
		echo json_encode($NuevoTipoC);
	}

	public function Modificando(){
		$this->load->database('default');
		$this->load->model('Tipo_Comprobante');

		$TipoCom= $this->Tipo_Comprobante->MostrarTipoComprobante($this->input->post("modificar"));
		echo json_encode($TipoCom);
	}

	public function Guardar(){
		$this->load->database('default');
		$this->load->model('Tipo_Comprobante');

		$NuevoTipoHab= $this->Tipo_Comprobante->Insertar($this->input->post("codtipocomprobante"),$this->input->post("serie"),
			$this->input->post("descripcion"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Tipo Comprobante Insertado Correctamente </b> </center>";
	}

	public function Modificar(){
		$this->load->database('default');
		$this->load->model('Tipo_Comprobante');

		$NuevoTipoHab= $this->Tipo_Comprobante->Modificar($this->input->post("codtipocomprobante"),$this->input->post("serie"),
			$this->input->post("descripcion"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Tipo Comprobante Modificado Correctamente </b> </center>";
	}

	public function Eliminar(){
		$this->load->database('default');
		$this->load->model('Tipo_Comprobante');

		$NuevoTipoHab= $this->Tipo_Comprobante->Eliminar($this->input->post("eliminar"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Tipo Comprobante Eliminado Correctamente </b> </center>";
	}
}