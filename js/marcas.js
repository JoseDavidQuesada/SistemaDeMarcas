  /* esta funcion esta para convertir la hora am y pm y no dejarla militar como es normalmente */   
     function convertirHora(hora,minutos){

        var ampm = "";
        var horaC = hora;
        var minutosC = minutos;
        if(horaC>=12){
            horaC = horaC - 12;
            ampm = "PM";
        }else{
          ampm = "AM";
        }
        if(horaC == 0){
          horaC = 12;
        }
        if(horaC<10){
          horaC = "0"+horaC;
        }else{
          horaC = horaC;
        };
        
        if(minutosC <10){
            minutosC = "0"+minutosC ;
        }else{
            minutosC = minutosC;
        };

      var FullHoraC = horaC+":"+minutosC+" "+ampm;

      return "<button type='button' class='btn btn-primary' disabled>"+FullHoraC+"</button>";
      }


/** Esta funcion registra las marcas, ella necesita id que seria un 
 * identificador para la funcion de marcas.php,idPersona y marcas que seria la  hora y fecha en la que se marco */
      function marcas(id,idPersona,marcas){
        var identificador = id;
        var persona = idPersona;
        var marca = marcas;

       $.ajax({
            type: 'POST',
            url: 'controlador/marcas.php',
            data: {
              'identificador' : identificador,
              'idPersona': persona,
              'marca' : marca
            },
            
          }).done(function(info) {
            console.log(info);
            
          });
       }

       /** Esta funcion se encarga de ir a verificar si ya hay marcas para que el boton le salga  bloqueado*/
       function marcasValidacion(){
        var identificador = 5;
        
       $.ajax({
            type: 'POST',
            url: 'controlador/marcas.php',
            data: {
              'identificador' : identificador,
            },
            dataType: 'json'

          }).done(function(info) {

            $( "#mEntradaLaboral" ).html(info.EntradaLaboral);
            $( "#mSalidaAlmuerzo" ).html(info.SalidaAlmuerzo);
            $( "#mEntradaAlmuerzo" ).html(info.EntradaAlmuerzo);
            $( "#mSalidaLaboral" ).html(info.SalidaLaboral);
            
          });
       }

       function marcasClick(id){
        $( "#mEntradaLaboral" ).click(function() {
             var idPersona = id;
             var marca = new Date();
             var anno = marca.getFullYear();
             var mes = marca.getMonth() + 1;
             var dia = marca.getDate();
             var hora = marca.getHours();
             var minutos = marca.getMinutes();
             var segundos = marca.getSeconds();
             var time = anno+"-"+mes+"-"+dia+ " " +hora+ ":" + minutos + ":" + segundos;

              $( this ).html(convertirHora(hora,minutos));
              marcas(1,idPersona,time);
              marcasValidacion();
         });

         $( "#mSalidaAlmuerzo" ).click(function() {
          var idPersona = id;
          var marca = new Date();
          var anno = marca.getFullYear();
          var mes = marca.getMonth() + 1;
          var dia = marca.getDate();
          var hora = marca.getHours();
          var minutos = marca.getMinutes();
          var segundos = marca.getSeconds();
          var time = anno+"-"+mes+"-"+dia+ " " +hora+ ":" + minutos + ":" + segundos;

           $( this ).html(convertirHora(hora,minutos));
           marcas(2,idPersona,time);
           marcasValidacion();
      });

        $( "#mEntradaAlmuerzo" ).click(function() {
          var idPersona = id;
          var marca = new Date();
          var anno = marca.getFullYear();
          var mes = marca.getMonth() + 1;
          var dia = marca.getDate();
          var hora = marca.getHours();
          var minutos = marca.getMinutes();
          var segundos = marca.getSeconds();
          var time = anno+"-"+mes+"-"+dia+ " " +hora+ ":" + minutos + ":" + segundos;

           $( this ).html(convertirHora(hora,minutos));
           marcas(3,idPersona,time);
           marcasValidacion();
      });
 
         $( "#mSalidaLaboral").click(function() {
          var idPersona = id;
          var marca = new Date();
          var anno = marca.getFullYear();
          var mes = marca.getMonth() + 1;
          var dia = marca.getDate();
          var hora = marca.getHours();
          var minutos = marca.getMinutes();
          var segundos = marca.getSeconds();
          var time = anno+"-"+mes+"-"+dia+ " " +hora+ ":" + minutos + ":" + segundos;

           $( this ).html(convertirHora(hora,minutos));
           marcas(4,idPersona,time);
           marcasValidacion();
         });
 
       } 

        marcasValidacion();