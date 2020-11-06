<?php 

require_once '../helpers/utilities.php';
require_once 'estudiante.php';
require_once '../service/iServiceBase.php';
require_once 'EstudianteServiceCookies.php';

$service = New EstudianteServiceCookie();

$isContainCodigo = isset($_GET['codigo']);

if($isContainCodigo){
    
    $estudianteid = $_GET['codigo'];

    $service->Delete($estudianteid);

}

header('Location: estudiantes.php');
exit();

?>