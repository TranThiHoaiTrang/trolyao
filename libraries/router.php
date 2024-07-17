<?php
/* Check HTTP */
$func->checkHTTP($http, $config['arrayDomainSSL'], $config_base, $config_url);

/* Validate URL */
$func->checkUrl($config['website']['index']);

/* Check login */
$func->checkLogin();

/* Mobile detect */
$deviceType = ($detect->isMobile() || $detect->isTablet()) ? 'mobile' : 'computer';
if ($deviceType == 'computer') define('TEMPLATE', './templates/');
else define('TEMPLATE', './templates/');

/* Watermark */
$wtmPro = $d->rawQueryOne("select hienthi, photo, options from #_photo where type = ? and act = ? limit 0,1", array('watermark', 'photo_static'));
$wtmNews = $d->rawQueryOne("select hienthi, photo, options from #_photo where type = ? and act = ? limit 0,1", array('watermark-news', 'photo_static'));

/* Router */
$router->setBasePath($config['database']['url']);
$router->map('GET', array('dangnhap/', 'dangnhap'), function () {
	global $func, $config;
	$func->redirect($config['database']['url'] . "dangnhap/index.php");
	exit;
});
$router->map('GET', array('dangnhap', 'dangnhap'), function () {
	global $func, $config;
	$func->redirect($config['database']['url'] . "dangnhap/index.php");
	exit;
});
$router->map('GET|POST', '', 'index', 'home');
$router->map('GET|POST', 'index.php', 'index', 'index');
$router->map('GET|POST', 'index_page.php', 'index_page', 'index_page');
$router->map('GET|POST', 'sitemap.xml', 'sitemap', 'sitemap');
$router->map('GET|POST', '[a:com]', 'allpage', 'show');
$router->map('GET|POST', '[a:com]/[a:lang]/', 'allpagelang', 'lang');
$router->map('GET|POST', '[a:com]/[a:action]', 'account', 'account');
$router->map('GET', THUMBS . '/[i:w]x[i:h]x[i:z]/[**:src]', function ($w, $h, $z, $src) {
	global $func;
	$func->createThumb($w, $h, $z, $src, null, THUMBS);
}, 'thumb');
$router->map('GET', WATERMARK . '/product/[i:w]x[i:h]x[i:z]/[**:src]', function ($w, $h, $z, $src) {
	global $func, $wtmPro;
	$func->createThumb($w, $h, $z, $src, $wtmPro, "product");
}, 'watermark');
$router->map('GET', WATERMARK . '/news/[i:w]x[i:h]x[i:z]/[**:src]', function ($w, $h, $z, $src) {
	global $func, $wtmNews;
	$func->createThumb($w, $h, $z, $src, $wtmNews, "news");
}, 'watermarkNews');
$match = $router->match();
if (is_array($match)) {
	if (is_callable($match['target'])) {
		call_user_func_array($match['target'], $match['params']);
	} else {
		$com = (isset($match['params']['com'])) ? htmlspecialchars($match['params']['com']) : htmlspecialchars($match['target']);
		$get_page = isset($_GET['p']) ? htmlspecialchars($_GET['p']) : 1;
	}
} else {
	// header('HTTP/1.0 404 Not Found', true, 404);
	// include("404.php");
	// exit;
	header('Location: /');
	exit;
}

/* Setting */
$sqlCache = "select * from #_setting";
$setting = $cache->getCache($sqlCache, 'fetch', 7200);
$optsetting = (isset($setting['options']) && $setting['options'] != '') ? json_decode($setting['options'], true) : null;

/* Lang */
if (isset($match['params']['lang']) && $match['params']['lang'] != '') $_SESSION['lang'] = $match['params']['lang'];
else if (!isset($_SESSION['lang']) && !isset($match['params']['lang'])) $_SESSION['lang'] = $optsetting['lang_default'];
$lang = $_SESSION['lang'];

/* Slug lang */
$sluglang = 'tenkhongdauvi';

/* SEO Lang */
$seolang = "vi";

/* Require datas */
require_once LIBRARIES . "lang/lang$lang.php";
require_once SOURCES . "allpage.php";

