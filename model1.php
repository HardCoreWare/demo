<?php

require_once('informe.php');

    $informe= new Informe();
    $informe->readPresupuesto();
    $informe->readGasto();
    $informe->chartData();

?>