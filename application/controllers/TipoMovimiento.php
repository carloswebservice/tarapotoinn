<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipomovimiento extends CI_Controller {
	
	public function index(){		
		$this->load->database('default');
		$this->load->model('Tipo_Movimiento');

		$TipoMovimientos = $this->Tipo_Movimiento->MostrarTipoMovimientos();
		$this->load->view("TipoMovimiento/index.php",compact("TipoMovimientos"));
	}
	
	public function Nuevo(){
		$this->load->database('default');
		$this->load->model('Tipo_Movimiento');

		$NuevoTipoHab= $this->Tipo_Movimiento->Nuevo();
		echo json_encode($NuevoTipoHab);
	}

	public function Modificando(){
		$this->load->database('default');
		$this->load->model('Tipo_Movimiento');

		$TipoHab= $this->Tipo_Movimiento->MostrarTipoMovimiento($this->input->post("modificar"));
		echo json_encode($TipoHab);
	}

	public function Guardar(){
		$this->load->database('default');
		$this->load->model('Tipo_Movimiento');

		$NuevoTipoHab= $this->Tipo_Movimiento->Insertar($this->input->post("codtipomovimiento"),$this->input->post("descripcionmov"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Tipo Movimiento Insertado Correctamente </b> </center>";
	}

	public function Modificar(){
		$this->load->database('default');
		$this->load->model('Tipo_Movimiento');

		$NuevoTipoHab= $this->Tipo_Movimiento->Modificar($this->input->post("codtipomovimiento"),$this->input->post("descripcionmov"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Tipo Movimiento Modificado Correctamente </b> </center>";
	}

	public function Eliminar(){
		$this->load->database('default');
		$this->load->model('Tipo_Movimiento');

		$NuevoTipoHab= $this->Tipo_Movimiento->Eliminar($this->input->post("eliminar"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Tipo Movimiento Eliminado Correctamente </b> </center>";
	}
}