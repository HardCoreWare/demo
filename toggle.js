var fields={

    Tipo_Gastos:[
    
        {Codigo_PEP:"GI-APL",Categorias:[

            {Codigo_PEP:"GI-APL-CNL",PEPs:[

                "GI-APL-CNL-B10-202-003",
                "GI-APL-CNL-B11-202-001",
                "GI-APL-CNL-B12-202-005"
            ]
        },
            {Codigo_PEP:"GI-APL-COR",PEPs:[

                "GI-APL-COR-B01-202-009",
                "GI-APL-COR-B01-202-011",
                "GI-APL-COR-B27-202-021"
            ]
        },
            {Codigo_PEP:"GI-APL-INF",PEPs:[

                "GI-APL-COR-B58-203-164"

            ]}

        ]},

        {Codigo_PEP:"GI-INF",Categorias:[

            {Codigo_PEP:"GI-INF-ALM",PEPs:[
                
                "GI-INF-ALM-B57-203-155"

            ]
        },
            {Codigo_PEP:"GI-INF-CPR",PEPs:[

                "GI-INF-CPR-B40-204-034",
                "GI-INF-CPR-B40-204-035",
                "GI-INF-CPR-B20-202-156"

            ]
        },
            {Codigo_PEP:"GI-INF-CSR",PEPs:[

                "GI-INF-CSR-B03-204-034",
                "GI-INF-CSR-B04-204-035",
                "GI-INF-CSR-C20-204-115"
            ]
        },
            {Codigo_PEP:"GI-INF-DCT",PEPs:[

                "GI-INF-DCT-B29-202-040",
                "GI-INF-DCT-B32-203-042",
                "GI-INF-DCT-B43-204-153"

            ]
        }

        ]},

        {Codigo_PEP:"GI-SER",Categorias:[

            {Codigo_PEP:"GI-SER-CAM",PEPs:[

                "GI-SER-CAM-B10-205-004",
                "GI-SER-CAM-B21-207-092",
                "GI-SER-CAM-B38-214-091"

            ]
        },
            {Codigo_PEP:"GI-SER-COR",PEPs:[

                "GI-SER-COR-B01-209-010",
                "GI-SER-COR-B03-202-015"
            ]
        },
            {Codigo_PEP:"GI-SER-FSR",PEPs:[

                "GI-SER-FSR-B21-207-094",
                "GI-SER-FSR-B21-207-095",
                "GI-SER-FSR-B21-207-093"

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

function toggleFilter() {
    
    $(document).ready(function(){  

        $(".list2").click(function(){

            // eventos al hacer click
    
            var Tipo_Gastos = fields.Tipo_Gastos;

            Tipo_Gastos.forEach(Tipo_Gasto => {
                
                var Codigo_PEP = Tipo_Gasto.Codigo_PEP;
                var htmlId1 = "#" + Codigo_PEP;
                var sonHtmlId1 = "#group-"+Codigo_PEP;
        
                if($(htmlId1).is(':checked')){
                
                    $(sonHtmlId1).show();

                    filterData.filters1.push(Codigo_PEP);
        
                }
    
                else{
                
                    $(sonHtmlId1).hide();
        
                }

                var Categorias=Tipo_Gasto.Categorias;

                Categorias.forEach(Categoria => {

                    var Codigo_PEP = Categoria.Codigo_PEP;
                    var htmlId2 = "#" + Codigo_PEP;
                    var sonHtmlId2 = "#group-" + Codigo_PEP;

                    if($(htmlId2).is(':checked')){
                
                        $(sonHtmlId2).show();

                        filterData.filters2.push(Codigo_PEP);
            
                    }
        
                    else{
                    
                        $(sonHtmlId2).hide();
            
                    }

                    var PEPs = Categoria.PEPs;
                    
                    PEPs.forEach(PEP =>{

                        var Codigo_PEP = PEP.Codigo_PEP;
                        var htmlId3 = "#" + Codigo_PEP;

                        console.log(htmlId3);

                        if($(htmlId3).is(':checked')){
                
                            filterData.filters3.push(Codigo_PEP);
                
                        }
            
                    });

                });

            });

    console.log(filterData);        
    //
        });

    });

}

toggleFilter();

