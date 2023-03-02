<?php 

require_once("../config/conexion.php");
require_once("../models/Dempleados.php");

$dempleados = new DEmpleados();

switch($_GET['op'])
{
	case "listar":
		$datos = $dempleados->get_empleados();	
		$data = Array();
		foreach ($datos as $renglon) 
		{
			$sub_array = array();
			
			$sub_array[] = $renglon['nombre'];
			$sub_array[] = $renglon['apellido_paterno'];
			$sub_array[] = $renglon['apellido_materno'];
			$sub_array[] = $renglon['puesto'];
			
			/*$sub_array[] = $renglon['fech_crea'];
			$sub_array[] = $renglon['fech_mod'];
			$sub_array[] = $renglon['fech_elim'];
			$sub_array[] = $renglon['est']; */
			$sub_array[] = '<input type="button" class="btn btn-danger"  onClick="eliminar('.$renglon['id'].');" value="Eliminar">
			<input type="button" class="btn btn-warning"  onClick="editar('.$renglon['id'].');" value="Editar">';
			
			
		
			$data[]=$sub_array;
		}

		$result = array(
			"sEcho"=>1,
			"iTotalRecords"=>count($data),
			"iTotalDisplayRecords"=>count($data),
			"aaData"=>$data);
		echo json_encode($result);

		break;
	case "guardaryeditar":
		$datos = $dempleados->get_empleados_id($_POST['id']);	
		if (empty($_POST["id"])) 
		{
			if (is_array($datos)==true and count($datos)==0) 
			{
				$dempleados->insert_empleado($_POST["nombre"],$_POST["apellido_paterno"],$_POST["apellido_paterno"],$_POST["puesto"]);
			}
		}
		else
		{
				$dempleados->update_empleado($_POST["id"],$_POST["nombre"],$_POST["apellido_paterno"],$_POST["apellido_materno"],$_POST["puesto"]
					,$_POST["status"]);
		}
			# code...
		
	break;

	case "mostrar":
		$datos = $dempleados->get_empleados_id($_POST['id']);
		
		echo json_encode($datos[0]);
	break;

	case "eliminar":
		$datos = $dempleados->delete_empleado($_POST['id']);
	break;
}


 ?>
 