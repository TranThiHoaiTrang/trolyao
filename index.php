<?php

require __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

const SOURCES_PATH = BASE_PATH . 'sources' . DIRECTORY_SEPARATOR;
const TEMPLATE_PATH = BASE_PATH . 'templates' . DIRECTORY_SEPARATOR;
const LAYOUT_PATH = TEMPLATE_PATH . 'layout' . DIRECTORY_SEPARATOR;

//session_start();
const LIBRARIES = LIBRARIES_PATH;
const SOURCES = SOURCES_PATH;
const LAYOUT = LAYOUT_PATH;
const THUMBS = THUMBS_URL;
const WATERMARK = WATERMARK_URL;

/* Config */
require_once LIBRARIES_PATH . 'autoload.php';
require_once LIBRARIES_PATH . "config.php";

global $config;

new AutoLoad();

$injection = new AntiSQLInjection();
$d = new PDODb($config['database']);
$seo = new Seo($d);
$emailer = new Email($d);
$router = new AltoRouter();
$cache = new FileCache($d);
$func = new Functions($d);
$breadcr = new BreadCrumbs($d);
$statistic = new Statistic($d, $cache);
$cart = new Cart($d);
$detect = new MobileDetect();
$addons = new AddonsOnline();
$css = new CssMinify($config['website']['debug-css'], $func);
$js = new JsMinify($config['website']['debug-js'], $func);

include TEMPLATE_PATH . "redirect.php";
require_once LIBRARIES_PATH . "router.php";
// include TEMPLATE_PATH . "pasg.php";

if (isset($_COOKIE['login_session']) && isset($_COOKIE['login_session_name'])) {
    include TEMPLATE_PATH . "index.php";
}
elseif($_SERVER['REDIRECT_URL'] == '/account/quen-mat-khau'){
    include "quenmatkhau.php";
}
else{
    include "lock.php";
}
