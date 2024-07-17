<?php
session_start();
// ini_set(' session.save_path',"/tmp");
require dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'bootstrap.php';

const ADMIN_PATH = BASE_PATH . 'admin' . DIRECTORY_SEPARATOR;
const ADMIN_URL = BASE_URL . 'admin/';
const ADMIN_ASSETS = ADMIN_URL . 'assets/';

const SOURCES_PATH = ADMIN_PATH . 'sources/';
const TEMPLATE_PATH = ADMIN_PATH . 'templates/';
const LAYOUT_PATH = TEMPLATE_PATH . 'layout/';
const UPLOAD_FILE = ADMIN_URL . 'upload/file/';

defined('ADMIN_BASEPATH') || define('ADMIN_BASEPATH', __DIR__ . '/');

//session_start();
const LIBRARIES = LIBRARIES_PATH;
//const LIBRARIES = '../libraries/';
const SOURCES = SOURCES_PATH;
//const SOURCES = './sources/';
const TEMPLATE = TEMPLATE_PATH;
//const TEMPLATE = './templates/';
const LAYOUT = LAYOUT_PATH;
//const LAYOUT = 'layout/';
const THUMBS = THUMBS_URL;
//const WATERMARK = '../watermark';
const WATERMARK = WATERMARK_URL;

require_once LIBRARIES_PATH . "config.php";
require_once LIBRARIES_PATH . 'autoload.php';

new AutoLoad();

$d = new PDODb($config['database']);
$seo = new Seo($d);
$emailer = new Email($d);
$func = new Functions($d);
$cache = new FileCache($d);
$statistic = new Statistic($d, $cache);
/* Check HTTP */
//$func->checkHTTP($http,$config['arrayDomainSSL'],$config_base,$config_url);

/* Config type */
require_once LIBRARIES . "config-type.php";

global $config;

/* Lang Init */
// require_once LIBRARIES_PATH."lang/langinit.php";

/* Setting */
$setting = $d->rawQueryOne("select * from #_setting limit 0,1");
$optsetting = (isset($setting['options']) && $setting['options'] != '') ? json_decode($setting['options'], true) : null;
$logo = $d->rawQueryOne("select id, photo from #_photo where type = ? and act = ? limit 0,1", ['logo', 'photo_static']);
$favicon = $d->rawQueryOne("select photo from #_photo where type = ? and act = ? and hienthi > 0 limit 0,1",array('favicon','photo_static'));

if (!empty($_COOKIE['login_admin']) && !empty($_COOKIE['login_session'])) {
    $row = $d->rawQueryOne("select * from #_user where id = ? and login_session=? and hienthi>0 limit 0,1", [$_COOKIE['login_admin'], $_COOKIE['login_session']]);
    /* Tạo Session login */
    $_SESSION[$login_admin]['active'] = true;
    $_SESSION[$login_admin]['username'] = $row['username'];
    $_SESSION[$login_admin]['id'] = $row['id'];
    $_SESSION[$login_admin]['role'] = $row['role'];
    $_SESSION[$login_admin]['quyen'] = $row['quyen'];
    $_SESSION[$login_admin]['token'] = $row['login_session'];
    $_SESSION[$login_admin]['password'] = $row['password'];
    $_SESSION[$login_admin]['login_session'] = $row['login_session'];
    $_SESSION[$login_admin]['login_token'] = $row['user_token'];
    $_SESSION[$login_admin]['id_donvi'] = $row['id_donvi'];
    $_SESSION[$login_admin]['cap'] = $row['cap'];

    /* Cập nhật quyền của user đăng nhập */
    $quyen = $_SESSION[$login_admin]['token'];
    $d->rawQuery("update #_user set quyen = ? where id = ?", [$quyen, $row['id']]);

    $success = "Đăng nhập thành công";

}

/* Requick */
include_once LIBRARIES_PATH . "requick.php";

