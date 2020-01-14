var arregloDatos=[];
$(document).ready(function () {
  saveSession(); 
  $("#divInfo").html('<a id="btnInicio" href="../admin/index.php" alt="Inicio"><i class= "fas fa-home"></i></a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="#" class="acerca-de" data-toggle="tooltip" title="Acerca de"> <i class="fas fa-info-circle"></i></a>');
  $("#divUsuario").html('<i class="fas fa-user-alt"></i><span class="usuario"> </span>'+correoUser);
  $("#divSalir").html('<a href="../server/login/logout.php" data-toggle="tooltip" title="Cerrar sesión"><i class="fas fa-sign-out-alt"></i></a>');
  cargaModalAcercaDe();  

 
});
  
function saveSession() {
  let tipo = sessionStorage.getItem("tipo");
  correoUser = sessionStorage.getItem("correo"); 
}  
  
        

    