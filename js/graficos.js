$(document).ready(function () {

  const ctx = document.getElementById('myChart').getContext('2d');

  let myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [],
      datasets: [{
        label: 'Total Cantidad',
        data: [],
        borderWidth: 1,
        backgroundColor: [], // Aquí se llenará con colores suaves
        borderColor: [],
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  });

  function getSoftColor() {
    const r = Math.floor(Math.random() * 128); // Valores de 0 a 127
    const g = Math.floor(Math.random() * 128); // Valores de 0 a 127
    const b = Math.floor(Math.random() * 128); // Valores de 0 a 127
    return `rgba(${r}, ${g}, ${b}, 0.6)`; // Color con opacidad
  }

  function listProductosReport(month) {
    const currentYear = new Date().getFullYear();
    const formattedDate = `${currentYear}-${month < 10 ? '0' + month : month}-01`; // Formato: 'YYYY-MM-DD'

    $.ajax({
      url: "controllers/DetalleVenta.controller.php",
      type: "GET",
      data: { op: "graficoProductos", fechaEmision: formattedDate },
      dataType: "json",
      success: function (response) {
        let labels = response.map(item => item.nombreProducto);
        let data = response.map(item => parseInt(item.totalCantidad));

        myChart.data.labels = [...labels];
        myChart.data.datasets[0].data = [...data, 0];
        
        // Generar colores suaves para cada barra
        myChart.data.datasets[0].backgroundColor = labels.map(() => getSoftColor());
        myChart.data.datasets[0].borderColor = labels.map(() => getSoftColor());

        myChart.options.scales.y.beginAtZero = true;

        myChart.update();
      },
      error: function (xhr, status, error) {
        console.error("Error en la solicitud:", status, error);
      }
    });
  }

  const currentMonthActual = new Date().getMonth() + 1; // +1 porque getMonth() devuelve 0-11
  $('#monthSelect').val(currentMonthActual); // Seleccionar el mes actual

  // Evento para cambiar el mes
  $('#monthSelect').change(function() {
    const selectedMonth = $(this).val();
    listProductosReport(selectedMonth);
  });

  // Inicializar con el mes actual
  const currentMonth = new Date().getMonth() + 1; // +1 porque getMonth() devuelve 0-11
  listProductosReport(currentMonth);
});
