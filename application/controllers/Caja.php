<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Caja extends CI_Controller {
	
	public function index(){
		$this->load->database('default');
		$this->load->model('Caja_model');
        
        $this->db->select('*');
        $this->db->from('caja');
        $this->db->join('empleado', 'empleado.codempleado = caja.codempleado');
        $this->db->order_by("caja.codcaja", "DESC"); 
        $query = $this->db->get();
		$data = $query->result_array();

        if(!empty($data)){               
            if($data[0]['estadocaja']==1){
                $lbl_boton = 'Cerrar Caja';
                $action = 'cerrar';
            }else{
                if(new DateTime((substr($data[0]['fecha_hora_apertura'],0,10)),new DateTimeZone('America/Lima'))==new DateTime(date("d-m-Y"),new DateTimeZone('America/Lima'))){
                    $lbl_boton = 'Reaperturar Caja';
                    $action = 'reaperturar';
                }else{
                    $lbl_boton = 'Aperturar Caja';
                    $action = 'aperturar';
                }
            }
        }
        //print_r($data); //exit();              
		$this->load->view("Caja/index.php",compact("data","lbl_boton","action"));
	}
        
    public function aperturar(){
        $this->load->database('default');
        $this->db->select_max('codcaja');
        $this->db->from('caja');
        $this->db->where('codempleado',$_SESSION['idempleado']);
        $query = $this->db->get();
        $datacaja = $query->row_array();
        $maxcaja = $datacaja["codcaja"];

        $this->db->select('*');
        $this->db->where('codcaja',$maxcaja);
        $this->db->from('caja');
        $query = $this->db->get();
        $saldos = $query->row_array();
        $maximosaldo = $saldos["saldo_cierre"];

        $data = array(
            "codempleado" => $_SESSION['idempleado'], //cambiar por la variable de sesion del empleado logueado
            "estadocaja" => 1, // abrimos la caja estado 1 /cerrar caja estado 0
            "fecha_hora_apertura" => date("Y-m-d H:i:s"),
            "saldo_apertura" => $maximosaldo,
            "saldo_cierre" => $maximosaldo,
            "fecha_hora_cierrre" => date("Y-m-d H:i:s")
        );
            
        $this->db->insert("caja",$data);
        echo "Caja Aperturada";
    }
        
    public function reaperturar(){
        $this->load->database('default');
        //seleccionamos la ultima caja
        $this->db->select_max('caja.codcaja');
        $this->db->from('caja');
        $this->db->join('empleado', 'empleado.codempleado = caja.codempleado');
        $query = $this->db->get();
        $datacaja = $query->row_array();
        $codigo = $datacaja["codcaja"];

     //   print $codigo;

        $this->db->select('*');
        $this->db->where('codcaja',$codigo);
        $this->db->from('caja');
        $query = $this->db->get();
        $saldos = $query->row_array();
        $saldoaper = $saldos["saldo_cierre"];

        $datab=array(
            "estadocaja" => 0,
            "fecha_hora_cierrre" => date("Y-m-d H:i:s")
        );
                    
        $where = array("codcaja" => $codigo);
        $this->db->update("caja",$datab,$where);
            
            
        $data2 = array(
            "codempleado" => $_SESSION['idempleado'], //cambiar por la variable de sesion del empleado logueado
            "estadocaja" => 1, // abrimos la caja estado1 /cerrar caja estado 0
            "fecha_hora_apertura" => date("Y-m-d H:i:s"),
            "saldo_apertura" => $saldos["saldo_cierre"],
            "saldo_cierre" => $saldos["saldo_cierre"],
            "fecha_hora_cierrre" => date("Y-m-d H:i:s")
        );          
        $this->db->insert("caja",$data2);

        echo "<center><span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Caja Reaperturada Correctamente
        </b></center>";         
    }

	public function Cerrar(){
		$this->load->database('default');
        //seleccionamos la ultima caja
        $this->db->select_max('caja.codcaja');
        $this->db->from('caja');
        $this->db->join('empleado', 'empleado.codempleado = caja.codempleado');
        $this->db->where('empleado.codempleado',$_SESSION['idempleado']);
        $query = $this->db->get();
        $datacaja = $query->row_array();

        $this->db->select('*');
        $this->db->from('caja');
        $this->db->join('empleado', 'empleado.codempleado = caja.codempleado');
        $query = $this->db->get();
		$data = $query->row_array();
                
        // verificamos si la sesion del empleado es dfe la quien cerro la caja
        if($data["codempleado"] == $_SESSION['idempleado']){ // reemplazar el 1 por la variab le de sesion
            $cajaid = $datacaja["codcaja"];
            
            $data=array(
                "estadocaja" => 0, // abrimos la caja estado 1 /cerrar caja estado 0
                    //"saldo_apertura" => 500,
                    //"saldo_cierre" => 500,
                "fecha_hora_cierrre" => date("Y-m-d H:i:s")
            );
            $where = array("codcaja" => $cajaid);
            $this->db->update("caja",$data,$where);
            echo "Caja Cerrada Correctamente".$cajaid;
        }else{
            echo "Usted No es es el Empleado que aperturo Caja";
        }
                
		//$this->load->model('Caja_model');
		//$Caja= $this->Caja_model->Cerrar($this->input->post("codcaja"));
		//echo "<center><span class='glyphicon glyphicon-warning-sign' aria-hidden='true'></span> <b> Caja Cerrada </b></center>";
	}
}