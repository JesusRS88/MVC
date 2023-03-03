# MVC


# Modelo MVC

MVC es una propuesta de arquitectura del software utilizada para separar el código por sus distintas responsabilidades, manteniendo distintas capas que se encargan de hacer una tarea muy concreta, lo que ofrece beneficios diversos.

# Modelo
Es la capa donde se trabaja con los datos, por tanto contendrá mecanismos para acceder a la información y también para actualizar su estado.

# Vista

Las vistas, como su nombre nos hace entender, contienen el código de nuestra aplicación que va a producir la visualización de las interfaces de usuario, o sea, el código que nos permitirá renderizar los estados de nuestra aplicación en HTML. 

# Controlador

Contiene el código necesario para responder a las acciones que se solicitan en la aplicación, como visualizar un elemento, realizar una compra, una búsqueda de información, etc.

## Vista
#Ejemplo Vista
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once('../mainhead.php'); ?>
        <title>Practica MVC</title>  
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="../../public/assets/img/navbar-logo.svg" alt="..." /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">DataTable</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Practica MVC</div>
                <div class="masthead-heading text-uppercase">Jesus Alberto Reyna Servin</div>
               <a class="btn btn-primary btn-xl text-uppercase" href="#services">5 "B"</a>
            </div>
        </header>
        <!-- Services-->
        <section class="page-section" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">DataTable Empleados</h2>
                    <button class="btn btn-primary btn-xl text-uppercase" id="btnnuevo" data-bs-toggle="modal" data-bs-target="#modalEmpleados">Nuevo Empleado</button>
                </div>
            </div>

            <div class="container">
                <table width="100%" cellspacing="0" class="table" id="dempleados_data">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido Paterno</th>
                            <th scope="col">Apellido Materno</th>
                            <th scope="col">Puesto</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>               
                    </tbody>
                </table>
            </div>
        </section>
        
       
        
       
        
        
       <?php require_once("modalEmpleados.php"); ?>    
       <?php require_once("../mainjs.php"); ?>

       <script type="text/javascript" src="dempleados.js"></script>
    </body>
</html>




## Modelo
#Ejemplo Modelo

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
		$result = parent::Ejecutar_Instruccion("INSERTONE tbl_empleados (nombre, apellido_paterno, apellido_materno, puesto, status) VALUES ('{$nombre}', 
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
## Controlador
#Ejemplo Controlador

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
 
## Conexion
#Ejemplo Conexion

<?php 


require_once('config.php');

class BD_PDO
{

	public $tot_reg;
	protected $dbh;

	public function getConection ()	
	{
			try {
			       $conexion = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME.";",DB_USER,DB_PASS);
		           }
		        catch(PDOException $e){
	                          echo "Failed to get DB handle: " . $e->getMessage();
	                           exit;    
	                                    }
	        return $conexion;
	}	

	public function Ejecutar_Instruccion($consulta_sql)
	{
		# code...
		$conexion = $this->getConection();
        $rows = array();
        
		$query=$conexion->prepare($consulta_sql);
		if(!$query)
		{
         	return "Error al mostrar";
        }
		else
		{			
        	$query->execute();   
           	$this->tot_reg = $query->rowCount();     	
        	while ($result = $query->fetch())
			{
            	$rows[] = $result;
          	}			
            return $rows;
        }
	}

	public function Tot_registros()
	{
		return $this->tot_reg;
	}

	/*public function set_names()
	{
		return $this->dbh->query("SET NAMES 'utf8'");
	}*/
}

?>

## Config para la conexion
<?php 

define('DB_SERVER', 'localhost');
define('DB_NAME', 'db_empresa');
define('DB_USER', 'root');
define('DB_PASS', '');

 ?>
