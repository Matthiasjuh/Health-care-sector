<?php


function PrijsExclBtw($prijsinclbtw)
{
    $prijsexclbtw = $prijsinclbtw * 0.79;
    $decimalen = number_format($prijsexclbtw, 2, '.', ',');

    return($decimalen);

}


?>