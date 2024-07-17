<?php
global $d;
include __DIR__ . "/ajax_config.php";

/* Paginations */
include LIBRARIES . "class/class.PaginationsAjax.php";
$pagingAjax = new PaginationsAjax();
$pagingAjax->perpage = 9;
$eShow = '.all_sp_search';

$listpr = $_POST['listpr'] ?? 0;
$catpro = $_POST['catpro'] ?? 0;
$danhmucvai = $_POST['danhmucvai'] ?? '';
$loaivai = $_POST['loaivai'] ?? '';
$chatlieu = $_POST['chatlieu'] ?? '';
$muavu = $_POST['muavu'] ?? '';

$listpr_p = $_GET['listpr'];
$catpro_p = $_GET['catpro'];
$danhmucvai_p = $_GET['danhmucvai'];
$loaivai_p = $_GET['loaivai'];
$chatlieu_p = $_GET['chatlieu'];
$muavu_p = $_GET['muavu'];

// var_dump($catpro);

if (!empty($listpr) || !empty($catpro) || !empty($danhmucvai) || !empty($loaivai) || !empty($chatlieu) || !empty($muavu) || !empty($listpr_p) || !empty($catpro_p) || !empty($danhmucvai_p)  || !empty($loaivai_p) || !empty($chatlieu_p) || !empty($muavu_p)) {
	if ($listpr) {
		$per .= "&listpr=$listpr";
	} 
	if ($catpro) {
		$per .= "&catpro=$catpro";
	} 
	if ($danhmucvai) {
		$per .= "&danhmucvai=$danhmucvai";
	}
	if ($loaivai) {
		$per .= "&loaivai=$loaivai";
	} 
	if ($chatlieu) {
		$per .= "&chatlieu=$chatlieu";
	}
	if ($muavu) {
		$per .= "&muavu=$muavu";
	}
	if ($listpr_p) {
		$per .= "&listpr=$listpr_p";
	}
	if ($catpro_p) {
		$per .= "&catpro=$catpro_p";
	}
	if ($danhmucvai_p) {
		$per .= "&danhmucvai=$danhmucvai_p";
	} 
	if ($loaivai_p) {
		$per .= "&loaivai=$loaivai_p";
	}
	if ($chatlieu_p) {
		$per .= "&chatlieu=$chatlieu_p";
	} 
	if ($muavu_p) {
		$per .= "&muavu=$muavu_p";
	} 
	// $per .= $per;
	$per = "?perpage=". $pagingAjax->perpage . $per;
}
else {
	$per = "?perpage=". $pagingAjax->perpage;
}

$p = (isset($_GET['p']) && $_GET['p'] > 0) ? htmlspecialchars($_GET['p']) : 1;
$start = ($p - 1) * $pagingAjax->perpage;
$pageLink = "ajax/ajax_searchpro.php" . $per;
$tempLink = "";
$where = "";


$tempLink .= "&p=";
$pageLink .= $tempLink;

if ($listpr) {
	if(!empty($danhmucvai)){
		$id_list = "and id_danhmuc REGEXP '". $danhmucvai ."'";
	}else{
		$id_list = "and id_danhmuc REGEXP '".$listpr."'";
	}
}
if ($catpro) {
    $id_cat = "and id_danhmuc_cap REGEXP '".$catpro."'";
}
if ($danhmucvai) {
    $id_list = "and id_danhmuc REGEXP '". $danhmucvai ."'";
}
if ($loaivai) {
    $id_loaivai = "and id_loaivai REGEXP '". $loaivai ."'";
}
if ($chatlieu) {
    $id_chatlieu = "and id_chatlieu REGEXP '". $chatlieu ."'";
}
if ($muavu) {
    $id_muavu = "and id_muavu REGEXP '". $muavu ."'";
}

if ($listpr_p) {
    $id_list = "and id_danhmuc REGEXP '". $listpr_p ."'";
}
if ($catpro_p) {
    $id_cat = "and id_danhmuc_cap REGEXP '".$catpro_p."'";
}
if ($danhmucvai_p) {
    $id_list = "and id_danhmuc REGEXP '". $danhmucvai_p ."'";
}
if ($loaivai_p) {
    $id_loaivai = "and id_loaivai REGEXP '". $loaivai_p ."'";
}
if ($chatlieu_p) {
    $id_chatlieu = "and id_chatlieu REGEXP '". $chatlieu_p ."'";
}
if ($muavu_p) {
    $id_muavu = "and id_muavu REGEXP '". $muavu_p ."'";
}

$where = $id_list . $id_cat . $id_loaivai . $id_chatlieu . $id_muavu;
/* Get data */
$sql = "select * from #_product where type='san-pham' $where and hienthi > 0 order by stt,id desc";
$sqlCache = $sql . " limit $start, $pagingAjax->perpage";
$product = $d->rawQuery($sqlCache);

// var_dump($sqlCache);

$countItems = count($d->rawQuery($sql));
/* Get page result */
$pagingItems = $pagingAjax->getAllPageLinks($countItems, $pageLink, $eShow);


?>
<?php if ($product) { ?>
	<div class="tatsasp">Tất cả: <?= $countItems ?> Sản phẩm</div>
	<div class="loadkhung_product mainkhung_product">
		<?php foreach ($product as $k => $v) { ?>
			<a href="<?= $v['tenkhongdauvi'] ?>">
				<div class="bangvai">
					<div class="img_bangvai">
                        <?=Helper::the_thumbnail($v['photo'], 606, 764, '', $v['ten' . $lang])?>
					</div>
					<div class="content_bangvai">
						<div class="name_bangvai text-split"><?= $v['ten' . $lang] ?></div>
						<div class="xemchitiet_bv">
							<span>Xem chi tiết</span>
							<i class="fas fa-long-arrow-alt-right"></i>
						</div>
					</div>
				</div>
			</a>
		<?php } ?>
	</div>
	<div class="paging_ajax">
		<?= $pagingItems ?>
	</div>
<?php } ?>
<!-- </?php echo($sqlCache); die();?> -->