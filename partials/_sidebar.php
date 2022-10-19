<?php
require('../../db/conexionDb.php');
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  
  <!-- Menu lateral -->
  <ul class="nav" id="menu">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle " src="../../assets/images/faces/387.jpg" alt="">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal" id="prueba"><?php echo ucwords($_SESSION['nombre'] . ' ' . $_SESSION['apellido']) ?></h5>
          </div>
        </div>        
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>
    
    <li class="nav-item menu-items">
      <a class="nav-link" href="../../pages/dashboards/dashboardAdmin.php">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="../../pages/horarios/horario.php">
        <span class="menu-icon">
          <i class="mdi mdi mdi-alarm"></i>
        </span>
        <span class="menu-title">Horario</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="../../pages/turnos/crearTurno.php">
        <span class="menu-icon">
          <i class="mdi mdi mdi-alarm-plus"></i>
        </span>
        <span class="menu-title">Crear turno</span>
      </a>
    </li>    

    <li class="nav-item menu-items" id='usuarios'>
      <a class="nav-link" data-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user">
        <span class="menu-icon">
          <i class="mdi mdi mdi-account-multiple-outline"></i>
        </span>
        <span class="menu-title">Usuarios</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="user">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="../../pages/usuarios/crearUsuario.php"> Crear usuario </a></li>
          <li class="nav-item"> <a class="nav-link" href="../../pages/usuarios/verUsuarios.php"> Ver usuarios </a></li>
        </ul>
      </div>
    </li> 

    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#cuenta" aria-expanded="false" aria-controls="auth">
        <span class="menu-icon">
          <i class="mdi mdi mdi-settings"></i>
        </span>
        <span class="menu-title">Cuenta</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="cuenta">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="../../pages/cuenta/cambiarContraseña.php"> Contraseña </a></li>
          <li class="nav-item"> <a class="nav-link" href="../../pages/cuenta/CambiarCorreo.php"> Actualizar Email </a></li>
        </ul>
      </div>
    </li>

  </ul>
  <!-- Menu lateral Fin-->
</nav>