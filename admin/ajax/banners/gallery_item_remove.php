<?php

global $d;
include dirname(__DIR__, 1) . "/ajax_config.php";

$id = $_POST['id'];
$tpl = $_POST['tpl'];
$link = $_POST['link'];

if ( $id && $tpl && $link ) {

    $item = $d->get_by_id( $tpl, $id );
    $galleries = $item['gallery'] ?? '';
    if ( $galleries ) {
        $galleries = explode( ',', $galleries );

        foreach ( $galleries as $i => $gallery ) {

            if ( $link === $gallery ) {
                unset($galleries[$i]);
                break;
            }
        }

        $d->where('id', $id);
        try {
            $arr_update = $d->filter_data( $tpl, [ 'gallery' => implode( ',', $galleries ) ] );
            $d->update($tpl, $arr_update);

        } catch (Exception $e) {}
    }
}

die();