/* Tối ưu link */
$requick = array(

	/* Sản phẩm */
	array("tbl" => "product_list", "field" => "idl", "source" => "product", "com" => "van-ban", "type" => "van-ban", 'menu' => true),
	array("tbl" => "product_cat", "field" => "idc", "source" => "product", "com" => "van-ban", "type" => "van-ban", 'menu' => true),
	array("tbl" => "product_item", "field" => "idi", "source" => "product", "com" => "van-ban", "type" => "van-ban", 'menu' => true),
	array("tbl" => "product_danhmuc", "field" => "iddm", "source" => "product", "com" => "van-ban", "type" => "van-ban", 'menu' => true),
	array("tbl" => "product_danhmuc_cap", "field" => "iddmc", "source" => "product", "com" => "van-ban", "type" => "van-ban", 'menu' => true),
	array("tbl" => "product", "field" => "id", "source" => "product", "com" => "van-ban", "type" => "van-ban", 'menu' => true),

	array("tbl" => "product_list", "field" => "idl", "source" => "product", "com" => "van-ban-ks", "type" => "van-ban-ks", 'menu' => true),
	array("tbl" => "product", "field" => "id", "source" => "product", "com" => "van-ban-ks", "type" => "van-ban-ks", 'menu' => true),

	array("tbl" => "product_list", "field" => "idl", "source" => "product", "com" => "van-ban-dang", "type" => "van-ban-dang", 'menu' => true),
	array("tbl" => "product", "field" => "id", "source" => "product", "com" => "van-ban-dang", "type" => "van-ban-dang", 'menu' => true),

	array("tbl" => "product_list", "field" => "idl", "source" => "product", "com" => "van-ban-nb", "type" => "van-ban-nb", 'menu' => true),
	array("tbl" => "product", "field" => "id", "source" => "product", "com" => "van-ban-nb", "type" => "van-ban-nb", 'menu' => true),

	array("tbl" => "product_list", "field" => "idl", "source" => "product", "com" => "phonghop-khonggiay", "type" => "phonghop-khonggiay", 'menu' => true),
	array("tbl" => "product", "field" => "id", "source" => "product", "com" => "phonghop-khonggiay", "type" => "phonghop-khonggiay", 'menu' => true),

	array("tbl" => "product_list", "field" => "idl", "source" => "product", "com" => "he-thong-bieu-mau", "type" => "he-thong-bieu-mau", 'menu' => true),
	array("tbl" => "product", "field" => "id", "source" => "product", "com" => "he-thong-bieu-mau", "type" => "he-thong-bieu-mau", 'menu' => true),

	array("tbl" => "product_list", "field" => "idl", "source" => "product_thpl", "com" => "tinh-huong-phap-ly", "type" => "tinh-huong-phap-ly", 'menu' => true),
	array("tbl" => "product", "field" => "id", "source" => "product_thpl", "com" => "tinh-huong-phap-ly", "type" => "tinh-huong-phap-ly", 'menu' => true),

	array("tbl" => "news", "field" => "id", "source" => "trungtam_quanly", "com" => "trungtam_quanly", "type" => "trungtam_quanly", 'menu' => true),

	/* Bài viết */
	array("tbl" => "news", "field" => "id", "source" => "news", "com" => "tin-tuc", "type" => "tin-tuc", 'menu' => false),
	array("tbl" => "news_list", "field" => "idl", "source" => "news", "com" => "tin-tuc", "type" => "tin-tuc", 'menu' => false),

	/* Trang tĩnh */
	array("tbl" => "static", "field" => "id", "source" => "static", "com" => "gioi-thieu", "type" => "gioi-thieu", 'menu' => true),

	/* Liên hệ */
	// array("tbl"=>"","field"=>"id","source"=>"","com"=>"lien-he","type"=>"",'menu'=>true),


);

