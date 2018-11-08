class MyChart{

    constructor(){

        this.chart=null;
        this.chart1=null;

    }

    begin(xlabels, yData00, yData01, yData10, yData11){

        var ctx = document.getElementById('myChart').getContext('2d');
        this.chart = new Chart(ctx, {

            // The type of chart we want to create
            type: 'bar',
      
            // The data for our dataset
            data: {
                labels: xlabels,
                datasets: [{
                    label: "Gasto Real",
                    backgroundColor: 'rgb(20, 200, 150)',
                    borderColor: 'rgb(120, 99, 255)',
                    data: yData00,
                },
                {
                    label: "Gasto Acumulado",
                    backgroundColor: 'rgb(150, 150, 25)',
                    borderColor: 'rgb(255, 200, 0)',
                    data: yData01,
                }
            ]
            },
        
            // Configuration options go here
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
        
        var ctx = document.getElementById('myChart1').getContext('2d');
        this.chart1 = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',

                // The data for our dataset
                data: {
                    labels: xlabels,
                    datasets: [{
                        label: "Presupuesto Anual",
                        backgroundColor: 'rgb(240, 50, 15)',
                        borderColor: 'rgb(255, 99, 50)',
                        data: yData10,
                    },
                    {
                        label: "Presupuesto Disponible",
                        backgroundColor: 'rgb(50, 10, 240)',
                        borderColor: 'rgb(255, 10, 50)',
                        data: yData11,
                    }
                ]
                },

                // Configuration options go here
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
                
        });

    }

    updateChart(xlabels, yData00, yData01, yData10, yData11){

        for (var i = 0; i < this.chart.data.labels.length; i++) {
            
            this.chart.data.datasets[0].data[0]=yData00[i];
            this.chart.data.datasets[1].data[1]=yData01[i];

            this.chart1.data.datasets[0].data[0]=yData10[i];
            this.chart1.data.datasets[1].data[1]=yData11[i];

        }

        this.chart.update();
        this.chart1.update();


    }

}