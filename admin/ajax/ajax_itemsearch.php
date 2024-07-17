<?php
global $d;
include __DIR__ . "/ajax_config.php";
	

if (!empty($_POST["term"])) {
    $tukhoa = htmlspecialchars($_POST['term']['term']);
    $where = " and tenvi LIKE('%" . $tukhoa . "%')";
    $data = $d->rawQuery("select id, tenvi, tenkhongdauvi, slugvi from #_product where type = 'van-ban' $where ");
    $data_dm = $d->rawQuery("select id, tenvi, tenkhongdauvi, slugvi from #_product_danhmuc where type = 'van-ban' $where ");

	$result = array_merge($data, $data_dm);
	$result_js = json_encode($result);
	echo $result_js;
}