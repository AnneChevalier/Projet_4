<?php

require 'lib/JFFram/Autoloader.php';

use JFFram\Autoloader;
use JFFram\Rooter;

Autoloader::register();

$rooter = new Rooter('Frontend');
$rooter->executeRequest();

?>