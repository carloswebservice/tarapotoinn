<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TipoHabitacion extends CI_Controller {
	
	public function index(){		
		$this->load->database('default');
		$this->load->model('Tipo_habitacion');

		$TipoHabitaciones = $this->Tipo_habitacion->MostrarTipoHabitaciones();
		$this->load->view("TipoHabitacion/index.php",compact("TipoHabitaciones"));
	}
	
	public function Nuevo(){
		$this->load->database('default');
		$this->load->model('Tipo_habitacion');

		$NuevoTipoHab= $this->Tipo_habitacion->Nuevo();
		echo json_encode($NuevoTipoHab);
	}

	public function Modificando(){
		$this->load->database('default');
		$this->load->model('Tipo_habitacion');

		$TipoHab= $this->Tipo_habitacion->MostrarTipoHabitacion($this->input->post("modificar"));
		echo json_encode($TipoHab);
	}

	public function Guardar(){
		echo "<pre>";
		$file=$_FILES['imagen']['name'];
		move_uploaded_file($_FILES["imagen"]["tmp_name"],'./imageneshotel/'.$file);

		$this->load->database('default');

		$config['upload_path'] = './imageneshotel/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
			
		$this->load->library('upload', $config);	
		$this->upload->do_upload("imagen");
		$icono = $this->upload->data();

		$arraydata = array(
            "codtipohabitacion"=>$_POST["codtipohabitacion"],
            "descripcion" => $_POST["descripcion"],
            "imagen" => $file,
        );                    
        $this->db->insert("tipohabitacion",$arraydata);
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Tipo Habitacion Insertado Correctamente </b> </center>";
	}

	public function Modificar(){
		$this->load->database('default');
		$this->load->model('Tipo_habitacion');

		$NuevoTipoHab= $this->Tipo_habitacion->Modificar($this->input->post("codtipohabitacion"),$this->input->post("descripcion"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Tipo Habitacion Modificado Correctamente </b> </center>";
	}

	public function Eliminar(){
		$this->load->database('default');
		$this->load->model('Tipo_habitacion');

		$NuevoTipoHab= $this->Tipo_habitacion->Eliminar($this->input->post("eliminar"));
		echo "<center> <span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Tipo Habitacion Eliminado Correctamente </b> </center>";
	}
}