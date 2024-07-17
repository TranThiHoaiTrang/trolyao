<?php
define('LIBRARIES', './libraries/');

require_once LIBRARIES . "config.php";
require_once LIBRARIES . 'autoload.php';
new AutoLoad();
$injection = new AntiSQLInjection();
$d = new PDODb($config['database']);
$func = new Functions($d);

/* Kiểm tra có đăng nhập chưa */
if ($func->check_login() == false && $act != "login") {
	$func->redirect("index.php?com=user&act=login");
}

/* Kiểm tra active export excel */
// if (!isset($config['order']['excelall']) || $config['order']['excelall'] == false) $func->transfer("Trang không tồn tại", "index.php", false);

/* Setting */
$setting = $d->rawQueryOne("select * from #_setting limit 0,1");
$optsetting = (isset($setting['options']) && $setting['options'] != '') ? json_decode($setting['options'], true) : null;

/* Thông tin đơn hàng */
$sql = "select * from #_member where id<>0";

$iddonvi = (isset($_SESSION[$login_admin]['id_donvi'])) ? htmlspecialchars($_SESSION[$login_admin]['id_donvi']) : '';


if ($iddonvi) $sql .= " and id_donvi IN ($iddonvi)";

$sql .= " order by stt,id desc";
// var_dump($sql);die();
$donhang = $d->rawQuery($sql);

/* PHPExcel */
require_once LIBRARIES . 'PHPExcel.php';

/* Khởi tọa đối tượng */
$PHPExcel = new PHPExcel();
$PHPExcelStyleTitle = new PHPExcel_Style();
$PHPExcelStyleContent = new PHPExcel_Style();

/* Khởi tạo thông tin người tạo */
$PHPExcel->getProperties()->setCreator($setting['tenvi']);
$PHPExcel->getProperties()->setLastModifiedBy($setting['tenvi']);
$PHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$PHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$PHPExcel->getProperties()->setDescription("Document for Office 2007 XLSX, generated using PHP classes.");

/* Merge cells */
// $PHPExcel->setActiveSheetIndex(0);
// $PHPExcel->setActiveSheetIndex(0)->mergeCells('A1:L1');
// $PHPExcel->setActiveSheetIndex(0)->mergeCells('A2:L2');
// $PHPExcel->setActiveSheetIndex(0)->mergeCells('A3:L3');
// $PHPExcel->setActiveSheetIndex(0)->mergeCells('A4:L4');

/* set Cell Value */
$PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
$PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$PHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$PHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$PHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$PHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$PHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
$PHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$PHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
$PHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
$PHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Tên User');
$PHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'Lượt truy cập T1');
$PHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Lượt truy cập T2');
$PHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Lượt truy cập T3');
$PHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'Lượt truy cập T4');
$PHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'Lượt truy cập T5');
$PHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'Lượt truy cập T6');
$PHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'Lượt truy cập T7');
$PHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'Lượt truy cập T8');
$PHPExcel->setActiveSheetIndex(0)->setCellValue('J1', 'Lượt truy cập T9');
$PHPExcel->setActiveSheetIndex(0)->setCellValue('K1', 'Lượt truy cập T10');
$PHPExcel->setActiveSheetIndex(0)->setCellValue('L1', 'Lượt truy cập T11');
$PHPExcel->setActiveSheetIndex(0)->setCellValue('M1', 'Lượt truy cập T12');
$PHPExcel->setActiveSheetIndex(0)->setCellValue('N1', 'Tổng lượt truy cập');

