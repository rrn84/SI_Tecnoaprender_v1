<?php
  session_start();
  if(!isset($_SESSION["usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
  header("Location: ../../index.php");
  }
  if (isset($_GET['nombre'])) {
   $nombre=$_GET['nombre'];
   $codigo=$_GET['codigo'];
   $id=$_GET['id'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<link rel="stylesheet" href="../../vendor/bootstrap-4.1.3/css/bootstrap.min.css">

<link rel='stylesheet' href='../../lib/fontawesome/css/all.css'>
<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
<link rel="stylesheet" href="../../vendor/alertify/css/alertify.min.css">
<link rel="stylesheet" href="../../vendor/alertify/css/themes/default.css">

<link rel="stylesheet" href="../../css/style_forms.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">

<!-- <link rel="stylesheet" href="../../css/main.css"> -->
<link rel="stylesheet" href="../../css/style_forms.css">

<link rel="stylesheet" href="../../vendor/animate/animate.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js" charset="utf-8"></script>

<script src="../../vendor/jquery-3.4.1/jquery.min.js"></script>

<script src="../../vendor/bootstrap-4.1.3/js/bootstrap.min.js" charset="utf-8"></script>
<script src="../../vendor/dist/jquery.validate.js"></script>
<script src="../../vendor/dist/additional-methods.min.js"></script>
<script src="../../vendor/alertify/alertify.min.js"></script>
<script src="../../vendor/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

<script src="../../js/asesorias.js" charset="utf-8"></script>
<script  src="../../js/acercade.js"></script>

  <title>Asesoria</title>
</head>
  <body>

  <div class="row" id="encForm">
      <div class="col-sm-12">
        <div class="">
          <div class="d-flex flex-row">
            <div class="p-2 border-logo"><img class ="logo" src="../../images/logo-tecnoaprender.png" alt="logo tecnoaprender"></div>
            <div class="p-2 align-self-center"><span class="tit-header-opt">Agregar gestión educativa.</span></div>
            <!-- <div class="p-2 ml-auto logout"><a id="btnInicio" href="index.php"><i class= "fas fa-home"></i> Inicio</a></div> -->
            <div id="divInfo" class="p-2 ml-auto logout"></div>
          </div>
          <div class="d-flex justify-content-end">
            <div id="divUsuario" class="p-2 logout"></div>
            <div id="divSalir" class="p-2 logout"></div>
          </div>
        </div>
      </div>
</div> 
<br>
    <div class="container">    
      <div class="row">
        <div class="col-12">
            <span class="badge badge-secondary p-2">1. Datos administrativos de la visita</span>        
        </div>
      </div>
      
      <div class="row">        
          <div class="col-sm-4 form-group">
            <div class="input-group input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text">Centro Educativo</span>
              </div>
              <input id="form_idCE" name="form_idCE" type="text" name="miConsulta" class="form-control form-1" aria-label="Default" required placeholder="Escriba el nombre o cód presupuestario" >
            </div>
          <div class="error"></div>
      </div>
          
        
      <div class="col-sm-2">          
        <button id="btnCargar" type="button" class="btn btn-info m-1" alt = "Buscar" title="Buscar">Buscar <i class="fas fa-search"></i></button>
      </div>
<!---------------------------------------------------------------------------------------------------------------->

                    <div class=" col-sm-6 form-group">
                        <div class="input-group input-group-sm">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Correo del asesor</span>
                          </div>
                          <input id="form_correoAsesor" name="form_correoAsesor" type="text" class="form-control form-1" aria-label="Default" readonly >
                        </div>
                        <div class="error"></div>
                    </div>
        </div>

        <div class="row">


                  <div class="col-sm-6 form-group">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Dirección Regional</span>
                      </div>
                      <input id="form_DRegional" name="form_DRegional" type="text" class="form-control form-1" aria-label="Default" readonly >
                      </div>
                    <div class="error"></div>
                  </div>
                   
                    <div class="col-sm-2 form-group">
                      <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Teléfono  </span>
                        </div>
                        <input id="form_telefonoI" name="form_telefonoI" type="text" class="form-control form-1" aria-label="Default" readonly >
                      </div>
                    <div class="error"></div>
                  </div>

                  <div class=" col-sm-4 form-group">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Fecha de gestión</span>
                      </div>
                      <input id= "form_fecha" name= "form_fecha" type="date" class="form-control form-1" required placeholder="nombre.apellido.apellido@mep.go.cr">
                    </div>
                    <div class="error"></div>
                </div>
          </div>
            
          <div class="row">
                <div class="col-sm-6 form-group">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Tipo de gestión</span>
                    </div>
                    <select id ="form_medio" name="form_medio" class="form-control custom-select form-1" required>
                    <!-- <option value="default" selected>Seleccione...</option> -->
                      <option value="default" selected="true" disabled="disabled">Seleccione...</option>
                      <option value="Presencial">Presencial</option>
                      <option value="Correo">Correo electrónico</option>
                      <option value="Llamada">Llamada</option>
                      <option value="WhatsApp">WhatsApp</option>
                      <option value="Virtual_Teams">Virtual (Teams)</option>
                    </select>
                  </div>
                  <div class="error"></div>
                </div>           

                <div class="col-sm-6 form-group">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Tipo de atención</span>
                    </div>
                    <select id ="form_atencion" name="form_atencion" class="form-control custom-select form-1" required>
                      <!-- <option value="default" selected>Seleccione...</option> -->
                      <option value="default" selected="true" disabled="disabled">Seleccione...</option>
                      <option value="Pedagogica">Pedagógica</option>
                      <option value="Administrativa">Administrativa</option>
                      <option value="Técnica">Técnica</option>                          
                    </select>
                    </div>
                      <div class="error"></div>
                    </div>  
          </div>
     <hr>      
    </div>   
    <br>
<!-------------------------------------------Aqui comienza la segunda parte--------------------------------->
    <div class="container">    
      <div class="row">
         <div class="col-12">
             <span class="badge badge-secondary p-2">2.	Datos administrativos</span>        
         </div>
      </div>
    
      <div class="row">
          <div class="col-sm-8 form-group">
              <div class="input-group input-group-sm">
                 
                  <div class="col-sm-3" >
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input form-1 chk-equipamiento" id="chkfonatel" name="chkfonatel" readonly disabled="false">
                        <label class="custom-control-label" for="chkfonatel">MEP-Fonatel</label>
                      </div>
                    </div>
                  
                  <div class="col-sm-3" >
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input form-1 chk-equipamiento" id="chktransferencia" name="chktransferencia" readonly disabled="false">
                        <label class="custom-control-label" for="chktransferencia">Transferencia</label>
                      </div>   
                  </div>

                  <div class="col-sm-3" >
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input form-1 chk-equipamiento" id="chkconectandonos" name="chkconectandonos" readonly disabled="false">
                        <label class="custom-control-label" for="chkconectandonos">Conectándonos</label>
                      </div>                  
                  </div>

                  <div class="col-sm-3" >
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input form-1 chk-equipamiento" id="chkdonacion" name="chkdonacion" readonly disabled="false">
                        <label class="custom-control-label" for="chkdonacion">Donación</label>
                      </div>
                  </div>

              </div>
              <div class="error"></div>
          </div>
        </div>

        <div class="row">
              <div class="col-sm-4 form-group">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Estado actual del equipo</span>
                    </div>
                    <select id ="form_eequipo" name="form_eequipo" class="form-control custom-select form-1" readonly disabled="true">
                      <!-- <option value="default" selected>Seleccione...</option> -->
                        <option value="0" selected="true" disabled="disabled">Seleccione...</option>
                        <option value="1">EXCELENTE</option>
                        <option value="2">BUENO</option>
                        <option value="3">REGULAR</option>
                        <option value="4">MALO</option>
                    </select>
                  </div>
                  <div class="error"></div>
                </div>           
      </div>
      <br>
<!------------------------------------------------SI/NO---------------------------------------------------------->     
      <div class="row">
          <div class="col-sm-4 form-group">
            <div class="input-group input-group-sm">
               <div class="input-group-prepend">
                  <span class="input-group-text">¿Está plaqueado el equipo?  </span>
               </div>
               <select id ="form_plaq" name="form_plaq" class="form-control custom-select form-1" readonly disabled="false">
               <!-- <option value="default" selected>Seleccione...</option> -->
                  <option value="0" selected="true" disabled="disabled">Seleccione...</option>
                  <option value="1">Si</option>
                  <option value="2">No</option>
                </select>
              </div>
              <div class="error"></div>
          </div> 

          <div class="col-sm-4 form-group">
            <div class="input-group input-group-sm">
               <div class="input-group-prepend">
                  <span class="input-group-text">¿Posee protocolo de uso?  </span>
               </div>
               <select id ="form_protocolo" name="form_protocolo" class="form-control custom-select form-1" readonly disabled="false">
               <!-- <option value="default" selected>Seleccione...</option> -->
                  <option value="0" selected="true" disabled="disabled">Seleccione...</option>
                  <option value="1">Si</option>
                  <option value="2">No</option>
                </select>
            </div>
            <div class="error"></div>
          </div>

          <div class="col-sm-4 form-group">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text">¿Requiere soporte? </span>
                    </div>
                    <select id ="form_soporte" name="form_soporte" class="form-control custom-select form-1" readonly disabled="false">
                    <!-- <option value="default" selected>Seleccione...</option> -->
                      <option value="default" selected="true" disabled="disabled">Seleccione...</option>
                      <option value="1">Si</option>
                      <option value="2">No</option>
                    </select>
                  </div>
                <div class="error"></div>
              </div> 
      </div> 
      <br>
      
      <div class="row">

                <div class="col-sm-4 form-group">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Estado de la instalación eléctrica</span>
                    </div>
                    <select id ="form_einstalacione" name="form_einstalacione" class="form-control custom-select form-1" readonly disabled="true">
                      <option value="0" selected>Seleccione</option>
                      <option value="1">Pésimo</option>
                      <option value="2">Malo</option>
                      <option value="3">Regular</option>
                      <option value="4">Bueno</option>
                      <option value="5">Excelente</option>
                    </select>
                  </div>
                  <div class="error"></div>
                </div>       

                <div class="col-sm-4 form-group">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                     <span class="input-group-text" for="form_pcorriente">¿Están polarizados los tomacorrientes?</span>
                    </div>
                    <select id ="form_pcorriente" name="form_pcorriente" class="form-control custom-select form-1" readonly disabled="false">
                      <option value="0" selected="true" disabled="disabled">Seleccione...</option>
                      <option value="1">Si</option>
                      <option value="2">No</option>
                    </select>
                </div>
                <div class="error"></div>
              </div>

              <div class="col-sm-4 form-group">
              <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                  <span class="input-group-text" for="form_aire_a">¿Cuenta con aire acondicionado?</span>
                </div>
                <select id ="form_aire_a" name="form_aire_a" class="form-control custom-select form-1" readonly disabled="false">
                  <option value="0" selected="true" disabled="disabled">Seleccione...</option>
                  <option value="1">Si</option>
                  <option value="2">No</option>
                </select>
                </div>
                <div class="error"></div>
            </div> 
        </div> 
      <hr>  
      </div>
      </div>
      </div>
      <br>
<!--------------------------------------------Aqui comienza la tercera parte-------------------------------->              
<div class="container">    
    <div class="row">
      <div class="col-12">
          <span class="badge badge-secondary p-2">3.	Objetivos </span>        
      </div>
    </div>

    <form  id="form_asesoria" name="form_asesoria" >
              <!--Objetivos -->
        <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <span class="badge badge-secondary p-2">3.1 Objetivos de la gestión:</span>
                    <textarea class="form-control" id="form_objetivos" name="form_objetivos" rows="3" required></textarea>
                  </div>
                  <div class="error"></div>    
                </div>
        </div>
  <hr>
</div>
<br>
<!--------------------------------------------Aqui comienza la cuarta parte-------------------------------->              
<div class="container">    
    <div class="row">
      <div class="col-12">
          <span class="badge badge-secondary p-2">4.	Observaciones y recomendaciones </span>        
      </div>
    </div>
    <form  id="form_asesoria" name="form_asesoria" >
              <!--Objetivos -->

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <span class="badge badge-secondary p-2">4.1 Observaciones</span>
                    <textarea class="form-control" id="form_observaciones" name="form_observaciones" rows="3" required></textarea>
                  </div>
                  <div class="error"></div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <span class="badge badge-secondary p-2">4.2 Recomendaciones</span>
                    <textarea class="form-control" id="form_recomendaciones" name="form_recomendaciones" rows="3" required></textarea>
                  </div>
                  <div class="error"></div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <span class="badge badge-secondary p-2">4.3 Recomendación otros participantes.</span>
                    <textarea class="form-control" id="form_recomendacionesDR" name="form_recomendacionesDR" rows="3"></textarea>
                  </div>
                  <div class="error"></div>
                </div>
              </div>
            <hr> 
            </div><!--Cierre segundo contenedor-->
            <br>            

    <div class="container">    
      <div class="row">
        <div class="col-12">
          <span class="badge badge-secondary p-2">5. Archivos complementarios</span>        
        </div>
      </div>

              <div class="row">                  
                 <div class="container">
                    <span class="badge badge-secondary p-2"></span><!--Ojo lo deje sin texto-->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="lblInputFile">Archivo</span>
                        </div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="form_url_file" aria-describedby="lblInputFile" name="form_url_file"  >
                          <label class="custom-file-label" id="lblFile" for="form_url_file">Clic para ajuntar archivo (No debe sobrepasar los 2 MB) </label>
                        </div>
                    </div>
                    <div class="error"></div>
                  </div>
              </div>

              <div class="row">
                <button id="btn_asesorias" name ="form-1" type="submit" class="btn btn-enviar form-1" alt = "Guardar" title="Guardar"><i class='fas fa-save' style='font-size:40px'></i></button>
              </div>
              <div class="error"></div>
    </form>
    
  </div>

  <div class="div-shadow invisible">
      <img class="img-ajax-loading" src="../../images/ajax-loader.gif" alt="Loading">
  </div>
  <div class="modal animated" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>      

<!---->
<?php
      if (isset($_GET['nombre'])) { ?>
        <script type="text/javascript">
        
          var nombre = '<?php echo $nombre;?>'
          var codigo = '<?php echo $codigo;?>'
          var id = '<?php echo $id;?>'
          var completo = "(COD: "+codigo+") -"+nombre+"- [ID: "+id+"]";
          console.log(completo);
          $("#miConsulta").val(completo);
          setTimeout(
              function() 
              {
                $("#btnSend").trigger("click");
              }, 1000);
          
        </script>
         <?php 
         }
      ?>
<!---->

</body>
</html>
