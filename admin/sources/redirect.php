<?php
	if(!defined('SOURCES')) die("Error");

	/* Kiểm tra active redirect */
	// if(isset($config['redirect']))
	// {
	// 	$arrCheck = array();
	// 	foreach($config['redirect'] as $k => $v) $arrCheck[] = $k;
	// 	if(!count($arrCheck) || !in_array($type,$arrCheck)) $func->transfer("Trang không tồn tại", "index.php", false);
	// }
	// else
	// {
	// 	$func->transfer("Trang không tồn tại", "index.php", false);
	// }

	switch($act)
	{
		case "man":
			get_items();
			$template = "redirect/man/items";
			break;

		case "add":		
			$template = "redirect/man/item_add";
			break;

		case "edit":		
			get_item();
			$template = "redirect/man/item_add";
			break;

		case "save":
			save_item();
			break;

		case "delete":
			delete_item();
			break;

		default:
			$template = "404";
	}

	/* Get redirect */
	function get_items()
	{
		global $d, $func, $curPage, $items, $paging, $type;

		$where = "";
		
		// if(isset($_REQUEST['keyword']))
		// {
		// 	$keyword = htmlspecialchars($_REQUEST['keyword']);
		// 	$where .= " and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
		// }

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_redirections order by stt,id desc $limit";
		// var_dump($sql);
		$items = $d->rawQuery($sql);
		$sqlNum = "select count(*) as 'num' from #_redirections order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum);
		$total = $count['num'];
		$url = "index.php?com=redirect&act=man&type=".$type;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit redirect */
	function get_item()
	{
		global $d, $func, $curPage, $item, $type;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=redirect&act=man&type=".$type."&p=".$curPage, false);

		$item = $d->rawQueryOne("select * from #_redirections where id = ? limit 0,1",array($id));

		if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=redirect&act=man&type=".$type."&p=".$curPage, false);
	}

	/* Save redirect */
	function save_item()
	{
		global $d, $curPage, $func, $config, $com, $type;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=redirect&act=man&type=".$type."&p=".$curPage, false);
		
		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}

			// $data['old_url'] = (isset($data['old_url'])) ? $data['old_url'] : '';
			// $data['new_url'] = (isset($data['new_url'])) ? $data['new_url'] : '';

			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		}

		
		$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

		if($id)
		{

			$data['ngaysua'] = time();

			$d->where('id', $id);
			// $d->where('type', $type);
			if($d->update('redirections',$data))
			{
				$func->redirect("index.php?com=redirect&act=man&type=".$type."&p=".$curPage);
			}
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=redirect&act=man&type=".$type."&p=".$curPage, false);
		}
		else
		{
			
			$data['ngaytao'] = time();
			if($d->insert('redirections',$data))
			{
				$func->redirect("index.php?com=redirect&act=man&type=".$type."&p=".$curPage);
			}
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=redirect&act=man&type=".$type."&p=".$curPage, false);
		}
	}

	/* Delete redirect */
	function delete_item()
	{
		global $d, $curPage, $func, $com, $type;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;
		
		if($id)
		{
			/* Lấy dữ liệu */
			$row = $d->rawQueryOne("select * from #_redirections where id = ? limit 0,1",array($id));

			if($row['id'])
			{
				$d->rawQuery("delete from #_redirect where id = ?",array($id));

				$func->redirect("index.php?com=redirect&act=man&type=".$type."&p=".$curPage);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=redirect&act=man&type=".$type."&p=".$curPage, false);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=redirect&act=man&type=".$type."&p=".$curPage, false);
	}
?>