"option explicit";

var correoUser;
var regional; //variable para llamar regionales//
var llevaArchivo = "false";

$(document).ready(function () {
          eventoCargarDatosIntitucion(); //llama al procedimiento que esta al final
          $.extend($.validator.messages, {
            required: "Campo requerido"
          });
          $('[data-toggle="tooltip"]').tooltip();
          saveSession();
          validacionyEnvioForm();          

          $("#form_url_file").change(function (e) { 
            e.preventDefault();
            const nombre = e.target.files[0].name;
            //console.log(nombre);
            $("#lblFile").text(nombre);            
          });   

          // $("#divInicio").html('<a href="../server/login/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>')
          // $("#divUsuario").html('<i class="fas fa-user-alt"></i> '+correoUser)
          $("#divInfo").html('<a id="btnInicio" href="index.php" alt="Inicio"><i class= "fas fa-home"></i></a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="#" class="acerca-de" data-toggle="tooltip" title="Acerca de"> <i class="fas fa-info-circle"></i></a>');
          $("#divUsuario").html('<i class="fas fa-user-alt"></i><span class="usuario"> </span>'+correoUser);
          $("#divSalir").html('<a href="../server/login/logout.php" data-toggle="tooltip" title="Cerrar sesión"><i class="fas fa-sign-out-alt"></i></a>');
          cargaModalAcercaDe();  
          selectMediador();

          let consSelect = 'SELECT id, cod_pres, institucion FROM centro_educativo ORDER BY cod_pres';
          enviarFormDataAjax2( empaquetarConsulta(consSelect), cargarCentrosEducativos, "../server/consultas_generales.php"); 
  });
  
  function saveSession() {
    let tipo = sessionStorage.getItem("tipo");
    correoUser = sessionStorage.getItem("correo");
    $("#divInicio").html('<a href="../server/login/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>')
    $("#divUsuario").html('<i class="fas fa-user-alt"></i><span class="usuario"> Usuario: </span>'+correoUser)
  }

  function validacionyEnvioForm() {
      // Validación Formulario de Información General y llamado para INSERT O UPDATE
      var form = $( "#form_asesoria" );
      $("form").off("submit");
      $("form").on("submit", function(event) {
            event.preventDefault();
      });
      $.validator.addMethod("valueNotEquals", function(value, element, arg){
        //console.log("avalue", value,"arg", arg);        
        return arg !== value;
        }, "Inserta el nombre");
    
      form.validate({
        rules: { 
          form_medio : {
            required: true,
            valueNotEquals: "default",
          },
        },
        messages: {
            form_medio : {
              required: 'Por favor selecciona un medio de visita',
              valueNotEquals: "Por favor selecciona un medio de visita"
              },
          },
          errorPlacement: function(error, element) {
              if ( element.is(":input")) {
                  error.appendTo(element.parent("div").next("div"));
                }
                else { // This is the default behavior of the script for all fields
                    error.insertAfter( element );
                }
            }
         });
        $("#btn_asesorias").click(function () {
          if(form.valid()=== true){ 
           console.log("formulario valido");
                        
            agregarAsesoria();            

            $("#btn_asesorias").prop("disabled", true);
          }
          else {
              alertify.notify('El formulario no es válido.','warning',3, null);
              $("#btn_asesorias").prop("disabled", false);
          }
       });
    };
//---------------------------------------------------------//
//--------------------Obtener ID CE a mostrar--------------//
function obtenerIdCe() 
{
  //Obtiene el id del string centro educativo
  let str =  $("#form_idCE").val().split("[");             
  let res = str[1].slice(4);
  let idCe = res.slice(0, -1).trim();
  //console.log(idCe);  
  return idCe;
}

