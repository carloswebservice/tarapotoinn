<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compra extends CI_Controller {
	
	public function index(){		
		$this->load->database('default');
		$this->load->model('Compra_model');
		$Compras = $this->Compra_model->MostrarCompras();
		$this->load->view("Compras/index.php",compact("Compras"));
	}
	
	public function Nuevo(){
		$this->load->database('default');
		$this->load->model('Compra_model');

		$TipoProductos = $this->Compra_model->TipoProductos();
		$Nuevo = $this->Compra_model->NuevaH();
		$this->load->view("Compras/nuevo.php",compact("Nuevo","TipoProductos"));
	}

	public function Vercompra(){
		$this->load->database('default');
		$this->load->model('Compra_model');

		$Compras = $this->Compra_model->VistaCompras($_POST['id']);
		$DetalleCompra = $this->Compra_model->VistaDetalleCompras($_POST['id']);

		$Cuotas = $this->Compra_model->Cuotas($_POST['id']);

		$this->load->view("Compras/Vercompra.php",compact('Compras','DetalleCompra','Cuotas'));
	}

	public function TraerProveedores(){
		$this->load->database('default');
        $this->load->model('Compra_model');

        $Proveedores=$this->Compra_model->TraerProveedores();
        echo json_encode($Proveedores);
	}

	public function TraerProductos(){
		$this->load->database('default');
        $this->load->model('Compra_model');

        $Productos=$this->Compra_model->TraerProductos();
        echo json_encode($Productos);
	}

	public function GuardarCompra(){
		//Para Insertar Ventas Y Detalle Ventas
		$this->load->database('default');
		$this->load->model('Compra_model');
		$this->Compra_model->grabacompra();

		echo "Compra Registrada Correctamente";
	}

	public function GuardarProveedor(){
		$this->load->database('default');
		$this->load->model('Compra_model');

		$Proveedor= $this->Compra_model->GuardarProveedor();
		echo $Proveedor;
	}

	public function GuardarProducto(){
		$this->load->database('default');
		$this->load->model('Compra_model');

		$Producto= $this->Compra_model->GuardarProducto();
		echo $Producto;
	}

	public function Guardar(){
		$this->load->database('default');
		$this->load->model('Compra_model');

		$NuevoComp= $this->Compra->Insertar($this->input->post("codcompra"),$this->input->post("proveedor"),$this->input->post("empleado"),
			$this->input->post("fechacompra"),$this->input->post("fechaingreso"),$this->input->post("nrofactura"),
			$this->input->post("igv"),$this->input->post("importe"),1);

		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Compra Insertado Correctamente </b> </center>";
	}
}