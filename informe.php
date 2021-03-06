<?php

class Informe{

    private $Informe=[];
    private $Resumen=[];

    public function __construct($filters1,$filters2,$filters3){

        $this->readPresupuesto($filters1,$filters2,$filters3);
        $this->readGasto($filters1,$filters2,$filters3);
        $this->chartData();

    }

    /************************************************************************************************************************************************************************************************/
    public function readPresupuesto($filters1,$filters2,$filters3){

        $presupuestoJson = file_get_contents('querys/presupuesto_query.json');
        $presupuestos = json_decode($presupuestoJson); $presupuestoJson = null;
        $presupuesto=$presupuestos[0]->Presupuesto_Total_TI;
        $presupuesos=null;

        $this->Informe['Presupuesto_Anual']['Presupuesto']=0;
        $this->Informe['Presupuesto_Anual']['Codigo_PEP']=$presupuesto->Codigo_PEP;

        foreach ($presupuesto->Tipo_Gastos as $i1=> $desgloce1) {

            if(in_array($desgloce1->Codigo_PEP,$filters1)){

                $this->Informe['Presupuesto_Anual']['Tipo_Gastos'][$i1]['Presupuesto']=0;
                $this->Informe['Presupuesto_Anual']['Tipo_Gastos'][$i1]['Codigo_PEP']=$desgloce1->Codigo_PEP;

                foreach ($desgloce1->Categorias as $i2 => $desgloce2) {

                    if(in_array($desgloce2->Codigo_PEP,$filters2)){

                        $this->Informe['Presupuesto_Anual']['Tipo_Gastos'][$i1]['Categorias'][$i2]['Presupuesto']=0;
                        $this->Informe['Presupuesto_Anual']['Tipo_Gastos'][$i1]['Categorias'][$i2]['Codigo_PEP']=$desgloce2->Codigo_PEP;

                        foreach ($desgloce2->PEPs as $i3 => $desgloce3) {

                            if(in_array($desgloce3->Codigo_PEP,$filters3)){

                                $this->Informe['Presupuesto_Anual']['Tipo_Gastos'][$i1]['Categorias'][$i2]['PEPs'][$i3]['Presupuesto']=floatval($desgloce3->Presupuesto);
                                $this->Informe['Presupuesto_Anual']['Tipo_Gastos'][$i1]['Categorias'][$i2]['PEPs'][$i3]['Codigo_PEP']=$desgloce3->Codigo_PEP;
                                $this->Informe['Presupuesto_Anual']['Tipo_Gastos'][$i1]['Categorias'][$i2]['Presupuesto']+=floatval($desgloce3->Presupuesto);

                            }
                        }

                        $this->Informe['Presupuesto_Anual']['Tipo_Gastos'][$i1]['Presupuesto']+=
                        $this->Informe['Presupuesto_Anual']['Tipo_Gastos'][$i1]['Categorias'][$i2]['Presupuesto'];

                    }
                }

                $this->Informe['Presupuesto_Anual']['Presupuesto']+=
                $this->Informe['Presupuesto_Anual']['Tipo_Gastos'][$i1]['Presupuesto'];

            }
        }

        $presupuesto=null;

    }

    /****************************************************************************************************************************************/

    public function readGasto($filters1,$filters2,$filters3){

        $gastosJson=file_get_contents('querys/gastos_query.json');

        $gastos=json_decode($gastosJson);

        $gastosJson=null;

        foreach ($gastos as $mensual) {

            $gasto=$mensual->Gasto_Mensual_TI;

            $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Gasto_Total']=0;
            $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Gasto_Real']=0;
            $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Gasto_Comprometido']=0;

            foreach ($gasto->Tipo_Gastos as $i1 => $desgloce1) {

                if(in_array($desgloce1->Codigo_PEP,$filters1)){

                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Gasto_Total']=0;
                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Gasto_Real']=0;
                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Gasto_Comprometido']=0;
                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Codigo_PEP']=$desgloce1->Codigo_PEP;

                    foreach ($desgloce1->Categorias as $i2 => $desgloce2) {

                        if(in_array($desgloce2->Codigo_PEP,$filters2)){

                            $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Gasto_Total']=0;
                            $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Gasto_Real']=0;
                            $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Gasto_Comprometido']=0;
                            $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Codigo_PEP']=$desgloce2->Codigo_PEP;

                            foreach ($desgloce2->PEPs as $i3 => $desgloce3) {

                                if(in_array($desgloce3->Codigo_PEP,$filters3)){

                                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Categorias'][$i2]['PEPs'][$i3]['Gasto_Total']=floatval($desgloce3->Gasto->Real)+floatval($desgloce3->Gasto->Comprometido);
                                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Categorias'][$i2]['PEPs'][$i3]['Gasto_Real']=floatval($desgloce3->Gasto->Real);
                                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Categorias'][$i2]['PEPs'][$i3]['Gasto_Comprometido']=floatval($desgloce3->Gasto->Comprometido);
                                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Categorias'][$i2]['PEPs'][$i3]['Codigo_PEP']=$desgloce3->Codigo_PEP;

                                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Gasto_Total']+=
                                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Categorias'][$i2]['PEPs'][$i3]['Gasto_Total'];
                                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Gasto_Real']+=
                                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Categorias'][$i2]['PEPs'][$i3]['Gasto_Real'];
                                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Gasto_Comprometido']+=
                                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Categorias'][$i2]['PEPs'][$i3]['Gasto_Comprometido'];                       
                                    
                                }

                                $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Gasto_Total']+=
                                $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Gasto_Total'];
                                $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Gasto_Real']+=
                                $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Gasto_Real'];
                                $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Gasto_Comprometido']+=
                                $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Gasto_Comprometido'];

                            }

                        }

                    }

                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Gasto_Total']+=
                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Gasto_Total'];
                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Gasto_Real']+=
                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Gasto_Real'];            
                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Gasto_Comprometido']+=
                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes]['Tipo_Gastos'][$i1]['Gasto_Comprometido'];

                }

            }

        }

    }

/*********************************************************************************************************************************************************/

    public function chartData(){

        $acumulado=0;
        $comprometido=0;
        
        foreach ($this->Informe['Gastos_Mensuales'] as $mes => $gasto) {

            //gastos reales
            $this->Resumen[$mes]['Gasto_Real']=$gasto['Gasto_Real'];

            //gastos totales acumulados
            $this->Resumen[$mes]['Gasto_Total_Acumulado']=$gasto['Gasto_Total']+$acumulado;
            $acumulado+=$gasto['Gasto_Total'];

            //gastos comprometidos
            $this->Resumen[$mes]['Gasto_Comprometido_Acumulado']=$gasto['Gasto_Comprometido']+$comprometido;
            $comprometido+=$gasto['Gasto_Comprometido'];

            //presupuesto inicial
            $this->Resumen[$mes]['Presupuesto_Inicial'] = $this->Informe['Presupuesto_Anual']['Presupuesto'];

            //presupuesto disponible
            $this->Resumen[$mes]['Presupuesto_Disponible'] = $this->Informe['Presupuesto_Anual']['Presupuesto']-
            $this->Resumen[$mes]['Gasto_Total_Acumulado'];

        }

        $resumenJson=json_encode($this->Resumen);

        echo($resumenJson);
        
    }

}


?>