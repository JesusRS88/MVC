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
