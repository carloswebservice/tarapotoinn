<?php
class usuario_model extends CI_Model{
	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
	
	function traer_usuarios()
	{
		$query = $this->db->get('usuario');
		return $query->result();		
	}

	function insertar_usuarios()
	{
		$this->dniusuario   = $_POST['dniusuario']; // por favor leer la nota de abajo
		$this->nombre = $_POST['nombre'];
		$this->apellidos   = $_POST["apellidos"];
		$this->fecha = date("Y-m-d");
		$this->db->insert('usuario', $this);
	}

	function actualizar_usuarios()
	{
		$this->dniusuario   = $_POST['dniusuario']; // por favor leer la nota de abajo
		$this->nombre = $_POST['nombre'];
		$this->apellidos   = $_POST["apellidos"];
		$this->fecha = date("Y-m-d");

		$this->db->update('usuario', $this, array('dniusuario', $_POST['dniusuario']));
	}

	function eliminar_usuarios($dni){
		$this->db->delete('usuario', array('dniusuario' => $dni)); 
	}

}