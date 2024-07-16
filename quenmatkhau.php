<!DOCTYPE HTML>
<html>

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Trợ lý ảo viện kiểm sát</title>
	<!-- Favicon -->
	<link href="https://trang.hdweb24h.com/trolyao/upload/photo/image-2.png" rel="shortcut icon" type="image/x-icon" />
	<meta name="robots" content="noindex,nofollow" />
	<link href="assets/coming/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="assets/coming/css/clock.css" rel="stylesheet" type="text/css" media="all" />
	<link href='http://fonts.googleapis.com/css?family=Petit+Formal+Script' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300' rel='stylesheet' type='text/css'>
	<link href='assets/css/font-awesome.css' rel='stylesheet' type='text/css'>
	<script src="assets/js/jquery.min.js"></script>
</head>

<?php

require __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

const SOURCES_PATH = BASE_PATH . 'sources' . DIRECTORY_SEPARATOR;
const TEMPLATE_PATH = BASE_PATH . 'templates' . DIRECTORY_SEPARATOR;
const LAYOUT_PATH = TEMPLATE_PATH . 'layout' . DIRECTORY_SEPARATOR;

//session_start();
const LIBRARIES = LIBRARIES_PATH;
const SOURCES = SOURCES_PATH;
const LAYOUT = LAYOUT_PATH;
const THUMBS = THUMBS_URL;
const WATERMARK = WATERMARK_URL;

/* Config */
require_once LIBRARIES_PATH . 'autoload.php';
require_once LIBRARIES_PATH . "config.php";

global $config;

new AutoLoad();

$injection = new AntiSQLInjection();
$d = new PDODb($config['database']);
$seo = new Seo($d);
$emailer = new Email($d);
$router = new AltoRouter();
$cache = new FileCache($d);
$func = new Functions($d);



$dnone = 'd-none';
if (isset($_POST['submit_doimatkhau'])) {


	$password = $_POST['password'];
	$new_password = $_POST['new_password'];
	$name = $_POST['name'];


	$user = $d->rawQueryOne("select * from #_user where username = '" . $name . "' and hienthi>0 limit 0,1");
	$member = $d->rawQueryOne("select * from #_member where username = '" . $name . "' and hienthi>0 limit 0,1");
	if (isset($user['id'])) {
		$data_re['password'] = md5($config['website']['secret'] . $new_password . $config['website']['salt']);

		$d->where('id', $user['id']);
		if ($d->update('user', $data_re)) {
			$dnone = '';
			// header("Location: " . BASE_URL . "index_page.php");
		}
	} else if (isset($member['id'])) {
		$data_re['password'] = md5($new_password);

		$d->where('id', $member['id']);
		if ($d->update('member', $data_re)) {
			$dnone = '';
			// header("Location: " . BASE_URL . "index_page.php");
		}
	}
}
?>

<body>
	<div class="content">
		<div class="wrap">
			<form enctype="multipart/form-data" method="post" class="login-box-form1" action="" id="loginForm">
				<img src="./assets/images/logo.png" alt="">
				<h2>Viện kiểm sát nhân dân tối cao</h2>
				<div class="input-group mb-3">
					<input type="text" class="form-control text-sm" name="name" id="name" placeholder="Tên đăng nhập *" autocomplete="off">
				</div>
				<div class="input-group mb-3">
					<input type="password" class="form-control text-sm" name="password" id="password" placeholder="Mật khẩu cũ *" autocomplete="off">
				</div>
				<div class="input-group mb-3">
					<input type="password" class="form-control text-sm" name="new_password" id="new_password" placeholder="Mật khẩu mới*" autocomplete="off">
				</div>
				<div class="text-align">
					<input type="submit" class="btn_dn" id="btn_dn" name="submit_doimatkhau" value="Đổi mật khẩu">
				</div>
				
				<div class="my-alert alert-login-pass <?= $dnone; ?>" role="alert">Mật khẩu của bạn đã được đổi thành công. Quay về trang chủ để tiến hành đăng nhập</div>
				<div class="text-align <?= $dnone; ?>">
					<a href="<?= BASE_URL ?>" class="btn_doimatkhau">Trang chủ</a>
				</div>
				<span class="thongbao">Sử dụng trình duyệt Chrome trên máy tính để phần mềm hiển thị tốt nhất</span>
			</form>
		</div>
	</div>
	<div class="clear"></div>
</body>

</html>

<script>

</script>