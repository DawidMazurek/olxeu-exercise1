<?php

include "../vendor/autoload.php";
ini_set('display_errors', 'off');

use naspersclassifieds\olxeu\app\Application;

(new Application([
    'routing' => include '../resources/routing.php',
]))->run();

