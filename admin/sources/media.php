<?php

global $func, $act, $com, $d;;

if (!defined('SOURCES')) die("Error");

if ( empty($config['media']) ) {
    $func->transfer("Trang không tồn tại", "index.php", false);
}

//-------------------------------------------------------------------

Media_Controller::show_media();
$template = "media/list";

//-------------------------------------------------------------------

class Media_Controller {

    public static function show_media() {
        global $d, $func, $curPage;
    }
}
