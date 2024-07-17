<?php
require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'bootstrap.php';

const ADMIN_PATH = BASE_PATH . 'admin' . DIRECTORY_SEPARATOR;
const SOURCES_PATH = ADMIN_PATH . 'sources/';

//session_start();
const LIBRARIES = LIBRARIES_PATH;
const SOURCES = SOURCES_PATH;
const THUMBS = THUMBS_URL;

/*const LIBRARIES = '../../libraries/';
const SOURCES = '../sources/';
const THUMBS = 'thumbs';*/

require_once LIBRARIES_PATH . 'autoload.php';
require_once LIBRARIES_PATH . "config.php";
require_once LIBRARIES_PATH . "config-type.php";

global $config;

new AutoLoad();

$d = new PDODb($config['database']);
$func = new Functions($d);
$cache = new FileCache($d);

if ( ! $func->check_login() || ! Helper::is_ajax_request() ) {
    die();
}
