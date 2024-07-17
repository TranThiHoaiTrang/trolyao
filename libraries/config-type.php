<?php
    /* Config type - Group */
    $config['group'] = array(
        /*"Group Sản Phẩm" => array(
            "product" => array("san-pham"),
            //"tags" => array("san-pham"),
            //"static" => array("gioi-thieu-san-pham"),
            //"photo" => array("slide-product"),
            //"photo_static" => array("watermark"),
            //"newsletter" => array("dangkybaogia")
        ),*/
        // "Nội dung trang chủ" => array(
        //     "photo" => array("slide"),
        //     "news" => array("feedback"),
        //     "photo_static" => array("background-tieuchi"),
        //     //"tags" => array("tin-tuc"),
        //     //"newsletter" => array("dangkytuyendung")
        // )
    );

/* Config type - Media */
require_once LIBRARIES_PATH . 'type/config-type-media.php';

    /* Config type - Product */
    require_once LIBRARIES_PATH.'type/config-type-product.php';

    /* Config type - Tags */
    // require_once LIBRARIES.'type/config-type-tags.php';

    /* Config type - Newsletter 
    require_once LIBRARIES.'type/config-type-newsletter.php';*/

    /* Config type - News */
    require_once LIBRARIES_PATH.'type/config-type-news.php';

    /* Config type - Static */
    // require_once LIBRARIES_PATH.'type/config-type-static.php';

    /* Config type - Photo */
    require_once LIBRARIES_PATH.'type/config-type-photo.php';

    /* Seo page */
    $config['seopage']['page'] = array(
        "gioi-thieu" => "Giới thiệu",
        "san-pham" => "Danh mục vải",
        "chinh-sach" => "Chính sách",        
        "blog" => "Blog",          
        // "lien-he" => "Liên hệ",
        //"tim-kiem" => "Tìm kiếm"
    );
    $config['seopage']['width'] = 300;
    $config['seopage']['height'] = 200;
    $config['seopage']['thumb'] = '300x200x1';
    $config['seopage']['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Setting */
    $config['setting']['diachi'] = true;
    $config['setting']['diachi2'] = true;
    $config['setting']['diachi3'] = true;
    $config['setting']['dienthoai'] = true;
    $config['setting']['dienthoai_nv'] = false;
    $config['setting']['hotline'] = true;
    $config['setting']['tg_hoatdong'] = false;
    $config['setting']['zalo'] = true;
    $config['setting']['oaidzalo'] = false;
    $config['setting']['copyright'] = false;
    $config['setting']['email'] = true;
    $config['setting']['website'] = true;
    $config['setting']['fanpage'] = true;
    $config['setting']['toado'] = true;
    $config['setting']['slogan'] = false;
    $config['setting']['excel'] = false;
    $config['setting']['file_excel'] = false;
    $config['setting']['toado_iframe'] = true;

    /* Quản lý import */
    $config['import']['images'] = false;
    $config['import']['thumb'] = '100x100x1';
    $config['import']['img_type'] = ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF";

    /* Quản lý export */
    $config['export']['category'] = false;

    /* Quản lý tài khoản */
    $config['user']['active'] = true;
    $config['user']['admin'] = true;
    $config['user']['visitor'] = true;

    /* Quản lý phân quyền */
    $config['permission'] = true;

    /* Quản lý địa điểm */
    $config['places']['active'] = false;
    $config['places']['placesship'] = false;

    /* Quản lý giỏ hàng */
    $config['order']['active'] = false;
    $config['order']['search'] = false;
    $config['order']['excel'] = false;
    $config['order']['word'] = false;
    $config['order']['excelall'] = false;
    $config['order']['wordall'] = false;
    $config['order']['thumb'] = '100x100x1';

    /* Quản lý thông báo đẩy */
    $config['onesignal'] = false;
