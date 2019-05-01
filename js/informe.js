var min = "";
var max = "";


$(document).ready(function() {



    $( "#filtroHoy" ).click(function() {
        var fullDate = new Date()
    
        var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
         
        var currentDate = fullDate.getFullYear()+ "-" + twoDigitMonth + "-0" + fullDate.getDate() ;
    
        var min  = $('#min-date').val(currentDate);
        var max =  $('#max-date').val(currentDate);
        
        
    });


  var table = $('#example').DataTable( {
     "order": [[ 2, "desc" ]],
    "processing" : true,
    "ajax": {
        "url":"controlador/informeDatos.php?id=1",
        "dataSrc": ""
    },
    "columns": [
        { "data": "cedula" },
        { "data": "Nombre" },
        { "data": "Fecha" },
        { "data": "mEntradaLaboral" },
        { "data": "mSalidaAlmuerzo" },
        { "data": "mEntradaAlmuerzo" },
        { "data": "mSalidaLaboral" },
        { "data": "Estado" },
        { "data": "HorasTrabajadas" },
        { "data": "Extras" }
    ],
    "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    }
} );

  var porMes = $( "#porMes" ).click(function() {

    
        var table =  $('#example').DataTable( {
            
            "processing" : true,
             "ajax": {
                "url":"controlador/informeDatos.php?id=2",
                "dataSrc": ""
            },
            "columns": [
                { "data": "cedula" },
                { "data": "Nombre" },
                { "data": "Fecha" },
                { "data": "mEntradaLaboral" },
                { "data": "mSalidaAlmuerzo" },
                { "data": "mEntradaAlmuerzo" },
                { "data": "mSalidaLaboral" },
                { "data": "Estado" },
                { "data": "HorasTrabajadas" },
                { "data": "Extras" }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
             },
             stateSave: true,
            "bDestroy": true
          } );


      });

    var porDia = $( "#porDia" ).click(function() {

    
        var table =  $('#example').DataTable( {

            "processing" : true,
             "ajax": {
                "url":"controlador/informeDatos.php?id=3",
                "dataSrc": ""
            },
            "columns": [
                { "data": "cedula" },
                { "data": "Nombre" },
                { "data": "Fecha" },
                { "data": "mEntradaLaboral" },
                { "data": "mSalidaAlmuerzo" },
                { "data": "mEntradaAlmuerzo" },
                { "data": "mSalidaLaboral" },
                { "data": "Estado" },
                { "data": "HorasTrabajadas" },
                { "data": "Extras" }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
             },
             stateSave: true,
            "bDestroy": true
          } );


      });


 
  
  // Extend dataTables search
  
  $.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
    
      var min = $('#min-date').val();
      var max = $('#max-date').val();
      var createdAt = data[2] || 0; // Our date column in the table
      
      if (
        (min == "" || max == "") ||
        (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
      ) {
        return true;
      }
      return false;
    }
  );
  
  // Re-draw the table when the a date range filter change



   $('.date-range-filter').change(function() {
    table.draw();
    });
  
  $('#example_filter').hide();

 
} );