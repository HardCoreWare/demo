<?php
/*
class Informe{

    private $Informe=[];

    public function __construct(){

        $this->read();

    }

    public function read(){

        $presupuestoJson = file_get_contents('querys/presupuesto_query.json');

        $presupuestos = json_decode($presupuestoJson); $presupuestoJson = null;

        $presupuesto=$presupuestos[0]->Presupuesto_Total_TI;

        $this->Informe['Presupuesto_Anual']['Codigo_PEP']=$presupuesto->Codigo_PEP;
        $this->Informe['Presupuesto_Anual']['Descripcion']=$presupuesto->Descripcion;
        $this->Informe['Presupuesto_Anual']['Presupuesto']=0;
        
        foreach ($presupuesto->Tipo_Gastos as $i1 => $desgloce1) {

            $this->Informe['Presupuesto_Anual']['Tipo_Gastos'][$i1]['Presupuesto']=0;

            foreach ($desgloce1->Categorias as $i2 => $desgloce2) {

                $this->Informe['Presupuesto_Anual']['Tipo_Gastos'][$i1]['Categorias'][$i2]['Presupuesto']=0;

                foreach ($desgloce2->PEPs as $i3 => $desgloce3) {

                    $this->Informe['Presupuesto_Anual']['Tipo_Gastos'][$i1]['Categorias'][$i2]['PEPs'][$i3]['Presupuesto']=floatval($desgloce3->Presupuesto);
                    $this->Informe['Presupuesto_Anual']['Tipo_Gastos'][$i1]['Categorias'][$i2]['Presupuesto']+=floatval($desgloce3->Presupuesto);

                }

                $this->Informe['Presupuesto_Anual']['Tipo_Gastos'][$i1]['Presupuesto']+=$this->Informe['Presupuesto_Anual']['Tipo_Gastos'][$i1]['Categorias'][$i2]['Presupuesto'];
            }

            $this->Informe['Presupuesto_Anual']['Presupuesto']+=$this->Informe['Presupuesto_Anual']['Tipo_Gastos'][$i1]['Presupuesto'];

        }


        $gastosJson=file_get_contents('querys/gastos_query.json');

        $gastos=json_decode($gastosJson);

        foreach ($gastos as $i => $gasto) {

            switch($gasto->Id_Mes){

                case 1: $this->Informe['Gastos_Mensuales'][$i]['Mes']='Enero'; break;
                case 2: $this->Informe['Gastos_Mensuales'][$i]['Mes']='Febrero'; break;
                case 3: $this->Informe['Gastos_Mensuales'][$i]['Mes']='Marzo'; break;

            }

            $this->Informe['Gastos_Mensuales'][$i]['Gasto_Total']=0;
            $this->Informe['Gastos_Mensuales'][$i]['Gasto_Real']=0;
            $this->Informe['Gastos_Mensuales'][$i]['Gasto_Comprometido']=0;

            foreach ($gasto->Gasto_Mensual_TI->Tipo_Gastos as $i1 => $desgloce1) {

                $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Gasto_Total']=0;
                $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Gasto_Real']=0;
                $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Gasto_Comprometido']=0;


                foreach ($desgloce1->Categorias as $i2 => $desgloce2) {

                    $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Gasto_Total']=0;
                    $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Gasto_Real']=0;
                    $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Gasto_Comprometido']=0;

                    foreach ($desgloce2->PEPs as $i3 => $desgloce3) {

                        $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Categorias'][$i2]['PEPs'][$i3]['Gasto_Total']=floatval($desgloce3->Gasto->Real)+floatval($desgloce3->Gasto->Comprometido);
                        $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Categorias'][$i2]['PEPs'][$i3]['Gasto_Real']=floatval($desgloce3->Gasto->Real);
                        $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Categorias'][$i2]['PEPs'][$i3]['Gasto_Comprometido']=floatval($desgloce3->Gasto->Comprometido);

                        $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Gasto_Total']+=
                        $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Categorias'][$i2]['PEPs'][$i3]['Gasto_Total'];
                        $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Gasto_Real']+=
                        $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Categorias'][$i2]['PEPs'][$i3]['Gasto_Real'];
                        $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Gasto_Comprometido']+=
                        $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Categorias'][$i2]['PEPs'][$i3]['Gasto_Comprometido'];                        
                        
                    }

                    $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Gasto_Total']+=
                    $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Gasto_Total'];
                    $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Gasto_Real']+=
                    $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Gasto_Real'];
                    $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Gasto_Comprometido']+=
                    $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Categorias'][$i2]['Gasto_Comprometido'];

                }

                $this->Informe['Gastos_Mensuales'][$i]['Gasto_Total']+=
                $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Gasto_Total'];
                $this->Informe['Gastos_Mensuales'][$i]['Gasto_Real']+=
                $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Gasto_Real'];               
                $this->Informe['Gastos_Mensuales'][$i]['Gasto_Comprometido']+=
                $this->Informe['Gastos_Mensuales'][$i]['Tipo_Gastos'][$i1]['Gasto_Comprometido'];

            }

        }
        
    }

    public function write(){

        $informeJson=json_encode($this->Tipo_Gastos);

        echo($informeJson);

    }

}

$informe= new Informe();
*/
?>