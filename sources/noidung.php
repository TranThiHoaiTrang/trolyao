<?php  
	if(!defined('SOURCES')) die("Error");

	/* Tìm kiếm sản phẩm */
	if(isset($_GET['id'])){
		$id = htmlspecialchars($_GET['id']);

		if($id){
			$where = "";
			$where = " id = '$id' and hienthi > 0";

			// $curPage = $get_page;
			// $per_page = 20;
			// $startpoint = ($curPage * $per_page) - $per_page;
			// $limit = " limit ".$startpoint.",".$per_page;
			$sql = "select * from #_product_danhmuc where $where order by stt,id desc";
			$product = $d->rawQueryOne($sql,$params);
			// $sqlNum = "select count(*) as 'num' from #_product where $where order by stt,id desc";
			// $count = $d->rawQueryOne($sqlNum,$params);
			// $total = $count['num'];
			// $url = $func->getCurrentPageURL();
			// $paging = $func->pagination($total,$per_page,$curPage,$url);
		}
	}

	$seopage = $d->rawQueryOne("select * from #_seopage where type = ? limit 0,1",array('noi-dung'));
	$banner=$seopage['banner'];
	/* SEO */
	$seo->setSeo('title',$title_crumb);

	/* breadCrumbs */
	$breadcr->setBreadCrumbs('',$title_crumb);
	$breadcrumbs = $breadcr->getBreadCrumbs();
?>