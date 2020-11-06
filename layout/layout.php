<?php

class Layout{

  private $isPage;
  private $directory;

  function __construct($page)
  {
    $this->isPage = $page;

    $this->directory = ($this->isPage)? "../": "";
  }


  public function printHeader(){
      $header = <<<EOF
  
  
      <!doctype html>
  <html lang="en">
  
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Registro</title>
  
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">
  
    <link href="{$this->directory}assets/css/libreria/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{$this->directory}assets/css/style.css" rel="stylesheet" type="text/css">
  </head>
  
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="{$this->directory}index.php">Universidad PHP</a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </nav>
  
    <div class="container-fluid">
      <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
          <div class="sidebar-sticky pt-3">
            <ul id="navigation" class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="{$this->directory}index.php">
                  <span data-feather="home"></span>
                  Home <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{$this->directory}sites/estudiantes.php">
                  <span data-feather="file"></span>
                  Estudiantes
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{$this->directory}sites/nuevoEstudiante.php">
                  <span data-feather="file"></span>
                  Nuevo Estudiante
                </a>
              </li>
            </ul>
          </div>
        </nav>
  
  EOF;
  
  echo $header;
  }
  
  public function printFooter(){
  
      $footer = <<<EOF
  
      </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="{$this->directory}assets/js/libreria/bootstrap/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
      <script src="{$this->directory}assets/js/index.js"></script>
      <script>
      $(document).ready(function() {
        var selector = '.nav-item a';
        $(selector).on('click', function(){
          $(selector).removeClass('active');
          $(this).addClass('active');
        });
      });
      </script>
    </body>
    
    </html>
  
  EOF;
  
  echo $footer;
  }

}


?>