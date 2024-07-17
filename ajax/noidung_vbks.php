<?php
include "ajax_config.php";

function isPdf($filename)
{
	$lastThreeChars = substr($filename, -3);
	if (strcasecmp($lastThreeChars, 'pdf') === 0) {
		return true;
	} else {
		return false;
	}
}

$id = (isset($_POST['id']) && $_POST['id'] > 0) ? htmlspecialchars($_POST['id']) : 0;
$type = (isset($_POST['type'])) ? htmlspecialchars($_POST['type']) : '';

$loaivanban = $d->rawQueryOne("select * from #_product where id = '" . $id . "' and hienthi>0 and type='$type' order by stt,id asc");
// var_dump(isPdf($loaivanban['taptin']));
?>
<div class="noidung_vanban_iframe">
	<?php if (isPdf($loaivanban['taptin']) == true) { ?>
		<button onclick="openFullScreenpdf()" style="background: transparent;border: none;font-size: 12px;"><i class="fas fa-expand-arrows-alt"></i> xem toàn màn hình</button>
		<iframe src="<?= $config_base ?>admin/upload/file/<?= $loaivanban['taptin'] ?>" frameborder="0"></iframe>
	<?php } else { ?>
		<button onclick="openFullScreen()" style="background: transparent;border: none;font-size: 12px;"><i class="fas fa-expand-arrows-alt"></i> xem toàn màn hình</button>
		<iframe src="https://view.officeapps.live.com/op/embed.aspx?src=<?= $config_base ?>admin/upload/file/<?= $loaivanban['taptin'] ?>" width="600" height="400" frameborder="0"></iframe>
	<?php } ?>
</div>

<script>
	function openFullScreenpdf() {
		var pdfUrl = "<?= $config_base ?>admin/upload/file/<?= $loaivanban['taptin'] ?>";
		window.open(pdfUrl, '_blank');
	}
	function openFullScreen() {
		var pdfUrl = "https://view.officeapps.live.com/op/embed.aspx?src=<?= $config_base ?>admin/upload/file/<?= $loaivanban['taptin'] ?>";
		window.open(pdfUrl, '_blank');
	}
</script>