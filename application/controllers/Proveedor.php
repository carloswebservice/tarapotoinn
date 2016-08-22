<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedor extends CI_Controller {
	
	public function index(){		
		$this->load->database('default');
		$this->load->model('Proveedor_model');

		$Proveedores = $this->Proveedor_model->MostrarProveedores();
		$this->load->view("Proveedor/index.php",compact("Proveedores"));
	}
	
	public function Nuevo(){
		$this->load->database('default');
		$this->load->model('Proveedor_model');

		$NuevoEmpleado= $this->Proveedor_model->Nuevo();
		echo json_encode($NuevoEmpleado);
	}

	public function Modificando(){
		$this->load->database('default');
		$this->load->model('Proveedor_model');

		$Emplea= $this->Proveedor_model->MostrarProveedor($this->input->post("modificar"));
		echo json_encode($Emplea);
	}

	public function Guardar(){
		$this->load->database('default');
		$this->load->model('Proveedor_model');

		$NuevoEmpleado= $this->Proveedor_model->Insertar($this->input->post("codproveedor"),$this->input->post("razonsocial"),
			$this->input->post("ruc"),$this->input->post("direccion"),$this->input->post("email"),$this->input->post("telefono"),
			$this->input->post("celular"),$this->input->post("rpm"),$this->input->post("rpc"),$this->input->post("zona"),1);
		echo "<center><span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Proveedor Registrado Correctamente </b> </center>";
	}

	public function Modificar(){
		$this->load->database('default');
		$this->load->model('Proveedor_model');

		$NuevoCargo= $this->Proveedor_model->Modificar($this->input->post("codproveedor"),$this->input->post("razonsocial"),
			$this->input->post("ruc"),$this->input->post("direccion"),$this->input->post("email"),$this->input->post("telefono"),
			$this->input->post("celular"),$this->input->post("rpm"),$this->input->post("rpc"),$this->input->post("zona"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Proveedor Modificado Correctamente </b> </center>";
	}

	public function Eliminar(){
		$this->load->database('default');
		$this->load->model('Proveedor_model');

		$provee= $this->Proveedor_model->ValidarProveedor($this->input->post("eliminar"));
		if ($provee == null) {
			$NuevoEmpleado= $this->Proveedor_model->Eliminar($this->input->post("eliminar"));
			echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Proveedor Eliminado Correctamente </b> </center>";	
		}else{
			echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> No Puede Eliminar Este Proveedor </b> </center>";
		}	
	}

		public function RUCempresa(){
		$this->load->database('default');
		$this->load->model('Proveedor_model');

		$a= $this->Proveedor_model->validarRUC($this->input->get("ruc"));
		
		if ($a == True){
			echo json_decode("1");
		}else{
			echo json_decode("0");
		}
	}
}