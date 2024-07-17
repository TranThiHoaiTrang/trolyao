<?php
if (!defined('SOURCES')) die("Error");

/* Tìm kiếm sản phẩm */
if (isset($_GET['keyword'])) {
	$tukhoa = htmlspecialchars($_GET['keyword']);
	$tukhoa3 = $_GET['keyword'];
	$tukhoa2 = htmlspecialchars($_GET['keyword']);
	$tukhoa = $func->url_title($tukhoa, ' ');

	$cookie_user = $_POST['cookie_user'];

	// var_dump($_POST);

	if ($tukhoa) {
		$tukhoa = rtrim($tukhoa);
		$keyword_all = $d->rawQueryOne("select * from #_messages_gpt where cookie_user = '$cookie_user' order by id desc");
		// var_dump("select * from #_keyword where keyword = '$tukhoa' order by id desc");
		$data = array();
		$data['noidung'] = $tukhoa;
		$data['cookie_user'] = $cookie_user;
		$data['name_user'] = 'user';
		$data['ngaytao'] = time();
		$d->insert('messages_gpt', $data);
		// var_dump($tukhoa);

		$where = ' and ( 1=1';
		$tukhoa_sp = preg_split("/[\s,-]+/", $tukhoa);
		foreach ($tukhoa_sp as $k) {
			$tk_m = str_split($k, 5);
			foreach ($tk_m as $tk) {
				$where .= " and (slugvi LIKE CONCAT('%', '" . $tk . "', '%'))";
			}
		}
		$where .= ')';
		
		$count_sanpham_all = $d->rawQueryOne("select count(id) as numb from #_product where type='van-ban' $where and hienthi>0 ");
        $count_sanpham_danhmuc_all = $d->rawQueryOne("select count(id) as numb from #_product_danhmuc where type='van-ban' $where and hienthi>0 ");

		if ($count_sanpham_all['numb'] > 0 || $count_sanpham_danhmuc_all['numb'] > 0) {
			$data = array();
			$data['noidung'] = 'Mời bạn xem kết quả tại thanh tìm kiếm.';
			$data['cookie_user'] = $cookie_user;
			$data['name_user'] = 'ai';
			$data['ngaytao'] = time();
			$d->insert('messages_gpt', $data);
			
		}else{
			$data = array();
			$data['noidung'] = 'Rất xin lỗi vì không tìm thấy kết quả bạn đang tìm kiếm. Tôi đã cố gắng hỗ trợ nhưng có thể tài liệu của tôi chưa đủ hoặc không chứa thông tin bạn đang tìm. Tôi sẽ cải thiện để giúp bạn tốt hơn.';
			$data['cookie_user'] = $cookie_user;
			$data['name_user'] = 'ai';
			$data['ngaytao'] = time();
			$d->insert('messages_gpt', $data);
			// exit();
		}
		$messages_gpt_all = $d->rawQuery("select * from #_messages_gpt where cookie_user = '$cookie_user' order by id asc");
	}
}

$seopage = $d->rawQueryOne("select * from #_seopage where type = ? limit 0,1", array('tim-kiem'));
$banner = $seopage['banner'];
/* SEO */
$seo->setSeo('title', $title_crumb);

/* breadCrumbs */
$breadcr->setBreadCrumbs('', $title_crumb);
$breadcrumbs = $breadcr->getBreadCrumbs();
