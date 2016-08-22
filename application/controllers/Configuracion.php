<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuracion extends CI_Controller {

	public function index(){

		if($this->input->post()){
			if($this->input->post("desarrollador")=="Carlos" and $this->input->post("clave")=="softwareII"){
	            $this->load->view('Desarrollador/MotorBD.php');
	        }else{
	            $this->load->view('Desarrollador/index.php');
	        }
		}else{
			$this->load->view('Desarrollador/index.php');
		}
	}
}