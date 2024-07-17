<?php  
	if(!defined('SOURCES')) die("Error");

	@$id = htmlspecialchars($_GET['id']);
	@$idl = htmlspecialchars($_GET['idl']);
	@$idc = htmlspecialchars($_GET['idc']);
	@$idi = htmlspecialchars($_GET['idi']);
	@$ids = htmlspecialchars($_GET['ids']);
	@$idb = htmlspecialchars($_GET['idb']);
	@$iddm = htmlspecialchars($_GET['iddm']);
	@$iddmc = htmlspecialchars($_GET['iddmc']);

	if($id!='')
	{ 
		/* Lấy sản phẩm detail */
		$row_detail = $d->rawQueryOne("select * from #_product where id = ? and type = ? and hienthi > 0 limit 0,1",array($id,$type));
		// var_dump($row_detail);die();
		/* Cập nhật lượt xem */
		$data_luotxem['luotxem'] = $row_detail['luotxem'] + 1;
		$d->where('id',$row_detail['id']);
		$d->update('product',$data_luotxem);

		$faqDB = $d->rawQuery("select * from #_cauhoi where idmuc = ? and type = ? ", array($id, $type));

		/*$pro_brand = $d->rawQueryOne("select id,ten$lang from #_product_brand where id = ? and type = ? and hienthi > 0",array($row_detail['id_brand'],$type));
		$pro_size = $d->rawQueryOne("select id,ten$lang from #_product_size where id = ? and type = ? and hienthi > 0",array($row_detail['id_size'],$type));
		$pro_mau = $d->rawQueryOne("select id,ten$lang from #_product_mau where id = ? and type = ? and hienthi > 0",array($row_detail['id_mau'],$type));
		$pro_doday = $d->rawQueryOne("select id,ten$lang from #_product_doday where id = ? and type = ? and hienthi > 0",array($row_detail['id_doday'],$type));

        /* Lấy tags *-/
		if($row_detail['id_tags']) $pro_tags = $d->rawQuery("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_tags where id in (".$row_detail['id_tags'].") and type='".$type."'");

		/* Lấy thương hiệu *=/
		$pro_brand = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_product_brand where id = ? and type = ? and hienthi > 0",array($row_detail['id_brand'],$type));

		/* Lấy màu */
		if($row_detail['id_mau']) $mau = $d->rawQuery("select loaihienthi, photo, mau, id, ten$lang from #_product_mau where type='".$type."' and find_in_set(id,'".$row_detail['id_mau']."') and hienthi > 0 order by stt,id desc");

		/* Lấy size */
		if($row_detail['id_size']) $size = $d->rawQuery("select id, ten$lang from #_product_size where type='".$type."' and find_in_set(id,'".$row_detail['id_size']."') and hienthi > 0 order by stt,id desc");

		/* Lấy cấp 1 */
		$pro_list = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_list where id = ? and type = ? and hienthi > 0 limit 0,1",array($row_detail['id_list'],$type));

		/* Lấy cấp 2 */
		$pro_cat = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_cat where id = ? and type = ? and hienthi > 0 limit 0,1",array($row_detail['id_cat'],$type));

		/* Lấy cấp 3 *-/
		$pro_item = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_item where id = ? and type = ? and hienthi > 0 limit 0,1",array($row_detail['id_item'],$type));

		/* Lấy cấp 4 *-/
		$pro_sub = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_sub where id = ? and type = ? and hienthi > 0 limit 0,1",array($row_detail['id_sub'],$type));
		
		/* Lấy hình ảnh con */
		// $hinhanhsp = $d->rawQuery("select photo from #_gallery where id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 order by stt,id desc",array($row_detail['id'],$type,$type));
		// var_dump("select photo from #_gallery where id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 order by stt,id desc",array($row_detail['id'],$type,$type));

		/* Lấy sản phẩm cùng loại */
		/*$where = "";
		$where = "id <> ? and id_list = ? and type = ? and hienthi > 0";
		$params = array($id,$row_detail['id_list'],$type);*/

		$params = array();
		$where = "a.id <> ? and a.type = ? and a.hienthi > 0 and a.banchay > 0";
		array_push($params, $id);
		array_push($params, $type);
		// if($row_detail['id_list']>0){
		// 	$where.=" and a.id_list = ?";
		// 	array_push($params, $row_detail['id_list']);
		// }
		// if($row_detail['id_cat']>0){
		// 	$where.=" and a.id_cat = ?";
		// 	array_push($params, $row_detail['id_cat']);
		// }
		// if($row_detail['id_item']>0){
		// 	$where.=" and a.id_item = ?";
		// 	array_push($params, $row_detail['id_item']);
		// }
		// if($row_detail['id_sub']>0){
		// 	$where.=" and a.id_sub = ?";
		// 	array_push($params, $row_detail['id_sub']);
		// }
		if($row_detail['id_danhmuc'] != ''){
			$where.=" and a.id_danhmuc REGEXP ?";
			array_push($params, $row_detail['id_danhmuc']);
		}
		if($row_detail['id_danhmuc_cap'] != ''){
			$where.=" and a.id_danhmuc_cap REGEXP ?";
			array_push($params, $row_detail['id_danhmuc_cap']);
		}

		$curPage = $get_page;
		$per_page = 8;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_product a where $where order by a.stt,a.id desc";
		// var_dump($sql,$params);
		$product = $d->rawQuery($sql,$params);
		$sqlNum = "select count(*) as 'num' from #_product a where $where order by a.stt,a.id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);

		/* SEO */
		$seoDB = $seo->getSeoDB($row_detail['id'],'product','man',$row_detail['type']);
		$seo->setSeo('h1',$row_detail['ten'.$lang]);
		if(!empty($seoDB['title'.$seolang])) $seo->setSeo('title',$seoDB['title'.$seolang]);
		else $seo->setSeo('title',$row_detail['ten'.$lang]);
		if(!empty($seoDB['keywords'.$seolang])) $seo->setSeo('keywords',$seoDB['keywords'.$seolang]);
		if(!empty($seoDB['description'.$seolang])) $seo->setSeo('description',$seoDB['description'.$seolang]);
		$seo->setSeo('url',$func->getPageURL());
		$seo->setSeo('url_canonical',$func->getPageCANONICAL($row_detail['canonical'.$lang]));
		$img_json_bar = (isset($row_detail['options']) && $row_detail['options'] != '') ? json_decode($row_detail['options'],true) : null;
		if($img_json_bar == null || ($img_json_bar['p'] != $row_detail['photo']))
		{
			$img_json_bar = $func->getImgSize($row_detail['photo'],UPLOAD_PRODUCT_L.$row_detail['photo']);
			$seo->updateSeoDB(json_encode($img_json_bar),'product',$row_detail['id']);
		}
		if(count($img_json_bar) > 0)
		{
			$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_PRODUCT_L.$row_detail['photo']);
			$seo->setSeo('photo:width',$img_json_bar['w']);
			$seo->setSeo('photo:height',$img_json_bar['h']);
			$seo->setSeo('photo:type',$img_json_bar['m']);
		}

		/* breadCrumbs */
		if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
		if($pro_list != null) $breadcr->setBreadCrumbs($pro_list[$sluglang],$pro_list['ten'.$lang]);
		if($pro_cat != null) $breadcr->setBreadCrumbs($pro_cat[$sluglang],$pro_cat['ten'.$lang]);
		if($pro_item != null) $breadcr->setBreadCrumbs($pro_item[$sluglang],$pro_item['ten'.$lang]);
		if($pro_sub != null) $breadcr->setBreadCrumbs($pro_sub[$sluglang],$pro_sub['ten'.$lang]);
		$breadcr->setBreadCrumbs($row_detail[$sluglang],$row_detail['ten'.$lang]);
		$breadcrumbs = $breadcr->getBreadCrumbs();
	}
	else if($idl!='')
	{
		/* Lấy cấp 1 detail */
		$pro_list = $d->rawQueryOne("select id, ten$lang, tenkhongdau$lang, type, photo, options,noidung$lang,mota$lang from #_product_list where id = ? and type = ? limit 0,1",array($idl,$type));
		$id_danhmuc_cacloai = $idl;
		$table_danhmuc_cacloai = '_product_list';

		$noidung_page=$pro_list['noidung'.$lang];
		$mota_page=$pro_list['mota'.$lang];
		/* SEO */
		$title_cat = $pro_list['ten'.$lang];
		$seoDB = $seo->getSeoDB($pro_list['id'],'product','man_list',$pro_list['type']);
		$seo->setSeo('h1',$pro_list['ten'.$lang]);
		if(!empty($seoDB['title'.$seolang])) $seo->setSeo('title',$seoDB['title'.$seolang]);
		else $seo->setSeo('title',$pro_list['ten'.$lang]);
		if(!empty($seoDB['keywords'.$seolang])) $seo->setSeo('keywords',$seoDB['keywords'.$seolang]);
		if(!empty($seoDB['description'.$seolang])) $seo->setSeo('description',$seoDB['description'.$seolang]);
		$seo->setSeo('url',$func->getPageURL());
		$seo->setSeo('url_canonical',$func->getPageCANONICAL($pro_list['canonical'.$lang]));
		$img_json_bar = (isset($pro_list['options']) && $pro_list['options'] != '') ? json_decode($pro_list['options'],true) : null;
		if($img_json_bar == null || ($img_json_bar['p'] != $pro_list['photo']))
		{
			$img_json_bar = $func->getImgSize($pro_list['photo'],UPLOAD_PRODUCT_L.$pro_list['photo']);
			$seo->updateSeoDB(json_encode($img_json_bar),'product_list',$pro_list['id']);
		}
		if(count($img_json_bar) > 0)
		{
			$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_PRODUCT_L.$pro_list['photo']);
			$seo->setSeo('photo:width',$img_json_bar['w']);
			$seo->setSeo('photo:height',$img_json_bar['h']);
			$seo->setSeo('photo:type',$img_json_bar['m']);
		}

		/* Lấy sản phẩm */
		$where = "";
		$where = "a.id_list = ? and a.type = ? and a.hienthi > 0";
		$params = array($idl,$type);

		$curPage = $get_page;
		$per_page = 9;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_product a where $where order by a.stt,a.id desc ";
		$product = $d->rawQuery($sql,$params);
		$sqlNum = "select count(*) as 'num' from #_product a where $where order by a.stt,a.id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);

		/* breadCrumbs */
		if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
		if($pro_list != null) $breadcr->setBreadCrumbs($pro_list[$sluglang],$pro_list['ten'.$lang]);
		$breadcrumbs = $breadcr->getBreadCrumbs();	
	}
	else
	{
		/* SEO */
		$seopage = $d->rawQueryOne("select * from #_seopage where type = ? limit 0,1",array($type));
		$noidung_page=$seopage['noidung'.$lang];
		$mota_page=$seopage['mota'.$lang];
		$seo->setSeo('h1',$title_crumb);
		if(!empty($seopage['title'.$seolang])) $seo->setSeo('title',$seopage['title'.$seolang]);
		else $seo->setSeo('title',$title_crumb);
		if(!empty($seopage['keywords'.$seolang])) $seo->setSeo('keywords',$seopage['keywords'.$seolang]);
		if(!empty($seopage['description'.$seolang])) $seo->setSeo('description',$seopage['description'.$seolang]);
		$seo->setSeo('url',$func->getPageURL());
		$seo->setSeo('url_canonical',$func->getPageCANONICAL($seopage['canonical'.$lang]));
		$img_json_bar = (isset($seopage['options']) && $seopage['options'] != '') ? json_decode($seopage['options'],true) : null;
		if(!empty($seopage['photo']))
		{
			if($img_json_bar == null || ($img_json_bar['p'] != $seopage['photo']))
			{
				$img_json_bar = $func->getImgSize($seopage['photo'],UPLOAD_SEOPAGE_L.$seopage['photo']);
				$seo->updateSeoDB(json_encode($img_json_bar),'seopage',$seopage['id']);
			}
			if(count($img_json_bar) > 0)
			{
				$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_SEOPAGE_L.$seopage['photo']);
				$seo->setSeo('photo:width',$img_json_bar['w']);
				$seo->setSeo('photo:height',$img_json_bar['h']);
				$seo->setSeo('photo:type',$img_json_bar['m']);
			}
		}

		/* Lấy tất cả sản phẩm */
		$where = "";
		$where = "a.type = ? and a.hienthi > 0";
		$params = array($type);

		$curPage = $get_page;
		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_product a where $where order by a.stt,a.id desc $limit";
		// var_dump($sql,$params);
		$product = $d->rawQuery($sql,$params);
		$sqlNum = "select count(*) as 'num' from #_product a where $where order by a.stt,a.id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);

		/* breadCrumbs */
		if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
		$breadcrumbs = $breadcr->getBreadCrumbs();
	}
?>