var filtros = {

    Tipo_Gastos=[

        {
            Codigo_PEP:"GI-APL",
            Descripcion:"hola",
            Categorias:[]

        },
        {
            Codigo_PEP:"GI-APL",
            Descripcion:"hola",
            Categorias:[]

        
        },
        {
            Codigo_PEP:"GI-APL",
            Descripcion:"hola",
            Categorias:[]

        }

    ]

}

function resumen(){

    $.ajax({

        url:"model1.php",
    
        method: "GET",
    
        data:"",
    
        success:function(response){
    
            var resumen = JSON.parse(response);
    
            datos=[];
    
            var gastosReales=[];
    
            var presupuestosDisponibles=[];
    
            var presupuestosIniciales=[];
    
            var meses=[];
    
            console.log(resumen);
    
            for (var key in resumen) {
                if (resumen.hasOwnProperty(key)) {
    
                    meses.push(key);
                    datos.push(resumen[key]);
    
                }
            }
    
            for(var i=0; i<datos.length; i++){
    
                var dato = datos[i];
                var gastoReal=dato.Gasto_Real;
                var presupuestoDisponible=dato.Presupuesto_Disponible;
                var presupuestoInicial=dato.Presupuesto_Inicial;
    
                gastosReales.push(gastoReal);
                presupuestosDisponibles.push(presupuestoDisponible);
                presupuestosIniciales.push(presupuestoInicial);
    
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
                        data: gastosReales,
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
                        labels: meses,
                        datasets: [{
                            label: "Presupuesto Anual gastado",
                            backgroundColor: 'rgb(132, 99, 240)',
                            borderColor: 'rgb(255, 99, 132)',
                            data: presupuestosIniciales,
                        },
                        {
                            label: "Presupuesto Remanente",
                            backgroundColor: 'rgb(15, 99, 240)',
                            borderColor: 'rgb(255, 99, 132)',
                            data: presupuestosDisponibles,
                        }
                    ]
                    },
    
                    // Configuration options go here
                    options: {}
                });
    
    
        }
    
    });


}

resumen();











