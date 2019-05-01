
$(document).ready(function() {



  var table = $('#example').DataTable( {
    select: true,
    searching: false,
 
    "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
     }
  } );
/*var tableFilter = $( "#send" ).click(function() {

    
          $('#example').DataTable( {
              searching: false,
            "processing" : true,
            "ajax": {
                "url":"controlador/buscadorDatos.php?id=2",
                "type": "POST",
                "data": {
                    "cedula": $("#cedula").val(),
                    "name": $("#name").val(),
                    "ape01": $("#ape01").val(),
                    "ape02": $("#ape02").val()
                },
                "dataSrc": ""
            },
            "columns": [
                { "data": "cedula" },
                { "data": "nombre" },
                { "data": "fechaNacimiento" },
                { "data": "user" },
                { "data": "correo" },
                { "data": "telefono" },
                { "data": "tipo" }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
             },
             stateSave: true,
            "bDestroy": true
          } );


      });


*/

$( "#send" ).click(function() {
       $.ajax({
            type: 'POST',
            url: 'controlador/buscadorDatos.php?id=2',  
            data: {
                    "cedula": $("#cedula").val(),
                    "name": $("#name").val(),
                    "ape01": $("#ape01").val(),
                    "ape02": $("#ape02").val()
            }, 
          }).done(function(info) {
            $( "#tablaContenido" ).html(info);
            
          }); 

        }); 

  }); 


/*
          var registerMessages = function(){
              $("#send").on("click", function(e){
                  e.preventDefault();
                  var frm = $("#formChat").serialize();
                  $.ajax({
                      type: "POST",
                      url: "servidor/register.php",
                      data : frm
                  }).done(function(info){
                     $("#message").val("");
                     var altura = $("#conversation").prop("scrollHeight");
                     $("#conversation").scrolltop(altura);
                      console.log( info );
                  })
              }); 
                
            }*/