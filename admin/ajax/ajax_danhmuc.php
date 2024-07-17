<?php
global $d;
include __DIR__ . "/ajax_config.php";

	if(isset($_POST["id"]))
	{
		$id = (isset($_POST["id"])) ? htmlspecialchars($_POST["id"]) : 0;
		$type = (isset($_POST["type"])) ? htmlspecialchars($_POST["type"]) : '';
		$row = null;

		if($id)
		{
			$row = $d->rawQuery("select tenvi, id from table_product_danhmuc_cap where id_danhmuc = ? and type = ? order by stt,id desc",array($id,$type));
		}

		$str = '<option value="0">Chọn chương</option>';
		if($row)
		{
			foreach($row as $v)
			{
				$str .= '<option value='.$v["id"].'>'.$v["tenvi"].'</option>';
			}
		}
		echo $str;
	}
?>