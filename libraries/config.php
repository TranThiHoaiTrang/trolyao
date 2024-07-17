<?php
if (!defined('LIBRARIES_PATH')) die("Error");

/* Root */
const ROOT = __DIR__;

/* Timezone */
date_default_timezone_set('Asia/Ho_Chi_Minh');

/* Cấu hình coder */
const NN_MSHD = 'trolyao';
const NN_AUTHOR = '';

/* Cấu hình chung */
$config = [
    'customEmail' => 'info@webhd.vn', //email nhận mật khẩu
    'copright' => [ // thông tin công ty tts
        'name' => 'CÔNG TY TNHH PHÁT TRIỂN CÔNG NGHỆ HD',
        'email' => 'info@webhd.vn',
        'dienthoai' => '0938 002 776',
        'diachi' => '4B Nhất Chi Mai, Phường 13, Quận Tân Bình, TPHCM',
        'website' => 'sotagroup.vn',
        'worktime' => '8h - 17h từ thứ 2 đến thứ sáu, 8h - 12h sáng thứ bảy'
    ],
    'author' => [
        'name' => 'CÔNG TY TNHH PHÁT TRIỂN CÔNG NGHỆ HD',
        'email' => 'info@webhd.vn',
        'timefinish' => 'Unknown'
    ],
    'arrayDomainSSL' => [""],
    // 'arrayDomainSSL' => array(),
    'database' => [
        'server-name' => $_SERVER["SERVER_NAME"],
        'url' => ROOT_URI,
        'type' => 'mysql',
        'host' => 'localhost',
        // 'username' => 'aelgsnnyhosting_detmaythanhtung',
        // 'password' => 'iN3@Thi2IzTCnU6',
        // 'dbname' => 'aelgsnnyhosting_detmaythanhtung',
        'username' => 'root',
        'password' => '',
        'dbname' => 'trolyao',
        'port' => 3306,
        'prefix' => 'table_',
        'charset' => 'utf8'
    ],
    'website' => [
        'sendmail' => false,
        'error-reporting' => false,
        'secret' => '$tts@',
        'salt' => 'swKJaajeS!t',
        'debug-developer' => false,
        'debug-css' => true,
        'debug-js' => true,
        'index' => false,
        'upload' => [
            'max-width' => 1600,
            'max-height' => 1600
        ],
        'lang' => [
            'vi' => 'Tiếng Việt'
            //'en'=>'Tiếng Anh'
        ],
        'lang-doc' => 'vi|en',
        'slug' => [
            'vi' => 'Tiếng Việt'
            //'en'=>'Tiếng Anh'
        ],
        'seo' => [
            'vi' => 'Tiếng Việt'
            //'en'=>'Tiếng Anh'
        ],
        'faq' => [
            'vi' => 'Tiếng Việt'
            //'en'=>'Tiếng Anh'
        ],
        'comlang' => [
            "gioi-thieu" => ["vi" => "gioi-thieu"],
            "tin-tuc" => ["vi" => "tin-tuc"],
            "san-pham" => ["vi" => "san-pham"],
            "cong-trinh" => ["vi" => "cong-trinh"],
            "dich-vu" => ["vi" => "dich-vu"],
            "lien-he" => ["vi" => "lien-he"]
        ]
    ],
    'order' => [
        'ship' => true,
    ],

    'login' => [
        'admin' => 'LoginAdmin' . NN_MSHD,
        'member' => 'LoginMember' . NN_MSHD,
        'attempt' => 5,
        'delay' => 15
    ],
    'googleAPI' => [
        'recaptcha' => [
            'active' => false,
            'urlapi' => 'https://www.google.com/recaptcha/api/siteverify',
            'sitekey' => '6Lc-lV8pAAAAAJbnW56XpQ3JLj2Gfgyjd3GgM3mL',
            'secretkey' => '6Lc-lV8pAAAAACxiMjqmr3bKK6rBoFawB8Dag9DX'
        ]
    ],
    'oneSignal' => [
        'active' => false,
        'id' => 'af12ae0e-cfb7-41d0-91d8-8997fca889f8',
        'restId' => 'MWFmZGVhMzYtY2U0Zi00MjA0LTg0ODEtZWFkZTZlNmM1MDg4'
    ],
    'license' => [
        'version' => "7.0.0",
        'powered' => "tts@congnghetts.vn"
    ]
];

/* Error reporting */
error_reporting(($config['website']['error-reporting']) ? E_ALL : 0);

/* Cấu hình base */
$http = 'http://';
$config_url = $config['database']['server-name'] . $config['database']['url'];
$config_base = $http . $config_url;

/* Cấu hình login */
$login_admin = $config['login']['admin'];
// $login_member = $config['login']['member'];

/* Cấu hình upload */
require_once LIBRARIES_PATH . "constant.php";
