var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO"],
        datasets: [{
            label: "Gasto Mensual",
            fill: 'false',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20],
        }]
    },

    // Configuration options go here
    options: {}
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




