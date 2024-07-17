<?php

/* tin tức */
$nametype = "quanly_donvi";
$config['news'][$nametype]['title_main'] = "Quản lý đơn vị";
$config['news'][$nametype]['dropdown'] = true;
$config['news'][$nametype]['list'] = false;
$config['news'][$nametype]['check'] = array();
$config['news'][$nametype]['view'] = true;
$config['news'][$nametype]['slug'] = false;
$config['news'][$nametype]['copy'] = false;
$config['news'][$nametype]['bando'] = false;
$config['news'][$nametype]['cauhoi'] = false;
$config['news'][$nametype]['images'] = false;
$config['news'][$nametype]['show_images'] = false;
$config['news'][$nametype]['mota'] = false;
$config['news'][$nametype]['noidung'] = false;
$config['news'][$nametype]['noidung_cke'] = true;
$config['news'][$nametype]['seo'] = false;
$config['news'][$nametype]['excel'] = false;
$config['news'][$nametype]['iframe_excel'] = false;
$config['news'][$nametype]['width'] = 684;
$config['news'][$nametype]['height'] = 372;
$config['news'][$nametype]['thumb'] = '684x372x1';
$config['news'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

/* tin tức */
$nametype = "trungtam_quanly";
$config['news'][$nametype]['title_main'] = "Trung tâm quản lý";
$config['news'][$nametype]['dropdown'] = true;
$config['news'][$nametype]['list'] = false;
$config['news'][$nametype]['check'] = array();
$config['news'][$nametype]['view'] = true;
$config['news'][$nametype]['slug'] = true;
$config['news'][$nametype]['copy'] = false;
$config['news'][$nametype]['bando'] = false;
$config['news'][$nametype]['donvi'] = true;
$config['news'][$nametype]['cauhoi'] = false;
$config['news'][$nametype]['images'] = false;
$config['news'][$nametype]['show_images'] = false;
$config['news'][$nametype]['mota'] = false;
$config['news'][$nametype]['noidung'] = false;
$config['news'][$nametype]['noidung_cke'] = true;
$config['news'][$nametype]['seo'] = true;
$config['news'][$nametype]['excel'] = true;
$config['news'][$nametype]['iframe_excel'] = true;
$config['news'][$nametype]['width'] = 684;
$config['news'][$nametype]['height'] = 372;
$config['news'][$nametype]['thumb'] = '684x372x1';
$config['news'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

/* Tin tức (List) */
// $config['news'][$nametype]['title_main_list'] = "Danh mục cấp 1";
// $config['news'][$nametype]['images_list'] = false;
// $config['news'][$nametype]['show_images_list'] = false;
// $config['news'][$nametype]['slug_list'] = true;
// $config['news'][$nametype]['check_list'] = array();
// $config['news'][$nametype]['gallery_list'] = array();
// $config['news'][$nametype]['mota_list'] = false;
// $config['news'][$nametype]['mota_cke_list'] = false;
// $config['news'][$nametype]['noidung_list'] = false;
// $config['news'][$nametype]['noidung_cke_list'] = false;
// $config['news'][$nametype]['seo_list'] = true;
// $config['news'][$nametype]['width_list'] = 320;
// $config['news'][$nametype]['height_list'] = 240;
// $config['news'][$nametype]['thumb_list'] = '100x100x1';
// $config['news'][$nametype]['img_type_list'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


/* Hình thức thanh toán *-/
    $nametype = "hinh-thuc-thanh-toan";
    $config['news']['hinh-thuc-thanh-toan']['title_main'] = "Hình thức thanh toán";
    $config['news']['hinh-thuc-thanh-toan']['check'] = array();
    $config['news']['hinh-thuc-thanh-toan']['mota'] = true;

    /* Quản lý mục (Không cấp) */
if (isset($config['news'])) {
    foreach ($config['news'] as $key => $value) {
        if (!isset($value['dropdown']) || (isset($value['dropdown']) && $value['dropdown'] == false)) {
            $config['shownews'] = 1;
            break;
        }
    }
}
