<?php

$m = new Memcache();
$m->addserver("localhost", 11211);

for ($i = 0; $i < 50000; $i++) {
    $m->get("numero_inteiro_{$i}");
}

for ($i = 0; $i < 50000; $i++) {
    $m->get("numero_inteiro__{$i}");
}



