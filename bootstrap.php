<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

define('ENVIRONMENT', $_SERVER['_ENV'] ?? 'production');

// ERROR REPORTING
switch (ENVIRONMENT) {
    case 'development':
        error_reporting(-1);
        ini_set('display_errors', 1);
        break;

    case 'staging':
    case 'testing':
    case 'production':
        ini_set('display_errors', 0);
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        break;

    default:
        header('HTTP/1.1 503 Service Unavailable.', true, 503);
        echo 'The application environment is not set correctly.';
        exit(1);
}

const BASE_PATH = __DIR__ . DIRECTORY_SEPARATOR;

//=======================================
const ROOT_URI = '/';
//=======================================

$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http") . "://" . @$_SERVER['HTTP_HOST'];
$base_url = rtrim($base_url, '/') . '/';

if ( '/' != ROOT_URI ) {
    $base_url .= trim(ROOT_URI, '/') . '/';
}

define('BASE_URL', $base_url);
unset($base_url);

const LIBRARIES_PATH = BASE_PATH . 'libraries' . DIRECTORY_SEPARATOR;

const UPLOADS_PATH = BASE_PATH . 'upload' . DIRECTORY_SEPARATOR;
const UPLOADS_URL = BASE_URL . 'upload/';

const THUMBS_PATH = BASE_PATH . 'thumbs' . DIRECTORY_SEPARATOR;
const THUMBS_URL = BASE_URL . 'thumbs/';

const WATERMARK_PATH = BASE_PATH . 'watermark' . DIRECTORY_SEPARATOR;
const WATERMARK_URL = BASE_URL . 'watermark/';

const ASSETS_URL = BASE_URL . 'assets/';

if (file_exists(BASE_PATH . 'vendor/autoload.php')) {
    require_once BASE_PATH . 'vendor/autoload.php';
}

require_once LIBRARIES_PATH . "Helper.php";
