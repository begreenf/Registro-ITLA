<?php
require_once 'layout/layout.php';

$layout = New Layout(false);

session_start();

$_SESSION['estudiantes'] = isset($_SESSION['estudiantes'])? $_SESSION['estudiantes'] : array();

?>


<?php $layout->printHeader(); ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Bienvenido(a) al registro de estudiantes</h1>
  </div>

  <h2></h2>
  <div class="table-responsive">
    <img src="assets\img\insights-article-meeting-students-expectations-for-a-digital-campus.jpg" class="img-fluid" alt="">
  </div>
</main>
<?php $layout->printFooter(); ?>