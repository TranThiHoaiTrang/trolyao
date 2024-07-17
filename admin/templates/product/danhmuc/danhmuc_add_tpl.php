<?php
$linkMan = "index.php?com=product&act=man_danhmuc&type=" . $type . "&p=" . $curPage;
$linkSave = "index.php?com=product&act=save_danhmuc&type=" . $type . "&p=" . $curPage;


/* Check cols */
if (isset($config['product'][$type]['images_danhmuc']) && $config['product'][$type]['images_danhmuc'] == true || $config['product'][$type]['list_danhmuc'] == true) {
    $colLeft = "col-xl-8 left_content align-self-start";
    $colRight = "col-xl-4 right_content align-self-start";
} else {
    $colLeft = "col-12";
    $colRight = "d-none";
}
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Chi tiết <?= $config['product'][$type]['title_main_danhmuc'] ?></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?= $linkSave ?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="row">
            <div class="<?= $colLeft ?>">
                <div id="scroll-left">
                    <?php
                    if (isset($config['product'][$type]['slug_danhmuc']) && $config['product'][$type]['slug_danhmuc'] == true) {
                        $slugchange = ($act == 'edit_danhmuc') ? 1 : 0;
                        include LAYOUT_PATH . "slug.php";
                    }
                    ?>
                    <div class="card card-primary card-outline text-sm">
                        <div class="card-header">
                            <h3 class="card-title">Nội dung <?= $config['product'][$type]['title_main_danhmuc'] ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                                <div class="custom-control custom-checkbox d-inline-block align-middle">
                                    <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" <?= (!isset($item['hienthi']) || $item['hienthi'] == 1) ? 'checked' : '' ?>>
                                    <label for="hienthi-checkbox" class="custom-control-label"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                                <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?= isset($item['stt']) ? $item['stt'] : 1 ?>">
                            </div>
                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                        <?php foreach ($config['website']['lang'] as $k => $v) { ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?= ($k == 'vi') ? 'active' : '' ?>" id="tabs-lang" data-toggle="pill" href="#tabs-lang-<?= $k ?>" role="tab" aria-controls="tabs-lang-<?= $k ?>" aria-selected="true"><?= $v ?></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="card-body card-article">
                                    <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                        <?php foreach ($config['website']['lang'] as $k => $v) { ?>
                                            <div class="tab-pane fade show <?= ($k == 'vi') ? 'active' : '' ?>" id="tabs-lang-<?= $k ?>" role="tabpanel" aria-labelledby="tabs-lang">
                                                <?php if (isset($config['product'][$type]['taptin_danhmuc']) && $config['product'][$type]['taptin_danhmuc'] == true) { ?>
                                                    <div class="form-group">
                                                        <label class="change-file mb-1 mr-2" for="file-taptin">
                                                            <p>Upload tập tin:</p>
                                                            <strong class="ml-2">
                                                                <span class="btn btn-sm bg-gradient-success"><i class="fas fa-file-upload mr-2"></i>Chọn tập tin</span>
                                                                <div><b class="text-sm text-split"></b></div>
                                                            </strong>
                                                        </label>
                                                        <strong class="d-block mt-2 mb-2 text-sm"><?php echo $config['product'][$type]['file_type']; ?></strong>
                                                        <div class="custom-file my-custom-file d-none">
                                                            <input type="file" class="custom-file-input" name="file-taptin" id="file-taptin">
                                                            <label class="custom-file-label" for="file-taptin">Chọn file</label>
                                                        </div>
                                                        <?php if (isset($item['taptin']) && $item['taptin'] != '') { ?>
                                                            <a class="btn btn-sm bg-gradient-primary text-white d-inline-block align-middle p-2 rounded mb-1" href="<?= UPLOAD_FILE . @$item['taptin'] ?>" title="Download tập tin hiện tại"><i class="fas fa-download mr-2"></i>Download tập tin hiện tại</a>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group">
                                                    <label for="ten<?= $k ?>">Tiêu đề (<?= $k ?>):</label>
                                                    <input type="text" class="form-control for-seo" name="data[ten<?= $k ?>]" id="ten<?= $k ?>" placeholder="Tiêu đề (<?= $k ?>)" value="<?= @$item['ten' . $k] ?>" <?= ($k == 'vi') ? 'required' : '' ?>>
                                                </div>
                                                <?php if (isset($config['product'][$type]['sohieu_danhmuc']) && $config['product'][$type]['sohieu_danhmuc'] == true && $k == 'vi') { ?>
                                                    <div class="form-group">
                                                        <label for="ten<?= $k ?>">Số hiệu:</label>
                                                        <input type="text" class="form-control for-seo" name="data[sohieu]" id="sohieu" placeholder="Số hiệu" value="<?= @$item['sohieu'] ?>">
                                                    </div>
                                                <?php } ?>
                                                <?php if (isset($config['product'][$type]['tinhtranghieuluc_danhmuc']) && $config['product'][$type]['tinhtranghieuluc_danhmuc'] == true && $k == 'vi') { ?>
                                                    <div class="form-group">
                                                        <label for="ten<?= $k ?>">Tình trạng hiệu lực:</label>
                                                        <input type="text" class="form-control for-seo" name="data[tinhtranghieuluc]" id="tinhtranghieuluc" placeholder="Tình trạng hiệu lực" value="<?= @$item['tinhtranghieuluc'] ?>">
                                                    </div>
                                                <?php } ?>
                                                <?php if (isset($config['product'][$type]['nguoiki_danhmuc']) && $config['product'][$type]['nguoiki_danhmuc'] == true && $k == 'vi') { ?>
                                                    <div class="form-group">
                                                        <label for="nguoiki">Người kí:</label>
                                                        <input type="text" class="form-control for-seo" name="data[nguoiki]" id="nguoiki" placeholder="Người kí" value="<?= @$item['nguoiki'] ?>">
                                                    </div>
                                                <?php } ?>
                                                <?php if (isset($config['product'][$type]['linhvuc_danhmuc']) && $config['product'][$type]['linhvuc_danhmuc'] == true && $k == 'vi') { ?>
                                                    <div class="form-group">
                                                        <label for="ten<?= $k ?>">Lĩnh vực:</label>
                                                        <input type="text" class="form-control for-seo" name="data[linhvuc]" id="linhvuc" placeholder="Lĩnh vực" value="<?= @$item['linhvuc'] ?>">
                                                    </div>
                                                <?php } ?>
                                                <?php if (isset($config['product'][$type]['coquanbanhanh_danhmuc']) && $config['product'][$type]['coquanbanhanh_danhmuc'] == true && $k == 'vi') { ?>
                                                    <div class="form-group">
                                                        <label for="ten">Cơ quan ban hành:</label>
                                                        <input type="text" class="form-control for-seo" name="data[coquanbanhanh]" id="coquanbanhanh" placeholder="Cơ quan ban hành" value="<?= @$item['coquanbanhanh'] ?>">
                                                    </div>
                                                <?php } ?>
                                                <?php if (isset($config['product'][$type]['sochidanmucdieu_danhmuc']) && $config['product'][$type]['sochidanmucdieu_danhmuc'] == true && $k == 'vi') { ?>
                                                    <div class="form-group">
                                                        <label for="sochidanmucdieu">Số chỉ dẫn mức Điều:</label>
                                                        <input type="text" class="form-control for-seo" name="data[sochidanmucdieu]" id="sochidanmucdieu" placeholder="Số chỉ dẫn mức Điều" value="<?= @$item['sochidanmucdieu'] ?>">
                                                    </div>
                                                <?php } ?>
                                                <?php if (isset($config['product'][$type]['sochidanmuckhoan_danhmuc']) && $config['product'][$type]['sochidanmuckhoan_danhmuc'] == true && $k == 'vi') { ?>
                                                    <div class="form-group">
                                                        <label for="sochidanmuckhoan">Số chỉ dẫn mức Khoản/Điểm:</label>
                                                        <input type="text" class="form-control for-seo" name="data[sochidanmuckhoan]" id="sochidanmuckhoan" placeholder="Số chỉ dẫn mức Khoản/Điểm" value="<?= @$item['sochidanmuckhoan'] ?>">
                                                    </div>
                                                <?php } ?>
                                                <?php if (isset($config['product'][$type]['sodieumuckhoan_danhmuc']) && $config['product'][$type]['sodieumuckhoan_danhmuc'] == true && $k == 'vi') { ?>
                                                    <div class="form-group">
                                                        <label for="sodieumuckhoan">Số điều có chỉ dẫn mức Khoản/Điểm:</label>
                                                        <input type="text" class="form-control for-seo" name="data[sodieumuckhoan]" id="sodieumuckhoan" placeholder="Số điều có chỉ dẫn mức Khoản/Điểm" value="<?= @$item['sodieumuckhoan'] ?>">
                                                    </div>
                                                <?php } ?>
                                                <?php if (isset($config['product'][$type]['tongsodieu_danhmuc']) && $config['product'][$type]['tongsodieu_danhmuc'] == true && $k == 'vi') { ?>
                                                    <div class="form-group">
                                                        <label for="tongsodieu">Tổng số điều:</label>
                                                        <input type="text" class="form-control for-seo" name="data[tongsodieu]" id="tongsodieu" placeholder="Tổng số điều" value="<?= @$item['tongsodieu'] ?>">
                                                    </div>
                                                <?php } ?>

                                                <?php if (isset($config['product'][$type]['ngaybanhanh_danhmuc']) && $config['product'][$type]['ngaybanhanh_danhmuc'] == true && $k == 'vi') { ?>
                                                    <div class="form-group">
                                                        <label for="ngaybanhanh">Ngày ban hành:</label>
                                                        <input type="date" class="form-control for-seo" name="data[ngaybanhanh]" id="ngaybanhanh" placeholder="Ngày ban hành" value="<?= !empty(@$item['ngaybanhanh']) ? date('Y-m-d', @$item['ngaybanhanh']) : '' ?>">
                                                    </div>
                                                <?php } ?>
                                                <?php if (isset($config['product'][$type]['ngayhethieuluc_danhmuc']) && $config['product'][$type]['ngayhethieuluc_danhmuc'] == true && $k == 'vi') { ?>
                                                    <div class="form-group">
                                                        <label for="ngayhethieuluc">Ngày hết hiệu lực:</label>
                                                        <input type="date" class="form-control for-seo" name="data[ngayhethieuluc]" id="ngayhethieuluc" placeholder="Ngày hết hiệu lực" value="<?= !empty(@$item['ngayhethieuluc']) ? date('Y-m-d', @$item['ngayhethieuluc']) : '' ?>">
                                                    </div>
                                                <?php } ?>
                                                <?php if (isset($config['product'][$type]['mota_danhmuc']) && $config['product'][$type]['mota_danhmuc'] == true) { ?>
                                                    <div class="form-group">
                                                        <label for="mota<?= $k ?>">Mô tả (<?= $k ?>):</label>
                                                        <textarea class="form-control for-seo <?= (isset($config['product'][$type]['mota_cke_danhmuc']) && $config['product'][$type]['mota_cke_danhmuc'] == true) ? 'ckeditor' : '' ?>" name="data[mota<?= $k ?>]" id="mota<?= $k ?>" rows="5" placeholder="Mô tả (<?= $k ?>)"><?= htmlspecialchars_decode(@$item['mota' . $k]) ?></textarea>
                                                    </div>
                                                <?php } ?>
                                                <?php if (isset($config['product'][$type]['noidung_danhmuc']) && $config['product'][$type]['noidung_danhmuc'] == true) { ?>
                                                    <div class="form-group">
                                                        <label for="noidung<?= $k ?>">Nội dung (<?= $k ?>):</label>
                                                        <textarea class="form-control for-seo <?= (isset($config['product'][$type]['noidung_cke_danhmuc']) && $config['product'][$type]['noidung_cke_danhmuc'] == true) ? 'ckeditor' : '' ?>" name="data[noidung<?= $k ?>]" id="noidung<?= $k ?>" rows="5" placeholder="Nội dung (<?= $k ?>)"><?= htmlspecialchars_decode(@$item['noidung' . $k]) ?></textarea>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="<?= $colRight ?>">
                <div id="scroll-right">

                    <div class="card card-primary card-outline text-sm">
                        <div class="card-header">
                            <h3 class="card-title">Danh mục <?= $config['product'][$type]['title_main'] ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group-category row">
                                <?php if (isset($config['product'][$type]['list_danhmuc']) && $config['product'][$type]['list_danhmuc'] == true) { ?>
                                    <div class="form-group col-xl-6 col-sm-6">
                                        <label class="d-block" for="id_list">Danh mục cấp 1:</label>
                                        <?= $func->get_ajax_category('product', 'list', $type) ?>
                                    </div>
                                <?php } ?>
                                <?php if (isset($config['product'][$type]['cat']) && $config['product'][$type]['cat'] == true) { ?>
                                    <div class="form-group col-xl-6 col-sm-6">
                                        <label class="d-block" for="id_cat">Danh mục cấp 2:</label>
                                        <?= $func->get_ajax_category('product', 'cat', $type) ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <?php if (isset($config['product'][$type]['images_danhmuc']) && $config['product'][$type]['images_danhmuc'] == true) { ?>
                        <div class="card card-primary card-outline text-sm">
                            <div class="card-header">
                                <h3 class="card-title">Hình ảnh <?= $config['product'][$type]['title_main_danhmuc'] ?></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">

                                <?php

                                $table_name = 'danhmuc';

                                // photo
                                $title = 'Ảnh đại diện';
                                $photoDetail = @$item['photo'] ?? '';
                                $input_name = $table_key = 'photo';
                                include LAYOUT_PATH . "single_image.php";

                                ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php if (isset($config['product'][$type]['seo_danhmuc']) && $config['product'][$type]['seo_danhmuc'] == true) { ?>
            <div class="card card-primary card-outline text-sm bottom_height">
                <div class="card-header">
                    <h3 class="card-title">Nội dung SEO</h3>
                    <a class="btn btn-sm bg-gradient-success d-inline-block text-white float-right create-seo" title="Tạo SEO">Tạo SEO</a>
                </div>
                <div class="card-body">
                    <?php
                    $seoDB = $seo->getSeoDB($id, $com, 'man_danhmuc', $type);
                    include LAYOUT_PATH . "seo.php";
                    ?>
                </div>
            </div>
        <?php } ?>
        <div class="card-footer text-sm bottom_height">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?= @$item['id'] ?>">
        </div>
    </form>
</section>