//---------------------Agrega la asesoría a la tabla------------------//
function agregarAsesoria() {
  //Verifica si hay archivo adjunto
  verificarArchivo();

  //Inicia el ajax loader 
  $(".div-shadow").removeClass("invisible");

  const idCe = obtenerIdCe();

//-------------------------//
var observacionesRegional = $("#form_recomendacionesDR").val();
if (observacionesRegional.length == 0) 
{
  observacionesRegional = "No aplica"
}
  let objFile = $("#form_url_file");
  let formData = new FormData();
  
  formData.append("id_CE", idCe );  
  formData.append("correo_asesor", $("#form_correoAsesor").val() );  
  formData.append("fecha", $("#form_fecha").val() ); 
  formData.append("medio_visita", $("#form_medio").val() );
  formData.append("tipo_atencion", $("#form_atencion").val() );
  formData.append("adquisicion_E", $("#form_adquisicion").val() );

  formData.append("objetivos", $("#form_objetivos").val() );
  formData.append("observaciones", $("#form_observaciones").val() );
  formData.append("recomendacion_asesor", $("#form_recomendaciones").val() );
  formData.append("recomendacion_dr",  observacionesRegional );
  

  formData.append("archivo", objFile[0].files[0] ); 
  formData.append("llevaArchivo", llevaArchivo); 

  //-----------------------//
  $.ajax
  ({
    url: "../server/agregar_asesoria.php",
    type: 'POST',
    data: formData,
    //dataType:'json',
    cache: false,
    contentType: false,
    processData: false,
    beforeSend: function()
    {
      console.log("En proceso");    
    }, success: function(response)
    {     
      $(".div-shadow").addClass("invisible");
                alertify
                  .alert("Tecnoaprender", "Datos enviados satisfactoriamente." , function()
                  {
                    console.log("ok"); 
                    window.location.href = "index.php";             
                  });
      console.log(response);
    
     }, error: function(response)
      {
        $(".div-shadow").addClass("invisible");    
        console.log("Error al enviar");
        alert (response.error)
        console.log(response.error);
        console.log(response.msj); 
        }
  });
}

function selectMediador () 
{
  $("#form_correoAsesor").val(correoUser);
}

function empaquetarConsulta(c) 
{ 
        var formData = new FormData();               
        formData.append("consulta", c );
        return formData;
}

function enviarFormDataAjax2  ( formData, mCallBack,  url) { 
    
  $.ajax({
    url: url,
    type: 'POST',
    data: formData,
    //dataType:'json',
    cache: false,
    contentType: false,
    processData: false,
    beforeSend: function(){
    console.log("En proceso");    
    }, success: function(response){
      console.log("Enviado satisfactoriamente");
      //console.log(response);
      mCallBack(response);      

    }, error: function(response){
      console.log("Error al enviar");
    //     console.log(response.error);
    //     console.log(response.msj);     
    }
  });
}

//----------------Cargar centros educativos--------------//
function cargarCentrosEducativos(stringArray) 
{
  //console.log("stringArray",stringArray);
  
  let data = JSON.parse(stringArray),
      availableCentros=[];
  // console.log(dataset);    
  //Renderiza el formulario de acuerdo al valor seleccionado por el usuario:
  const maxCentros = data.length;
  for (var index = 0; index < maxCentros; index++) 
  { 
    availableCentros.push( "(COD: " + data[index].cod_pres + ") -"+    data[index].institucion    +  "- [ID: " + data[index].id  + "]");
  }
  $( "#form_idCE").autocomplete(
  {
    source: availableCentros
  });
}

