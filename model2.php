<?php

require_once('informe.php');

    $informe = new Informe();

    $informe->read0(["GI-APL","GI-INF","GI-SER"],[],[]);

    $informe->read1([],[],[]);

    $informe->testing();

?>