"option explicit";

var correoUser;
var regional; //variable para llamar regionales//
var llevaArchivo = "false";
var listaProyectos;
var tipoBusqueda = 1;

$(document).ready(function () {
  ocultarElementosFormulario();
  $('#Otros').hide(); 
  $("#btn_asesorias").prop("disabled", true);
  
  $('#form_Funcionario').on('change', function (){
    var funcionarioS= $('select[id=form_Funcionario]').val();
    if (funcionarioS=="Otro"){
      $('#Otros').show(); 
    }else {
      $('#Otros').hide(); 
    }
});

  
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

          $("input[name=tipoBusqueda]").change(function(){
            if ($("input[name='tipoBusqueda']:checked").val() == 'CE') {
              tipoBusqueda = 1;
              document.getElementById("tituloBusqueda").innerText = "Centro Educativo";
              consSelect = 'SELECT id, cod_pres, institucion FROM centro_educativo ORDER BY cod_pres';
              
          }else {
            tipoBusqueda = 2;
            document.getElementById("tituloBusqueda").innerText = "Dirección Regional";
            consSelect = 'SELECT id, nombre FROM direcciones_regionales ORDER BY id';
          }
          $("input[name=form_idCE]").val("");
          $("input[name=form_DRegional]").val("");
          $("input[name=form_telefonoI]").val("");
          
          enviarFormDataAjax2( empaquetarConsulta(consSelect), cargarCentrosEducativos, "../server/consultas_generales.php"); 
          });

 

      
  });

  
  function ocultarElementosFormulario(){
    $('#form_asesoria select').attr("disabled", "enabled");
    $('#form_asesoria textarea').attr("disabled", "disabled");
    $('#form_asesoria input').attr("disabled", "disabled");
  }

  function mostrarElementosFormulario(){
    $("input").removeAttr("disabled");
    $("textarea").removeAttr("disabled");
    $("select").removeAttr("disabled");
  }

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
  try {
  //Obtiene el id del string centro educativo
  let str =  $("#form_idCE").val().split("[");         
  let res = str[1].slice(4);   
  let idCe = res.slice(0, -1).trim();
  
  return idCe;
  }
  catch (e) {
    alertify.alert('Gestión Educativa','Seleccione un código de centro educativo correcto');
  }
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
  let funcionarioS =  $("#form_Funcionario").val();
  
  formData.append("id_CE", idCe );  
  formData.append("correo_asesor", $("#form_correoAsesor").val() );  
  formData.append("fecha", $("#form_fecha").val() );
  formData.append("tipo_visita", tipoBusqueda);
  formData.append("medio_visita", $("#form_medio").val() );
  formData.append("tipo_atencion", $("#form_atencion").val() );
  formData.append("adquisicion_E", $("#form_adquisicion").val() );

  if (funcionarioS=="Otro"){
  formData.append("funcionario", $("#otros_especif").val() );
  }else {
    formData.append("funcionario", funcionarioS );
  }

  formData.append("proyecto_id", $("#form_Proyectos").val() );
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
       // console.log("Esto es aquí", formData);   
        return formData;
}

