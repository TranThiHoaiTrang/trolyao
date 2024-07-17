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
$pageLink = "ajax/ajax_news.php?perpage=" . $pagingAjax->perpage;
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
$sql = "select * from #_product where type='van-ban-ks' $where and hienthi > 0 order by stt,id desc";
$sqlCache = $sql . " limit $start, $pagingAjax->perpage";
$loaivanban = $cache->getCache($sqlCache, 'result', 7200);

/* Count all data */
$countItems = count($cache->getCache($sql, 'result', 7200));

/* Get page result */
$pagingItems = $pagingAjax->getAllPageLinks($countItems, $pageLink, $eShow);


?>
<?php if ($countItems) { ?>
	<div class="all_vanban_kiemsoat">
		<div class="all_noidung_vanban_kiemsoat">
			<div class="stt_vanban_kiemsoat" style="font-weight: 600;">STT</div>
			<div class="noidung_vanban_kiemsoat" style="font-weight: 600;">Tên tài liệu</div>
			<div class="loai_vanban_kiemsoat" style="font-weight: 600;">Loại văn bản</div>
		</div>
		<?php
		$i = 0;
		foreach ($loaivanban as $v) {
			$loaivanban_list = $d->rawQueryOne("select * from #_product_list where type='van-ban-ks' and id = '" . $v['id_list'] . "' and hienthi>0 order by stt,id asc");
			$i++;
		?>
			<!-- <div class="all_block-view-all hide-shadow hide-border"> -->
			<div class="all_noidung_vanban_kiemsoat" data-id="<?= $v['id'] ?>" data-type="<?= $v['type'] ?>">
				<div class="stt_vanban_kiemsoat"><?= $i ?></div>
				<div class="noidung_vanban_kiemsoat"><?= $func->highlightKeyword($v['ten' . $lang], $tukhoa2) ?></div>
				<div class="loai_vanban_kiemsoat"><?= $loaivanban_list['ten' . $lang] ?></div>
			</div>
			<!-- </div> -->
		<?php } ?>
		<div class="paging_ajax">
			<?= $pagingItems ?>
		</div>
	</div>

<?php } ?>

<script>
	$(document).ready(function() {
		$(".all_noidung_vanban_kiemsoat").click(function() {
			var id = $(this).data("id");
			var type = $(this).data("type");
			$.ajax({
				type: "POST",
				url: "ajax/noidung_vbks.php",
				data: {
					id: id,
					type: type
				},
				success: function(result) {
					$("#popup_noidung_vbks .modal-body").html(result);
					$("#popup_noidung_vbks").modal("show");
				},
			});
		});
	});
</script>