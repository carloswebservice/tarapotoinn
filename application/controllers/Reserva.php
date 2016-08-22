<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reserva extends CI_Controller {

	public function index(){
		$this->load->database('default');
        $this->load->model('reserva_model');
        
        $Reservas = $this->reserva_model->MostrarReservas();
        $this->load->view("Reserva/index.php",compact("Reservas"));
	}

	public function Nuevo(){
		$this->load->database('default');
		$this->load->model('reserva_model');
		$TipoHabitaciones = $this->reserva_model->MostrarTipoHabitacion();

		$Departamentos = $this->reserva_model->UbigeoDep();
		$this->load->view("Reserva/nuevo.php",compact("TipoHabitaciones","Departamentos"));
	}

	public function VerReserva(){
		$this->load->database('default');
		$this->load->model('reserva_model');

		$Estadia = $this->reserva_model->VistaEstadia($_POST['id']);
		$DetalleEstadia = $this->reserva_model->VistaDetalleEstadia($_POST['id']);

		$Cuotas = $this->reserva_model->Cuotas($_POST['id']);

		$this->load->view("Reserva/verreserva.php",compact('Estadia','DetalleEstadia','Cuotas'));
	}

	public function TraeHabitacion(){
		$this->load->database('default');

		$query = $this->db->query(
			"select *from habitacion where estado=1 and codtipohabitacion=".$_POST['tipohabitaciones']." and codhabitacion not in(SELECT de.codhabitacion FROM  estadia e
			INNER JOIN detalleestadia de ON de.codestadia = e.codestadia
			WHERE fechareserva = '".$_POST['fechaingreso']."')"
        );
        $data = $query->result_array();
        echo json_encode($data);
	}	

	public function GuardarReserva(){
		$this->load->database('default');

        $this->load->model('Reserva_model');
        $this->Reserva_model->grabareserva();

        echo "Reserva Realizada Correctamente";
	}


	public function GuardarReservaMobil(){
		$this->load->database('default');

        $this->load->model('Reserva_model');
        $this->Reserva_model->grabareservamobil();
	}

	public function TraeHabitacion1(){
		$this->load->database('default');

		$query = $this->db->query(
			"select *from habitacion where estado=1 and codtipohabitacion=".$_POST['tipohabitaciones']." and codhabitacion not in(SELECT de.codhabitacion FROM  estadia e
			INNER JOIN detalleestadia de ON de.codestadia = e.codestadia
			WHERE fechareserva = '".$_POST['fechaingreso']."')"
        );
        $data = $query->result_array();
        echo json_encode($data);
	}	
}
