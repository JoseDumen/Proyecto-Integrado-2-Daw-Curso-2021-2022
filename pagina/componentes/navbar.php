<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="inicio.php">Inicio</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Sección empleados
      </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="altaEmpleado.php">Alta empleado</a></li>
              <li><a class="dropdown-item" href="listadoEmpleado.php">Listado empleados</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="informacionEmpleado.php">Información personal</a></li>
          </ul>
      </li>
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Sección proyectos
      </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Alta proyecto</a></li>
              <li><a class="dropdown-item" href="#">Listado proyectos</a></li>
          </ul>
      </li>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="cerrarSesion.php">Cerrar sesión</a>
            </li>
        </ul>
    </div>
</div>
</nav>