<?php

$m = new Memcache();
$m->addserver("localhost", 11211);
$m->addserver("192.168.45.2", 11211);


for ($i = 0; $i < 50000; $i++) {
    $m->set("numero_inteiro_{$i}", $i);
}



