<?php
	class Venta_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarVentas(){
			$this->db->select('*');
			$this->db->from('ventas');
			$this->db->join('cliente', 'cliente.codcliente = ventas.codcliente');

			$query = $this->db->get();
			return $query->result();
		}


		function VistaVentas($cod){
			$this->db->select('*');
			$this->db->where('ventas.codventas',$cod);
			$this->db->from('ventas');
			$this->db->join('cliente', 'cliente.codcliente = ventas.codcliente');

			$query = $this->db->get();
			return $query->result();
		}

		function VistaDetalleVentas($codventa){
            $this->db->select('*');
			$this->db->from('detalleventas');
			$this->db->join('producto', 'producto.codproducto = detalleventas.codproducto');
            $this->db->join('ventas', 'ventas.codventas = detalleventas.codventas');
            $this->db->where(array("detalleventas.codventas"=>$codventa));

			$query = $this->db->get();
			return $query->result();
        }

        function Cuotas($codventa){
            $this->db->select('*');
			$this->db->from('cuotasventas');
            $this->db->join('ventas', 'ventas.codventas = cuotasventas.codventas');
            $this->db->where(array("ventas.codventas"=>$codventa));

			$query = $this->db->get();
			return $query->result();
        }

		function UbigeoDep(){
			$query = $this->db->query("select distinct departamento,ubidepartamento from ubigeo");
			return $query->result();
		}

		function UbigeoPro($dep){
			$query = $this->db->query("select distinct provincia,ubiprovincia from ubigeo where ubidepartamento='".$dep."'");
			return $query->result();
		}

		function UbigeoDis($dep,$pro){
			$query = $this->db->query("select distrito,ubidistrito from ubigeo where ubiprovincia='".$pro."' and ubidepartamento='".$dep."'");
			return $query->result();
		}

		//Para Grabar Cliente
		function TraerClientes(){
			$query = $this->db->query("select *from cliente where estado=1");
			return $query->result();
		}

		function GrabaNuevoCliente(){
			//Obteniendo nuevo cod cliente
			$this->db->select_max('codcliente');
		    $result= $this->db->get('cliente')->result_array();
		    $idcliente= $result[0]['codcliente']+1;

		    //Obteniendo el ubigeo
		    $this->db->where('ubidepartamento',$_POST['departamento']);
		    $this->db->where('ubiprovincia',$_POST['provincia']);
		    $this->db->where('ubidistrito',$_POST['distrito']);
		    $result= $this->db->get('ubigeo')->result_array();
		    $idubigeo= $result[0]['codubigeo'];

			if ($_POST["tipocliente"]=="persona") {
				$data = array(
	                'codcliente' => $idcliente,
	                'dnicliente' => $_POST["dnicli"],
	                'codubigeo' => $idubigeo,
	                'nombre' => $_POST["nom"],
	                'appaterno' => $_POST["apep"],
	                'apmaterno' => $_POST["apem"],
	                'direccion' => $_POST["dire"],
	                'email' => $_POST["correoelec"],
	                'estado' => 1
	            );          
			}else{
				$data = array(
	                'codcliente' => $idcliente,
	                'codubigeo' => $idubigeo,               
	                'ruc' => $_POST["ruc"],
	                'razonsocial' => $_POST["razons"],      
	                'direccion' => $_POST["dire"],
	                'email' => $_POST["correoelec"],
	                'estado' => 1
	            ); 
			}
			$this->db->insert("cliente",$data);
		}

		function TipoComprobantes(){
			$query = $this->db->get('tipocomprobante');
			return $query->result();
		}
		
		function FormaPagos(){
			$query = $this->db->get('formapagos');
			return $query->result();
		}

		function Productos(){
			$query = $this->db->get('producto');
			return $query->result();
		}

		function VerVenta($cod){
			$this->db->where('codventas',$cod);
			$this->db->from('ventas');
			return $this->db->count_all_results();
		}

		function MostrarDetalleVenta($codventa){
			$query = $this->db->get_where('vistadetalleventas', array('codventas' => $codventa));
			return $query->result();
		}

		function InsertandoVenta($_P){
			//Insertando Ventas 
			$data = array(
               'codventas' => $_REQUEST['codventa'],'codcliente' => $_REQUEST['codcliente'],'codempleado' => $_REQUEST['codempleado'],
               'fechaventa' => date('d-m-Y'),'igv' => $_REQUEST['igv'],'importe' => $_REQUEST['total'],'estadoventa' =>1
            );
			$this->db->insert('ventas', $data); 

			//Insertando Detalle Ventas
			foreach ($_REQUEST['idproductodetalle'] as $key => $value) {
				$data = array(
	               'codventas' => $_REQUEST['codventa'],'codproducto' => $_REQUEST['idproductodetalle'][$key],
	               'cantidad' => $_REQUEST['cantidaddetalle'][$key],'precio' => $_REQUEST['preciodetalle'][$key]
	            );
				$this->db->insert('detalleventas', $data);

				$query = $this->db->get_where('producto', array('codproducto' => $_REQUEST['idproductodetalle'][$key]))->result_array();
		    	$actual= $query[0]['stockactual'];
				$data1 = array(
	               'stockactual' => $actual-$_REQUEST['cantidaddetalle'][$key]
	            );
				$this->db->where('codproducto', $_REQUEST['idproductodetalle'][$key]);
				$this->db->update('producto', $data1); 
			}		
		}


		function grabaventa(){
            $data = array(
                'codventas' => $_POST['codventa'],
                'codcliente' => $_POST['codcliente'],
                'codempleado' => $_POST['codempleado'],
                'fechaventa' => date('d-m-Y'),
                'igv' => $_POST['igv'],
                'importe' => $_POST['total'],
                'tipodepago' =>$_POST["formapago"],
                'estadoventa' =>1
            );
            $this->db->insert("ventas",$data);

            //Insertando Detalle Ventas
			foreach ($_POST['idproductodetalle'] as $key => $value) {
				$data = array(
	               'codventas' => $_POST['codventa'],
	               'codproducto' => $_POST['idproductodetalle'][$key],
	               'cantidad' => $_POST['cantidaddetalle'][$key],
	               'precio' => $_POST['preciodetalle'][$key],
	               'igv' => $_POST['igvdetalle'][$key]
	            );
				$this->db->insert('detalleventas', $data);

				$query = $this->db->get_where('producto', array('codproducto' => $_REQUEST['idproductodetalle'][$key]))->result_array();
		    	$actual= $query[0]['stockactual'];
				$data1 = array(
	               'stockactual' => $actual-$_POST['cantidaddetalle'][$key]
	            );
				$this->db->where('codproducto', $_POST['idproductodetalle'][$key]);
				$this->db->update('producto', $data1);
			}

			//Para las Cuotas
			if($_POST["formapago"] == "1"){
                $arraydata = array(
                    "codventas" => $_POST['codventa'],
                    "nrocuota" =>  1,
                    "monto" => $_POST["total"],
                    "fechavencimiento" => date("Y-m-d"),
                    "monto_cobrado" => 0,
                    "estado" => 1
                );
                $this->db->insert("cuotasventas",$arraydata);
            }else{
            	foreach($_POST["idcuota"] as $key => $value){
                    $arraydata = array(
                        "codventas" => $_POST['codventa'],
                        "nrocuota" =>  $_POST['idcuota'][$key],
                        "monto" => $_POST['montocuota'][$key],
                        "fecha" => $_POST['fechavence'][$key],
                        "monto_cobrado" => 0,
                        "estado" => 1
                    );
                    $this->db->insert("cuotasventas",$arraydata);
                }
            }
        }

		function Vercantidad($codpro){
		    $query = $this->db->get_where('producto', array('codproducto' => $codpro));
			return $query->result();
		}


		function InsertarVenta($cod,$codcliente){
			$data = array(
               'codventas' => $cod,'codcliente' => $codcliente,'codempleado' => 2,'fechaventa' => date('Y-m-d'),
               'estadoventa' => 1
            );
			$this->db->insert('ventas', $data);
		}

		function InsertarDetalle($venta,$producto,$cantidad,$precio){
			$data = array(
               'codventas' => $venta,'codproducto' => $producto,'cantidad' => $cantidad,'precio' => $precio,
               'igv' => ($cantidad*$precio*0.18)
            );
			$this->db->insert('detalleventas', $data);
		}

		function MostrarDisponibles(){
			$query = $this->db->get_where('articulo', array('estado' => 1));
			return $query->result();
		}

		function EliminarArticulo($hab,$art){
			$this->db->where('codhabitacion', $hab);
			$this->db->where('codarticulo', $art);
			$this->db->delete('articuloporhabitacion');
		}

		function NuevaH(){
			$this->db->select_max('codventas');
			$query = $this->db->get('ventas');
			return $query->result();
		}
	}
?>