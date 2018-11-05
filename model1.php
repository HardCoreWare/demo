<?php

class Informe{

    private $Informe=[];

    private $resumen=['Gasto'];

    public function __construct(){


    }

    /************************************************************************************************************************************************************************************************/
    public function read0(){

        $presupuestoJson = file_get_contents('querys/presupuesto_query.json');

        $presupuestos = json_decode($presupuestoJson); $presupuestoJson = null;

        $presupuesto=$presupuestos[0]->Presupuesto_Total_TI;

        $this->Informe['Presupuesto_Anual'][$presupuesto->Codigo_PEP]['Descripcion']=$presupuesto->Descripcion;
        $this->Informe['Presupuesto_Anual'][$presupuesto->Codigo_PEP]['Presupuesto']=0;
        
        foreach ($presupuesto->Tipo_Gastos as $desgloce1) {

            $this->Informe['Presupuesto_Anual'][$presupuesto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Presupuesto']=0;

            foreach ($desgloce1->Categorias as $desgloce2) {

                $this->Informe['Presupuesto_Anual'][$presupuesto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['Presupuesto']=0;

                foreach ($desgloce2->PEPs as $desgloce3) {

                    $this->Informe['Presupuesto_Anual'][$presupuesto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['PEPs'][$desgloce3->Codigo_PEP]['Presupuesto']=floatval($desgloce3->Presupuesto);
                    $this->Informe['Presupuesto_Anual'][$presupuesto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['Presupuesto']+=floatval($desgloce3->Presupuesto);

                }

                $this->Informe['Presupuesto_Anual'][$presupuesto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Presupuesto']+=
                $this->Informe['Presupuesto_Anual'][$presupuesto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['Presupuesto'];

            }

            $this->Informe['Presupuesto_Anual'][$presupuesto->Codigo_PEP]['Presupuesto']+=
            $this->Informe['Presupuesto_Anual'][$presupuesto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Presupuesto'];

        }

    }


    public function read1(){

        $gastosJson=file_get_contents('querys/gastos_query.json');

        $gastos=json_decode($gastosJson);

        foreach ($gastos as $mensual) {

            $gasto=$mensual->Gasto_Mensual_TI;

            $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Gasto_Total']=0;
            $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Gasto_Real']=0;
            $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Gasto_Comprometido']=0;

            foreach ($gasto->Tipo_Gastos as $desgloce1) {

                $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Gasto_Total']=0;
                $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Gasto_Real']=0;
                $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Gasto_Comprometido']=0;

                foreach ($desgloce1->Categorias as $desgloce2) {

                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['Gasto_Total']=0;
                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['Gasto_Real']=0;
                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['Gasto_Comprometido']=0;

                    foreach ($desgloce2->PEPs as $desgloce3) {

                        $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['PEPs'][$desgloce3->Codigo_PEP]['Gasto_Total']=floatval($desgloce3->Gasto->Real)+floatval($desgloce3->Gasto->Comprometido);
                        $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['PEPs'][$desgloce3->Codigo_PEP]['Gasto_Real']=floatval($desgloce3->Gasto->Real);
                        $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['PEPs'][$desgloce3->Codigo_PEP]['Gasto_Comprometido']=floatval($desgloce3->Gasto->Comprometido);

                        $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['Gasto_Total']+=
                        $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['PEPs'][$desgloce3->Codigo_PEP]['Gasto_Total'];
                        $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['Gasto_Real']+=
                        $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['PEPs'][$desgloce3->Codigo_PEP]['Gasto_Real'];
                        $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['Gasto_Comprometido']+=
                        $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['PEPs'][$desgloce3->Codigo_PEP]['Gasto_Comprometido'];                       
                        
                    }

                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Gasto_Total']+=
                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['Gasto_Total'];
                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Gasto_Real']+=
                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['Gasto_Real'];
                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Gasto_Comprometido']+=
                    $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['Gasto_Comprometido'];

                }

                $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Gasto_Total']+=
                $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Gasto_Total'];
                $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Gasto_Real']+=
                $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Gasto_Real'];            
                $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Gasto_Comprometido']+=
                $this->Informe['Gastos_Mensuales'][$mensual->Id_Mes][$gasto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Gasto_Comprometido'];

            }

        }

        //print_r($this->Informe['Gastos_Mensuales']);
        
    }

    public function read2(){

        $presupuestoJson = file_get_contents('querys/presupuesto_query.json');

        $presupuestos = json_decode($presupuestoJson); $presupuestoJson = null;

        $presupuesto=$presupuestos[0]->Presupuesto_Total_TI;

        $this->Informe['Campos'][$presupuesto->Codigo_PEP]['Descripcion']=$presupuesto->Descripcion;
        
        foreach ($presupuesto->Tipo_Gastos as $desgloce1) {

            $this->Informe['Campos'][$presupuesto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Descripcion']=$desgloce1->Descripcion;

            foreach ($desgloce1->Categorias as $desgloce2) {

                $this->Informe['Campos'][$presupuesto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['Descripcion']=$desgloce2->Descripcion;

                foreach ($desgloce2->PEPs as $desgloce3) {

                    $this->Informe['Campos'][$presupuesto->Codigo_PEP]['Tipo_Gastos'][$desgloce1->Codigo_PEP]['Categorias'][$desgloce2->Codigo_PEP]['PEPs'][$desgloce3->Codigo_PEP]['Descripcion']=$desgloce3->Descripcion;

                }

            }

        }

        $pepsJson=json_encode($this->Informe['Campos']);

        echo($pepsJson);
        
    }

    public function chartData(){

        foreach ($this->Informe['Gastos_Mensuales'] as $mes => $gasto) {

            $this->Resumen['Gastos'][$mes]=$gasto['GI-TI-TOT']['Gasto_Real'];
            $this->Resumen['Presupuesto'][$mes]['Inicial'] = $this->Informe['Presupuesto_Anual']['GI-TI-TOT']['Presupuesto'];
            $this->Resumen['Presupuesto'][$mes]['Disponible'] = $this->Informe['Presupuesto_Anual']['GI-TI-TOT']['Presupuesto']-
            $this->Resumen['Gastos'][$mes]=$gasto['GI-TI-TOT']['Gasto_Total'];

        }

        $resumenJson=json_encode($this->Resumen);

        echo($resumenJson);
        
    }

}

$informe= new Informe();
$informe->read0();
$informe->read1();
$informe->chartData();

?>