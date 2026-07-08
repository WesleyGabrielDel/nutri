<?php

// Definindo caminhos de pasta
define('ROOT_PATH', __DIR__);
define('SRC_PATH', ROOT_PATH . '/src');
define('CORE_PATH', SRC_PATH . '/core');
define('ROUTES_PATH', SRC_PATH . '/routes');
define('UTILS_PATH', SRC_PATH . '/utils');
define('MODULES_PATH', ROOT_PATH . '/modules');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('HANDLERS_PATH', CORE_PATH . '/handlers');
define('SERVICES_PATH', CORE_PATH . '/services');

// Dependências
require_once MODULES_PATH . '/_autoloader.php';
require_once UTILS_PATH . '/_autoloader.php';
require_once SERVICES_PATH . '/_autoloader.php';
require_once HANDLERS_PATH . '/_autoloader.php';

$fields = Env::get();

// Definindo as variáveis do .env
define('API_KEY', $fields['API_KEY']);
define('API_SECRET', $fields['API_SECRET']);
define('DBNAME', $fields['DBNAME']);
define('DBPORT', $fields['DBPORT']);
define('DBPASSWORD', $fields['DBPASSWORD']);
define('DBUSER', $fields['DBUSER']);

