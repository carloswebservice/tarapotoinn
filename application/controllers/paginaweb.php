<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class paginaweb extends CI_Controller {


	public function mobil(){
		$this->load->view("Paginaweb/mobil/index.php");
	}
	public function mobilnosotros(){
		$this->load->database('default');
		$this->load->model('pagina_model');
		$Informacion = $this->pagina_model->MostrarInformacion();
		$this->load->view("Paginaweb/mobil/nosotros.php",compact("Informacion"));
	}
	public function mobilsimple(){
		$this->load->database('default');
		$this->load->model('pagina_model');
		$Informacion = $this->pagina_model->InformacionHabitaciones();
		$this->load->view("Paginaweb/mobil/habsimple.php",compact("Informacion"));
	}
	public function mobildoble(){
		$this->load->database('default');
		$this->load->model('pagina_model');
		$Informacion = $this->pagina_model->InformacionHabitaciones();
		$this->load->view("Paginaweb/mobil/habdoble.php",compact("Informacion"));
	}
	public function mobiltriple(){
		$this->load->database('default');
		$this->load->model('pagina_model');
		$Informacion = $this->pagina_model->InformacionHabitaciones();
		$this->load->view("Paginaweb/mobil/habtriple.php",compact("Informacion"));
	}
	public function mobilcuadruple(){
		$this->load->database('default');
		$this->load->model('pagina_model');
		$Informacion = $this->pagina_model->InformacionHabitaciones();
		$this->load->view("Paginaweb/mobil/habcuadruple.php",compact("Informacion"));
	}
	public function mobilmatrimonial(){
		$this->load->database('default');
		$this->load->model('pagina_model');
		$Informacion = $this->pagina_model->InformacionHabitaciones();
		$this->load->view("Paginaweb/mobil/habmatrimonial.php",compact("Informacion"));
	}
	public function mobilsuit(){
		$this->load->database('default');
		$this->load->model('pagina_model');
		$Informacion = $this->pagina_model->InformacionHabitaciones();
		$this->load->view("Paginaweb/mobil/habsuit.php",compact("Informacion"));
	}
	public function mobilhabitaciones(){
		$this->load->database('default');
		$this->load->model('pagina_model');
		$Informacion = $this->pagina_model->InformacionHabitaciones();
		$this->load->view("Paginaweb/mobil/habitaciones.php",compact("Informacion"));
	}
	public function mobilreservas(){
		$this->load->view("Paginaweb/mobil/reservas.php");
	}
	public function mobilservicios(){
		$this->load->view("Paginaweb/mobil/servicios.php");
	}
	public function mobilubicacion(){
		$this->load->view("Paginaweb/mobil/ubicacion.php");
	}
	public function mobilcontacto(){
		$this->load->view("Paginaweb/mobil/contacto.php");
	}
	public function mobiltours(){
		$this->load->view("Paginaweb/mobil/tours.php");
	}
	public function mobilvideos(){
		$this->load->view("Paginaweb/mobil/videos.php");
	}
	public function habitacionsimple(){
		$this->load->view("Paginaweb/mobil/habsimple.php");
	}
	public function habitaciondoble(){
		$this->load->view("Paginaweb/mobil/habdoble.php");
	}
	public function habitaciontriple(){
		$this->load->view("Paginaweb/mobil/habtriple.php");
	}
	public function habitacioncuadruple(){
		$this->load->view("Paginaweb/mobil/habcuadruple.php");
	}
	public function habitacionmatrimonial(){
		$this->load->view("Paginaweb/mobil/habmatrimonial.php");
	}
	public function habitacionsuit(){
		$this->load->view("Paginaweb/mobil/habsuit.php");
	}
	public function index(){
		$this->load->database('default');
		$this->load->model('pagina_model');

		$Informacion = $this->pagina_model->InformacionHabitaciones();

		$ci;
		$this->ci =& get_instance();
		
        !$this->ci->load->helper('url') ? $this->ci->load->helper('url') : false;
		
		!$this->ci->load->library('user_agent') ? $this->ci->load->library('user_agent') : false;

		if ($this->ci->agent->is_mobile()){
			
			//mostramos el nombre del dispositivo que nos visita
			//y cargamos la vista correspondiente
			//echo $this->ci->agent->mobile();
			$this->ci->load->view('Paginaweb/mobil/index.php');
			
		}else{
			
			//cargamos la vista home
			//echo 'el dispositivo es de otro tipo';
			//$this->ci->load->view('Paginaweb/Hotel.php')
			$this->load->view("Paginaweb/Hotel.php",compact("Informacion"));
			
		}

		
	}

	public function nosotros(){
		$this->load->database('default');
		$this->load->model('pagina_model');

		$Informacion = $this->pagina_model->MostrarInformacion();

		$this->load->view("Paginaweb/Nosotros.php",compact("Informacion"));
	}

	public function habitaciones(){
		$this->load->database('default');
		$this->load->model('pagina_model');

		$Informacion = $this->pagina_model->InformacionHabitaciones();

		$this->load->view("Paginaweb/Habitaciones.php",compact("Informacion"));
	}

	public function tours(){
		$this->load->view("Paginaweb/Tours.php");
	}
	public function productos(){
		$this->load->view("Paginaweb/Productos.php");
	}

	public function login(){
		$this->load->database('default');
		$this->load->model('pagina_model');

		$usuario= $this->pagina_model->logear($this->input->post("nombre"),$this->input->post("contra"));

		if(count($usuario) == 1){			
			$_SESSION['usuario']=$usuario[0]['usuario'];
			$_SESSION['idempleado']=$usuario[0]['codempleado'];
            $_SESSION['codcargo'] = $usuario[0]['codcargo'];
			redirect(base_url().'SistemaHotelero','refresh');
		}else{
			redirect(base_url(),'refresh');
		}
	}

	public function cerrarsession(){
		session_destroy();
		redirect(base_url(),'refresh');
	}
}
