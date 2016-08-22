<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Movimiento extends CI_Controller {

    public function index(){
        $this->load->database('default');

        $query = $this->db->query("select distinct(p.*)  
        from proveedor as p inner join compra as c on(c.codproveedor=p.codproveedor) 
                inner join cronogramapagos as cp on (c.codcompra=cp.codcompra) 
        where cp.estado=1");
        $Proveedores = $query->result();

        $query = $this->db->query("select distinct (lc.*)from listacliente as lc");
        $Clientes = $query->result();

        $this->load->view("Movimientos/index.php",compact("Clientes","Proveedores"));
    }

	public function VerMovimiento(){
        $this->load->database('default');
        $query = $this->db->query("
            select m.*,c.descripcion as concepto, tc.descripcion as tipocomprobante,cli.nombre as nomc,cli.appaterno as app,cli.razonsocial as rz from movimientos as m inner join conceptos as c on(c.codconcepto=m.codconcepto)
            inner join tipocomprobante as tc on(m.codtipocomprobante=tc.codtipocomprobante) 
            inner join cliente as cli on (m.codcliente=cli.codcliente)
            where m.estado='A'
        ");
        $Movimientos = $query->result();
		$this->load->view("Movimientos/vermovimiento.php",compact("Movimientos"));
	}

    public function LoginAdmin(){
        $this->load->database('default');
        $user = $this->input->post("usuario");
        $cla=$this->input->post("clave");
        $query = $this->db->query("select *from empleado where codcargo=1 and usuario='".$user."' and clave='".$cla."'");
        $data = $query->result_array();
        if (count($data)==0) {
            echo "Incorrecto";
        }else{
            echo "Correcto";
        }
    }

    public function Extornar(){
        $this->load->database('default');
        $movimiento = $this->input->post("movimiento");
        $query = $this->db->query("
            select m.*,c.descripcion as concepto, tm.codtipomovimiento as tipomovimiento from movimientos as m inner join conceptos as c on(c.codconcepto=m.codconcepto)
            inner join tipomovimiento as tm on(c.codtipomovimiento=tm.codtipomovimiento) where m.codmovimientos=".$movimiento
        );
        $movi = $query->row_array();
        $montoextorno=$movi["monto"];
        $tipomovim=$movi["tipomovimiento"];


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

        if($caja["codempleado"] == 1){
            if($b[0]==date("Y-m-d")){
                $arraydata = array(
                    "estado" => "E"
                );
                $this->db->where('codmovimientos', $movimiento);
                $this->db->update("movimientos",$arraydata);
                // agregamos el dinero de la caja
                if ($tipomovim==1) {
                    $money = (double)$caja["saldo_cierre"] - (double)$montoextorno;
                    $this->db->update("caja",array("saldo_cierre"=>$money),array("codcaja"=>$caja["codcaja"]));
                }else{
                    $money = (double)$caja["saldo_cierre"] + (double)$montoextorno;
                    $this->db->update("caja",array("saldo_cierre"=>$money),array("codcaja"=>$caja["codcaja"]));
                }
                echo "Extorno Realizado Correctamente";
            }else{
                echo "Se debe aperturar la caja con la fecha de hoy";
            }
        }else{
            echo "Usted no es el usuario que aperturo la caja";
        }
    }

    public function cargaconceptos(){
        $this->load->database('default');
        $id = $_POST["id"];
        $query = $this->db->get_where("conceptos",array("codtipomovimiento"=>$id));

        $html ="<option value='selec'>--Seleccione--</option>";
        foreach ($query->result_array() as $key => $value) {
            $html = $html."<option value='".$value["codconcepto"]."'>".$value["descripcion"]."</option>";
        }
        print $html;
    }

	public function VerRecord(){
		$this->load->database('default');
            /*$cli = $this->db->get_where("cliente",array("dnicliente"=>$this->input->post("cliente")));
            $cli = $cli->row_array();
            $idcliente = $cli["codcliente"]; */
        $idcliente = $this->input->post("cliente");
        $query = $this->db->query("
            select 'estadia' as concepto,c.nombre,c.appaterno,c.direccion,e.codestadia,e.fechaingreso,e.total,SUM(ce.monto_cobrado) as montocobrado
            from estadia as e inner join cuotaestadia as ce on(e.codestadia=ce.codestadia)
            inner join cliente as c on(c.codcliente=e.codcliente)
            where e.codcliente=".$idcliente."
            group by e.codestadia,ce.codestadia,c.codcliente,c.nombre,c.appaterno,c.direccion,e.fechaingreso,e.total
            having e.total>SUM(ce.monto_cobrado)

            union all

            select 'venta' as concepto,c.nombre,c.appaterno,c.direccion,v.codventas,v.fechaventa,v.importe,SUM(cv.monto_cobrado) as montocobrado
            from ventas as v inner join cuotasventas as cv on(v.codventas=cv.codventas)
            inner join cliente as c on(c.codcliente=v.codcliente)
            where v.codcliente=".$idcliente."
            group by v.codventas,cv.codventas,c.codcliente,c.nombre,c.appaterno,c.direccion,v.fechaventa,v.importe
            having v.importe>SUM(cv.monto_cobrado)
        ");
        $data = $query->result_array();
		echo json_encode($data);
	}

    public function VerRecordC(){
        $this->load->database('default');
        $cli = $this->db->get_where("proveedor",array("codproveedor"=>$this->input->post("cliente")));
        $cli = $cli->row_array();
        $idcliente = $cli["codproveedor"];
        $query = $this->db->query("
            select 'compra' as concepto,p.ruc,p.razonsocial,p.direccion,com.codcompra,com.fechacompra,com.importe,SUM(cp.monto_pagado) as montopagado
            from compra as com inner join cronogramapagos as cp on(com.codcompra=cp.codcompra)
            inner join proveedor as p on(p.codproveedor=com.codproveedor)
            where p.codproveedor= ".$idcliente."
            group by p.ruc,p.razonsocial,p.direccion,com.codcompra,com.fechacompra,com.importe
            having com.importe>SUM(cp.monto_pagado)
        ");
        $data = $query->result_array();
        echo json_encode($data);
    }

    public function vercuota(){
        $this->load->database('default');
        $ide = $_POST["ide"];
        $conc  = $_POST["conc"];
        if($conc == "1" ){
            $ji = $this->db->get_where("cuotaestadia",array("codestadia"=> $ide));
        }else{
            $ji = $this->db->get_where("cuotasventas",array("codventas"=> $ide));
        }
        print json_encode($ji->result_array());
    }

    public function getTIPODOC(){
        $this->load->database('default');
        $id = $_POST["pk"];

        $res = $this->db->get_where('tipocomprobante',array("codtipocomprobante"=> $id));
        print json_encode($res->result_array()[0]);
    }
}
