<?php
if (!defined('SOURCES')) die("Error");

/* Tìm kiếm sản phẩm */
if (isset($_GET['keyword'])) {
	$tukhoa = htmlspecialchars($_GET['keyword']);
	$tukhoa3 = $_GET['keyword'];
	$tukhoa2 = htmlspecialchars($_GET['keyword']);
	$tukhoa = $func->url_title($tukhoa, ' ');
	// var_dump($tukhoa2);
	if ($tukhoa) {
		$tukhoa = rtrim($tukhoa);
		$keyword_all = $d->rawQueryOne("select * from #_keyword where keyword = '$tukhoa' order by id desc");
		// var_dump("select * from #_keyword where keyword = '$tukhoa' order by id desc");
		if (empty($keyword_all)) {
			$data = array();
			$data['keyword'] = $tukhoa;
			$data['ngaytao'] = time();
			$d->insert('keyword', $data);
		}
		$tukhoa_sp = preg_split("/[\s,-]+/", $tukhoa3);
		if (count($tukhoa_sp) > 2) {
			$where = ' and ( 1=1';
			foreach ($tukhoa_sp as $k) {
				$tk_m = str_split($k, 5);
				foreach ($tk_m as $tk) {
					$where .= " and (tenvi LIKE CONCAT('%', '" . $tk . "', '%'))";
				}
			}

			$where .= ')';
		} else {
			$where .= " and tenvi LIKE ('%$tukhoa2%')";
		}

		// var_dump($where);
		$count_sanpham_all = $d->rawQueryOne("select count(id) as numb from #_product where type='van-ban-dang' $where and hienthi>0 ");
		$count_sanpham_list_all = $d->rawQueryOne("select count(id) as numb from #_product_list where type='van-ban-dang' $where and hienthi>0 ");
	}
}

$seopage = $d->rawQueryOne("select * from #_seopage where type = ? limit 0,1", array('tim-kiem'));
$banner = $seopage['banner'];
/* SEO */
$seo->setSeo('title', $title_crumb);

/* breadCrumbs */
$breadcr->setBreadCrumbs('', $title_crumb);
$breadcrumbs = $breadcr->getBreadCrumbs();
