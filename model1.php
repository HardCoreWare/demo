<?php

if(isset($_GET['req'])){

   $filtersJson=$_GET['req'];

    $filters=json_decode($filtersJson);

    $filters1=$filters->$filters1;

    $filters2=$filters->$filters2;

    $filters3=$filters->$filters3;

    require_once('informe.php');

    $informe = new Informe($filters1,$filters2,$filters3);

}


?>