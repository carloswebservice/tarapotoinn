<?php 
header('Access-Control-Allow-Origin: *');
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class android extends CI_Controller {
	
	public function TraeHabitacion(){
		$this->load->database('default');
		$ruta=base_url().'imageneshotel/';
		$query = $this->db->query(
			"select h.codhabitacion,h.nrohabitacion,th.descripcion as text,h.precio,h.estado,('".$ruta."'||th.imagen) as picture
			from habitacion as h inner join tipohabitacion th on(h.codtipohabitacion=th.codtipohabitacion)
			order by h.nrohabitacion"
        );
        $data = $query->result_array();
		echo json_encode($data);
	}

	public function DetalleHabitacion($habitacion){
		$this->load->database('default');
		$query = $this->db->query(
			"select a.descripcionart from habitacion as h inner join articuloporhabitacion as ah on(h.codhabitacion=ah.codhabitacion)
			inner join articulo as a on(a.codarticulo=ah.codarticulo)
			where h.codhabitacion=".$habitacion 
		);
        $data = $query->result_array();
		echo json_encode($data);
	}

	public function ReservaAndroid(){
		$data = (array)json_decode($_GET['data']);
		$dni=$data['dni'];
		$nom=$data['nombres'];
		$pat=$data['paterno'];
		$mat=$data['materno'];
		$fechar=$data['reserva'];
		$fechas=$data['salida'];
		$idhabi=$data['id'];

		$this->load->database('default');
		$query = $this->db->query("
			select *from estadia as e
			INNER JOIN detalleestadia de ON de.codestadia = e.codestadia
			WHERE e.fechareserva = '".$fechar."' and de.codhabitacion=".$idhabi
		);
		$data = $query->result_array();
		if (count($data)==0) {
			$this->db->select('*');
		    $this->db->where('dnicliente',$dni);
		    $existe= $this->db->get('cliente')->result_array();
		    if (count($existe)==0) {
		    	$this->db->select_max('codcliente');
			    $result= $this->db->get('cliente')->result_array();
			    $idcliente= $result[0]['codcliente']+1;

			    $datacliente = array(
			        'codcliente' => $idcliente,
			        'codubigeo' => 1, //predefinido
			        'nombre' => $nom,
			        'appaterno' => $pat,
			        'apmaterno' => $mat,
			        'dnicliente' => $dni,
			        'estado' => 1
			    );
			    $cliente=$this->db->insert("cliente",$datacliente);
		    	
		    }else{
		    	$idcliente=$existe[0]['codcliente'];
		    }

	        $data = array(
	            'codcliente' => $idcliente,
	            'codempleado' => 1,
	            'fechaingreso' => $fechar,
	            'fechasalida' => $fechas,
	            'fechareserva' => $fechar,
	            'estado' => 1
	        );
	        $this->db->insert("estadia",$data);
	        $idestadia = $this->db->insert_id();
	            
	        $datadetalleestadia = array(
	                'codcliente' => $idcliente,
	                'codhabitacion' => $idhabi,
	                'codestadia' => $idestadia,
	                'estado' => 1
	        );
	        $this->db->insert("detalleestadia",$datadetalleestadia);

	        $query = $this->db->query(
				"select *from cliente where codcliente=".$idcliente
			);
	        $clien = $query->result_array();
			$response['cliente'] = $clien;
			$response['status'] = 'success';
			$response['message'] = 'La Reserva Se Realizo Correctamente';
			
			echo json_encode($response);
		}else{
			$response['status'] = 'error';
			$response['message'] = 'No Se Puede Reservar Esta Habitacion';
			echo json_encode($response);
		}
    }


    public function getReservas($idcliente){
		$this->load->database('default');
		$ruta=base_url().'imageneshotel/';
		$query = $this->db->query(
			"select c.codcliente,c.dnicliente,e.codestadia,e.fechaingreso,e.fechasalida,e.total,h.codhabitacion,th.descripcion,('".$ruta."'||th.imagen) as picture 
			from estadia as e inner join cliente as c on(e.codcliente=c.codcliente)
				inner join detalleestadia as de on(e.codestadia=de.codestadia)
				inner join habitacion as h on (h.codhabitacion=de.codhabitacion) inner join tipohabitacion as th on(h.codtipohabitacion=th.codtipohabitacion)
			where c.codcliente=".$idcliente." 
			group by c.codcliente,e.codestadia,h.codhabitacion,th.imagen,th.descripcion"
        );
		$informacion['reservas']=$query->result_array();
		foreach ($informacion['reservas'] as $key => $value) {
			$query = $this->db->query("select c.cantidad,c.precio,c.igv,p.descripcion 
				from consumos as c join producto as p on(c.codproducto=p.codproducto)
				where c.codestadia=".$value['codestadia']
			);
			$informacion['reservas'][$key]['consumos']=$query->result_array();
		}   
		echo json_encode($informacion);
	}
}