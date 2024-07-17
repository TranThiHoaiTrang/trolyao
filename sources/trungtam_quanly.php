<?php  
	if(!defined('SOURCES')) die("Error");

	@$id = htmlspecialchars($_GET['id']);
	@$idl = htmlspecialchars($_GET['idl']);
	@$idc = htmlspecialchars($_GET['idc']);
	@$idi = htmlspecialchars($_GET['idi']);
	@$ids = htmlspecialchars($_GET['ids']);
	$seopage = $d->rawQueryOne("select * from #_seopage where type = ? limit 0,1",array($type));
	$banner=$seopage['banner'];
	if($id!='')
	{
		/* Lấy bài viết detail */
		$row_detail = $d->rawQueryOne("select * from #_news where id = ? and type = ? and hienthi > 0 limit 0,1",array($id,$type));

		/* Cập nhật lượt xem */
		$data_luotxem['luotxem'] = $row_detail['luotxem'] + 1;
		$d->where('id',$row_detail['id']);
		$d->update('news',$data_luotxem);

		$faqDB = $d->rawQuery("select * from #_cauhoi where idmuc = ? and type = ? ", array($id, $type));

		/* Lấy cấp 1 */
		$news_list = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_news_list where id = ? and type = ? and hienthi > 0 limit 0,1",array($row_detail['id_list'],$type));

		/* Lấy cấp 2 */
		$news_cat = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_news_cat where id = ? and type = ? and hienthi > 0 limit 0,1",array($row_detail['id_cat'],$type));

		/* Lấy cấp 3 */
		$news_item = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_news_item where id = ? and type = ? and hienthi > 0 limit 0,1",array($row_detail['id_item'],$type));

		/* Lấy cấp 4 */
		$news_sub = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_news_sub where id = ? and type = ? and hienthi > 0 limit 0,1",array($row_detail['id_sub'],$type));	
		
		/* Lấy hình ảnh con */
		$hinhanhtt = $d->rawQuery("select photo,tenvi from #_gallery where id_photo = ? and com='news' and type = ? and kind='man' and val = ? and hienthi > 0 order by stt,id desc",array($row_detail['id'],$type,$type));
		 
		/* Lấy bài viết cùng loại */
		$where = "";
		$where = "id <> ? and id_list = ? and type = ? and hienthi > 0";
		$params = array($id,$row_detail['id_list'],$type);

		$curPage = $get_page;
		$per_page = 8;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select id, ten$lang, tenkhongdauvi, tenkhongdauen, photo, ngaytao, mota$lang from #_news where $where order by stt,id desc $limit";
		$news = $d->rawQuery($sql,$params);
		$sqlNum = "select count(*) as 'num' from #_news where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);

		/* SEO */
		$seoDB = $seo->getSeoDB($row_detail['id'],'news','man',$row_detail['type']);
		$seo->setSeo('h1',$row_detail['ten'.$lang]);
		if(!empty($seoDB['title'.$seolang])) $seo->setSeo('title',$seoDB['title'.$seolang]);
		else $seo->setSeo('title',$row_detail['ten'.$lang]);
		if(!empty($seoDB['keywords'.$seolang])) $seo->setSeo('keywords',$seoDB['keywords'.$seolang]);
		if(!empty($seoDB['description'.$seolang])) $seo->setSeo('description',$seoDB['description'.$seolang]);
		if(!empty($row_detail['canonical'.$seolang])) $seo->setSeo('canonical',$seoDB['canonical'.$seolang]);
		$seo->setSeo('url',$func->getPageURL());
		$seo->setSeo('url_canonical',$func->getPageCANONICAL($row_detail['canonical'.$lang]));
		$img_json_bar = (isset($row_detail['options']) && $row_detail['options'] != '') ? json_decode($row_detail['options'],true) : null;
		if($img_json_bar == null || ($img_json_bar['p'] != $row_detail['photo']))
		{
			$img_json_bar = $func->getImgSize($row_detail['photo'],UPLOAD_NEWS_L.$row_detail['photo']);
			$seo->updateSeoDB(json_encode($img_json_bar),'news',$row_detail['id']);
		}
		if(count($img_json_bar) > 0)
		{
			$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_NEWS_L.$row_detail['photo']);
			$seo->setSeo('photo:width',$img_json_bar['w']);
			$seo->setSeo('photo:height',$img_json_bar['h']);
			$seo->setSeo('photo:type',$img_json_bar['m']);
		}

		/* breadCrumbs */
		if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
		if($news_list != null) $breadcr->setBreadCrumbs($news_list[$sluglang],$news_list['ten'.$lang]);
		if($news_cat != null) $breadcr->setBreadCrumbs($news_cat[$sluglang],$news_cat['ten'.$lang]);
		if($news_item != null) $breadcr->setBreadCrumbs($news_item[$sluglang],$news_item['ten'.$lang]);
		if($news_sub != null) $breadcr->setBreadCrumbs($news_sub[$sluglang],$news_sub['ten'.$lang]);
		$breadcr->setBreadCrumbs($row_detail[$sluglang],$row_detail['ten'.$lang]);
		$breadcrumbs = $breadcr->getBreadCrumbs();
	}
	
?>