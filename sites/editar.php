<?php
require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'estudiante.php';
require_once '../service/iServiceBase.php';
require_once 'EstudianteServiceCookies.php';

$layout = new Layout(true);
$service = new EstudianteServiceCookie();
$utilities = new Utilities();

if (isset($_GET['codigo'])) {



  $estudianteid = $_GET['codigo'];

  $element = $service->GetByCodigo($estudianteid);

  if (/*isset($_POST['codigo']) &&*/isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['carrera']) && isset($_POST['favs']) && isset($_FILES['profilePhoto'])) {

    $status = $_POST['status'];
    if ($status != 'Activo') {
      $status = 'No activo';
    };

    $updateEstudiante = new Estudiante();

    $updateEstudiante->InitializeData($estudianteid, $_POST['nombre'], $_POST['apellido'], $_POST['carrera'], $status, $_POST['favs']);

    $service->Update($estudianteid, $updateEstudiante);

    header("Location: estudiantes.php");
    exit();
  };
} else {

  header("Location: estudiantes.php");
  exit();
}





?>

<?php $layout->printHeader(true); ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edición de estudiante <?php echo $element->nombre . ' ' . $element->apellido ?></h1>
  </div>
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Editar estudiante
        </div>
        <div class="card-body">
          <form enctype="multipart/form-data" action="editar.php?codigo=<?php echo $element->codigo ?>" method="POST">
            <div class="">
              <div class="form-group">
                <label for="codigo">Codigo</label>
                <input type="numfmt_create" class="form-control" value="<?php echo $element->codigo ?>" placeholder="<?php echo $estudianteid; ?>" readonly>
              </div>

              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" value="<?php echo $element->nombre ?>" placeholder="Nombre de estudiante" name="nombre" required>
              </div>
              <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" value="<?php echo $element->apellido ?>" placeholder="Apellido de estudiante" name="apellido" required>
              </div><br>
              <div class="form-group">
                <label for="carrera">Carrera</label>
                <select id="carrera" class="form-control" name="carrera" required>
                  <?php foreach ($utilities->carrera as $carrera => $text) : ?>
                    <?php if ($carrera == $element->carrera) : ?>
                      <option selected value="<?php echo $carrera ?>"> <?php echo $text; ?> </option>
                    <?php else : ?>
                      <option value="<?php echo $carrera ?>"> <?php echo $text; ?> </option>
                    <?php endif; ?>

                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <p>Materias favoritas:</p>
                <textarea name="favs" class="form-control" rows="4" cols="70" wrap="off"><?php echo $element->favs; ?></textarea>
              </div>

              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="status" name="status" value="Activo" <?php if ($element->status == 'Activo') {
                                                                                                              echo 'checked';
                                                                                                            }
                                                                                                            ?>>
                  <label class="form-check-label" for="status">
                    ¿Activo?
                  </label>
                </div>
              </div>

              <tr style="line-height: 300%;">
                <td style="width: 5%; height: inherit;">

                  <?php if ($element->profilePhoto == "" || $element->profilePhoto == null) : ?>
                    <img width="70%" src="<?php echo "../assets/img/default.png" ?>" alt="" srcset="">

                  <?php else : ?>
                    <img width="70%" src="<?php echo "../assets/img/estudiantes/" . $element->profilePhoto; ?>">
                  <?php endif; ?>


                </td>

                <div class="form-group">
                  <label for="photo" class="float-left">Editar foto de estudiante</label>
                  <input type="file" class="form-control-file" id="photo" name="profilePhoto">
                </div>
              </tr>






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