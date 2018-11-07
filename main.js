var filterData={

    filters1:["GI-APL","GI-SER"],
    filters2:["GI-APL-CNL"],
    filters3:["GI-APL-CNL-B10-202-003","GI-APL-CNL-B11-202-001"]

}

var filters=JSON.stringify(filterData);

function resumen(){

    $.ajax({

        url:"model.php",
        method: "GET",
        data:{"req":filters},

        beforeSend:function() {

            

        },
    
        success:function(response){

            console.log(response);
    
            var resumen = JSON.parse(response);
    
            datos=[];
    
            var gastosReales=[];
            var gastosComprometidos=[]
            var presupuestosDisponibles=[];
            var presupuestosIniciales=[];
            var meses=[];
    
            console.log(resumen);
    
            for (var key in resumen) {

                if (resumen.hasOwnProperty(key)) {
    
                    switch (key) {

                        case "1": meses.push("Enero"); break;
                        case "2": meses.push("Febrero"); break;
                        case "3": meses.push("Marzo"); break;
                        case "4": meses.push("Abril"); break;
                        case "5": meses.push("Mayo"); break;
                        case "6": meses.push("Junio"); break;
                        case "7": meses.push("Julio"); break;
                        case "8": meses.push("Agosto"); break;
                        case "9": meses.push("Septiembre"); break;
                        case "10": meses.push("Octubre"); break;
                        case "11": meses.push("Noviembre"); break;
                        case "12": meses.push("Diciembre"); break;

                    }

                    datos.push(resumen[key]);
    
                }
            }
    
            for(var i=0; i<datos.length; i++){
    
                var dato = datos[i];
                var gastoReal=dato.Gasto_Real;
                var presupuestoDisponible=dato.Presupuesto_Disponible;
                var presupuestoInicial=dato.Presupuesto_Inicial;
                var gastoComprometido=dato.Gasto_Comprometido_Acumulado;
    
                gastosReales.push(gastoReal);
                presupuestosDisponibles.push(presupuestoDisponible);
                presupuestosIniciales.push(presupuestoInicial);
                gastosComprometidos.push(gastoComprometido);
    
            }

            for(var i=0; i<gastosComprometidos.length; i++){

                if(i<(gastosComprometidos.length-1)){

                    gastosComprometidos[i]=0;

                }

            }

            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',
          
                // The data for our dataset
                data: {
                    labels: meses,
                    datasets: [{
                        label: "Gasto Mensual real",
                        backgroundColor: 'rgb(132, 99, 240)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: gastosReales,
                    },
                    {
                        label: "Gasto Comprometido Acumulado",
                        backgroundColor: 'rgb(50, 0, 240)',
                        borderColor: 'rgb(255, 0, 50)',
                        data: gastosComprometidos,
                    }
                ]
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
                            backgroundColor: 'rgb(15, 50, 240)',
                            borderColor: 'rgb(255, 99, 50)',
                            data: presupuestosIniciales,
                        },
                        {
                            label: "Presupuesto Remanente",
                            backgroundColor: 'rgb(15, 0, 240)',
                            borderColor: 'rgb(255, 0, 50)',
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











