<?php 

interface IServiceBase{
    public function GetByCodigo($codigo);
    public function GetList();
    public function Add($entity);
    public function Update($codigo,$entity);
    public function Delete($codigo);

}

?>