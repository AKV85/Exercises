<?php
function padalintiIMasyvus($masyvas)
{ 
    $sortMasyvas=$masyvas;
    rsort($sortMasyvas);

    $grupes = array(array(), array(), array());

    foreach ($sortMasyvas as $elementas) {
        $mažiausiosSumosIndeksas = surastiMinSumosIndeksa($grupes);

        $grupes[$mažiausiosSumosIndeksas][] = $elementas;
    }

    $eilutesPabaiga = (php_sapi_name() !== 'cli') ? "<br>" : "\n";

    echo "Pradinis masyvas: " . implode(",", $masyvas) . $eilutesPabaiga;
    
    echo "Rezultatai: " . $eilutesPabaiga;
    foreach ($grupes as $grupe) {
        echo implode(",", $grupe) . " = " . array_sum($grupe) . $eilutesPabaiga;
    }
}

function surastiMinSumosIndeksa($grupes)
{
    $minSuma = PHP_INT_MAX;
    $minSumosIndeksas = -1;

    foreach ($grupes as $indeksas => $grupe) {
        $suma = array_sum($grupe);
        if ($suma < $minSuma) {
            $minSuma = $suma;
            $minSumosIndeksas = $indeksas;
        }
    }

    return $minSumosIndeksas;
}

$masyvas = array(1,2,4,7,1,6,2,8);

padalintiIMasyvus($masyvas);
