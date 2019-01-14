<?php

    define('PROTOCOL','http://');
    define('BASE_URL',$_SERVER['HTTP_HOST'].'/');
    define('SITE_URL',PROTOCOL.BASE_URL.'aertrip/');
    define('IMG_URL',SITE_URL.'images/');
    define('LIB_CLASS',SITE_URL.'lib/');
    define('EXEC',SITE_URL.'exec/');

    require_once 'lib/session.php';
    $session = new Session;
