<?php 

// Dependências
require_once "modules/_autoloader.php";

$fields = Env::get();

// Definindo as variáveis do .env
define("API_KEY", $fields["API_KEY"]);
define("API_SECRET", $fields["API_SECRET"]);
define("DBNAME", $fields["DBNAME"]);
define("DBPORT", $fields["DBPORT"]);
define("DBPASSWORD", $fields["DBPASSWORD"]);
define("DBUSER", $fields["DBUSER"]);

