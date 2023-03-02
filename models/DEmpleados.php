<?php
require_once("../config/conexion.php");

class DEmpleados extends BD_PDO
{
	public function get_empleados()
	{
		//parent::set_names();
		$result = $this->Ejecutar_Instruccion("Select * from tbl_empleados where status=1");
		return $result;
	}

	public function get_materia2()
	{		
		$conectar = $this->getConection();
		//parent::set_names();
		$sql = "Select * from tbl_empleados";
		$sql = $conectar->prepare($sql);
		$sql->execute();
		return $sql->fetchAll();
	}

	public function get_empleados_id($id)
	{
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("Select * from tbl_empleados where id = '{$id}'");
		return $result;
	}

	public function delete_empleado($id)
	{
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("Update tbl_empleados set status=0 where id = '{$id}'");
		return $result;
	}

	public function insert_empleado($nombre, $ap, $am, $puesto)
	{
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("INSERT INTO tbl_empleados (nombre, apellido_paterno, apellido_materno, puesto, status) VALUES ('{$nombre}', 
			'{$ap}', '{$am}','{$puesto}', '1');");
		return $result;
	}

	public function update_empleado($id, $nombre, $ap, $am, $peusto, $status)
	{
		//parent::set_names();
		$result = parent::Ejecutar_Instruccion("Update tbl_empleados set nombre='{$nombre}', apellido_paterno='{$ap}', apellido_materno='{$am}', puesto='{$peusto}',status='{$status}' where id = '{$id}'");
		return $result;
	}
}

?>