<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estadia extends CI_Controller {

	public function index(){
		$this->load->database('default');
		$this->load->model('Estadia_model');
		$Estadias = $this->Estadia_model->MostrarEstadias();
		$this->load->view("Estadia/index.php",compact("Estadias"));
	}

	public function Nuevo(){
		$this->load->database('default');
		$this->load->model('Estadia_model');
		$TipoHabitaciones = $this->Estadia_model->MostrarTipoHabitacion();
		$Comprobantes = $this->Estadia_model->MostrarTipoComprobantes();
		$FormaPago = $this->Estadia_model->MostrarFormaPago();
		$Clientes = $this->Estadia_model->MostrarClientes();
		$Nuevo = $this->Estadia_model->NuevaE();

		$Departamentos = $this->Estadia_model->UbigeoDep();
		$this->load->view("Estadia/nuevo.php",compact("TipoHabitaciones","Comprobantes","FormaPago","Clientes","Nuevo","Departamentos"));
	}

	public function Consumo(){
		$this->load->database('default');
		$this->load->model('Estadia_model');

		$Estadia = $this->Estadia_model->VistaEstadia($_POST['id']);
		$DetalleEstadia = $this->Estadia_model->VistaDetalleEstadia($_POST['id']);
		$ListaConsumos = $this->Estadia_model->VistaListaConsumos($_POST['id']);

		$Cuotas = $this->Estadia_model->Cuotas($_POST['id']);

		$Productos = $this->Estadia_model->ListaProductos($_POST['id']);

		$this->load->view("Estadia/consumo.php",compact('Estadia','DetalleEstadia','ListaConsumos','Cuotas','Productos'));
	}

	//Tema Scoring
	public function DeudasTodas(){
		$this->load->database('default');
        $query = $this->db->query("
			select SUM(cv.monto)-SUM(cv.monto_cobrado) as deuda from cuotasventas cv inner join ventas as v on(cv.codventas=v.codventas)
			inner join cliente as c on(c.codcliente=v.codcliente) where c.codcliente=".$_POST['codcliente']."
			union all 
			select SUM(ce.monto)-SUM(ce.monto_cobrado) as deuda from cuotaestadia ce inner join estadia as e on(ce.codestadia=e.codestadia)
			inner join cliente as c on(c.codcliente=e.codcliente) where c.codcliente=".$_POST['codcliente']
		);
		$Deudas = $query->result_array();
		$Deuda=0;
		foreach ($Deudas as $key => $value) {
            $Deuda=$Deuda+$value["deuda"];
        }
		echo $Deuda;
	}

	public function Grafico(){
		$this->load->database('default');
		//$query = $this->db->query("select *from deudas where codcliente=".$_POST['codcliente']." and 
		//	fechapago is not null order by fecha");
		$query = $this->db->query("select *from deudas where codcliente=3 and 
			fechapago is not null order by fecha");

		$narray = array();
		$notas = array();
		$pendiente = array();
		$Deudas = $query->result_array();

		if(count($Deudas)<=1){
			$var="nada";
			echo json_encode($var);
			exit();
		}

		$calificacion = $this->db->get("calificacion");
		$califica = $calificacion->result_array();

		//Para El Mensaje Del Analisis
		foreach ($Deudas as $key => $value) {
			$narray[] = $value["fecha"];
			if($value["fechapago"] > $value["fecha"]){			    
			    $dias	= (strtotime($value["fechapago"])-strtotime($value["fecha"]))/86400;
				$dias 	= abs($dias); $dias = floor($dias);
				
				foreach ($califica as $key => $value) {	
					$rangos = explode("-", $value["rango"]);
					$rangonota = explode("-", $value["rangonota"]);

					if ($rangos[1]=="+") {
						$rangoinfinito=$rangos[0]+10;
						if ($dias>=$rangoinfinito) {
							$notas[]=0; break;
						}else{
							$rangos[1]=$rangos[0]+10;
						}
					}
					if ($dias<=$rangos[1]){
						$calificadocomo=$value["descripcion"];
						$rangomin=$rangos[0]; $rangomax=$rangos[1];
						$notamin=$rangonota[0]; $notamax=$rangonota[1];
						do{
							$promediorango=round(($rangomin+$rangomax)/2);
							$promedionota=($notamin+$notamax)/2;

							if ($dias>$promediorango) {
								$notamax=$promedionota;
								$rangomin=$promediorango;
							}else{
								$notamin=$promedionota;
								$rangomax=$promediorango;
							}
						}while ($dias!=$promediorango);
						$notas[]=round($promedionota,1); break;
					}				
				}
			}else{
				$notas[]=20; 
			}
		}
		
		
		//Calulo Nueva Pendiente
		$sumax=0;$sumay=0;$sumavar=0;$mediay=0;$mediax=0;$cantida=0;
		$contan=0;$desviacion=0;$sumacova=0;$a=0;$b=0;$puntox=0;$puntoy=0;
		foreach ($notas as $key => $value) {
			$cantida=$cantida+1;
			$sumay=$sumay+$value;
			$sumax=$sumax+$cantida;
		}
		$mediax=round($sumax/$cantida,2);
		$mediay=round($sumay/$cantida,2);

		foreach ($notas as $key => $value) {
			$contan=$contan+1;
			$sumavar=$sumavar+(($contan-$mediax)*($contan-$mediax));
			$sumacova=$sumacova+(($value-$mediay)*($contan-$mediax));
		}
		$sumavar=$sumavar/$cantida;
		$desviacion=sqrt($sumavar);
		$desviacion=round($desviacion,2);

		//La Varianza
		$sumacova=round($sumacova/$cantida,2);

		$a=$sumacova/round($sumavar,2);
		$b=$mediay-(round($a)*$mediax);
		print_r($a .' '.$b);exit();
		if ($b>20) {
			$b=19.5;
		}		

		$x1=1;$y1=$b;$pendiente1=$b;
		//Calculamos la pendiente
		$suma=0;$connt=0;$monto=0;
		foreach ($notas as $key => $value){
			$connt=$connt+1;
			if ($connt==count($notas)) {
				if ($a>0) {
					$pendiente2=$value-0.3;
				}else{
					$pendiente2=$value+0.3;
				}				
			}
			$suma=$suma+$value;
		}
		$suma=round($suma/$connt,2);
		if ($a>0) {
			$estado="Pendiente +";
			$intervalo=($pendiente2-$pendiente1)/(count($notas)-1);
			$intervalo=round($intervalo,3);$conta=0;
			foreach ($notas as $key => $value) {
				$conta++;
				if ($conta==1) {
					$pendiente[]=$b;$pendiente1=$b;
				}else{
					if($conta==count($notas)){
						$pendiente[]=$value-0.3;
					}else{
						$pendiente1=$pendiente1+$intervalo;
						$pendiente[]=$pendiente1;
					}
				}			
			}
		}else{
			if ($a<0) {
				$estado="Pendiente -";
				$intervalo=($pendiente1-$pendiente2)/(count($notas)-1);
				$intervalo=round($intervalo,3);$conta=0;
				foreach ($notas as $key => $value) {
					$conta++;
					if ($conta==1) {
						$pendiente[]=$b;$pendiente1=$b;
					}else{
						if($conta==count($notas)){
							$pendiente[]=$value+0.3;
						}else{
							$pendiente1=$pendiente1-$intervalo;
							$pendiente[]=$pendiente1;
						}
					}
				}
			}else{
				$estado="Pendiente Neutra";
			}		
		}

		$mensaje=" Calificado Como: ".$calificadocomo." --- Nota Promedio: ".round($suma,2)." (".$estado.")";
		$envio = array();

		$envio["categories"] = $narray;
		$envio["nota"] = $notas;
		$envio["pendiente"]=$pendiente;
		$envio["calif"] = $mensaje;

		echo json_encode($envio);
	}


	public function Cantidadstock(){
		$this->load->database('default');
		$this->load->model('Estadia_model');

		$Cantidad = $this->Estadia_model->Vercantidad($this->input->post("codproducto"));
		echo json_encode($Cantidad);
	}

	public function GuardarConsumo(){
		$this->load->database('default');
		
        $this->load->database('default');
		$this->load->model('Estadia_model');
		$this->Estadia_model->grabaconsumos();
	}

	public function TerminarEstadia(){
		$this->load->database('default');
		$this->load->model('Estadia_model');
		$Habitaciones=$this->Estadia_model->TerminarEstadia($this->input->post("codestadia"));

		echo "Estadia Finalizada Correctamente";
	}

	public function UbigeoPro(){
		$this->load->database('default');
		$this->load->model('Estadia_model');

		$Provincias= $this->Estadia_model->UbigeoPro($this->input->post("departamento"));
		echo json_encode($Provincias);
	}

	public function UbigeoDis(){
		$this->load->database('default');
		$this->load->model('Estadia_model');

		$Provincias= $this->Estadia_model->UbigeoDis($this->input->post("departamento"),$this->input->post("provincia"));
		echo json_encode($Provincias);
	}
	//Para Guardar Un Cliente Nuevo
	public function TraerClientes(){
		$this->load->database('default');
        $this->load->model('Estadia_model');

        $clientes=$this->Estadia_model->TraerClientes();
        echo json_encode($clientes);
	}

	public function GuardarClienteNuevo(){
		$this->load->database('default');
        $this->load->model('Estadia_model');

        $mensaje=$this->Estadia_model->GrabaNuevoCliente();
        echo $mensaje;
	}

	//Para Visualizar Estadia
	public function ClienteEstadia(){
		$this->load->database('default');
        $this->load->model('Estadia_model');

        $estadia = $_POST["estadia"];

        $Cliente = $this->Estadia_model->ClienteEstadia($estadia);
        echo json_encode($Cliente);
	}
    public function detalleestadia(){
        $this->load->database('default');
        $this->load->model('Estadia_model');

        $estadia = $_POST["ide"];

        $Clientes = $this->Estadia_model->DetalleEstadia($estadia);
        echo json_encode($Clientes);
    }


	public function BuscarHab(){
		$this->load->database('default');
		$this->load->model('Estadia_model');

		$Habitaciones= $this->Estadia_model->BuscaHab($this->input->post("tipohab"),$this->input->post("reserva"),$this->input->post("fecha"));
		echo json_encode($Habitaciones);
	}

	public function BuscarPrecio(){
		$this->load->database('default');
		$this->load->model('Estadia_model');

		$Precio= $this->Estadia_model->Precio($this->input->post("codhab"));
		echo json_encode($Precio);
	}

	public function ClienteExiste(){
		$this->load->database('default');
		$this->load->model('Estadia_model');

		$Cliente= $this->Estadia_model->ExisteCliente($this->input->post("codcliente"));
		echo json_encode($Cliente);
	}

	public function Cancelar(){
		$this->load->database('default');
		$this->load->model('Estadia_model');

		$Habilitar=$this->Estadia_model->HabilitarHabitacion($this->input->post("codestadia"));
		echo json_encode($Habilitar);

		echo $existeestadia;
		if ($existeestadia == 0) {
			$RegistroEsta=$this->Estadia_model->RegistroEstadia($this->input->post("codestadia"),
				$this->input->post("codcliente"),$this->input->post("codempleado"));
		}
	}

	public function RegistroEstadia(){
		$this->load->database('default');
		$this->load->model('Estadia_model');

		$existeestadia=$this->Estadia_model->VerEstadia($this->input->post("codestadia"));
		echo $existeestadia;
		if ($existeestadia == 0) {
			$RegistroEsta=$this->Estadia_model->RegistroEstadia($this->input->post("codestadia"),
				$this->input->post("codcliente"),$this->input->post("codempleado"));
		}
	}

	public function EliminarHabitacion(){
		$this->load->database('default');
		$this->load->model('Estadia_model');
		$Elimina= $this->Estadia_model->EliminarHab($this->input->post("habitacion"),$this->input->post("estadia"));

		$DetalleHabit = $this->Estadia_model->MostrarHabitacionesEstadia($this->input->post("estadia"));
		$this->load->view("Estadia/mostrarhabitaciones.php",compact("DetalleHabit"));
	}


            public function GuardarEstadiaReserva(){
                $this->load->database('default');
                $ide = $_POST["id"];

                $es =  $this->db->get_where("estadia",array("codestadia"=>$ide));
                $es = $es->row_array();

                $arraydata = array( "fechareserva"=>NULL );
                $this->db->update("estadia",$arraydata,array("codestadia"=>$ide));

                $habs = $this->db->get_where("detalleestadia",array("codestadia"=>$ide));
                $habs = $habs->result_array();

                foreach ($habs as $key => $value) {
                    $dataa = array("estado" => 0);
                    $this->db->update("habitacion",$dataa,array("codhabitacion"=>$value["codhabitacion"]));
                }


                //      $this->load->model('Estadia_model');
                //$this->Estadia_model->grabaestadia();

                echo "Se proceso como estadia correctamente";
            }

	public function GuardarEstadia(){

        $this->load->database('default');

        $this->load->model('Estadia_model');
        $this->Estadia_model->grabaestadia();

		echo "Estadia Registrada Correctamente";
	}

}
