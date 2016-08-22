<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH."/third_party/fpdf/fpdf.php";
class Reportes extends CI_Controller {

	public function ReporteMovimientos(){
		$this->load->database('default');
		$this->load->model('Reportes_model');

		$Movimientoslista = $this->Reportes_model->Movimientoslista();
		$this->load->view("Movimientos/ReportarMovimientos.php",compact("Movimientoslista"));
	}
	
	public function estadias(){		
		$this->load->database('default');
		$this->load->model('Reportes_model');

		$Estadias = $this->Reportes_model->Estadias();
		$this->load->view("Reportes/ReporteEstadias.php",compact("Estadias"));
	}

	public function Reservas(){		
		$this->load->database('default');
		$this->load->view("Reportes/ReporteReservas.php");
	}

	public function ventas(){		
		$this->load->database('default');
		$this->load->model('Reportes_model');

		$Ventas = $this->Reportes_model->Ventas();
		$this->load->view("Reportes/ReporteVentas.php",compact("Ventas"));
	}

	public function compras(){		
		$this->load->database('default');
		$this->load->model('Reportes_model');

		$Compras = $this->Reportes_model->Compras();
		$this->load->view("Reportes/ReporteCompras.php",compact("Compras"));
	}

	public function clientes(){		
		$this->load->database('default');
		$this->load->model('Reportes_model');

		$Clientes = $this->Reportes_model->Clientes();
		$this->load->view("Reportes/ReporteClientes.php",compact("Clientes"));
	}

	public function ImprimirEstadias(){		
		$this->load->database('default');
		$this->load->model('Reportes_model');

		$Estadias = $this->Reportes_model->Estadias1();
		$this->load->view("Reportes/ImprimirEstadias.php",compact("Estadias"));
	}

	public function ImprimirVentas(){		
		$this->load->database('default');
		$this->load->model('Reportes_model');

		$Ventas = $this->Reportes_model->Ventas1();
		$this->load->view("Reportes/ImprimirVentas.php",compact("Ventas"));
	} 

	public function ImprimirCompras(){		
		$this->load->database('default');
		$this->load->model('Reportes_model');

		$Compras = $this->Reportes_model->Compras1();
		$this->load->view("Reportes/ImprimirCompras.php",compact("Compras"));
	} 

	public function ImprimirClientes(){		
		$this->load->database('default');
		$this->load->model('Reportes_model');

		$Clientes = $this->Reportes_model->Clientes1();
		$this->load->view("Reportes/ImprimirClientes.php",compact("Clientes"));
	} 
}