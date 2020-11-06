<?php

class Estudiante
{

    public $codigo;
    public $nombre;
    public $apellido;
    public $carrera;
    public $status;
    public $favs;
    public $profilePhoto;

    private $utilities;

    public function __construct()
    {
        $this->utilities = new Utilities();
    }

    public function InitializeData($codigo, $nombre, $apellido, $carrera, $status, $favs)
    {
        $this->codigo = $codigo ;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->carrera = $carrera;
        $this->status = $status;
        $this->favs = $favs;
        
    }

    public function set($data){
        foreach($data as $key => $value) $this->{$key} = $value;
    }

    function getCarrera()
    {
        if($this->carrera != 0 && $this->carrera != null){
            return $this->utilities->carrera[$this->carrera];
        }
    }
}
