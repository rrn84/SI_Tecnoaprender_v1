<?php
session_start();
if(!isset($_SESSION["usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
      header("Location: ../../index.php");
  }
  //  elseif ($_SESSION['tipo'] !== 1) {  //debe ser tipo administrador
  //        header("Location: ../../index.php");
  //      }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reportes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>   
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> 
    <script src=" https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="../../js/reporteUsos.js"></script>
    <script  src="../../js/acercade.js"></script>
    <script src="../../vendor/moment-with-locales.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../../vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/style_forms.css">
    
    <style>
        tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
    .buscador{
        visibility:hidden;
    }
    .margen-izq{
    margin-left: 34px;
  }
  .marcadores{
      color:#554835;
      font-size:12px;
      font-weight: bold;
  }
    </style>


</head>
<body>  
    <div class="row" id="encForm">
        <div class="col-sm-12">
            <div class="">
            <div class="d-flex flex-row">
                <div class="p-2 border-logo"><img class ="logo" src="../../images/logo-tecnoaprender.png" alt="logo tecnoaprender"></div>
                <div class="p-2 align-self-center"><span class="tit-header-opt">Reporte de usos por materia</span></div>
                <div id="divInfo" class="p-2 ml-auto logout"></div>
                <!-- <div class="p-2 ml-auto logout"><a id="btnInicio" href="index.php"><i class= "fas fa-home"></i> Inicio</a></div> -->
            </div>
            <div class="d-flex justify-content-end">
                <div id="divUsuario" class="p-2 logout"></div>
                <div id="divSalir" class="p-2 logout"></div>
            </div>
            </div>
        </div>
    </div> 

        <form id="criterios">

    <table class="table table-bordered">
<tbody>
<tr>
<th colspan="4">Seleccione las materias</th>

</tr>
<tr>
    <td>
        <input type="checkbox" style="visibility:hidden" name="columnas" value="cod_pres" checked>
        <input type="checkbox" style="visibility:hidden" name="columnas" value="institucion" checked>
        <input type="checkbox" class="mat-basicas" name="columnas" value="uso_est"> Estudios Sociales<br>
        <input class="margen-izq mat-basicas" type="checkbox" name="columnas" value="uso_mat"> Matemáticas<br>
        <input class="margen-izq mat-basicas" type="checkbox" name="columnas" value="uso_cie"> Ciencias <br>
        <input class="margen-izq mat-basicas" type="checkbox" name="columnas" value="uso_esp"> Español<br>
        <input class="margen-izq mat-basicas" type="checkbox" name="columnas" value="uso_ing"> Ingles<br>
         <br>  
        <br> 
        <div><input  type="checkbox" id="selectall1"><span class="marcadores"> Todas/Ninguna</span></div>

    </td>
    <td>
        <input class="margen-izq mat-sec"  type="checkbox" name="columnas" value="uso_bio"> Biología<br>
        <input class="margen-izq mat-sec"  type="checkbox" name="columnas" value="uso_fis"> Física<br>
        <input class="margen-izq mat-sec"  type="checkbox" name="columnas" value="uso_qui"> Química<br>
        <input class="margen-izq mat-sec"  type="checkbox" name="columnas" value="uso_civ"> Cívica<br>
        <br>  
        <br> 
        <div><input type="checkbox" id="selectall"> <span class="marcadores"> Todas/Ninguna</span></div>
    
        
    </td>
    <td>
        <input class="margen-izq mat-esp" type="checkbox" name="columnas" value="uso_apl"> Artes Plásticas<br>
        <input class="margen-izq mat-esp" type="checkbox" name="columnas" value="uso_ain"> Artes Industriales<br>
        <input class="margen-izq mat-esp" type="checkbox" name="columnas" value="uso_eph"> Educación para el Hogar<br>
        <input class="margen-izq mat-esp" type="checkbox" name="columnas" value="uso_mus"> Música<br>
        <input class="margen-izq mat-esp" type="checkbox" name="columnas" value="uso_rel"> Religión<br>
        <br>  
        <div><input type="checkbox" id="selectall3"><span class="marcadores"> Todas/Ninguna</span></div>
    </td>
    <td> 
        <input class="margen-izq mat-otras" type="checkbox" name="columnas" value="uso_bib"> Biblioteca<br>
        <input class="margen-izq mat-otras" type="checkbox" name="columnas" value="uso_bib_cra"> BIBLIOCRA<br>
        <input class="margen-izq mat-otras" type="checkbox" name="columnas" value="uso_bib_digital"> Biblioteca digital<br>
        <input class="margen-izq mat-otras" type="checkbox" name="columnas" value="uso_incluir_plan_vocacional"> Plan de estudios vocacional<br>
        <input class="margen-izq mat-otras" type="checkbox" name="columnas" value="uso_incluir_modulos_cindea_ipec"> CINDEA e IPEC<br>
        <input type="checkbox" style="visibility:hidden" name="columnas" value="fecha_actualizacion" checked>
        
        <div><input type="checkbox" id="selectall4"><span class="marcadores"> Todas/Ninguna</span></div>
    </td>

    
</tr>

</tbody>

</table>    
<div id="contenedorBoton">
    <input type="button" class="btn btn-info" onclick="crearArreglo()" value="Generar informe"> <br> <br>  
</div>
       
</form>
    <div id="resultado">
        <div id="alerta" style="visibility:hidden" class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Atención: </strong> Debe seleccionar al menos una materia para generar un informe.
        </div>
    </div>

    <div class="modal animated" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>

</body>
</html>