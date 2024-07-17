<?php
include "ajax_config.php";

$id_vb_chinh = $_POST['id_vb_chinh'] ?? 0;
$keyword = htmlspecialchars($_POST['keyword']) ?? '';

/* Get data */
$sql = "select * from #_product_danhmuc where id = '$id_vb_chinh' and hienthi>0 and type='van-ban'";
// $sqlCache = $sql . " limit $start, $pagingAjax->perpage";
$all_vb_chinh = $d->rawQueryOne($sql);
$all_chuongthuoc_vb_chinh = $d->rawQuery("select * from #_product_danhmuc_cap where id_danhmuc = '$id_vb_chinh' and hienthi>0 and type='van-ban'");
?>
<?php if ($all_vb_chinh) { ?>
	<?= $func->highlightKeyword_product($all_vb_chinh['mota' . $lang], $keyword) ?>
	<?php if ($all_chuongthuoc_vb_chinh) { ?>
		<?php foreach ($all_chuongthuoc_vb_chinh as $chuong) {
			$all_vb_thuocchuong = $d->rawQuery("select * from #_product where id_danhmuc = '$id_vb_chinh' and id_danhmuc_cap = '" . $chuong['id'] . "' and hienthi>0 and type='van-ban'");
		?>
			<?= $func->highlightKeyword_product($chuong['ten' . $lang], $keyword) ?>
			<?= $func->highlightKeyword_product($chuong['noidung' . $lang], $keyword) ?>
			<div class="all_danhsach_dieu_thuoc_chuong">
				<?php foreach ($all_vb_thuocchuong as $dieu) { ?>
					<div class="dieu_thuoc_chuong">
						<div class="dieu_luat">
							<div class="icon_dieuluat"><i class="fas fa-caret-right"></i></div>
							<span class="name_dieuluat"><?= $func->highlightKeyword_product($dieu['ten' . $lang], $keyword) ?></span>
							<?php if ($dieu['id_chidan']) {
								$id_chidan = explode(',', $dieu['id_chidan']);
							?>
								<div class="all_chidan">
									<div class="name_chidan">Chỉ dẫn</div>
									<div class="noidung_chidan">
										<?php for ($i = 0; $i < count($id_chidan); $i++) {
											$danhmuc_chidan = $d->rawQueryOne("select * from #_product_danhmuc where slugvi = '" . $id_chidan[$i] . "' and hienthi>0 and type='van-ban'");
											$chidan_pro = $d->rawQueryOne("select * from #_product where slugvi = '" . $id_chidan[$i] . "' and hienthi>0 and type='van-ban'");
										?>
											<?php if ($danhmuc_chidan) { ?>
												<a href="<?= $danhmuc_chidan['tenkhongdauvi'] ?>" target="_blank"><?= $danhmuc_chidan['ten' . $lang] ?></a>
											<?php } ?>
											<?php if ($chidan_pro) { ?>
												<a href="<?= $chidan_pro['tenkhongdauvi'] ?>" target="_blank"><?= $chidan_pro['ten' . $lang] ?></a>
											<?php } ?>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="noidung_dieu_luat"><?= $func->highlightKeyword_product($dieu['noidung' . $lang], $keyword) ?></div>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	<?php } else {
		$all_vb_thuocchuong = $d->rawQuery("select * from #_product where id_danhmuc = '$id_vb_chinh' and hienthi>0 and type='van-ban'");
	?>
		<div class="all_danhsach_dieu_thuoc_chuong">
			<?php foreach ($all_vb_thuocchuong as $dieu) { ?>
				<div class="dieu_thuoc_chuong">
					<div class="dieu_luat">
						<div class="icon_dieuluat"><i class="fas fa-caret-right"></i></div>
						<span><?= $func->highlightKeyword_product($dieu['ten' . $lang], $keyword) ?></span>
					</div>
					<div class="noidung_dieu_luat"><?= $func->highlightKeyword_product($dieu['noidung' . $lang], $keyword) ?></div>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
<?php } ?>

<script>
	$(".name_chidan").click(function() {
		if ($(this).parent('.all_chidan').children('.noidung_chidan').hasClass("active")) {
			$(this).parent('.all_chidan').children('.noidung_chidan').removeClass("active");
			$(this).parent('.all_chidan').children('.noidung_chidan').css({
				display: "none",
			});
		} else {
			$(this).parent('.all_chidan').children('.noidung_chidan').addClass("active");
			// $(this).parent('.all_chidan').children('.noidung_chidan').fadeIn(500);
			$(this).parent('.all_chidan').children('.noidung_chidan').css({
				display: "flex",
			});
		}
		return false;
	});
</script>