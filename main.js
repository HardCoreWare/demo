var onBegin=0;

var clicked=0;

var myChart = new MyChart();

var filterOrdinal=0;

var fields={

    Tipo_Gastos:[
    
        {Codigo_PEP:"GI-APL",Categorias:[

            {Codigo_PEP:"GI-APL-CNL",PEPs:[

                {Codigo_PEP:"GI-APL-CNL-B10-202-003"},
                {Codigo_PEP:"GI-APL-CNL-B11-202-001"},
                {Codigo_PEP:"GI-APL-CNL-B12-202-005"}
            ]
        },
            {Codigo_PEP:"GI-APL-COR",PEPs:[

                {Codigo_PEP:"GI-APL-COR-B01-202-009"},
                {Codigo_PEP:"GI-APL-COR-B01-202-011"},
                {Codigo_PEP:"GI-APL-COR-B27-202-021"}
            ]
        },
            {Codigo_PEP:"GI-APL-INF",PEPs:[

                {Codigo_PEP:"GI-APL-COR-B58-203-164"}

            ]}

        ]},

        {Codigo_PEP:"GI-INF",Categorias:[

            {Codigo_PEP:"GI-INF-ALM",PEPs:[
                
                {Codigo_PEP:"GI-INF-ALM-B57-203-155"}

            ]
        },
            {Codigo_PEP:"GI-INF-CPR",PEPs:[

                {Codigo_PEP:"GI-INF-CPR-B40-204-034"},
                {Codigo_PEP:"GI-INF-CPR-B40-204-035"},
                {Codigo_PEP:"GI-INF-CPR-B20-202-156"}

            ]
        },
            {Codigo_PEP:"GI-INF-CSR",PEPs:[

                {Codigo_PEP:"GI-INF-CSR-B03-204-034"},
                {Codigo_PEP:"GI-INF-CSR-B04-204-035"},
                {Codigo_PEP:"GI-INF-CSR-C20-204-115"}
            ]
        },
            {Codigo_PEP:"GI-INF-DCT",PEPs:[

                {Codigo_PEP:"GI-INF-DCT-B29-202-040"},
                {Codigo_PEP:"GI-INF-DCT-B32-203-042"},
                {Codigo_PEP:"GI-INF-DCT-B43-204-153"}

            ]
        }

        ]},

        {Codigo_PEP:"GI-SER",Categorias:[

            {Codigo_PEP:"GI-SER-CAM",PEPs:[

                {Codigo_PEP:"GI-SER-CAM-B10-205-004"},
                {Codigo_PEP:"GI-SER-CAM-B21-207-092"},
                {Codigo_PEP:"GI-SER-CAM-B38-214-091"}

            ]
        },
            {Codigo_PEP:"GI-SER-COR",PEPs:[

                {Codigo_PEP:"GI-SER-COR-B01-209-010"},
                {Codigo_PEP:"GI-SER-COR-B03-202-015"}
            ]
        },
            {Codigo_PEP:"GI-SER-FSR",PEPs:[

                {Codigo_PEP:"GI-SER-FSR-B21-207-094"},
                {Codigo_PEP:"GI-SER-FSR-B21-207-095"},
                {Codigo_PEP:"GI-SER-FSR-B21-207-093"}

            ]
        }

        ]}

    ]

}

var filterData={

    filters1:[],
    filters2:[],
    filters3:[]

}

function loadFilter(){

                filterData.filters1=[];
                filterData.filters2=[];
                filterData.filters3=[];
    
                var Tipo_Gastos = fields.Tipo_Gastos;

                Tipo_Gastos.forEach(Tipo_Gasto => {
                    
                    var Codigo_PEP = Tipo_Gasto.Codigo_PEP;
                    var htmlId1 = "#" + Codigo_PEP;
                    var sonHtmlId1 = "#group-"+Codigo_PEP;
            
                    if($(htmlId1).is(':checked')){
                    
                        filterData.filters1.push(Codigo_PEP);

                        if(filterOrdinal===1){

                            $(sonHtmlId1).show();

                            Tipo_Gasto.Categorias.forEach(Categoria => {

                                var htmlSonId = "#"+Categoria.Codigo_PEP;

                                $(htmlSonId).prop('checked',true);

                            });
                            
                        }

                    }
        
                    else{

                        if(filterOrdinal===1){

                            $(sonHtmlId1).hide();

                            Tipo_Gasto.Categorias.forEach(Categoria => {

                                var htmlSonId = "#"+Categoria.Codigo_PEP;

                                $(htmlSonId).prop('checked',false);

                            });

                        }

                    }
    
                    var Categorias=Tipo_Gasto.Categorias;
    
                    Categorias.forEach(Categoria => {
    
                        var Codigo_PEP = Categoria.Codigo_PEP;
                        var htmlId2 = "#" + Codigo_PEP;
                        var sonHtmlId2 = "#group-" + Codigo_PEP;
    
                        if($(htmlId2).is(':checked')){
                    
                            filterData.filters2.push(Codigo_PEP);

                            //si se selecciono la accion del nivel correcto
                            if(filterOrdinal===2){

                                $(sonHtmlId2).show();
        
                                Categoria.PEPs.forEach(PEP => {

                                    var htmlSonId = "#"+PEP.Codigo_PEP;
        
                                    $(htmlSonId).prop('checked',true);
        
                                });

                            }
                
                        }
            
                        else{
                        
                            //si se selecciono la accion del nivel correcto
                            if(filterOrdinal===2){

                                $(sonHtmlId2).hide();

                                Categoria.PEPs.forEach(PEP => {

                                    var htmlSonId = "#"+PEP.Codigo_PEP;
        
                                    $(htmlSonId).prop('checked',false);
        
                                });

                            }
                
                        }
    
                        var PEPs = Categoria.PEPs;
                        
                        PEPs.forEach(PEP =>{
    
                            var Codigo_PEP = PEP.Codigo_PEP;
                            var htmlId3 = "#" + Codigo_PEP;
    
                            if($(htmlId3).is(':checked')){
                    
                                filterData.filters3.push(Codigo_PEP);
                    
                            }
                
                        });
    
                    });
    
                });
    
            }


function resumen(){

    var filters=JSON.stringify(filterData);

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

            if(onBegin===0){

                myChart.begin(meses,gastosReales, gastosComprometidos, presupuestosIniciales, presupuestosDisponibles );
                onBegin=1;

            }

            else{

                myChart.clearChart();
                myChart.begin(meses,gastosReales, gastosComprometidos, presupuestosIniciales, presupuestosDisponibles );

            }

        }
    
    });

}


$(document).ready(function(){  
 
    $(".check-item1").click(function(){

        filterOrdinal=1;

        loadFilter();

    });

    $(".check-item2").click(function(){

        filterOrdinal=2;

        loadFilter();


    });

    $(".list3").click(function(){

        filterOrdinal=0;

        loadFilter(); 

    });

});

$("#btnInforme").click(function(){

    filterOrdinal=0;

    loadFilter(); 

    resumen();

});

