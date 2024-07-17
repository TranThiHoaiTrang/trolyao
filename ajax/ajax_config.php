<?php

require dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'bootstrap.php';

const SOURCES_PATH = BASE_PATH . 'sources' . DIRECTORY_SEPARATOR;
const TEMPLATE_PATH = BASE_PATH . 'templates' . DIRECTORY_SEPARATOR;
const LAYOUT_PATH = TEMPLATE_PATH . 'layout' . DIRECTORY_SEPARATOR;

//session_start();
const LIBRARIES = LIBRARIES_PATH;
const THUMBS = THUMBS_URL;
const WATERMARK = WATERMARK_URL;

if (!isset($_SESSION['lang'])) $_SESSION['lang'] = 'vi';
$lang = $_SESSION['lang'];

require_once LIBRARIES_PATH . "config.php";
require_once LIBRARIES_PATH . 'autoload.php';

new AutoLoad();
$d = new PDODb($config['database']);
$func = new Functions($d);
$cache = new FileCache($d);
$cart = new Cart($d);
require_once LIBRARIES_PATH . "lang/lang$lang.php";

/* Slug lang */
$sluglang = 'tenkhongdauvi';
