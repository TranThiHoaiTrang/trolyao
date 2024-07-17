<?php
$linkMan = "index.php?com=user&act=man&p=" . $curPage;
$linkSave = "index.php?com=user&act=save&p=" . $curPage;

function get_donvi($id = 0)
{
    global $d, $type, $login_admin;

    // if ($id) {
    //     $temps = $d->rawQueryOne("select id_donvi from #_member where id = ? limit 0,1", array($id));
    //     $arr_mau = explode(',', $temps['id_donvi']);

    //     for ($i = 0; $i < count($arr_mau); $i++) $temp[$i] = $arr_mau[$i];
    // }
    $id_user = $_SESSION[$login_admin]['id'];
    $user = $d->rawQueryOne("select id_donvi from #_user where id = '" . $id_user . "' and hienthi>0 limit 0,1");
    $temp[] = $user['id_donvi'];

    // var_dump($temp);
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
<style>
    .input_mk_all {
        position: relative;
    }

    .icon_mk {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 3%;
    }

    .icon_mk_nl {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 3%;
    }
</style>

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
?>

<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Chi tiết tài khoản khách</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?= $linkSave ?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm
                lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title"><?= ($act == "edit") ? "Cập nhật" : "Thêm mới"; ?> tài khoản</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="permission">Danh sách đơn vị:</label>
                        <?= get_donvi(@$item['id']) ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="username">Tài khoản: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="data[username]" id="username" placeholder="Tài khoản" value="<?= @$item['username'] ?>" <?= ($act == "edit") ? 'readonly' : ''; ?> required>
                    </div>
                    <!-- <div class="form-group col-md-4">
                        <label for="ten">Họ tên: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="data[ten]" id="ten" placeholder="Họ tên"
                            value="<?= @$item['ten'] ?>" required>
                    </div> -->
                    <div class="form-group col-md-4">
                        <label for="password">Mật khẩu:</label>
                        <div class="input_mk_all">
                            <input type="password" class="form-control input_mk" name="data[password]" id="password" placeholder="Mật khẩu" <?= ($act == "add") ? 'required' : ''; ?>>
                            <div class="icon_mk">
                                <i class="fas fa-eye"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="confirm_password">Nhập lại mật khẩu:</label>
                        <div class="input_mk_all">
                            <input type="password" class="form-control input_mk_nl" name="confirm_password" id="confirm_password" placeholder="Nhập lại mật khẩu" <?= ($act == "add") ? 'required' : ''; ?>>
                            <div class="icon_mk_nl">
                                <i class="fas fa-eye"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="data[email]" id="email" placeholder="Email" value="<?= @$item['email'] ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="dienthoai">Điện thoại:</label>
                        <input type="text" class="form-control" name="data[dienthoai]" id="dienthoai" placeholder="Điện thoại" value="<?= @$item['dienthoai'] ?>">
                    </div>
                    <!-- <div class="form-group col-md-4">
                        <label for="gioitinh">Giới tính:</label>
                        <select class="form-control" name="data[gioitinh]" id="gioitinh">
                            <option value="0">Chọn giới tính</option>
                            <option <?= (@$item['gioitinh'] == 1) ? "selected" : "" ?> value="1">Nam</option>
                            <option <?= (@$item['gioitinh'] == 2) ? "selected" : "" ?> value="2">Nữ</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="ngaysinh">Ngày sinh:</label>
                        <input type="text" class="form-control" name="data[ngaysinh]" id="ngaysinh"
                            placeholder="Ngày sinh"
                            value="<?= (@$item['ngaysinh']) ? date('d/m/Y', @$item['ngaysinh']) : ""; ?>" readonly>
                    </div> -->
                    <div class="form-group col-md-4">
                        <label for="diachi">Địa chỉ:</label>
                        <input type="text" class="form-control" name="data[diachi]" id="diachi" placeholder="Địa chỉ" value="<?= @$item['diachi'] ?>">
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label class="d-block" for="giakm">Chiết khấu:</label>
                    <div class="input-group">
                        <input type="text" class="form-control sale" name="data[sale]" id="sale" placeholder="Sale"
                            value="<?= @$item['sale'] ?>" maxlength="3">
                        <div class="input-group-append">
                            <div class="input-group-text"><strong>%</strong></div>
                        </div>
                    </div>
                </div> -->
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
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm
                lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?= @$item['id'] ?>">
        </div>
    </form>
    <form>
        <div class="all_select_option_month_year">
            <select id="months" name="months" onchange="goToPage(this)" style="height: calc(2.25rem + 2px);border: 1px solid #ced4da;padding: .46875rem .75rem;margin-bottom: 10px;">
                <option value="">-- Chọn một tháng --</option>
                <option value="1">Tháng 1</option>
                <option value="2">Tháng 2</option>
                <option value="3">Tháng 3</option>
                <option value="4">Tháng 4</option>
                <option value="5">Tháng 5</option>
                <option value="6">Tháng 6</option>
                <option value="7">Tháng 7</option>
                <option value="8">Tháng 8</option>
                <option value="9">Tháng 9</option>
                <option value="10">Tháng 10</option>
                <option value="11">Tháng 11</option>
                <option value="12">Tháng 12</option>
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
    const passField = document.querySelector(".input_mk");
    const passField2 = document.querySelector(".input_mk_nl");
    $('.icon_mk').click(function() {

        if (passField.type === "password") {
            passField.type = "text";
            $('.icon_mk').html('<i class="fas fa-eye-slash"></i>');
        } else {
            passField.type = "password";
            $('.icon_mk').html('<i class="fas fa-eye"></i>');
        }
    });
    $('.icon_mk_nl').click(function() {

        if (passField2.type === "password") {
            passField2.type = "text";
            $('.icon_mk_nl').html('<i class="fas fa-eye-slash"></i>');
        } else {
            passField2.type = "password";
            $('.icon_mk_nl').html('<i class="fas fa-eye"></i>');
        }
    });

    function goToPage(selectElement) {
        var currentUrl = window.location.href;
        var selectedValue = selectElement.value;
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
</script>


<script type="text/javascript">
    $(function() {
        $('#container').highcharts({
            chart: {
                type: 'spline'
            },
            colors: ['#6CF', '#39F', '#06C', '#036', '#000'],
            title: {
                text: 'Thống kê truy cập tháng : <?php echo $month ?> - <?php echo $year ?>'
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
                    $user_id = $item['id'];
                    for ($i = 1; $i <= $daysInMonth; $i++) :
                        $k = $i + 1;
                        $begin = strtotime($year . '-' . $month . '-' . $i);
                        $end = strtotime($year . '-' . $month . '-' . $k);
                        $todayrc = $d->rawQueryOne("select count(*) as todayrecord from #_counter_member where tm >= ? and tm < ? and user_id = ?", array($begin, $end, $user_id));
                        $today_visitors = $todayrc['todayrecord'];
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