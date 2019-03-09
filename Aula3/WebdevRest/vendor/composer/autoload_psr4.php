<?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'util\\' => array($baseDir . '/slim/aplicacao/util'),
    'model\\' => array($baseDir . '/slim/aplicacao/model'),
    'controller\\' => array($baseDir . '/slim/aplicacao/controller'),
    'Slim\\' => array($vendorDir . '/slim/slim/Slim'),
    'Psr\\Http\\Message\\' => array($vendorDir . '/psr/http-message/src'),
    'Psr\\Container\\' => array($vendorDir . '/psr/container/src'),
    'Interop\\Container\\' => array($vendorDir . '/container-interop/container-interop/src/Interop/Container'),
    'Firebase\\JWT\\' => array($vendorDir . '/firebase/php-jwt/src'),
    'FastRoute\\' => array($vendorDir . '/nikic/fast-route/src'),
);
