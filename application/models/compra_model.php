<?php
	class compra_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function MostrarCompras(){
			$this->db->select('*');
			$this->db->from('compra');
			$this->db->join('proveedor', 'proveedor.codproveedor = compra.codproveedor');

			$query = $this->db->get();
			return $query->result();
		}

		function VistaCompras($cod){
			$this->db->select('*');
			$this->db->where('compra.codcompra',$cod);
			$this->db->from('compra');
			$this->db->join('proveedor', 'proveedor.codproveedor = compra.codproveedor');

			$query = $this->db->get();
			return $query->result();
		}

		function VistaDetalleCompras($codcompra){
            $this->db->select('*');
			$this->db->from('detallecompra');
			$this->db->join('producto', 'producto.codproducto = detallecompra.codproducto');
            $this->db->join('compra', 'compra.codcompra = detallecompra.codcompra');
            $this->db->where(array("detallecompra.codcompra"=>$codcompra));

			$query = $this->db->get();
			return $query->result();
        }

        function Cuotas($codcompra){
            $this->db->select('*');
			$this->db->from('cronogramapagos');
            $this->db->join('compra', 'compra.codcompra = cronogramapagos.codcompra');
            $this->db->where(array("compra.codcompra"=>$codcompra));

			$query = $this->db->get();
			return $query->result();
        }

		
		function TraerProductos(){
			$query = $this->db->query("select *from producto where estado=1");
			return $query->result();
		}
		function TraerProveedores(){
			$query = $this->db->query("select *from proveedor where estado=1");
			return $query->result();
		}

		function TipoProductos(){
			$query = $this->db->get('tipoproducto');
			return $query->result();
		}

		function FormaPagos(){
			$query = $this->db->get('formapagos');
			return $query->result();
		}

		function GuardarProveedor(){
		    $query = $this->db->get_where('proveedor', array('ruc' => $_POST["rucem"]));
		    $buscar = $query->result();
			if (count($buscar)==0) {
				$this->db->select_max('codproveedor');
			    $result= $this->db->get('proveedor')->result_array();
			    $idproveedor= $result[0]['codproveedor']+1;

				$data = array(
	                'codproveedor' => $idproveedor,
	                'ruc' => $_POST["rucem"],
	                'razonsocial' => $_POST["razon"],
	                'telefono' => $_POST["tel"],
	                'celular' => $_POST["cel"],
	                'direccion' => $_POST["dire"],
	                'email' => $_POST["correoelec"],
	                'estado' => 1
	            );
	            $this->db->insert("proveedor",$data);
	            return "Proveedor Registrado Correctamente";
			}else{
				return "Proveedor Ya Existente";
			}
		}

		function GuardarProducto(){
			$this->db->select_max('codproducto');
			$result= $this->db->get('producto')->result_array();
	        $idproducto= $result[0]['codproducto']+1;

			$data = array(
	            'codproducto' => $idproducto,
	            'codtipoproducto' => $_POST["tipod"],
	            'descripcion' => $_POST["descrip"],
	            'stockminimo' => $_POST["stockmin"],
	            'stockmaximo' => $_POST["stockmax"],
	            'stockactual' => 0,
	            'precio' => $_POST["preciop"],
	            'cobrarigv' => $_POST["cigv"],
	            'estado' => 1
	        );
	        $this->db->insert("producto",$data);
	        return "Producto Registrado Correctamente";
		}

		//Guardar Compra Verdadero

		function grabacompra(){
            $data = array(
            	'codcompra' => $_POST['codcompra'],
				'codproveedor' => $_POST['codproveedor'],
           		'codempleado' => $_POST['codempleado'],
           		'fechaingreso' => date('d-m-Y'),
           		'fechacompra' => $_POST['fechacompra'],
               	'nrofactura' => $_POST['factura'],
            	'igv' => $_POST['igv'],
           		'importe' => $_POST['total'],
           		'estadocompra' =>1
            );
            $this->db->insert("compra",$data);

            //Insertando Detalle Ventas
			foreach ($_POST['idproductodetalle'] as $key => $value) {
				$data = array(
	               'codcompra' => $_POST['codcompra'],
	               'codproducto' => $_POST['idproductodetalle'][$key],
	               'cantidad' => $_POST['cantidaddetalle'][$key],
	               'precio' => $_POST['preciodetalle'][$key]
	            );
				$this->db->insert('detallecompra', $data);

				$query = $this->db->get_where('producto', array('codproducto' => $_POST['idproductodetalle'][$key]))->result_array();
		    	$actual= $query[0]['stockactual'];
				$data1 = array(
	               'stockactual' => $actual+$_POST['cantidaddetalle'][$key]
	            );
				$this->db->where('codproducto', $_POST['idproductodetalle'][$key]);
				$this->db->update('producto', $data1); 
			}

			//Para las Cuotas
			if($_POST["formapago"] == "1"){
                $arraydata = array(
                    "codcompra" => $_POST['codcompra'],
                    "nrocuota" =>  1,
                    "monto" => $_POST["total"],
                    "fechavencimiento" => date("Y-m-d"),
                    "monto_pagado" => 0,
                    "estado" => 1
                );
                $this->db->insert("cronogramapagos",$arraydata);
            }else{
            	foreach($_POST["idcuota"] as $key => $value){
                    $arraydata = array(
                        "codcompra" => $_POST['codcompra'],
                        "nrocuota" =>   $_POST['idcuota'][$key],
                        "monto" => $_POST['montocuota'][$key],
                        "fechavencimiento" => $_POST['fechavence'][$key],
                        "monto_pagado" => 0,
                        "estado" => 1
                    );
                    $this->db->insert("cronogramapagos",$arraydata);
                }
            }
        }

		function InsertandoCompra($_P){
			//Insertando Ventas 
			$data = array(
               'codcompra' => $_REQUEST['codcompra'],'codproveedor' => $_REQUEST['codproveedor'],
               'codempleado' => $_REQUEST['codempleado'],'fechaingreso' => date('d-m-Y'),
               'fechacompra' => $_REQUEST['fechacompra'],'nrofactura' => $_REQUEST['factura'],
               'igv' => $_REQUEST['igv'],'importe' => $_REQUEST['total'],'estadocompra' =>1
            );
			$this->db->insert('compra', $data); 

			//Insertando Detalle Ventas
			foreach ($_REQUEST['idproductodetalle'] as $key => $value) {
				$data = array(
	               'codcompra' => $_REQUEST['codcompra'],'codproducto' => $_REQUEST['idproductodetalle'][$key],
	               'cantidad' => $_REQUEST['cantidaddetalle'][$key],'precio' => $_REQUEST['preciodetalle'][$key]
	            );
				$this->db->insert('detallecompra', $data);

				$query = $this->db->get_where('producto', array('codproducto' => $_REQUEST['idproductodetalle'][$key]))->result_array();
		    	$actual= $query[0]['stockactual'];
				$data1 = array(
	               'stockactual' => $actual+$_REQUEST['cantidaddetalle'][$key]
	            );
				$this->db->where('codproducto', $_REQUEST['idproductodetalle'][$key]);
				$this->db->update('producto', $data1); 
			}		
		}

		function InsertarCuotas($codcompra,$cuota,$monto,$fecha,$estado){
			$data = array(
               'codcompra' => $codcompra,'cuota' => $cuota,'monto' => $monto,
               'fechavencimiento' => $fecha,'estado' => $estado
            );
			$this->db->insert('cronogramapagos', $data); 
		}




		function MostrarEmpleado($cod){
			$query = $this->db->get_where('empleado', array('codempleado' => $cod));
			return $query->result();
		}

		function ValidarProveedor($cod){
			$this->db->where('codproveedor',$cod);
			$this->db->from('proveedor');
			return $this->db->count_all_results();
		}

		function NuevaH(){
			$this->db->select_max('codcompra');
			$query = $this->db->get('compra');
			return $query->result();
		}

		function Insertar($cod,$prov,$emp,$fecomp,$feing,$nrofac,$igv,$imp){
			$data = array(
               'codcompra' => $cod,'codproveedor' => $prov,'codempleado' => $emp,'fechacompra' => $fecomp,'fechaingreso' => $feing,
               'nrofactura' => $nrofac,'igv' => $igv,'importe' => $imp,'estadocompra' => 1
            );
			$this->db->insert('compra', $data);
		}

		function Modificar($cod,$prov,$emp,$fecomp,$feing,$nrofac,$igv,$imp){
			$data = array(
               'codcompra' => $cod,'codproveedor' => $prov,'codempleado' => $emp,'fechacompra' => $fecomp,'fechaingreso' => $feing,
               'nrofactura' => $nrofac,'igv' => $igv,'importe' => $imp,'estado' => $estado
            );
			$this->db->where('codcompra', $cod);
			$this->db->update('compra', $data); 
		}

		function Eliminar($codigo){
			$data = array(
               'estado' => 0
            );
			$this->db->where('codcompra', $codigo);
			$this->db->update('compra', $data);  
		}
	}
?>