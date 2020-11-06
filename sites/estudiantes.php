<?php
require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'estudiante.php';
require_once '../service/iServiceBase.php';
require_once 'EstudianteServiceCookies.php';

$layout = new Layout(true);
$service = new EstudianteServiceCookie();
$utilities = new Utilities();

$listadoEstudiantes = $service->GetList();

if (!empty($listadoEstudiantes)) {

  if (isset($_GET['carreraid'])) {

    $listadoEstudiantes = $utilities->searchProperty($listadoEstudiantes, 'carrera', $_GET['carreraid']);
  }
};

?>

<?php $layout->printHeader(true); ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Estudiantes</h1>
  </div>

  <h2></h2>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th></th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Carrera</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>

        <?php if (empty($listadoEstudiantes)) : ?>

          <h3>No hay estudiantes registrados, registra aqui: <a href="nuevoEstudiante.php" class="btn btn-primary">nuevo estudiante</a> </h3>

        <?php else : ?>

          <div class="float-right dropdown-menu-right">

            <a id="mi-dropdown" href="#" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">Filtrar</a>
            <ul class="dropdown-menu text-dark">
              <li><a class="text-dark" href="estudiantes.php">Todos</a></li>
              <li><a class="text-dark" href="estudiantes.php?carreraid=1">Redes</a></li>
              <li><a class="text-dark" href="estudiantes.php?carreraid=2">Mecatronica</a></li>
              <li><a class="text-dark" href="estudiantes.php?carreraid=3">Manufactura</a></li>
              <li><a class="text-dark" href="estudiantes.php?carreraid=4">Multimedia</a></li>
              <li><a class="text-dark" href="estudiantes.php?carreraid=5">Software</a></li>
            </ul>

          </div>
          <?php foreach ($listadoEstudiantes as $estudiant) : ?>

            <tr style="line-height: 300%;">
              <td style="width: 5%; height: inherit;">

                <?php if ($estudiant->profilePhoto == "" || $estudiant->profilePhoto == null) : ?>
                  <img width="70%" src="<?php echo "../assets/img/default.png" ?>" alt="" srcset="">

                <?php else : ?>
                  <img width="70%" src="<?php echo "../assets/img/estudiantes/" . $estudiant->profilePhoto; ?>" alt="" srcset="">
                <?php endif; ?>


              </td>
              <td><?php echo $estudiant->nombre ?></td>
              <td><?php echo $estudiant->apellido ?></td>
              <td><?php echo $estudiant->getCarrera(); ?></td>
              <td><?php echo $estudiant->status ?></td>
              <td><a href="editar.php?codigo=<?php echo $estudiant->codigo ?>" class="link">Editar</a></td>
              <?php echo "<td><a href='eliminar.php?codigo=$estudiant->codigo' onclick=\"return confirm('¿Está seguro que desea eliminar?');\" class='link'>Eliminar</a></td>"; ?>
            </tr>

          <?php endforeach; ?>

        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>

<?php $layout->printFooter(true); ?>