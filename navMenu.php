<?php
if (!isset($_SESSION))
    session_start();
if (!isset($_SESSION["tipo_corpoteg"]) && !isset($_SESSION["usuario_corpoteg"])) {
    header("Location: index.php"); /* Redirect browser */
    exit();
}
?>

<nav class="navbar navbar-default navbar-fixed-top" ;>
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <img src="img/logo_alltron.png" class="navbar-brand" alt="Alltron" style="padding: 4px;">
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="visor_general.php">Inicio</a></li>
         <?php if($_SESSION['tipo_corpoteg'] == 1 || $_SESSION['tipo_corpoteg'] == 3) { ?>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sistema
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?php if($_SESSION['tipo_corpoteg'] == 1) { ?>
              
              <li><a href="cliente.php">Cliente</a></li>
              <li><a href="pregunta.php">Preguntas</a></li>
              <li><a href="seccion.php">Secciones</a></li>
              <li><a href="categoria.php">Reportes</a></li>
              <li><a href="servicio.php">Asignar Reporte</a></li>
              <li><a href="usuario.php">Reportes contestados</a></li>
              
              <?php  }; ?>
            </ul>
          </li>
        <?php  }; ?>
        
        <?php if($_SESSION['tipo_corpoteg'] == 1 ) { ?>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Usuarios
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="usuario.php">Registro</a></li>
            <li><a href="turno.php">Asignar Servicio</a></li>
            
          </ul>
        </li>
        <?php  }; ?>
         <?php if($_SESSION['tipo_corpoteg'] == 1 || $_SESSION['tipo_corpoteg'] == 3 || $_SESSION['tipo_corpoteg'] == 4) { ?>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Servicios
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="grupo.php">Servicios</a></li>
            
          </ul>
        </li>
        <?php  }; ?>
	     
      </ul>
      <ul class="nav navbar-nav navbar-right">
        
        <li><label class="navbar-text"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $_SESSION['nombre_corpoteg']." ".$_SESSION['usuario_corpoteg']?></span></label></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
       
      </ul>
    </div>
  </div>
</nav>