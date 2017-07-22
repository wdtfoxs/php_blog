<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// Main constants
define('CORE_PATH', realpath(__DIR__.'/..'));
define('SITE_PATH', realpath(CORE_PATH . '/../Site'));
define('PUBLIC_PATH', realpath(CORE_PATH . '/../../web'));
define('RESOURCES_PATH', realpath(CORE_PATH . '/../resources'));
define('MVC_DEFAULT_CONTROLLER', '\Exam\Site\Controllers\\'.'Home');
//actions
define('MVC_INDEX_ACTION', 'index');
define('MVC_NEW_ACTION', 'new');
define('MVC_CREATE_ACTION', 'create');
define('MVC_SHOW_ACTION', 'show');
define('MVC_EDIT_ACTION', 'edit');
define('MVC_UPDATE_ACTION', 'update');
define('MVC_DESTROY_ACTION', 'destroy');
session_start();