/* Style */
// $PHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray(
// 	array(
// 		'font' => array(
// 			'color' => array(
// 				'rgb' => '000000'
// 			),
// 			'name' => 'Arial',
// 			'bold' => true,
// 			'italic' => false,
// 			'size' => 14
// 		),
// 		'alignment' => array(
// 			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
// 			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
// 			'wrap' => true
// 		)
// 	)
// );
// $PHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray(
// 	array(
// 		'font' => array(
// 			'size' => 11
// 		),
// 		'alignment' => array(
// 			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
// 			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
// 			'wrap' => true
// 		)
// 	)
// );
// $PHPExcel->getActiveSheet()->getStyle('A3')->applyFromArray(
// 	array(
// 		'font' => array(
// 			'size' => 11
// 		),
// 		'alignment' => array(
// 			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
// 			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
// 			'wrap' => true
// 		)
// 	)
// );
// $PHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray(
// 	array(
// 		'font' => array(
// 			'size' => 11
// 		),
// 		'alignment' => array(
// 			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
// 			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
// 			'wrap' => true
// 		)
// 	)
// );
$PHPExcelStyleTitle->applyFromArray(
	array(
		'font' => array(
			'color' => array('rgb' => '000000'),
			'name' => 'Calibri',
			'bold' => true,
			'italic' => false,
			'size' => 10
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			'wrap' => true
		),
		'borders' => array(
			'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
		)
	)
);
$PHPExcel->getActiveSheet()->setSharedStyle($PHPExcelStyleTitle, 'A1:N1');

/* Lấy và Xuất dữ liệu */
$vitri = 2;
// var_dump(count($donhang));
for ($i = 0; $i < count($donhang); $i++) {

	$day = date('d');
	$month = date('n');
	$year = date('Y');
	$tong = 0;

	$monthstart1 = [];
	for ($j = 1; $j <= 12; $j++) {
		$daysInMonth = cal_days_in_month(0, $j, $year);

		$monthstart = mktime(0, 0, 0, $j, 1, $year);
		$monthend = mktime(0, 0, 0, $j, $daysInMonth, $year);
		
		$monthrec = $d->rawQueryOne("select count(*) as monthrec from #_counter_member where user_id = '" . @$donhang[$i]['id'] . "' and tm>='$monthstart' and tm<'$monthend'");

		$tong += $monthrec['monthrec'];
		$monthstart1[] = array_merge($monthrec);
	}


	// var_dump(date("d/m/Y", $monthstart));
	// var_dump(date("d/m/Y", $monthend));
	// var_dump($monthstart1);



	/* Gán giá trị */
	$PHPExcel->setActiveSheetIndex(0)
		->setCellValue('A' . $vitri, @$donhang[$i]['username'])
		->setCellValue('B' . $vitri, $monthstart1[0]['monthrec'])
		->setCellValue('C' . $vitri, $monthstart1[1]['monthrec'])
		->setCellValue('D' . $vitri, $monthstart1[2]['monthrec'])
		->setCellValue('E' . $vitri, $monthstart1[3]['monthrec'])
		->setCellValue('F' . $vitri, $monthstart1[4]['monthrec'])
		->setCellValue('G' . $vitri, $monthstart1[5]['monthrec'])
		->setCellValue('H' . $vitri, $monthstart1[6]['monthrec'])
		->setCellValue('I' . $vitri, $monthstart1[7]['monthrec'])
		->setCellValue('J' . $vitri, $monthstart1[8]['monthrec'])
		->setCellValue('K' . $vitri, $monthstart1[9]['monthrec'])
		->setCellValue('L' . $vitri, $monthstart1[10]['monthrec'])
		->setCellValue('M' . $vitri, $monthstart1[11]['monthrec'])
		->setCellValue('N' . $vitri, $tong);

	$PHPExcelStyleContent->applyFromArray(
		array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'wrap' => true
			),
			'borders' => array(
				'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			)
		)
	);
	// var_dump($vitri);
	$PHPExcel->getActiveSheet()->setSharedStyle($PHPExcelStyleContent, 'A' . $vitri . ':N' . $vitri);
	$vitri++;
}
// die();
/* Rename title */
$PHPExcel->getActiveSheet()->setTitle('user List');

/* Khởi tạo chỉ mục ở đầu sheet */
$PHPExcel->setActiveSheetIndex(0);

/* Xuất file */
$time = time();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="orders_list_' . $time . '_' . date('d_m_Y') . '.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit();
