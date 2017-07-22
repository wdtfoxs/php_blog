<?php
/**
 * Created by PhpStorm.
 * User: wdtfoxs
 * Date: 17.04.17
 * Time: 19:58
 */
require '../vendor/autoload.php';
require_once '../src/Core/infrastructure/init.php';

$frontController = new \Exam\Core\FrontController();
$frontController->run();