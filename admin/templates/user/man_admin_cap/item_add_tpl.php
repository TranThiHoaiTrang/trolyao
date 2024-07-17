<?php
$linkMan = "index.php?com=user&act=man_admin_cap&p=" . $curPage;
$linkSave = "index.php?com=user&act=save_admin_cap&p=" . $curPage;

function get_donvi($id = 0)
{
	global $d, $type;

	if ($id) {
		$temps = $d->rawQueryOne("select id_donvi from #_user where id = ? limit 0,1", array($id));
		$arr_mau = explode(',', $temps['id_donvi']);

		for ($i = 0; $i < count($arr_mau); $i++) $temp[$i] = $arr_mau[$i];
	}

	$row_donvi = $d->rawQuery("select tenvi, id from #_news where type = 'quanly_donvi' order by stt,id desc");

	$str = '<select id="donvi_group" name="donvi_group[]" class="form-control select2" >';
	$str .= '<option value="0"> Chọn đơn vị</option>';
	for ($i = 0; $i < count($row_donvi); $i++) {
		if (isset($temp) && count($temp) > 0) {
			if (in_array($row_donvi[$i]['id'], $temp)) $selected = 'selected="selected"';
			else $selected = '';
		} else {
			$selected = '';
		}
		$str .= '<option value="' . $row_donvi[$i]["id"] . '" ' . $selected . ' > ' . $row_donvi[$i]["tenvi"] . '</option>';
	}
	$str .= '</select>';

	return $str;
}
?>
<?php
// var_dump($_GET);
if ($_GET['month'] != '') {
	$date = strtotime(date('y-m-d'));
	$year = date('Y', $date);
	$time = $year . '-' . $_GET['month'] . '-1';
	$date = strtotime($time);
} else {
	$date = strtotime(date('y-m-d'));
}

if ($_GET['member'] != '') {
	$id_member = $_GET['member'];
} else {
	$id_member = '';
}

$day = date('d', $date);
$month = date('m', $date);
$year = date('Y', $date);
$firstDay = mktime(0, 0, 0, $month, 1, $year);
$title = strftime('%B', $firstDay);
$dayOfWeek = date('D', $firstDay);
$daysInMonth = cal_days_in_month(0, $month, $year);
$timestamp = strtotime('next Sunday');
$weekDays = array();

for ($i = 0; $i < 7; $i++) {
	$weekDays[] = strftime('%a', $timestamp);
	$timestamp = strtotime('+1 day', $timestamp);
}

$blank = date('w', strtotime("{$year}-{$month}-01"));

$donvi = $item['id_donvi'];
?>
<style>
	.all_select_option_month_year{margin-bottom: 10px;}
	.all_select_option_month_year .select2-container{
		width: max-content !important;
		min-width: 200px;
	}
</style>
<!-- Content Header -->
<section class="content-header text-sm">
	<div class="container-fluid">
		<div class="row">
			<ol class="breadcrumb float-sm-left">
				<li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
				<li class="breadcrumb-item active">Chi tiết tài khoản cấp tỉnh</li>
			</ol>
		</div>
	</div>
</section>

