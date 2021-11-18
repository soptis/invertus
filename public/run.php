<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Controller\ProcessController;

(new ProcessController())->processFile();