if (isset($_GET['elfinder'])) {
    require_once "elfinder/php/connector.minimal.php";
    exit;
}
if (isset($_GET['elfinder'])) {
    require_once "filemanager/config/config.php";
    exit;
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= Helper::thumbnail_link( $favicon['photo'], 180, 180 ) ?>" rel="shortcut icon" type="image/x-icon"/>
    <title>Administrator - <?= $setting['tenvi'] ?></title>

    <!-- CSS -->
    <!--<link href="../assets/fontawesome512/all-admin.css" rel="stylesheet">-->
    <link href="../assets/css/animate.min.css" rel="stylesheet">
    <link href="<?=ADMIN_ASSETS?>sweetalert2/sweetalert2.css" rel="stylesheet">
    <link href="<?=ADMIN_ASSETS?>select2/select2.css" rel="stylesheet">
    <link href="<?=ADMIN_ASSETS?>sumoselect/sumoselect.css" rel="stylesheet">
    <link href="<?=ADMIN_ASSETS?>datetimepicker/jquery.datetimepicker.css" rel="stylesheet">
    <link href="<?=ADMIN_ASSETS?>daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="<?=ADMIN_ASSETS?>rangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="<?=ADMIN_ASSETS?>filer/jquery.filer.css" rel="stylesheet">
    <link href="<?=ADMIN_ASSETS?>filer/jquery.filer-dragdropbox-theme.css" rel="stylesheet">
    <link href="<?=ADMIN_ASSETS?>holdon/HoldOn.css" rel="stylesheet">
    <link href="<?=ADMIN_ASSETS?>css/adminlte.css" rel="stylesheet">
    <link href="<?=ADMIN_ASSETS?>css/adminlte-style.css" rel="stylesheet">
    <link href="<?=ADMIN_ASSETS?>css/codemirror/codemirror.min.css" rel="stylesheet" />
    <link href="<?=ASSETS_URL?>css/fonts_awe.css" rel="stylesheet" />

    <link href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.min.css" rel="stylesheet" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <script>
        var hd = {'lang': {}},
            BASE_URL = '<?php echo BASE_URL;?>';
        ADMIN_URL = '<?php echo ADMIN_URL;?>';
    </script>

    <!-- JS -->
    <script src="<?=ADMIN_ASSETS?>js/jquery.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!--<script src="assets/js/jquery-1.10.2.min.js"></script>-->
    <script src="<?=ADMIN_ASSETS?>js/moment.min.js"></script>
    <script src="<?=ADMIN_ASSETS?>sweetalert2/sweetalert2.js"></script>
    <script src="<?=ADMIN_ASSETS?>select2/select2.full.js"></script>
    <script src="<?=ADMIN_ASSETS?>sumoselect/jquery.sumoselect.js"></script>
    <script src="<?=ADMIN_ASSETS?>datetimepicker/php-date-formatter.min.js"></script>
    <script src="<?=ADMIN_ASSETS?>datetimepicker/jquery.mousewheel.js"></script>
    <script src="<?=ADMIN_ASSETS?>datetimepicker/jquery.datetimepicker.js"></script>
    <script src="<?=ADMIN_ASSETS?>daterangepicker/daterangepicker.js"></script>
    <script src="<?=ADMIN_ASSETS?>rangeSlider/ion.rangeSlider.js"></script>
    <script src="<?=ADMIN_ASSETS?>js/priceFormat.js"></script>
    <script src="<?=ADMIN_ASSETS?>jscolor/jscolor.js"></script>
    <script src="<?=ADMIN_ASSETS?>filer/jquery.filer.js"></script>
    <script src="<?=ADMIN_ASSETS?>holdon/HoldOn.js"></script>
    <script src="<?=ADMIN_ASSETS?>sortable/Sortable.js"></script>
    <script src="<?=ADMIN_ASSETS?>js/bootstrap.bundle.js"></script>
    <script src="<?=ADMIN_ASSETS?>js/adminlte.js"></script>

</head>
<body class="sidebar-mini hold-transition text-sm <?= (!isset($_SESSION[$login_admin]['active']) || $_SESSION[$login_admin]['active'] == false) ? 'login-page' : '' ?>">
<?php /* if($template == 'index' || $template == 'user/login') include TEMPLATE.LAYOUT."loader.php"; */ ?>
<!-- Wrapper -->

<?php if (isset($_SESSION[$login_admin]['active']) && ($_SESSION[$login_admin]['active'] == true)) { ?>
    <div class="wrapper layout-fixed">
        <?php
        include LAYOUT_PATH . "header.php";
        include LAYOUT_PATH . "menu.php";
        ?>
        <div class="content-wrapper">
            <?php if ($alertlogin) { ?>
                <section class="content">
                    <div class="container-fluid">
                        <div class="alert my-alert alert-warning alert-dismissible text-sm bg-gradient-warning mt-3 mb-0">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fas fa-exclamation-triangle"></i> <?= $alertlogin ?>
                        </div>
                    </div>
                </section>
            <?php } ?>
            <?php include TEMPLATE_PATH . $template . "_tpl.php"; ?>
        </div>

        <?php include LAYOUT_PATH . "footer.php"; ?>

    </div>
<?php } else {
    include TEMPLATE_PATH . "user/login_tpl.php";
} ?>
</body>
</html>