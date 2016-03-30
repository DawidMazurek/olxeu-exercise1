<?php

include "../vendor/autoload.php";

use naspersclassifieds\olxeu\app\Application;

(new Application([
    'routing' => include '../resources/routing.php',
]))->run();