//-------------------------------------------------------//
//-------------Metodo manejador de Eventos---------------//
function eventoCargarDatosIntitucion()
{
 var  i=0, tmp, tmp2;
 
    console.log("eventoClic2");      
    $("#btnCargar").click(function () 
    {
      const idCe = obtenerIdCe();

      console.log("CE",idCe);  
      obtenerJson ("../server/obtener_datos_gestion.php?idCe="+idCe, function (arrayJson) 
      {
        console.log("Datos",arrayJson[0]);
        $("#form_DRegional").val(arrayJson[0].direccion_regional);
        $("#form_telefonoI").val(arrayJson[0].telefono);
        $("#form_pcorriente").val(arrayJson[0].tomas);
        $("#form_einstalacione").val(arrayJson[0].condicion_electrica);
        $("#form_plaq").val(arrayJson[0].plaqueo_equipo);
        $("#form_protocolo").val(arrayJson[0].protocolo_equipo);
        $("#form_aire_a").val(arrayJson[0].aire_acondicionado);

        //---------------se consulta el valor del campo de equipamiento------------------//
         if (arrayJson[i].equipamiento != "") 
         {
         tmp = JSON.parse( arrayJson[i].equipamiento );
         console.log("tmp:",tmp);   

         for (let index = 0; index < tmp.length; index++) 
         {
             let tmpChk =  document.getElementById( tmp[index].id );
             tmpChk.checked = tmp[index].chk;  
              
             if (tmpChk.checked == true)
             { 
               tmp2 = tmpChk.name;
               console.log("tmp2:",tmp2);
               switch (tmp2) 
               {

                case "chkfonatel":
                console.log("FONATEL");
                    obtenerJson2 ("../server/obtener_datos_equipo_fonatel.php?idCe="+idCe, function (arrayJson2)
                    { 
                      console.log("Datos:",arrayJson2[0]);
                      $("#form_soporte").val(arrayJson2[0].requiere_soporte);
                      $("#form_eequipo").val(arrayJson2[0].fonatel_estado); 
                    });
                   break;

                 case "chktransferencia":
                   console.log("TRANSFERENCIA");
                   obtenerJson2 ("../server/obtener_datos_equipo_transferencia.php?idCe="+idCe, function (arrayJson2)
                   { 
                     console.log("Datos:",arrayJson2[0]);
                     $("#form_soporte").val(arrayJson2[0].requiere_soporte);
                     $("#form_eequipo").val(arrayJson2[0].transferencia_estado); 
                   });
                  break;
                 case "chkconectandonos":
                   console.log("CONECTANDONOS");
                   obtenerJson2 ("../server/obtener_datos_equipo_conectandonos.php?idCe="+idCe, function (arrayJson2)
                   { 
                     console.log("Datos:",arrayJson2[0]);
                     $("#form_soporte").val(arrayJson2[0].requiere_soporte);
                     $("#form_eequipo").val(arrayJson2[0].conectandonos_estado); 
                   });
                  break;
                 case "chkdonacion":
                   console.log("DONACION");
                   obtenerJson2 ("../server/obtener_datos_equipo_donacion.php?idCe="+idCe, function (arrayJson2)
                   { 
                     console.log("Datos:",arrayJson2[0]);
                     $("#form_soporte").val(arrayJson2[0].requiere_soporte);
                     $("#form_eequipo").val(arrayJson2[0].donacion_estado); 
                   });
                  break;
               }
             }         
         }
       }
       else
       {
         console.log("esta vacío equipamiento");        
       }
      //----------------------------------------------------------------------------------//
      });
    })  
}

//----------------------------------//
//function renderizarEquipamientoFonatel(data, accion)
//{
// var equipamiento=[],
//      registros= false;

//   if(data.length !== 0)   {
//    registros = true;
//       $.each(data, function(i, field){
//         equipamiento.push(field);  
//         $("#form_soporte").val(equipamiento[0].requiere_soporte);
//       });
//   };
// }
//----------------------------------//
function obtenerJson (url, mCallback) 
{
  fetch(url)
  .then(function(response) 
  {
    return response.json();
  })

  .then(function(arrayJson) 
  {
    mCallback(arrayJson);
  }); 
}

//---------------------------------//
function obtenerJson2 (url, mCallback) 
{
  fetch(url)
  .then(function(response) 
  {
    return response.json();
  })

  .then(function(arrayJson2) 
  {
    mCallback(arrayJson2);
  }); 
}



//-------------------------------------------------------//
function camposVacios () {
  let isVacio = true;
  if (  $("#form_idCE").val( ) !=""   &&   $("#form_objetivos").val( ) != ""  )    {
    isVacio = false
  }
  return isVacio;  
}

function verificarArchivo  () {
  var objFile = $("#form_url_file");  
 //  console.log(objFile[0].files[0]);
   if (objFile[0].files[0] != undefined  ) {
    llevaArchivo = "true";     
   }
   
}