/* Find data */
if ($com != 'tim-kiem' && $com != 'account' && $com != 'sitemap') {
	foreach ($requick as $k => $v) {
		$url_tbl = (isset($v['tbl']) && $v['tbl'] != '') ? $v['tbl'] : '';
		$url_tbltag = (isset($v['tbltag']) && $v['tbltag'] != '') ? $v['tbltag'] : '';
		$url_type = (isset($v['type']) && $v['type'] != '') ? $v['type'] : '';
		$url_field = (isset($v['field']) && $v['field'] != '') ? $v['field'] : '';
		$url_com = (isset($v['com']) && $v['com'] != '') ? $v['com'] : '';

		if ($url_tbl != '' && $url_tbl != 'static' && $url_tbl != 'photo') {
			$row = $d->rawQueryOne("select id from #_$url_tbl where $sluglang = ? and type = ? and hienthi > 0 limit 0,1", array($com, $url_type));

			if ($row['id']) {
				$_GET[$url_field] = $row['id'];
				$com = $url_com;
				break;
			}
		}
	}
}

/* Switch coms */
switch ($com) {
		// case 'lien-he':
		// 	$source = "contact";
		// 	$template = "contact/contact";
		// 	$seo->setSeo('type','object');
		// 	$title_crumb = 'Liên hệ';
		// 	break;

		// case 'gioi-thieu':
		// 	$source = "static";
		// 	$template = "static/static";
		// 	$type = $com;
		// 	$seo->setSeo('type','article');
		// 	$title_crumb = 'Giới thiệu';
		// 	break;

	case 'tin-tuc':
		$source = "news";
		$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
		$seo->setSeo('type', isset($_GET['id']) ? "article" : "object");
		$type = $com;
		$title_crumb = "Tin tức";
		break;

	case 'van-ban':
		$source = "product";
		$template = isset($_GET['id']) ? "product/product_detail" : "product/product";
		$seo->setSeo('type', 'article');
		$type = $com;
		$title_crumb = 'Văn bản';
		break;

	case 'van-ban-ks':
		$source = "product";
		$template = isset($_GET['id']) ? "product_ks/product_detail" : "product_ks/product";
		$seo->setSeo('type', 'article');
		$type = $com;
		$title_crumb = 'Văn bản kiểm sát';
		break;

	case 'van-ban-dang':
		$source = "product";
		$template = isset($_GET['id']) ? "product_dang/product_detail" : "product_dang/product";
		$seo->setSeo('type', 'article');
		$type = $com;
		$title_crumb = 'Văn bản của đảng';
		break;

	case 'van-ban-nb':
		$source = "product";
		$template = isset($_GET['id']) ? "product_nb/product_detail" : "product_nb/product";
		$seo->setSeo('type', 'article');
		$type = $com;
		$title_crumb = 'Văn bản nội bộ';
		break;

	case 'phonghop-khonggiay':
		$source = "product";
		$template = isset($_GET['id']) ? "product_phkg/product_detail" : "product_phkg/product";
		$seo->setSeo('type', 'article');
		$type = $com;
		$title_crumb = 'Phòng họp không giấy';
		break;

	case 'luat-viet-nam':
		$source = "product";
		$template = isset($_GET['id']) ? "product_lvn/product_detail" : "product_lvn/product";
		$seo->setSeo('type', 'article');
		$type = $com;
		$title_crumb = 'Luật Việt Nam';
		break;

	case 'he-thong-bieu-mau':
		$source = "product";
		$template = isset($_GET['id']) ? "product_htbm/product_detail" : "product_htbm/product";
		$seo->setSeo('type', 'article');
		$type = $com;
		$title_crumb = 'Hệ thống biểu mẫu';
		break;

	case 'tinh-huong-phap-ly':
		$source = "product_thpl";
		$template = isset($_GET['id']) ? "product_thpl/product_detail" : "product_thpl/product";
		$seo->setSeo('type', 'article');
		$type = $com;
		$title_crumb = 'Tình huống pháp lý';
		break;

	case 'tinh-huong-phap-ly-dm':
		$source = "product_thpl";
		$template = isset($_GET['id']) ? "product_thpl/product_detail" : "product_thpl/product";
		$seo->setSeo('type', 'article');
		$type = 'tinh-huong-phap-ly';
		$title_crumb = 'Tình huống pháp lý';
		break;

	case 'ma-hoa-tai-lieu':
		$source = "product_mhtl";
		$template = isset($_GET['id']) ? "product_mhtl/product_detail" : "product_mhtl/product";
		$seo->setSeo('type', 'article');
		$type = $com;
		$title_crumb = 'Mã hóa tài liệu';
		break;

	case 'ra-soat-chinh-ta':
		$source = "product_mhtl";
		$template = isset($_GET['id']) ? "product_rsct/product_detail" : "product_rsct/product";
		$seo->setSeo('type', 'article');
		$type = $com;
		$title_crumb = 'Rà soát chính tả';
		break;

	case 'tim-kiem-vb-ks':
		$source = "search-vbks";
		$template = "search_ks/product";
		$seo->setSeo('type', 'object');
		$title_crumb = timkiem;
		break;

	case 'tim-kiem-vb-dang':
		$source = "search-vbdang";
		$template = "search_dang/product";
		$seo->setSeo('type', 'object');
		$title_crumb = timkiem;
		break;

	case 'tim-kiem-vb-nb':
		$source = "search-noibo";
		$template = "search_nb/product";
		$seo->setSeo('type', 'object');
		$title_crumb = timkiem;
		break;

	case 'tim-kiem-phkg':
		$source = "search-phkg";
		$template = "search_phkg/product";
		$seo->setSeo('type', 'object');
		$title_crumb = timkiem;
		break;

	case 'tim-kiem-ht-bm':
		$source = "search-htbm";
		$template = "search_htbm/product";
		$seo->setSeo('type', 'object');
		$title_crumb = timkiem;
		break;

	case 'tim-kiem-thpl':
		$source = "search-thpl";
		$template = "search_thpl/product";
		$seo->setSeo('type', 'object');
		$title_crumb = timkiem;
		break;

	case 'trungtam_quanly':
		$source = "trungtam_quanly";
		$template = isset($_GET['id']) ? "trungtam_quanly/trungtam_quanly" : "trungtam_quanly/trungtam_quanly";;
		$seo->setSeo('type', 'object');
		$type = $com;
		$title_crumb = 'Trung tâm quản lý';
		break;

	case 'tim-kiem':
		$source = "search";
		$template = "search/product";
		$seo->setSeo('type', 'object');
		$title_crumb = timkiem;
		break;

	case 'tim-kiem-gpt':
		$source = "search-gpt";
		$template = "search/product";
		$seo->setSeo('type', 'object');
		$title_crumb = timkiem;
		break;

	case 'noi-dung':
		$source = "noidung";
		$template = "noidung/noidung";
		$seo->setSeo('type', 'object');
		$title_crumb = 'Nội dung văn bản';
		break;

		// case 'gio-hang':
		// 	$source = "order";
		// 	$template = 'order/order';
		// 	$title_crumb = giohang;
		// 	$seo->setSeo('type','object');
		// 	break;

	case 'account':
		$source = "user";
		break;

	case 'dowloadword':
		$source = "dowload_file";
		break;

	case 'logout':
		$source = "logout_user";
		break;

		// case 'ngon-ngu':
		// 	if(isset($lang))
		// 	{
		// 		switch($lang)
		// 		{
		// 			case 'vi':
		// 				$_SESSION['lang'] = 'vi';
		// 				break;
		// 			case 'en':
		// 				$_SESSION['lang'] = 'en';
		// 				break;
		// 			default:
		// 				$_SESSION['lang'] = 'vi';
		// 				break;
		// 		}
		// 	}
		// 	$func->redirect($_SERVER['HTTP_REFERER']);
		// 	break;

	case 'sitemap':
		include_once LIBRARIES . "sitemap.php";
		exit();

	case '':
	case 'index':
		$source = "index";
		$template = "index/index";
		$seo->setSeo('type', 'website');
		break;

	case 'index_page':
		$source = "index";
		$template = "index_page/index_page";
		$seo->setSeo('type', 'website');
		break;

		// case 'index_page':
		// 	$source = "index";
		// 	$template = "index/index";
		// 	$seo->setSeo('type', 'website');
		// 	break;

	default:
		header('HTTP/1.0 404 Not Found', true, 404);
		include("404.php");
		exit();
}

/* Include sources */
if ($source != '') include SOURCES . $source . ".php";
if ($template == '') {
	header('HTTP/1.0 404 Not Found', true, 404);
	include("404.php");
	exit();
}
