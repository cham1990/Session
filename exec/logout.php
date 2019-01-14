<?php

require_once '../config.php';
require_once '../lib/pdo.php';

$_SESSION['user_id'] = '';
session_destroy();
header("Location: ".SITE_URL); 
exit();
