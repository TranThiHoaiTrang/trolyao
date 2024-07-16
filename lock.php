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

session_start();
// var_dump($_SESSION[$login_member]);
$dnone = 'd-none';
if (isset($_POST['submit_dangnhap'])) {
	echo '<script>localStorage.setItem("userLoggedIn", "true");</script>';
	$password = $_POST['password'];
	$name = $_POST['name'];


	// $passwordMD5 = md5('abc123');

	$lastlogin = time();
	$login_session = md5($password . $lastlogin);

	$_SESSION['login_index'] = NULL;

	$user = $d->rawQueryOne("select * from #_user where username = '" . $name . "' and hienthi>0 limit 0,1");
	$member = $d->rawQueryOne("select * from #_member where username = '" . $name . "' and hienthi>0 limit 0,1");
	if (isset($user['id'])) {
		$password_moiMD5 = $func->encrypt_password($config['website']['secret'], $password, $config['website']['salt']);
		if ($password_moiMD5 == $user['password'] && !empty($name)) {

			$_SESSION[$login_member]['active'] = true;
			$_SESSION[$login_member]['id'] = $user['id'];
			$_SESSION[$login_member]['username'] = $user['username'];
			$_SESSION[$login_member]['dienthoai'] = $user['dienthoai'];
			$_SESSION[$login_member]['diachi'] = $user['diachi'];
			$_SESSION[$login_member]['email'] = $user['email'];
			$_SESSION[$login_member]['ten'] = $user['ten'];

			$_SESSION['login_index']['active'] = true;
			$_SESSION['login_index']['login_session'] = $login_session;

			$_SESSION['logged_in'] = true;

			$time_expiry = time() + 3600 * 24 * 1;
			setcookie('login_session', $login_session, $time_expiry, '/');
			setcookie('login_session_name', $name, $time_expiry, '/');
			setcookie('login_cap_user', $user['cap'], $time_expiry, '/');
			setcookie('login_donvi_user', $user['id_donvi'], $time_expiry, '/');
			setcookie('login_user', 'user', $time_expiry, '/');
			setcookie('id_user', $user['id'], $time_expiry, '/');

			header("Location: " . BASE_URL . "index_page.php");
		} else {
			$dnone = '';
		}
	} else if (isset($member['id'])) {
		$password_moiMD5 = md5($password);
		if ($password_moiMD5 == $member['password'] && !empty($name)) {

			$_SESSION[$login_member]['active'] = true;
			$_SESSION[$login_member]['id'] = $member['id'];
			$_SESSION[$login_member]['username'] = $member['username'];
			$_SESSION[$login_member]['dienthoai'] = $member['dienthoai'];
			$_SESSION[$login_member]['diachi'] = $member['diachi'];
			$_SESSION[$login_member]['email'] = $member['email'];
			$_SESSION[$login_member]['ten'] = $member['ten'];

			$_SESSION['login_index']['active'] = true;
			$_SESSION['login_index']['login_session'] = $login_session;

			$_SESSION['logged_in'] = true;

			$time_expiry = time() + 3600 * 24 * 1;
			setcookie('login_session', $login_session, $time_expiry, '/');
			setcookie('login_session_name', $name, $time_expiry, '/');
			setcookie('login_cap_user', $member['cap'], $time_expiry, '/');
			setcookie('login_donvi_user', $member['id_donvi'], $time_expiry, '/');
			setcookie('login_user', 'member', $time_expiry, '/');
			setcookie('id_user', $member['id'], $time_expiry, '/');

			header("Location: " . BASE_URL . "index_page.php");
		} else {
			$dnone = '';
		}
	}
}


?>

<body>
	<div class="content">
		<div class="wrap">
			<form enctype="multipart/form-data" method="post" class="login-box-form1" action="" id="loginForm">
				<img src="./assets/images/logo.png" alt="">
				<h2>Viện kiểm sát nhân dân <br> tối cao</h2>
				<div class="input-group mb-3">
					<input type="text" class="form-control text-sm" name="name" id="name" placeholder="Tên đăng nhập *" autocomplete="off">
				</div>
				<div class="input-group mb-3">
					<input type="password" class="form-control text-sm" name="password" id="password" placeholder="Mật khẩu *" autocomplete="off">
				</div>
				<div class="text-align">
					<input type="submit" class="btn_dn" id="btn_dn" name="submit_dangnhap" value="Đăng nhập">
					<!-- <button type="submit" class="btn_dn" >
						<span>Login</span>
					</button> -->
				</div>
				<div class="text-align">
					<a href="<?= BASE_URL ?>quenmatkhau.php" class="btn_doimatkhau">Đổi mật khẩu</a>
				</div>
				<div class="my-alert alert-login <?= $dnone ?>" role="alert">Sai thông tin.</div>
				<span class="thongbao">Sử dụng trình duyệt Chrome trên máy tính để phần mềm hiển thị tốt nhất</span>
				<!-- <div class="all_khungungdung">
					<div class="khungungdung">
						<img src="./assets/images/ios.png" alt="" width="37" height="37">
						<img src="./assets/images/chplay.png" alt="" width="37" height="37">
					</div>
					<div class="text_khungungdung">Vui lòng đăng nhập để tải App về điện thoại</div>
				</div> -->
			</form>
		</div>
	</div>
	<div class="clear"></div>
</body>

</html>

<script>
	window.onload = function() {
		var hasLoaded = localStorage.getItem('hasLoaded');
		var hasLoadedBefore = localStorage.getItem('hasLoadedBefore');
		if (hasLoaded) {
			localStorage.setItem('hasLoaded', false);
		}
		if (hasLoadedBefore) {
			localStorage.setItem('hasLoadedBefore', false);
		}
	};

	var loginButton = document.getElementById('btn_dn');

	document.getElementById('loginForm').addEventListener('submit', function() {
		// Lưu trạng thái tương tác của người dùng
		localStorage.setItem('userInteracted', 'true');
	});
</script>