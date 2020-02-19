<?php

/*
 * 
 * Author: Oleg Antipov
<<<<<<< HEAD
 * 
=======
 *12
>>>>>>> 09288a413484c752396d1e9926667c05582b6b02
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);

date_default_timezone_set('Europe/Moscow');

define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("URI", $_SERVER['REQUEST_URI']);

require ROOT . '/app/models/_AutoInclude.php';
require ROOT . '/app/models/_DB.php';
require ROOT . '/app/models/_MainModel.php';
require ROOT . '/app/models/_Render.php';
require ROOT . '/app/models/_Router.php';
require ROOT . '/app/presenters/_MainPresenter.php';


//подключение всех файлов
$include = new _AutoInclude();
$include->autoload();

//роутер
$router = new _Router();
$router->initialization();

?>
