var arregloDatos=[];
var arregloProyectos=[];
var tipoBusqueda = 1;
var idCEDR=0;

$(document).ready(function () {
  saveSession(); 
  $("#divInfo").html('<a id="btnInicio" href="../admin/index.php" alt="Inicio"><i class= "fas fa-home"></i></a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="#" class="acerca-de" data-toggle="tooltip" title="Acerca de"> <i class="fas fa-info-circle"></i></a>');
  $("#divUsuario").html('<i class="fas fa-user-alt"></i><span class="usuario"> </span>'+correoUser);
  $("#divSalir").html('<a href="../server/login/logout.php" data-toggle="tooltip" title="Cerrar sesión"><i class="fas fa-sign-out-alt"></i></a>');
  cargaModalAcercaDe();  
  cargarProyectos();

  $("#btn-exportar").click(function (e) { 
          e.preventDefault();
          exportPDF();   
    });
    
    $(function() {   
//      console.log("clic");
      $(".btn-exportar-doc").click(function(event) {
          $("#visorAsesorias").wordExport();          
      });
    });

eventoCargarDatosIntitucion(); 
    

$('[data-toggle="tooltip"]').tooltip();

let consSelect = 'SELECT id, cod_pres, institucion FROM centro_educativo ORDER BY cod_pres';
enviarFormDataAjax2( empaquetarConsulta(consSelect), cargarCentrosEducativos, "../server/consultas_generales.php"); 

$("input[name=tipoBusqueda]").change(function(){
  if ($("input[name='tipoBusqueda']:checked").val() == 'CE') {
    tipoBusqueda = 1;
    consSelect = 'SELECT id, cod_pres, institucion FROM centro_educativo ORDER BY cod_pres';
    
}else {
  tipoBusqueda = 2;
  consSelect = 'SELECT id, nombre FROM direcciones_regionales ORDER BY id';
}

$("input[name=form_idCE]").val("");

enviarFormDataAjax2( empaquetarConsulta(consSelect), cargarCentrosEducativos, "../server/consultas_generales.php"); 
});

});

function empaquetarConsulta(c) 
{ 
        var formData = new FormData();            
        formData.append("consulta", c );
       // console.log("Esto es aquí", formData);   
        return formData;
}

function cargarCentrosEducativos(stringArray) 
{
    
  let data = JSON.parse(stringArray),
      availableCentros=[];
   //console.log(data);    
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

function enviarFormDataAjax2  ( formData, mCallBack,  url) { 
  //console.log("Si-funciona". url);
$.ajax({
  url: url,
  type: 'POST',
  data: formData,
  //dataType:'json',
  cache: false,
  contentType: false,
  processData: false,
  beforeSend: function(){
  //console.log("En proceso");    
  }, success: function(response){
    //console.log("Enviado satisfactoriamente");
    //console.log(response);
    mCallBack(response);      

  }, error: function(response){
    console.log("Error al enviar");   
  }
});
}

function eventoCargarDatosIntitucion()
{ 
         
    $("#btnCargar").click(function () 
    {
      document.getElementById("visor").innerHTML=null;

      if (tipoBusqueda == 1){
      idCEDR = obtenerIdCe();
      }else {
        if (tipoBusqueda == 2){
          idCEDR = obtenerNombreRegional();
          }
      }
      cargarApp();
     // console.log(idCe);
    });

 
}
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
    alertify.alert('Gestión Educativa','Seleccione un código de centro educativo o dirección regional correcto');
  }
}

