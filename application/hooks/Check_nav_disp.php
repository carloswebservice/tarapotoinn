<?php if (!defined( 'BASEPATH')) exit('No direct script access allowed');
 
class Check_nav_disp
{
	
    private $ci;
	
    public function __construct()
    {
        $this->ci =& get_instance();
		
        !$this->ci->load->helper('url') ? $this->ci->load->helper('url') : false;
		
		!$this->ci->load->library('user_agent') ? $this->ci->load->library('user_agent') : false;
 
	}	
	//podemos detectar si es un dispositivo móvil
	public function dispositivos()
	{
		
		if ($this->ci->agent->is_mobile()){
			
			//mostramos el nombre del dispositivo que nos visita
			//y cargamos la vista correspondiente
			//echo $this->ci->agent->mobile();
			//$this->ci->load->view('Paginaweb/mobil/index.php');
			
		}else{
			
			//cargamos la vista home
			//echo 'el dispositivo es de otro tipo';
			//$this->ci->load->view('Paginaweb/Hotel.php')
			
		}
	}
}
/*
/end hooks/Check_nav_disp.php
*/