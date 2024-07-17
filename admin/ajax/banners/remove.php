<?php

include dirname(__DIR__, 1) . "/ajax_config.php";

global $d;

$id = $_POST['id'];
$tpl = $_POST['tpl'];
$key = $_POST['key'];

if ( $id && $tpl && $key ) {
    $d->where('id', $id);

    $arr_update = $d->filter_data($tpl, [$key => '']);dd('xxxx');
    $d->update($tpl, $arr_update);
}

die();