function obtenerNombreRegional() 
{
  try {
  //Obtiene el id del string centro educativo
  let str =  $("#form_idCE").val().split("[");         
  let res = str[0].slice(11);   
  let idCe = res.slice(0, -2).trim();
  //console.log(idCe);
  return idCe;
  }
  catch (e) {
    alertify.alert('Gestión Educativa','Seleccione un código de centro educativo o dirección regional correcto');
  }
}

  
function saveSession() {
  let tipo = sessionStorage.getItem("tipo");
  correoUser = sessionStorage.getItem("correo"); 
}  
  
  function cargarApp(){
  //CArga el ajax loader    
  $(".div-shadow").removeClass("invisible");

  if (tipoBusqueda==1){
  const data = new FormData();
   url= "../server/consultar_asesorias.php?id_CE="+idCEDR+"&correo=x&tipo_usr=10";
   
   fetch( url)
      .then(function(response) {
          return response.json();
      })
      .then(function(myJson) {
        if (myJson.length>0) {
        arregloDatos = myJson;
        dibujarTabla (myJson, '#visor');
        $(".div-shadow").addClass("invisible");
        }else {
          $("#visor").append("<br><br><h2>No se ha encontrado información.</h2>");
          $(".div-shadow").addClass("invisible");
        }      
    })
  }else {

    if (tipoBusqueda==2){
      const data = new FormData();
       url= "../server/consultar_asesorias.php?id_CE="+idCEDR+"&correo=x&tipo_usr=11";
       //console.log(url);
       fetch( url)
          .then(function(response) {
              return response.json();
          })
          .then(function(myJson) {
            if (myJson.length>0) {
            arregloDatos = myJson;
            dibujarTabla (myJson, '#visor');
            $(".div-shadow").addClass("invisible");
            }else {
              $("#visor").append("<br><br><h2>No se ha encontrado información.</h2>");
              $(".div-shadow").addClass("invisible");
            }      
        })
      }
  }
    }  
  
    function cargarProyectos(){
      url= '../server/obtener_proyectosConsulta.php';
       fetch( url)
          .then(function(response) {
              return response.json();
          })
          .then(function(myJson) {
              
              arregloProyectos=myJson;       
          })
        }  


        function verificarProyecto(id){
         
          let nombreProyecto = "Sin asignar";

          for (let index = 0; index < arregloProyectos.length; index++) {
            if (arregloProyectos[index].id == id  ) {
              return nombreProyecto = arregloProyectos[index].nombre;
            }
          }

          return nombreProyecto;
           }  


  function mostrarDetalle(id, array) 
    {
        
      $("#visorAsesorias").empty(); 
        for (let index = 0; index < array.length; index++) {
          if (array[index].id_visita == id  ) {
            $("#visorAsesorias").append("<span class='t1'><div align='center'><img src='../../images/Logos.png' height='80' width='210'/> </div></span><br>");
            $("#visorAsesorias").append("<span class='t1'><h5 align='center'>MINISTERIO DE EDUCACIÓN PÚBLICA</h5></span>");
            $("#visorAsesorias").append("<span class='t1'><h5 align='center'>Informe de gestión educativa</h5></span>");
            $("#visorAsesorias").append("<span class='t1'><hr></span>");
            $("#visorAsesorias").append("<span class='t1'><p>Estimado(a) director(a), el presente documento cuenta con información importante sobre un jornada de intervención realizada en la institución que usted representa, asociada con el desarrollo de la(s) diferentes propuesta(s) educativas  de la Dirección de Recursos Tecnológicos en Educación.</p></span>");
            
            if (array[index].cod_pres != null){

            $("#visorAsesorias").append("<span class='t1'><b>Datos administrativos de la visita.</b></span><br>");
            $("#visorAsesorias").append("<span class='t1'>Codigo Presupuestario: </span><span>"+array[index].cod_pres+"</span><br>");
            $("#visorAsesorias").append("<span class='t1'>Nombre del centro educativo: </span><span>"+array[index].institucion+"</span><br>");
            $("#visorAsesorias").append("<span class='t1'>Provincia: </span><span>"+array[index].provincia+"</span><br>");
            $("#visorAsesorias").append("<span class='t1'>Cantón: </span><span>"+array[index].canton+"</span><br>");
            $("#visorAsesorias").append("<span class='t1'>Distrito: </span><span>"+array[index].distrito+"</span><br>");
            $("#visorAsesorias").append("<span class='t1'>Dirección Regional: </span> <span>"+array[index].direccion_regional+"</span><br>");
          } else {
            $("#visorAsesorias").append("<span class='t1'>Dirección Regional: </span> <span>"+array[index].nombre+"</span><br>");
            $("#visorAsesorias").append("<span class='t1'>Teléfono: </span> <span>"+array[index].telefono+"</span><br>");

          }
            $("#visorAsesorias").append("<span class='t1'>Fecha de la gestión educativa: </span><span>"+ moment(array[index].fecha).format('L') + "</span>");
            //$("#visorAsesorias").append("<span class='t1'>Propuesta educativa: </span><span>"+array[index].equipamiento2+"</span>");        //  

            $("#visorAsesorias").append("<br><br><span class='t1'><b>Información general.</b></span><br>");                 
            $("#visorAsesorias").append("<span class='t1'>Canal de comunicación: </span><span>"+ array[index].medio_visita+"<br></span>");
            $("#visorAsesorias").append("<span class='t1'>Tipo de atención: </span><span>"+ array[index].tipo_atencion+"<br></span>");
            $("#visorAsesorias").append("<span class='t1'>Funcionario: </span><span>"+ array[index].funcionario+"<br></span>");

            $("#visorAsesorias").append("<span class='t1'>Proyecto: </span><span>"+ verificarProyecto(array[index].proyecto_id)+"</span>");
            //$("#visorAsesorias").append("<span class='t1'>Aval del informe: </span> <span>"+array[index].estado_asesoria+"</span>"); 

            $("#visorAsesorias").append("<br><span class='t1'><br><b>Consultas Administrativas/Pedagógicas.</b></span><br>");
            $("#visorAsesorias").append("<span class='t1'><b>Objetivos: </b></span><span>"+array[index].objetivos+"</span><br><br>");
            $("#visorAsesorias").append("<span class='t1'><b>Observaciones: </b></span><span>"+array[index].observaciones+"</span>");
            $("#visorAsesorias").append("<span class='t1'><br><br><b>Recomendaciones.</b><br></span>");
            $("#visorAsesorias").append("<span class='t1'><b>Recomendaciones por funcionarios de Dirección Regional: </b></span><span>"+array[index].recomendacion_dr+"</span><br><br>" );
            $("#visorAsesorias").append("<span class='t1'><b>Recomendaciones de los asesores DRTE-PNTM: </b></span><span>"+array[index].recomendacion_asesor+"</span><br>" );
            if (array[index].observaciones_director.length > 1 ) 
            {
              $("#visorAsesorias").append("<span class='t1'> Observciones del Director: </span><span>"+array[index].observaciones_director+"</span>" );  
            }
            $("#visorAsesorias").append("<br><br><span><b>_______________________________</b></span><br>");
            $("#visorAsesorias").append("<span class='t1'>Asesor(a):</b></span><span><br>"+array[index].correo_asesor+"</span>");
            if (array[index].url_archivo != "Sin Archivo") {
              $("#visorAsesorias").append("<hr><a href="+ array[index].url_archivo +" class='t1' target='_blank' > <i class='fas fa-paperclip'></i> Archivo adjunto </a><br>");  
            }
          }
        }
      }

    function dibujarTabla (array, visor) {
      moment.locale('es'); 
         $(visor).empty();
     
         var limite = array.length, row,
         htmlTable = $(
           "<table  id='tblReportes' class='table table-striped'>" +
           "<thead>" +
           "<tr>" +        
             "<th class='text-center' scope='col'>C.Educativo-D.Regional</th>" +
             "<th scope='col'>Medio</th>" +
             "<th class='text-center'>Asesor a cargo</th>" +
             "<th class='text-center'>Fecha de asesoría</th>" +
             "<th class='text-center'>Fecha de registro</th>" +
             "<th class='text-center'>Tipo de atención</th>" +
             "<th class='text-center'>Estado</th>" +             
             "<th class='text-center'>Ver detalles</th>" +
            "</tr>" +
           "</thead>" +
           "<tfoot> <tr><th>centro educativo</th><th>medio</th> <th>asesor</th> <th>fecha asesoría</th> <th>fecha registro</th> <th>tipo atención</th><th>estado</th><th class='buscador'>asdf</th>"+
           "</tr></tfoot>"+
           "</table>"
         ), tBody = $("<tbody></tbody>");
     
                 for (let index = 0; index < limite; index++) {
                   let fowNumb = index + 1;
                   let tipoVisita; 

                   if (array[index].tipo_visita == 1){
                    tipoVisita = array[index].institucion;
                   }else {
                    tipoVisita = array[index].nombre;
                   }
                   
                   row = $(
                     "<tr>" +
                     "<td class=''>" +
                     tipoVisita +
                     "</td>" +
                     "<td class=''>"+ array[index].medio_visita+ "</td>" +
                     "<td class='text-center'>" +
                        array[index].correo_asesor  +
                    "</td>" +
                    "<td class='text-center'>" +
                                     array[index].fecha +
                        // moment(array[index].fecha).format('L') +
                    "</td>" +
                    "<td class='text-center'>" +
                    array[index].fecha_ingreso +
                        // moment(array[index].fecha_ingreso).format('L') +
                "</td>" +
                    "<td class='text-center'>" +
                          array[index].tipo_atencion  +
                    "</td>" +
                    "<td class='text-center'>" +
                    array[index].estado_asesoria  +
                  "</td>" +
                   "<td class='text-center' >" +
                       "<i id='"+ array[index].id_visita +"'  class='fas fa-eye lnk-ico  btnVerDetalles'></i>" +
                   "</td>" +
                     "</tr>"
                 );
                   $(tBody).append(row);
               }
        $(htmlTable).append(tBody);
        $(visor).html(htmlTable);     
  

        //Se agrega el manejador de eventos en el botón ver detalles
        $(".btnVerDetalles").click(function (e) { 
           // console.log("botón cliqueado");
          e.preventDefault();
          let idItem = e.target.id;
         //console.log("id BOTON:", idItem);
          //console.log("AQUI ES SI:", arregloDatos);
          mostrarDetalle(idItem, arregloDatos);
          $('#asesoriasModal').modal(); 
        }); 
        loadDataTable();
       }
      
      function loadDataTable() {
        var table = $('#tblReportes').DataTable({
          dom: 'Blfrtip',
          buttons: [
              {extend: 'copy',text: '<i class="far fa-copy"></i> Copiar'},
              {extend: 'excel',text: '<i class="far fa-file-excel"></i> Exportar a Excel'},
              {extend: 'pdf',text: '<i class="far fa-file-pdf"></i> Exportar como PDF'},
              {extend: 'print',text: '<i class="fas fa-print"></i> Imprimir'}
          ],
          "language": {
            "emptyTable":			"No hay datos disponibles en la tabla.",
            "info":		   			"Del _START_ al _END_ de _TOTAL_ ",
            "infoEmpty":			"Mostrando 0 registros de un total de 0.",
            "infoFiltered":			"(filtrados de un total de _MAX_ registros)",
            "infoPostFix":			"(actualizados)",
            "lengthMenu":			"Mostrar _MENU_ registros",
            "loadingRecords":		"Cargando...",
            "processing":			"Procesando...",
            "search":				"Buscar:",
            "searchPlaceholder":	"Dato para buscar",
            "zeroRecords":			"No se han encontrado coincidencias.",
            "paginate": {
                "first":			"Primera",
                "last":				"Última",
                "next":				"Siguiente",
                "previous":			"Anterior"
            },
            "aria": {
                "sortAscending":	"Ordenación ascendente",
                "sortDescending":	"Ordenación descendente"
            }
        },
        "lengthMenu":				[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "Todas"] ]
     
        });
        $('#tblReportes tfoot th').each( function () {
          var title = $(this).text();
          $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
      } );
     
        // Apply the search
        table.columns().every( function () {
            var that = this;
     
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
      }

//-------------------------------------------------------------------------------------------------------------------------------------//
function exportPDF()
{ 

  var HTML_Width = $(".modal-body").width();
  var HTML_Height = $(".modal-body").height();
  var top_left_margin = 15;
  var PDF_Width = HTML_Width+(top_left_margin*2);
  var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
  var canvas_image_width = HTML_Width;
  var canvas_image_height = HTML_Height;  
  var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;  

  //---Se llama a variable global con la imagen//
  //console.log(imgTecnoA);

  html2canvas($(".modal-body")[0],{allowTaint:true}).then(function(canvas) 
  {
    canvas.getContext('2d');
   //console.log(canvas.height+"  "+canvas.width);    
    
    var imgData = canvas.toDataURL("image/jpeg", 1.0);
    var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
    var time_pdf = moment().add(10, 'days').calendar(); 

    pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);   
    //pdf.addImage(imgTecnoMep, 'JPEG', 300, 30, 200, 60); 
    for (var i = 1; i <= totalPDFPages; i++) 
    {
      pdf.addPage(PDF_Width, PDF_Height);      
      pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin),canvas_image_width,canvas_image_height);
      //pdf.addImage(imgTecnoMep, 'JPEG', 30, 30, 200, 60);    
    }
      
      pdf.save('Gestion_educativa_'+time_pdf +'.pdf');
  });
};      

    