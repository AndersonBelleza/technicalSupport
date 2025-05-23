$(document).ready(function(){

  function consultaDNI(){
    let documento = $("#documento").val();

      var data = {
        op: "consultaDNI",
        documento: documento
      };

      $.ajax({
          url :'controllers/Api.php',
          type: 'GET',
          data: data,
          dataType: 'JSON',
          success: function(result){
            const { nombre } = result;
            $("#cliente").val(nombre);
          }
      });
  }

  function consultaRUC(){
    let documento = $("#documento").val();

      var data = {
        op: "consultaRUC",
        documento: documento
      };

      $.ajax({
          url :'controllers/Api.php',
          type: 'GET',
          data: data,
          dataType: 'JSON',
          success: function(result){
            const { nombre } = result;
            console.log(result)
            $("#cliente").val(nombre);
          }
      });
  }

  $("#documento").on('input', function() {
    const selectedValue = $('#tipoCliente').val();
  
    if (selectedValue == "persona") {
      $(this).attr('maxlength', 8);
  
      if ($(this).val().length === 8) {
        consultaDNI();
      }
    }
  
    if (selectedValue == "empresa") {
      $(this).attr('maxlength', 11);
  
      if ($(this).val().length === 11) {
        consultaRUC(); 
      }
    } 
  });
  

  $("#tipoCliente").on('change', function(){
    $('#documento').val("");
    $('#cliente').val("");
  })

});