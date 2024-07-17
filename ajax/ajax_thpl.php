<?php
include "ajax_config.php";

/* Paginations */
include LIBRARIES . "class/class.PaginationsAjax.php";
$pagingAjax = new PaginationsAjax();
$pagingAjax->perpage = (htmlspecialchars($_GET['perpage']) && $_GET['perpage'] > 0) ? htmlspecialchars($_GET['perpage']) : 1;
$eShow = htmlspecialchars($_GET['eShow']);


//$namelist = $_GET['namelist'];//(isset($_GET['namelist']) && $_GET['namelist'] !='') ? htmlspecialchars($_GET['namelist']) : 0;
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';
$keyword = (isset($_GET['keyword']) && $_GET['keyword'] != '') ? $_GET['keyword'] : '';
// var_dump($_GET);
$p = (isset($_GET['p']) && $_GET['p'] > 0) ? htmlspecialchars($_GET['p']) : 1;
$start = ($p - 1) * $pagingAjax->perpage;
$pageLink = "ajax/ajax_thpl.php?perpage=" . $pagingAjax->perpage;
$tempLink = "";

$where = ' and ( 1=1';
/* Math url */
if ($id) {
	$tempLink .= "&keyword=" . $id;
	$tukhoa2 = $id;
	$tukhoa = $func->url_title($id, ' ');

	$tukhoa_sp = preg_split("/[\s,-]+/", $tukhoa);
	foreach ($tukhoa_sp as $k) {
		$tk_m = str_split($k, 5);
		foreach ($tk_m as $tk) {
			$where .= " and (slugvi LIKE CONCAT('%', '" . $tk . "', '%'))";
		}
	}
}
if ($keyword) {
	$tempLink .= "&keyword=" . $keyword;
	$tukhoa2 = $keyword;
	$tukhoa = $func->url_title($keyword, ' ');

	$tukhoa_sp = preg_split("/[\s,-]+/", $tukhoa);
	foreach ($tukhoa_sp as $k) {
		$tk_m = str_split($k, 5);
		foreach ($tk_m as $tk) {
			$where .= " and (slugvi LIKE CONCAT('%', '" . $tk . "', '%'))";
		}
	}
}

$where .= ')';

$tempLink .= "&p=";
$pageLink .= $tempLink;

// var_dump($where);
/* Get data */
// $loaivanban = $d->rawQuery("select * from #_product where type='van-ban-ks' $where and hienthi>0 order by stt,id asc $limit");
$sql = "select * from #_product where type='tinh-huong-phap-ly' $where and hienthi > 0 order by stt,id desc";
$sqlCache = $sql . " limit $start, $pagingAjax->perpage";
$loaivanban = $cache->getCache($sqlCache, 'result', 7200);

/* Count all data */
$countItems = count($cache->getCache($sql, 'result', 7200));

/* Get page result */
$pagingItems = $pagingAjax->getAllPageLinks($countItems, $pageLink, $eShow);


?>
<?php if ($countItems) { ?>
	<?php
	foreach ($loaivanban as $v) {
		$loaivanban_list = $d->rawQueryOne("select * from #_product_list where type='tinh-huong-phap-ly' and id = '" . $v['id_list'] . "' and hienthi>0 order by stt,id asc");
	?>
		<div class="all_block-view-all">
			<div class="block-view-all">
				<a href="<?= $v['tenkhongdauvi'] ?>">
					<span style="color: #4d5156;font-size: 14px;">Giải đáp tình huống pháp lý</span>
					<div class="name_danhmuc"><?= $v['ten' . $lang] ?></div>
					<div class="all_danhmuc_list"><?= $loaivanban_list['ten' . $lang] ?></div>
					<div class="name_danhmuc" style="font-size: 14px;">Trả lời:</div>
					<div class="all_dieu">
						<div class="dieu_danhmuc">
							<?= $func->sub_str($v['noidung' . $lang], 200) ?><span>(Xem thêm)</span>
						</div>
					</div>
				</a>
			</div>
		</div>
	<?php } ?>
	<div class="paging_ajax">
		<?= $pagingItems ?>
	</div>
<?php } ?>