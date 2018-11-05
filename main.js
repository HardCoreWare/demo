$(document).ready(function(){

    $.ajax({

        url:"model1.php",

        method: "GET",

        data:"",

        success:function(response){

            var resumen = JSON.parse(response);

            var gasto = resumen.Gastos;

            var presupuesto = resumen.Presupuesto;

            var meses = [];

            var gastos = [];

            var disponibles = [];

            var iniciales = [];

            console.log(resumen);

            for (var key in gasto) {
                if (gasto.hasOwnProperty(key)) {

                    meses.push(key);
                    gastos.push(gasto[key]);
                }
            }

            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',
            
                // The data for our dataset
                data: {
                    labels: meses,
                    datasets: [{
                        label: "Gasto Mensual",
                        fill: 'false',
                        borderColor: 'rgb(255, 99, 132)',
                        data: gastos,
                    }]
                },
            
                // Configuration options go here
                options: {}
            });





        }

    });

});



var ctx = document.getElementById('myChart1').getContext('2d');
var chart1 = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO"],
        datasets: [{
            label: "Presupuesto Anual gastado",
            backgroundColor: 'rgb(132, 99, 240)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20],
        }]
    },

    // Configuration options go here
    options: {}
});




