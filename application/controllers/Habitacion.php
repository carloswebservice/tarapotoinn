<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Habitacion extends CI_Controller {
	
	public function index(){		
		$this->load->database('default');
		$this->load->model('Habitacion_model');
		
		$Habitaciones = $this->Habitacion_model->MostrarHabitaciones();
		$this->load->view("Habitacion/index.php",compact("Habitaciones"));
	}
	
	public function Nuevo(){
		$this->load->database('default');
		$this->load->model('Habitacion_model');
		$TipoHabitaciones = $this->Habitacion_model->MostrarTipoHabitaciones();
		$Articulos = $this->Habitacion_model->MostrarDisponibles();
		$Nuevo = $this->Habitacion_model->NuevaH();
		$this->load->view("Habitacion/nuevo.php",compact("TipoHabitaciones","Nuevo","Articulos"));
	}

	public function VerHabitacion(){
		$this->load->database('default');
		$this->load->model('Habitacion_model');

		$Articulos = $this->Habitacion_model->MostrarDisponibles();
		$Habitacion = $this->Habitacion_model->MostrarHabitacion($_POST['id']);
		$DetalleHabi = $this->Habitacion_model->MostrarDetalleHabitacion($_POST['id']);
		$this->load->view("Habitacion/VerHabitacion.php",compact("Habitacion","DetalleHabi","Articulos"));
	}
	
	public function nrohabitacion(){
		$this->load->database('default');
		$this->load->model('Habitacion_model');

		$a= $this->Habitacion_model->validarhabitacion($this->input->get("nrohabitacion"));	
		if ($a == True){
			echo json_decode("1");
		}else{
			echo json_decode("0");
		}
	}

	public function DetalleHab(){
		$this->load->database('default');
		$this->load->model('Habitacion_model');
		$Insert= $this->Habitacion_model->InsertarDetalle($this->input->post("codhabitacion"),$this->input->post("codarticulo"));

		$ArticulosHab = $this->Habitacion_model->MostrarDetalle($this->input->post("codhabitacion"));
		$this->load->view("Habitacion/mostrardetalle.php",compact("ArticulosHab"));
	}

	public function ArticuloDisponible(){
		$this->load->database('default');
		$this->load->model('Habitacion_model');
		$Articulos = $this->Habitacion_model->MostrarDisponibles();
		$this->load->view("Habitacion/disponible.php",compact("Articulos"));
	}

	public function Eliminarartic(){
		$this->load->database('default');
		$this->load->model('Habitacion_model');	
		$Elimina= $this->Habitacion_model->EliminarArticulo($this->input->post("codhabi"),$this->input->post("codarticulo"));

		echo "Eliminado Correctamente";
	}

	public function NuevaHab(){
		$this->load->database('default');
		$this->load->model('Habitacion_model');

		$NuevoTipoHab= $this->Habitacion_model->NuevaH();
		echo json_encode($NuevoTipoHab);

	}
	public function Seleccion(){
		$this->load->database('default');
		$this->load->model('Habitacion_model');

		$Selec= $this->Habitacion_model->Seleccionado($this->input->post("seleccionar"));
		echo json_encode($Selec);
	}

	public function Modificando(){
		$this->load->database('default');
		$this->load->model('Habitacion_model');

		$Articulo= $this->Habitacion_model->MostrarHabitacion($this->input->post("modificar"));
		echo json_encode($Articulo);
	}


	public function GuardarHabitacion(){
		//Para Insertar Ventas Y Detalle Ventas
		$this->load->database('default');
		$this->load->model('Habitacion_model');
		$Registrohab= $this->Habitacion_model->InsertandoHabitacion($_REQUEST);
		echo "Habitacion Registrada Correctamente";
	}

	public function ActualizarHabitacion(){
		//Para Insertar Ventas Y Detalle Ventas
		$this->load->database('default');
		$this->load->model('Habitacion_model');
		$Registrohab= $this->Habitacion_model->ActualizandoHabitacion($_REQUEST);
		echo "Habitacion Actualizada Correctamente";
	}
}