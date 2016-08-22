<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permisos extends CI_Controller {

    public function index(){
        $this->load->database('default');
        $tipousu = $this->db->get("cargo")->result_array();

        $this->load->view("Permisos/index.php",compact("tipousu"));
    }

    public function grabar(){
        $this->load->database('default');

        $this->db->where('codcargo', $_POST["codcargo"]);
        $this->db->delete('permisos');

        foreach ($_POST["permisos"] as $key => $value) {
            $data = array(
                    "codcargo" => $_POST["codcargo"],
                    "modulo_id" => $value
                );
            $this->db->insert("permisos",$data);
        }
        echo "Permisos Proporcionados Correctamente";
    }

    public function getmodulos(){
        $this->load->database('default');
        $id = $_POST["id"];      

        $modulos = $this->db->get_where("modulos",array("estado"=> "A","mod_padre"=>0))->result_array();
        $permisos = $this->db->get_where("permisos",array("codcargo" => $id ))->result_array();

        $arrp = array();
        foreach ($permisos as $key => $value) {
            $arrp[] = $value["modulo_id"];
        }

        $html = "<ul id='nav'>";
        foreach ($modulos as $key => $value) {
            $html.= "<li>";
                if(in_array($value["id"],$arrp)){
                    $attr = "checked";
                }else{
                    $attr = "";
                }
                $html .= "<p><input type='checkbox' name='permisos[]' value='".$value["id"]."' $attr > ".$value["mod_descripcion"]."</p>".$this->cargapadre($value["id"],$arrp);
            $html.=  "</li>";
        }
        $html .= "</ul>";
        print $html;
    }

    public function cargapadre($idpadre,$arrp){
        $this->load->database('default');

        $modulos = $this->db->get_where("modulos",array("estado"=> "A","mod_padre"=>$idpadre))->result_array();

        $html = "<ul>";
        foreach ($modulos as $key => $value) {
            if(in_array($value["id"],$arrp)){
                $attr = "checked";
            }else{
                $attr = "";
            }
            $html .= "<li><input type='checkbox' name='permisos[]' value='".$value["id"]."'  $attr > ".$value["mod_descripcion"]."</li>";
        }
        $html .= "</ul>";
        return  $html;
    }
}
