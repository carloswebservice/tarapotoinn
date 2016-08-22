<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Cronogcobro extends CI_Controller {

	public function index(){
		$this->load->database('default');

        $query = $this->db->query("
            SELECT est.codestadia,cli.nombre,cli.appaterno,cli.apmaterno ,est.fechaingreso,est.total,
            (SELECT SUM(cuotaestadia.monto_cobrado) FROM cuotaestadia WHERE cuotaestadia.codestadia = est.codestadia ) as monto_cobrado
            FROM estadia est
            INNER JOIN cliente cli ON cli.codcliente = est.codcliente
            WHERE est.estado = 1 AND est.tipodepago = 2 ORDER BY est.codestadia DESC"
        );

        $data = $query->result_array();
		$this->load->view("Cronogcobro/index.php",compact("data"));
	}

    public function vercuota(){
        $this->load->database('default');
        $ide = $_POST["ide"];

        $conc  = $_POST["conc"];

        if($conc == "1" ){
            $this->db->where('codestadia',$ide);
            $this->db->from('cuotaestadia');
            $this->db->order_by("nrocuota", "asc"); 
            $ji = $this->db->get();
        }else{
            $this->db->where('codventas',$ide);
            $this->db->from('cuotasventas');
            $this->db->order_by("nrocuota", "asc"); 
            $ji = $this->db->get();
        }
        print json_encode($ji->result_array());
    }

    public function vercuotaC(){
        $this->load->database('default');
        $ide = $_POST["ide"];

        $this->db->where('codcompra',$ide);
        $this->db->from('cronogramapagos');
        $this->db->order_by("nrocuota", "asc"); 
        $ji = $this->db->get();
        print json_encode($ji->result_array());
    }


    public function pagamov(){
            $this->load->database('default');

            $this->db->select_max('codcaja');
            $this->db->from('caja');
            $this->db->where('codempleado',$_SESSION['idempleado']); //Poner la sesion
            $query = $this->db->get();
            $datacaja = $query->row_array();
            $maxcaja = $datacaja["codcaja"];

            $this->db->select('*');
            $this->db->where('codcaja',$maxcaja);
            $this->db->where('estadocaja',1);
            $this->db->from('caja');
            $query = $this->db->get();
            $caja = $query->row_array();

            if (count($caja)==0) {
                echo "Se Debe aperturar la caja";exit();
            }

            $b = explode(" ",$caja["fecha_hora_apertura"]);

            if($caja["codempleado"] == $_SESSION['idempleado']){
                if($b[0]== date("Y-m-d")){
                    // poner las validaciones de caja
                    $arraydata = array(
                        "codcaja"=>$maxcaja,
                        "codformapago" => $_POST["fp"],
                        "codconcepto" => $_POST["con"],
                        "codtipocomprobante" => $_POST["tc"],
                        "monto" => $_POST["montoa"],
                        "nrocomprobante" => $_POST["c"],
                        "codcliente" => $_POST["idcli"],
                        "fechamovimiento" => date('d-m-Y'),
                        "estado" => "A"
                    );                    
                    $this->db->insert("movimientos",$arraydata);

                    if ($_POST["tm"] == "2") {
                        $money = (double)$caja["saldo_cierre"] - (double)$_POST["montoa"];
                        $this->db->update("caja",array("saldo_cierre"=>$money),array("codcaja"=>$caja["codcaja"]));
                    }else{
                        $money = (double)$caja["saldo_cierre"] + (double)$_POST["montoa"];
                        $this->db->update("caja",array("saldo_cierre"=>$money),array("codcaja"=>$caja["codcaja"]));
                    }
                    echo "Se Realizo Correctamente";
                }else{               
                    echo "Se debe aperturar la caja con la fecha de hoy";
            }
        }else{
            echo "Usted no es el usuario que aperturo la caja";
        }
    }

    public function amortiza(){
        $this->load->database('default');

        $id = $_POST["id"];
        $ma = $_POST["montoa"];
        $concep = $_POST["con"];

        $this->db->select_max('codcaja');
        $this->db->from('caja');
        $this->db->where('codempleado',$_SESSION['idempleado']); //Poner la sesion
        $query = $this->db->get();
        $datacaja = $query->row_array();
        $maxcaja = $datacaja["codcaja"];

        $this->db->select('*');
        $this->db->where('codcaja',$maxcaja);
        $this->db->where('estadocaja',1);
        $this->db->from('caja');
        $query = $this->db->get();
        $caja = $query->row_array();

        if (count($caja)==0) {
            echo "Se Debe aperturar la caja";exit();
        }
            //echo  date_format($caja["fecha_hora_apertura"],"Y-m-d");
        $b = explode(" ",$caja["fecha_hora_apertura"]);

        if($caja["codempleado"] == $_SESSION['idempleado']){
            if($b[0]== date("Y-m-d")){
                $arraydata = array(
                    "codcaja"=>$caja["codcaja"],
                    "codformapago" => $_POST["fp"],
                    "codconcepto" => $concep,
                    "codtipocomprobante" => $_POST["tc"],
                    "monto" => $_POST["montoa"],
                    "nrocomprobante" => $_POST["c"],
                    "codcliente" => $_POST["idcli"],
                    "fechamovimiento" => date('d-m-Y'),
                    "estado" => "A"
                );

                $this->db->insert("movimientos",$arraydata);
                $codmovimiento=$this->db->insert_id();
                // agregamos el dinero de la caja
                $money = (double)$caja["saldo_cierre"] + (double)$_POST["montoa"];
                $this->db->update("caja",array("saldo_cierre"=>$money),array("codcaja"=>$caja["codcaja"]));

                $tps = $this->db->get_where("tipocomprobante",array("codtipocomprobante"=>$_POST["tc"]));
                $tps = $tps->row_array();

                $nr = (int)$tps["correlativo"]+1;

                $this->db->update("tipocomprobante" , array("correlativo"=>$nr),array("codtipocomprobante"=>$_POST["tc"]));

                if($concep == "1"){
                    $this->db->where('codestadia',$id);
                    $this->db->from('cuotaestadia');
                    $this->db->order_by("nrocuota", "asc"); 
                    $ji = $this->db->get();

                    $ji = $ji->result();

                    foreach ($ji as $key => $value) {
                        //solo entra los montos que faltarian pagar
                        if($value->monto > $value->monto_cobrado){

                            $monto_restante = $value->monto - $value->monto_cobrado;
                            //print $monto_restante."<br>";
                            //se captura cuanto se debe de la cuota
                            //si el monto amortizar es diferente de 0
                            if ($ma != 0) {
                                //si lo que debe es mayor al monto que se desea amortizar
                                if ($monto_restante >= $ma) {
                                    if ($monto_restante == $ma) {
                                        $arraydetail = array(
                                            "monto_cobrado" => $value->monto, 
                                            "fechapago" => date('d-m-Y'),
                                            "estado" => 0                                      
                                        );
                                    }else{
                                        $arraydetail = array(
                                            "monto_cobrado"=>$value->monto_cobrado+$ma,                                     
                                        );
                                    }
                                    $where = array("codcuotaestadia"=>$value->codcuotaestadia);
                                    $this->db->update("cuotaestadia",$arraydetail,$where);                                    
                                    $ma = 0;
                                }else{
                                    $arraydetail = array(
                                        "monto_cobrado" => $value->monto, 
                                        "fechapago" => date('d-m-Y'),
                                        "estado" => 0                                      
                                    );
                                    $where = array("codcuotaestadia"=>$value->codcuotaestadia);
                                    $this->db->update("cuotaestadia",$arraydetail,$where);
                                    $ma = $ma-$monto_restante;
                                }
                            }
                        }
                    }
                }else{
                    $this->db->where('codventas',$id);
                    $this->db->from('cuotasventas');
                    $this->db->order_by("nrocuota", "asc"); 
                    $ji = $this->db->get();

                    $ji = $ji->result();
                    foreach ($ji as $key => $value) {
                        //solo entra los montos que faltarian pagar
                        if($value->monto > $value->monto_cobrado){
                            $monto_restante = $value->monto - $value->monto_cobrado;
                            //print $monto_restante."<br>";
                            //se captura cuanto se debe de la cuota
                            //si el monto amortizar es diferente de 0
                            if ($ma != 0) {
                                //si lo que debe es mayor al monto que se desea amortizar
                                if ($monto_restante >= $ma) {
                                    if ($monto_restante == $ma) {
                                        $arraydetail = array(
                                            "monto_cobrado" => $value->monto, 
                                            "fechapago" => date('d-m-Y'),
                                            "estado" => 0                                      
                                        );
                                    }else{
                                        $arraydetail = array(
                                            "monto_cobrado"=>$value->monto_cobrado+$ma,                                     
                                        );
                                    }
                                    $where = array("codcuotasventas"=>$value->codcuotasventas);
                                    $this->db->update("cuotasventas",$arraydetail,$where);
                                    $ma = 0;
                                }else{
                                    $arraydetail = array(
                                        "monto_cobrado" => $value->monto,
                                        "fechapago" => date('d-m-Y'),
                                        "estado" => 0
                                    );
                                    $where = array("codcuotasventas"=>$value->codcuotasventas);
                                    $this->db->update("cuotasventas",$arraydetail,$where);

                                    $ma = $ma-$monto_restante;
                                }
                            }
                        }
                    }
                }
                echo "Se realizo correctamente";
            }else{
                echo "Se debe aperturar la caja con la fecha de hoy";
            }
        }else{
            echo "Usted no es el usuario que aperturo la caja";
        }
    }

    public function amortizaC(){
        $this->load->database('default');

        $id = $_POST["id"];
        $ma = $_POST["montoa"];

        $caja = $this->db->get_where("caja",array("estadocaja"=>"1"));
        $caja = $caja->row_array();

        $this->db->select_max('codcaja');
        $this->db->from('caja');
        $this->db->where('codempleado',$_SESSION['idempleado']); //Poner la sesion
        $query = $this->db->get();
        $datacaja = $query->row_array();
        $maxcaja = $datacaja["codcaja"];

        $this->db->select('*');
        $this->db->where('codcaja',$maxcaja);
        $this->db->where('estadocaja',1);
        $this->db->from('caja');
        $query = $this->db->get();
        $caja = $query->row_array();
        
        if (count($caja)==0) {
            echo "Se Debe aperturar la caja";exit();
        }

        $b = explode(" ",$caja["fecha_hora_apertura"]);

        //Falta comprar con la session $_SESSION['idusuario']
        if($caja["codempleado"] ==$_SESSION['idempleado']){
            if($b[0]== date("Y-m-d")){
                if($caja["saldo_cierre"] < $_POST["montoa"]){
                    echo "No se cuenta con el dinero suficiente en caja";
                }else{
                    $arraydata = array(
                        "codcaja"=>$caja["codcaja"],
                        "codformapago" => $_POST["fp"],
                        "codconcepto" => 6 ,
                        "codtipocomprobante" => $_POST["tc"] ,
                        "monto" => $_POST["montoa"],
                        "nrocomprobante" => $_POST["c"],
                        "codcliente" => $_POST["idcli"],
                        "fechamovimiento" => date('d-m-Y'),
                        "estado" => "A"
                    );

                    $this->db->insert("movimientos",$arraydata);
                    // restamos el dinero de la caja
                    $money = (double)$caja["saldo_cierre"] - (double)$_POST["montoa"];
                    $this->db->update("caja",array("saldo_cierre"=>$money),array("codcaja"=>$caja["codcaja"]));

                    $this->db->where('codcompra',$id);
                    $this->db->from('cronogramapagos');
                    $this->db->order_by("nrocuota", "asc"); 
                    $ji = $this->db->get();

                    $ji = $ji->result();
                    foreach ($ji as $key => $value) {
                        //solo entra los montos que faltarian pagar
                        if($value->monto > $value->monto_pagado){
                            $monto_restante = $value->monto - $value->monto_pagado;
                            //print $monto_restante."<br>";
                            //se captura cuanto se debe de la cuota
                            //si el monto amortizar es diferente de 0
                            if ($ma != 0) {
                                //si lo que debe es mayor al monto que se desea amortizar
                                if ($monto_restante >= $ma) {
                                    if ($monto_restante == $ma) {
                                        $arraydetail = array(
                                            "monto_pagado" => $value->monto,
                                            "fechapago" => date('d-m-Y'),
                                            "estado" => 0                                     
                                        );
                                    }else{
                                        $arraydetail = array(
                                            "monto_pagado"=>$value->monto_pagado+$ma                                     
                                        );
                                    }
                                    $where = array("codcronogramapagos"=>$value->codcronogramapagos);
                                    $this->db->update("cronogramapagos",$arraydetail,$where);

                                    $ma = 0;

                                }else{
                                    $arraydetail = array(
                                        "monto_pagado" => $value->monto,
                                        "fechapago" => date('d-m-Y'),
                                        "estado" => 0
                                    );
                                    $where = array("codcronogramapagos"=>$value->codcronogramapagos);
                                    $this->db->update("cronogramapagos",$arraydetail,$where);
                                    $ma = $ma-$monto_restante;
                                }
                            }
                        }
                    }
                    echo "Se Realizo Correctamente";
                }
            }else{
                echo "Se debe aperturar la caja con la fecha de hoy";
            }
        }else{
            echo "Usted no es el usuario que aperturo la caja";
        }
    }
}