<!-- Main content -->
<section class="content">
	<form class="validation-form" novalidate method="post" action="<?= $linkSave ?>" enctype="multipart/form-data">
		<div class="card-footer text-sm sticky-top">
			<button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
			<button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
			<a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
		</div>
		<div class="card card-primary card-outline text-sm">
			<div class="card-header">
				<h3 class="card-title"><?= ($act == "edit") ? "Cập nhật" : "Thêm mới"; ?> tài khoản</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<!-- <div class="form-group col-md-4">
						<?php if (isset($config['permission']) && $config['permission'] == true) { ?>
							<label for="permission">Danh sách nhóm quyền:</label>
							<?= $func->get_permission(@$item['id_nhomquyen']) ?>
						<?php } ?>
					</div> -->
					<div class="form-group col-md-4">
						<?php if (isset($config['permission']) && $config['permission'] == true) { ?>
							<label for="permission">Danh sách đơn vị:</label>
							<?= get_donvi(@$item['id']) ?>
						<?php } ?>
					</div>
					<div class="form-group col-md-4">
						<label for="username">Tài khoản: <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="data[username]" id="username" placeholder="Tài khoản" value="<?= @$item['username'] ?>" <?= ($act == "edit") ? 'readonly' : ''; ?> required>
					</div>
					<div class="form-group col-md-4">
						<label for="ten">Họ tên: <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="data[ten]" id="ten" placeholder="Họ tên" value="<?= @$item['ten'] ?>" required>
					</div>
					<div class="form-group col-md-4">
						<label for="password">Mật khẩu:</label>
						<input type="password" class="form-control" name="data[password]" id="password" placeholder="Mật khẩu" <?= ($act == "add_admin") ? 'required' : ''; ?>>
					</div>
					<div class="form-group col-md-4">
						<label for="confirm_password">Nhập lại mật khẩu:</label>
						<input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Nhập lại mật khẩu" <?= ($act == "add_admin") ? 'required' : ''; ?>>
					</div>
					<div class="form-group col-md-4">
						<label for="email">Email:</label>
						<input type="email" class="form-control" name="data[email]" id="email" placeholder="Email" value="<?= @$item['email'] ?>">
					</div>
					<div class="form-group col-md-4">
						<label for="dienthoai">Điện thoại:</label>
						<input type="text" class="form-control" name="data[dienthoai]" id="dienthoai" placeholder="Điện thoại" value="<?= @$item['dienthoai'] ?>">
					</div>
					<div class="form-group col-md-4">
						<label for="gioitinh">Giới tính:</label>
						<select class="form-control" name="data[gioitinh]" id="gioitinh">
							<option value="0">Chọn giới tính</option>
							<option <?= (@$item['gioitinh'] == 1) ? "selected" : "" ?> value="1">Nam</option>
							<option <?= (@$item['gioitinh'] == 2) ? "selected" : "" ?> value="2">Nữ</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="ngaysinh">Ngày sinh:</label>
						<input type="text" class="form-control" name="data[ngaysinh]" id="ngaysinh" placeholder="Ngày sinh" value="<?= (@$item['ngaysinh']) ? date('d/m/Y', @$item['ngaysinh']) : ""; ?>" readonly>
					</div>
					<div class="form-group col-md-4">
						<label for="diachi">Địa chỉ:</label>
						<input type="text" class="form-control" name="data[diachi]" id="diachi" placeholder="Địa chỉ" value="<?= @$item['diachi'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Kích hoạt:</label>
					<div class="custom-control custom-checkbox d-inline-block align-middle">
						<input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" <?= (!isset($item['hienthi']) || $item['hienthi'] == 1) ? 'checked' : '' ?>>
						<label for="hienthi-checkbox" class="custom-control-label"></label>
					</div>
				</div>
				<div class="form-group">
					<label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
					<input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?= isset($item['stt']) ? $item['stt'] : 1 ?>">
				</div>
			</div>
		</div>
		<div class="card-footer text-sm">
			<button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
			<button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
			<a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
			<input type="hidden" name="id" value="<?= @$item['id'] ?>">
		</div>
	</form>
	<form>
		<div class="all_select_option_month_year">
			<select id="months" class="form-control select2" name="months" onchange="goToPage(this)" style="height: calc(2.25rem + 2px);border: 1px solid #ced4da;padding: .46875rem .75rem;margin-bottom: 10px;">
				<option value="">-- Chọn một tháng --</option>
				<option value="1" <?= $_GET['month'] == '1'  ? 'selected="selected"' : '' ?>>Tháng 1</option>
				<option value="2" <?= $_GET['month'] == '2'  ? 'selected="selected"' : '' ?>>Tháng 2</option>
				<option value="3" <?= $_GET['month'] == '3'  ? 'selected="selected"' : '' ?>>Tháng 3</option>
				<option value="4" <?= $_GET['month'] == '4'  ? 'selected="selected"' : '' ?>>Tháng 4</option>
				<option value="5" <?= $_GET['month'] == '5'  ? 'selected="selected"' : '' ?>>Tháng 5</option>
				<option value="6" <?= $_GET['month'] == '6'  ? 'selected="selected"' : '' ?>>Tháng 6</option>
				<option value="7" <?= $_GET['month'] == '7'  ? 'selected="selected"' : '' ?>>Tháng 7</option>
				<option value="8" <?= $_GET['month'] == '8'  ? 'selected="selected"' : '' ?>>Tháng 8</option>
				<option value="9" <?= $_GET['month'] == '9'  ? 'selected="selected"' : '' ?>>Tháng 9</option>
				<option value="10" <?= $_GET['month'] == '10'  ? 'selected="selected"' : '' ?>>Tháng 10</option>
				<option value="11" <?= $_GET['month'] == '11'  ? 'selected="selected"' : '' ?>>Tháng 11</option>
				<option value="12" <?= $_GET['month'] == '12'  ? 'selected="selected"' : '' ?>>Tháng 12</option>
			</select>
			<?php
			$member_user = $d->rawQuery("select * FROM #_member WHERE id_donvi = ? order by stt,id desc", array($donvi));
			?>
			<select id="users" class="form-control select2" name="users" onchange="goToUser(this)" style="height: calc(2.25rem + 2px);border: 1px solid #ced4da;padding: .46875rem .75rem;margin-bottom: 10px;">
				<option value="">-- Chọn thành viên --</option>
				<?php foreach ($member_user as $v) { ?>
					<option value="<?= $v['id'] ?>" <?= $_GET['member'] == $v['id']  ? 'selected="selected"' : '' ?>><?= $v['username'] ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="card">
			<div class="card-header">
				<h5 class="mb-0">Thống kê truy cập tháng <?= $month ?>/<?= $year ?></h5>
			</div>
			<div class="card-body">
				<form class="form-filter-charts row align-items-center mb-1" action="index.php" method="get" name="form-thongke" accept-charset="utf-8">
					<div id="container" style="width: 100%; height: 400px; margin: 0 auto"></div>
				</form>
				<div id="apexMixedChart"></div>
			</div>
		</div>
	</form>
</section>

<!-- User js -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#ngaysinh').datetimepicker({
			timepicker: false,
			format: 'd/m/Y',
			formatDate: 'd/m/Y',
			// minDate: '1950/01/01',
			maxDate: '<?= date("Y/m/d", time()) ?>'
		});
	});

	function goToPage(selectElement) {
		var currentUrl = window.location.href;
		var selectedValue = selectElement.value;
		var users = $('.users').val();
		var newUrl;
		if (selectedValue) {
			// Kiểm tra nếu URL đã có tham số option
			if (currentUrl.indexOf('&month=') !== -1 || currentUrl.indexOf('?month=') !== -1) {
				// Thay thế giá trị của month
				newUrl = currentUrl.replace(/([&?]month=)[^&]*/, '$1' + selectedValue);
			} else {
				// Thêm giá trị của month
				if (currentUrl.indexOf('?') !== -1) {
					newUrl = currentUrl + '&month=' + selectedValue;
				} else {
					newUrl = currentUrl + '?month=' + selectedValue;
				}
			}
			window.location.href = newUrl;
		}
	}

	function goToUser(selectElement) {
		var currentUrl = window.location.href;
		var users = selectElement.value;
		var months = $('.months').val();
		var newUrl;
		
		if (users) {
			// Kiểm tra nếu URL đã có tham số option
			if (currentUrl.indexOf('&member=') !== -1 || currentUrl.indexOf('?member=') !== -1) {
				// Thay thế giá trị của user
				newUrl = currentUrl.replace(/([&?]member=)[^&]*/, '$1' + users);
			} else {
				// Thêm giá trị của user
				if (currentUrl.indexOf('?') !== -1) {
					newUrl = currentUrl + '&member=' + users;
				} else {
					newUrl = currentUrl + '?member=' + users;
				}
			}
			
		} else {
			console.log(users);
			newUrl = currentUrl.replace(/([&?]member=)[^&]*(&?)/,'');
		}
		window.location.href = newUrl;
	}
