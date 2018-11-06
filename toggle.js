function toggleFilter() {
    
    $(document).ready(function(){  

        //
        $(".list2").click(function(){
    
            filters.Tipo_gastos.forEach(Tipo_Gasto => {
            
                console.log(Tipo_Gasto.Codigo_PEP)
        
                var htmlId = "#"+Tipo_Gasto.Codigo_PEP;
                var sonHtmlId = "#group-"+Tipo_Gasto.Codigo_PEP;
        
                if($(htmlId).is(':checked')){
                
                    $(sonHtmlId).show();
        
                }
    
                else{
                
                    $(sonHtmlId).hide();
        
                }
        
            });
    
    
        });

        //

        
    
    
    });

}

toggleFilter();
