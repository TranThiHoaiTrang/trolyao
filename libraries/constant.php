<?php
if (!defined('LIBRARIES_PATH')) die("Error");

/* Array folders */
$upload_const = 'upload';
//$array_const = array('file', 'elfinder', 'sync', 'excel', 'seopage', 'photo', 'temp', 'user', 'product', 'color', 'news', 'tags', 'static');

$config_base = BASE_URL;

/* Define - Create folders uploads */
Helper::create_directory( BASE_PATH . $upload_const . DIRECTORY_SEPARATOR );

if ( file_exists( BASE_PATH . $upload_const . DIRECTORY_SEPARATOR ) ) {
    $path_htaccess = BASE_PATH . $upload_const . DIRECTORY_SEPARATOR . '.htaccess';

    if ( ! file_exists( $path_htaccess ) ) {
        $content_htaccess = '<Files ~ "\.(inc|sql|php|cgi|pl|php4|php5|asp|aspx|jsp|txt|kid|cbg|nok|shtml)$">' . PHP_EOL;
        $content_htaccess .= 'order allow,deny' . PHP_EOL;
        $content_htaccess .= 'deny from all' . PHP_EOL;
        $content_htaccess .= '</Files>';

        $file_htaccess = fopen($path_htaccess, "w") or die("Unable to open file");
        fwrite($file_htaccess, $content_htaccess);
        fclose($file_htaccess);
    }
}

/** */
