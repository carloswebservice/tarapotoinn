<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empleado extends CI_Controller {
	
	public function index(){		
		$this->load->database('default');
		$this->load->model('Empleado_model');
		$Cargos = $this->Empleado_model->MostrarCargos();
		$Empleados = $this->Empleado_model->MostrarEmpleados();
		$this->load->view("Empleado/index.php",compact("Empleados","Cargos"));
	}
	
	public function Nuevo(){
		$this->load->database('default');
		$this->load->model('Empleado_model');

		$NuevoEmpleado= $this->Empleado_model->Nuevo();
		echo json_encode($NuevoEmpleado);
	}

	public function Modificando(){
		$this->load->database('default');
		$this->load->model('Empleado_model');

		$Emplea= $this->Empleado_model->MostrarEmpleado($this->input->post("modificar"));
		echo json_encode($Emplea);
	}

	public function Guardar(){
		$this->load->database('default');
		$this->load->model('Empleado_model');

		$NuevoEmpleado= $this->Empleado_model->Insertar($this->input->post("codempleado"),$this->input->post("dni"),
			$this->input->post("direccion"),$this->input->post("nombre"),$this->input->post("apellidop"),$this->input->post("apellidom"),
			$this->input->post("email"),$this->input->post("telefono"),$this->input->post("celular"),$this->input->post("zona"),
			$this->input->post("cargo"),$this->input->post("estadocivil"),$this->input->post("sexo"),1);
		echo "<center><span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Empleado Registrado Correctamente </b> </center>";
	}

	public function Modificar(){
		$this->load->database('default');
		$this->load->model('Empleado_model');

		$NuevoCargo= $this->Empleado_model->Modificar($this->input->post("codempleado"),$this->input->post("dni"),
			$this->input->post("direccion"),$this->input->post("nombre"),$this->input->post("apellidop"),$this->input->post("apellidom"),
			$this->input->post("email"),$this->input->post("telefono"),$this->input->post("celular"),$this->input->post("zona"),
			$this->input->post("cargo"),$this->input->post("estadocivil"),$this->input->post("sexo"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Empleado Modificado Correctamente </b> </center>";
	}

	public function dniempleado(){
		$this->load->database('default');
		$this->load->model('Empleado_model');

		$a= $this->Cliente_model->validardni($this->input->get("dni"));
		
		if ($a == True){
			echo json_decode("1");
		}else{
			echo json_decode("0");
		}
		
	}

	public function dnicliente(){
		$this->load->database('default');
		$this->load->model('Empleado_model');

		$a= $this->Empleado_model->validardni($this->input->get("dni"));
		
		if ($a == True){
			echo json_decode("1");
		}else{
			echo json_decode("0");
		}
		
	}

	public function Eliminar(){
		$this->load->database('default');
		$this->load->model('Empleado_model');
		
		$NuevoEmpleado= $this->Empleado_model->Eliminar($this->input->post("eliminar"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Empleado Eliminado Correctamente </b> </center>";	
	}
}