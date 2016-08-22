<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Venta extends CI_Controller {
	
	public function index(){		
		$this->load->database('default');
		$this->load->model('Venta_model');
		$Ventas = $this->Venta_model->MostrarVentas();
		$this->load->view("Ventas/index.php",compact("Ventas"));
	}
	
	public function Nuevo(){
		$this->load->database('default');
		$this->load->model('Venta_model');

		$TipoComprobantes = $this->Venta_model->TipoComprobantes();
		$FormaPagos = $this->Venta_model->FormaPagos();
		$Productos = $this->Venta_model->Productos();
		$Nuevo = $this->Venta_model->NuevaH();

		$Departamentos = $this->Venta_model->UbigeoDep();
		$this->load->view("Ventas/nuevo.php",compact("Nuevo","Departamentos","Proveedores","TipoComprobantes","FormaPagos","Productos"));
	}

	public function Verventa(){
		$this->load->database('default');
		$this->load->model('Venta_model');

		$Ventas = $this->Venta_model->VistaVentas($_POST['id']);
		$DetalleVenta = $this->Venta_model->VistaDetalleVentas($_POST['id']);

		$Cuotas = $this->Venta_model->Cuotas($_POST['id']);

		$this->load->view("Ventas/verventa.php",compact('Ventas','DetalleVenta','Cuotas'));
	}

	public function UbigeoPro(){
		$this->load->database('default');
		$this->load->model('Venta_model');

		$Provincias= $this->Venta_model->UbigeoPro($this->input->post("departamento"));
		echo json_encode($Provincias);
	}

	public function UbigeoDis(){
		$this->load->database('default');
		$this->load->model('Venta_model');

		$Provincias= $this->Venta_model->UbigeoDis($this->input->post("departamento"),$this->input->post("provincia"));
		echo json_encode($Provincias);
	}

	public function Cantidadstock(){
		$this->load->database('default');
		$this->load->model('Venta_model');

		$Cantidad = $this->Venta_model->Vercantidad($this->input->post("codproducto"));
		echo json_encode($Cantidad);
	}

	public function TraerClientes(){
		$this->load->database('default');
        $this->load->model('Venta_model');

        $clientes=$this->Venta_model->TraerClientes();
        echo json_encode($clientes);
	}

	public function GuardarClienteNuevo(){
		$this->load->database('default');
        $this->load->model('Venta_model');

        $this->Venta_model->GrabaNuevoCliente();
	}

	public function GuardarVenta(){
		//Para Insertar Ventas Y Detalle Ventas
		$this->load->database('default');
		$this->load->model('Venta_model');
		$this->Venta_model->grabaventa();

		echo "Venta Registrada Correctamente";
	}
}