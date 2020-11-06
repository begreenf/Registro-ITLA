<?php
require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'estudiante.php';
require_once '../service/iServiceBase.php';
require_once 'EstudianteServiceCookies.php';

$layout = new Layout(true);
$service = new EstudianteServiceCookie();
$utilities = new Utilities();


global $estudianteid;

if (/*isset($_POST['codigo']) &&*/isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['carrera']) && isset($_POST['favs']) && isset($_FILES['profilePhoto'])) {

  /*   var_dump($_FILES['profilePhoto']);
  exit(); */

  $status = $_POST['status'];
  if ($status != 'Activo') {
    $status = 'No activo';
  }

  $newEstudiante = new Estudiante();

  $newEstudiante->InitializeData(0, $_POST['nombre'], $_POST['apellido'], $_POST['carrera'], $status, $_POST['favs']);

  $service->Add($newEstudiante);


  header("Location: estudiantes.php");
  exit();
};



?>

<?php $layout->printHeader(true); ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Nuevo estudiante</h1>
  </div>

  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Crear nuevo estudiante
        </div>
        <div class="card-body">
          <form class="was-validated" enctype="multipart/form-data" action="nuevoEstudiante.php" method="POST">
            <div class="">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre de estudiante" name="nombre" required>
              </div>
              <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" placeholder="Apellido de estudiante" name="apellido" required>
              </div><br>
              <div class="form-group">
                <label for="carrera">Carrera</label>
                <select id="carrera" class="form-control" name="carrera" required>
                  <option value="" selected>Elegir...</option>
                  <?php foreach ($utilities->carrera as $carrera => $text) : ?>
                    <option value="<?php echo $carrera ?>"> <?php echo $text; ?> </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <p>Materias favoritas:</p>
                <textarea class="form-control" name="favs" rows="4" cols="70" wrap="off"></textarea>
              </div>

              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="status" name="status" value="Activo" checked>
                  <label class="form-check-label" for="status">
                    ¿Activo?
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="photo" class="float-left">Elegir foto de estudiante</label>
                <input type="file" class="form-control-file" id="photo" name="profilePhoto">
              </div>
            </div>


            <button type="submit" class="btn btn-primary float-right">Guardar</button>&nbsp;&nbsp;
            <a href="estudiantes.php" class="btn btn-secondary float-right" role="button" aria-pressed="true">Volver atras</a>

          </form>
        </div>
      </div>
    </div>
    <div class="col-md-3"></div>
  </div>


  </div>
</main>

<?php $layout->printFooter(true); ?>