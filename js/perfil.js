function confirmacionLogout(){
    alertify.confirm('Cerrar sesion', 'Desea continuar?',
     function(){ 
        alertify.success('Ok');
        location.href='controlador/logout.php';
     },
     function(){
        alertify.error('Cancel');
      }
     
     );

}

function cancelarPerfil(){
    alertify.confirm('Cancelando creación de perfil', 'Desea continuar?',
     function(){ 
        alertify.success('Ok');
        location.href='home.php';
     },
     function(){
        alertify.error('Cancel');
      }
     
     );

}

function cancelarModificacionAdmin(){
    alertify.confirm('Si los cambios no se han guardado se perderan', 'Desea continuar?',
     function(){ 
        alertify.success('Ok');
        location.href='perfil.php?id=3';
     },
     function(){
        alertify.error('Cancel');
      }
     
     );

}

function cancelarModificacionPerfil(){
    alertify.confirm('Si los cambios no se han guardado se perderan', 'Desea continuar?',
     function(){ 
        alertify.success('Ok');
        location.href='home.php';
     },
     function(){
        alertify.error('Cancel');
      }
     
     );

}



window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    }); 

}, 3000);
