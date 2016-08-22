<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente extends CI_Controller {
	
	public function index(){		
		$this->load->database('default');
		$this->load->model('Cliente_model');

		$Departamentos = $this->Cliente_model->UbigeoDepartamentos();
		$Provincias = $this->Cliente_model->UbigeoProvincia();
		$Distritos = $this->Cliente_model->UbigeoDistrito();
		$Clientes = $this->Cliente_model->TraerClientes();
		$Empresas = $this->Cliente_model->TraerEmpresas();
		$this->load->view("Cliente/index.php",compact("Clientes","Empresas","Departamentos","Provincias","Distritos"));
	}
	
	public function Nuevo(){
		$this->load->database('default');
		$this->load->model('Cliente_model');
		$NuevoEmpleado= $this->Cliente_model->NuevoC();

		$Departamentos = $this->Cliente_model->UbigeoDepartamentos();
		$this->load->view("Cliente/nuevo.php",compact("NuevoEmpleado","Departamentos"));
	}

	public function UbigeoProvincias(){
		$this->load->database('default');
		$this->load->model('Cliente_model');

		$Provincias= $this->Cliente_model->UbigeoProv($this->input->post("departamento"));
		echo json_encode($Provincias);
	}

	public function UbigeoDistritos(){
		$this->load->database('default');
		$this->load->model('Cliente_model');

		$Provincias= $this->Cliente_model->UbigeoDis($this->input->post("departamento"),$this->input->post("provincia"));
		echo json_encode($Provincias);
	}

	public function TraerClientes(){
		$this->load->database('default');
        $this->load->model('Cliente_model');

        $clientes=$this->Cliente_model->TraerClientes();
        echo json_encode($clientes);
	}

	public function Modificando(){
		$this->load->database('default');
		$this->load->model('Cliente_model');

		$Emplea= $this->Cliente_model->MostrarCliente($this->input->post("modificar"));
		echo json_encode($Emplea);
	}

	public function GuardarClienteNuevo(){
		$this->load->database('default');
        $this->load->model('Cliente_model');

        $this->Cliente_model->GuadarCliente();
        echo "Cliente Registrado Correctamente";
	}

	public function Modificar(){
		$this->load->database('default');
		$this->load->model('Cliente_model');

		$this->Cliente_model->ModificarCliente($this->input->post("codcliente"));
        echo "Cliente Modificado Correctamente";
	}
	
	public function dnicliente(){
		$this->load->database('default');
		$this->load->model('Cliente_model');

		$a= $this->Cliente_model->validardni($this->input->get("dni"));
		
		if ($a == True){
			echo json_decode("1");
		}else{
			echo json_decode("0");
		}
		
	}

	public function RUCempresa(){
		$this->load->database('default');
		$this->load->model('Cliente_model');

		$a= $this->Cliente_model->validarRUC($this->input->get("ruc"));
		
		if ($a == True){
			echo json_decode("1");
		}else{
			echo json_decode("0");
		}
	}

	public function Eliminar(){
		$this->load->database('default');
		$this->load->model('Cliente_model');
		
		$client= $this->Cliente_model->ValidarCliente($this->input->post("eliminar"));
		$client1= $this->Cliente_model->ValidarCliente1($this->input->post("eliminar"));
	
		if ($client == null && $client1== null) {
			$NuevoCliente= $this->Cliente_model->Eliminar($this->input->post("eliminar"));
			echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Cliente Eliminado Correctamente </b> </center>";
		}else{
			echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> No Puede Eliminar Este Cliente </b> </center>";
		}
	}
}