function enviarFormDataAjax2  ( formData, mCallBack,  url) { 
    //console.log("Si". url);
  $.ajax({
    url: url,
    type: 'POST',
    data: formData,
    //dataType:'json',
    cache: false,
    contentType: false,
    processData: false,
    beforeSend: function(){
   // console.log("En proceso");    
    }, success: function(response){
      //console.log("Enviado satisfactoriamente");
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
  if (tipoBusqueda == 1){
  for (var index = 0; index < maxCentros; index++) 
  { 
    availableCentros.push( "(COD: " + data[index].cod_pres + ") -"+    data[index].institucion    +  "- [ID: " + data[index].id  + "]");
  }
}else {
  for (var index = 0; index < maxCentros; index++) 
  { 
    availableCentros.push( "(REGIONAL: "+    data[index].nombre    +  "- [ID: " + data[index].id  + "]");
  }
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
         
    $("#btnCargar").click(function () 
    {

      const idCe = obtenerIdCe();

      $("#form_asesoria input[type=checkbox]").prop("checked", false); 

     // console.log("CE",idCe);  
     if (tipoBusqueda==1){
      obtenerJson ("../server/obtener_datos_gestion.php?tipo=1&idCe="+idCe, function (arrayJson) 
      {
       
       // console.log("Datos",arrayJson[0]);
        $("#form_telefonoI").val(arrayJson[0].telefono);
        $("#form_DRegional").val(arrayJson[0].direccion_regional);
        $("#form_pcorriente").val(arrayJson[0].tomas);
        $("#form_einstalacione").val(arrayJson[0].condicion_electrica);
        $("#form_plaq").val(arrayJson[0].plaqueo_equipo);
        $("#form_protocolo").val(arrayJson[0].protocolo_equipo);
        $("#form_aire_a").val(arrayJson[0].aire_acondicionado);

      });
    }else {
      
      obtenerJson ("../server/obtener_datos_gestion.php?tipo=2&idCe="+idCe, function (arrayJson) 
      {
       
        $("#form_DRegional").val(arrayJson[0].nombre);
        $("#form_telefonoI").val(arrayJson[0].telefono);

      });
    }

      $('option', '#form_Proyectos').remove();
      
      $('#form_Proyectos').append($('<option>', {
        value: "default",
        text: "Seleccione...",
        selected: true,
        disabled: "disabled"
      }));

      cargaFormProyectos(idCe);
      mostrarElementosFormulario();
    })  

 
}

function cargaProyectos(mCallBack,codigoP) {

  let tabla="iniciativas",
      url= "../server/obtener_datos.php?tipo=0&id="+codigoP+"&tabla="+tabla; 

      fetch( url)
      .then(response => response.json())
      .then(data => { 
        
        mCallBack (data);            
      })
      .catch( 
        error => {
          // aquí
          console.error(error)
        })   
      
}


function renderizarProyectos(data) {
  if(data.length !== 0)   {
             
      $('#form_Proyectos').append($('<option>', {
        value: data[0].id,
        text: data[0].nombre
      }));

  }
};

function renderizarProyectosRegionales(data) {

  var proyecto=[];
     
  if(data.length !== 0)   {
    
    $.each(data, function(i, field){
      proyecto.push(field);  
      
      $('#form_Proyectos').append($('<option>', {
        value: proyecto[i].id,
        text: proyecto[i].nombre
      }));    
    });

    $("#btn_asesorias").prop("disabled", false);

  }else {
    $("#btn_asesorias").prop("disabled", true);
  }
};

function cargaFormProyectos(codigoCE) {
  let tabla="proyectos", url
  // llena el formulario2 Proyectos
  if (tipoBusqueda==1){
    $('#proyectosList').show(); 
    url= "../server/obtener_datos.php?tipo=0&id="+codigoCE+"&tabla="+tabla;  
    cargarJsonProyectos(renderizarFormProyectos, url);
  }else {
    $('#proyectosList').hide(); 
    tabla="iniciativas"
    url= "../server/obtener_datos.php?tipo=2&id="+codigoCE+"&tabla="+tabla;  
    cargarJsonProyectos(renderizarProyectosRegionales, url);
  }
      //console.log("esto es", url);

}


function renderizarFormProyectos(data) {
  var proyecto=[];

  if(data.length !== 0)   {
    $.each(data, function(i, field){
      proyecto.push(field);  
      
      let id_iniciativa = proyecto[i].id_iniciativa;
      $("#"+id_iniciativa+"").prop("checked", true);
      cargaProyectos(renderizarProyectos,id_iniciativa);     
    });

    $("#btn_asesorias").prop("disabled", false);
  }
  else {
     alertify.alert('Gestión Educativa','Es necesario actualizar los proyectos TecnoAprender del centro educativo');
     $("#btn_asesorias").prop("disabled", true);
  }
 
  //formaBotonEnviar(formulario,registros);
};

function cargarJsonProyectos ( mCallBack,url  ) {
 
  fetch( url)
         .then(response => response.json())
         .then(data => { 

             mCallBack (data);                
         })
         .catch( 
           error => {
             // aquí
             console.error(error)
           })                 
};

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