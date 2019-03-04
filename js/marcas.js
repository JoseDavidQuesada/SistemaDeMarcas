
            var d = new Date();
            var mes2 = d.getMonth() + 1;
            var time2 = d.getFullYear()+"-"+mes2+"-"+d.getDate()+ " " + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
            console.log(time2);

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
             var mes = marca.getMonth() + 1;
             var time = marca.getFullYear()+"-"+mes+"-"+marca.getDate()+ " " + marca.getHours() + ":" + marca.getMinutes() + ":" + marca.getSeconds();
 
             marcas(1,idPersona,time);
             marcasValidacion();
         });
 
         $( "#mSalidaLaboral").click(function() {
             var idPersona = id;
             var marca = new Date();
             var mes = marca.getMonth() + 1;
             var time = marca.getFullYear()+"-"+mes+"-"+marca.getDate()+ " " + marca.getHours() + ":" + marca.getMinutes() + ":" + marca.getSeconds();
 
             marcas(4,idPersona,time);
             marcasValidacion();
         });
 
       } 

        marcasValidacion();