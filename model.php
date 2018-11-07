<?php

if(isset($_GET['req'])){

   $filtersJson=$_GET['req'];

    $filters=json_decode($filtersJson); $filtersJson=null;

    $filters1=[];
    $filters2=[];
    $filters3=[];

    foreach ($filters->filters1 as $filterSet) {$filters1[]=$filterSet;}

    foreach ($filters->filters2 as $filterSet) {$filters2[]=$filterSet;}

    foreach ($filters->filters3 as $filterSet) {$filters3[]=$filterSet;}

    $filters=null;

    require_once('informe.php');

    $informe = new Informe($filters1,$filters2,$filters3);

}

?>