<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index(){

		// si existen variables via POST
		if($this->input->post()){
			//print "<pre>";
			//print_r($_POST);
			//exit();

			//asigno los datos del formulario para grabarlos en el config.ini
			$driver 	= $this->input->post("driver");
			$user 		= $this->input->post("user");
			$password 	= $this->input->post("password");
			$host 		= $this->input->post("host");
			$dbname 	= $this->input->post("basedatos");

			//almaceno los datos en un array con su valor
			$configuracion = 
			array(
				"driver" => $driver, 
				"usuario" => $user, 
				"password" => $password, 
				"host" => $host, 
                "basedatos" => $dbname);

			//abrimos el archivo config.ini
            $fp = fopen("./application/config/config.ini", "w");
            
            fwrite($fp, "[database]");
            $fp = fopen("./application/config/config.ini", "a+");

            //grabamos los valores
            foreach ($configuracion as $key => $valor) {
                fwrite($fp, "\n" . $key . " = " . $valor);
            }

            //cerramos el archivo  config.ini
            fclose($fp);
		}else{
			$ini_array2 = parse_ini_file("./application/config/config.ini");
	        $host = $ini_array2["host"];
	        
	        if($host == ""){
	            $this->load->view('index/index.php');
	        }else{
	            redirect(base_url().'SistemaHotel/', 'refresh');
	        }
    	}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */