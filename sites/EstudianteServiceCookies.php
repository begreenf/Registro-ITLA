<?php

class EstudianteServiceCookie implements IServiceBase
{
    private $utilities;
    private $cookieName;

    public function __construct()
    {
        $this->utilities = new Utilities();
        $this->cookieName = 'estudiantes';
    }

    public function GetList()
    {
        $ListadoEstudiantes = array();

        if (isset($_COOKIE[$this->cookieName])) {
            $ListadoEstudiantesDecode = json_decode($_COOKIE[$this->cookieName], false);

            foreach ($ListadoEstudiantesDecode as $elementDecode) {
                $element = new Estudiante();
                $element->set($elementDecode);

                array_push($ListadoEstudiantes, $element);
            }
        } else {
            setcookie($this->cookieName, json_encode($ListadoEstudiantes), $this->utilities->GetCookieTime(), "/");
        }
        return $ListadoEstudiantes;
    }




    public function GetByCodigo($codigo)
    {
        $ListadoEstudiantes = $this->GetList();
        $estudiante = $this->utilities->searchProperty($ListadoEstudiantes, 'codigo', $codigo)[0];
        return $estudiante;
    }

    public function Add($entity)
    {
        $ListadoEstudiantes = $this->GetList();
        $estudianteid = 1;

        if (!empty($ListadoEstudiantes)) {
            $lastEstudiante = $this->utilities->getLastElement($ListadoEstudiantes);
            $estudianteid = $lastEstudiante->codigo + 1;
        }
        $entity->codigo = $estudianteid;
        $entity->profilePhoto = "";

        if (isset($_FILES['profilePhoto'])) {

            $photoFile = $_FILES['profilePhoto'];

            if ($photoFile['error'] == 4) {
                $entity->profilePhoto = "";
            } else {
                $typeReplace = str_replace("image/", "", $_FILES['profilePhoto']['type']);
                $type = $photoFile['type'];
                $size = $photoFile['size'];
                $name = $estudianteid . '.' . $typeReplace;
                $tmpname = $photoFile['tmp_name'];

                $success = $this->utilities->uploadImage('../assets/img/estudiantes/', $name, $tmpname, $type, $size);
                if ($success) {
                    $entity->profilePhoto = $name;
                }
            }
        }

        array_push($ListadoEstudiantes, $entity);

        setcookie($this->cookieName, json_encode($ListadoEstudiantes), $this->utilities->GetCookieTime(), "/");
    }

    public function Update($codigo, $entity)
    {
        $element = $this->GetByCodigo($codigo);
        $ListadoEstudiantes = $this->GetList();

        $elementIndex = $this->utilities->getIndexElement($ListadoEstudiantes, 'codigo', $codigo);

        if (isset($_FILES['profilePhoto'])) {

            $photoFile = $_FILES['profilePhoto'];

            if ($photoFile['error'] == 4) {
                $entity->profilePhoto = $element->profilePhoto;
            } else {
                $typeReplace = str_replace("image/", "", $_FILES['profilePhoto']['type']);
                $type = $photoFile['type'];
                $size = $photoFile['size'];
                $name = $codigo . '.' . $typeReplace;
                $tmpname = $photoFile['tmp_name'];

                $success = $this->utilities->uploadImage('../assets/img/estudiantes/', $name, $tmpname, $type, $size);
                if ($success) {
                    $entity->profilePhoto = $name;
                }
            }
        }

        $ListadoEstudiantes[$elementIndex] = $entity;

        setcookie($this->cookieName, json_encode($ListadoEstudiantes), $this->utilities->GetCookieTime(), "/");
    }

    public function Delete($codigo)
    {
        $ListadoEstudiantes = $this->GetList();

        $elementIndex = $this->utilities->getIndexElement($ListadoEstudiantes, 'codigo', $codigo);

        unset($ListadoEstudiantes[$elementIndex]);

        $ListadoEstudiantes = array_values($ListadoEstudiantes);

        setcookie($this->cookieName, json_encode($ListadoEstudiantes), $this->utilities->GetCookieTime(), "/");
    }
}