</script>

<script type="text/javascript">
	$(function() {
		$('#container').highcharts({
			chart: {
				type: 'spline'
			},
			colors: ['#6CF', '#39F', '#06C', '#036', '#000'],
			title: {
				text: 'Thống kê truy cập thành viên tháng : <?php echo $month ?> - <?php echo $year ?>'
			},
			subtitle: {
				text: ''
			},
			xAxis: {
				type: 'category',
				labels: {
					rotation: -45,
					style: {
						fontSize: '13px',
						fontFamily: 'Arial'
					}
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Số người truy cập'
				}
			},
			legend: {
				enabled: false
			},
			tooltip: {
				pointFormat: 'Tổng : <b>{point.y:.1f} Lượt truy cập</b>'
			},
			series: [{
				name: 'Population',
				data: [
					<?php
					for ($i = 1; $i <= $daysInMonth; $i++) :
						$k = $i + 1;
						$begin = strtotime($year . '-' . $month . '-' . $i);
						$end = strtotime($year . '-' . $month . '-' . $k);
						if ($id_member != '') {
							$todayrc = $d->rawQueryOne("select count(*) as todayrecord FROM #_counter_member cm JOIN #_member m ON cm.user_id = $id_member WHERE cm.tm >= ? AND cm.tm < ? AND m.id_donvi = ?", array($begin, $end, $donvi));
						} else {
							$todayrc = $d->rawQueryOne("select count(*) as todayrecord FROM #_counter_member cm JOIN #_member m ON cm.user_id = m.id WHERE cm.tm >= ? AND cm.tm < ? AND m.id_donvi = ?", array($begin, $end, $donvi));
						}

						$today_visitors = $todayrc['todayrecord'];
						// var_dump($todayrc);
					?>['<?= $i ?>', <?= $today_visitors ?>],
					<?php endfor; ?>
				],
				dataLabels: {
					enabled: true,
					rotation: -90,
					color: '#FFFFFF',
					align: 'right',
					format: '{point.y:.1f}', // one decimal
					y: 10, // 10 pixels down from the top
					style: {
						fontSize: '13px',
						fontFamily: 'Arial'
					}
				}
			}]
		});
		$("#datepicker").datepicker({
			dateFormat: 'yy-mm-dd'
		});
	});
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="js/highcharts/modules/exporting.js"></script>