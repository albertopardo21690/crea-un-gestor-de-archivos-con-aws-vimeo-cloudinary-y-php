<?php

/*=============================================
Depurar Errores
=============================================*/

define('DIR',__DIR__);

ini_set("display_errors", 1);
ini_set("log_erros", 1);
ini_set("error_log", DIR."/php_error_log");

require_once "controllers/curl.controller.php";
require_once "controllers/template.controller.php";

$index = new TemplateController();
$index->index();