<?php

function get_alldanhmuc($id = 0)
{
    global $d, $type;

    if ($id) {
        $temps = $d->rawQueryOne("select id_danhmuc from #_product_danhmuc_cap where id = ? and type = ? limit 0,1", array($id, $type));
        $arr_danhmuc = explode(',', $temps['id_danhmuc']);

        for ($i = 0; $i < count($arr_danhmuc); $i++) $temp[$i] = $arr_danhmuc[$i];
    }

    $row_danhmuc = $d->rawQuery("select tenvi, id from #_product_danhmuc where type = ? order by stt,id desc", array($type));
    $str = '<select id="danhmuc_group" name="danhmuc_group[]" class="form-control select2">';
    $str .= '<option value="0"> Chọn bộ luật</option>';
    for ($i = 0; $i < count($row_danhmuc); $i++) {
        if (isset($temp) && count($temp) > 0) {
            if (in_array($row_danhmuc[$i]['id'], $temp)) $selected = 'selected="selected"';
            else $selected = '';
        } else {
            $selected = '';
        }
        $str .= '<option value="' . $row_danhmuc[$i]["id"] . '" ' . $selected . ' > ' . $row_danhmuc[$i]["tenvi"] . '</option>';
    }
    $str .= '</select>';

    return $str;
};

$linkMan = "index.php?com=product&act=man_danhmuc_cap&type=" . $type . "&p=" . $curPage;
$linkSave = "index.php?com=product&act=save_danhmuc_cap&type=" . $type . "&p=" . $curPage;

/* Check cols */
if (isset($config['product'][$type]['images_danhmuc_cap']) && $config['product'][$type]['images_danhmuc_cap'] == true) {
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
                <li class="breadcrumb-item active">Chi tiết <?= $config['product'][$type]['title_main_danhmuc_cap'] ?></li>
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
                    if (isset($config['product'][$type]['slug_danhmuc_cap']) && $config['product'][$type]['slug_danhmuc_cap'] == true) {
                        $slugchange = ($act == 'edit_danhmuc_cap') ? 1 : 0;
                        include LAYOUT_PATH . "slug.php";
                    }
                    ?>
                    <div class="card card-primary card-outline text-sm">
                        <div class="card-header">
                            <h3 class="card-title">Nội dung <?= $config['product'][$type]['title_main_danhmuc_cap'] ?></h3>
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
                                                <div class="form-group">
                                                    <label for="ten<?= $k ?>">Tiêu đề (<?= $k ?>):</label>
                                                    <input type="text" class="form-control for-seo" name="data[ten<?= $k ?>]" id="ten<?= $k ?>" placeholder="Tiêu đề (<?= $k ?>)" value="<?= @$item['ten' . $k] ?>" <?= ($k == 'vi') ? 'required' : '' ?>>
                                                </div>
                                                <?php if (isset($config['product'][$type]['mota_danhmuc_cap']) && $config['product'][$type]['mota_danhmuc_cap'] == true) { ?>
                                                    <div class="form-group">
                                                        <label for="mota<?= $k ?>">Mô tả (<?= $k ?>):</label>
                                                        <textarea class="form-control for-seo <?= (isset($config['product'][$type]['mota_cke_danhmuc_cap']) && $config['product'][$type]['mota_cke_danhmuc_cap'] == true) ? 'ckeditor' : '' ?>" name="data[mota<?= $k ?>]" id="mota<?= $k ?>" rows="5" placeholder="Mô tả (<?= $k ?>)"><?= htmlspecialchars_decode(@$item['mota' . $k]) ?></textarea>
                                                    </div>
                                                <?php } ?>
                                                <?php if (isset($config['product'][$type]['noidung_danhmuc_cap']) && $config['product'][$type]['noidung_danhmuc_cap'] == true) { ?>
                                                    <div class="form-group">
                                                        <label for="noidung<?= $k ?>">Nội dung (<?= $k ?>):</label>
                                                        <textarea class="form-control for-seo <?= (isset($config['product'][$type]['noidung_cke_danhmuc_cap']) && $config['product'][$type]['noidung_cke_danhmuc_cap'] == true) ? 'ckeditor' : '' ?>" name="data[noidung<?= $k ?>]" id="noidung<?= $k ?>" rows="5" placeholder="Nội dung (<?= $k ?>)"><?= htmlspecialchars_decode(@$item['noidung' . $k]) ?></textarea>
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
                            <h3 class="card-title">Danh mục</h3>
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
                            <div class="form-group-category">
                                <?php if (isset($config['product'][$type]['danhmuc']) && $config['product'][$type]['danhmuc'] == true) { ?>
                                    <div class="form-group">
                                        <label class="d-block" for="id_danhmuc">Bộ luật:</label>
                                        <?= get_alldanhmuc(@$item['id']) ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($config['product'][$type]['images_danhmuc_cap']) && $config['product'][$type]['images_danhmuc_cap'] == true) { ?>
                        <div class="card card-primary card-outline text-sm">
                            <div class="card-header">
                                <h3 class="card-title">Hình ảnh</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php

                                $table_name = 'product_danhmuc_cap';

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
        <?php if (isset($config['product'][$type]['seo_danhmuc_cap']) && $config['product'][$type]['seo_danhmuc_cap'] == true) { ?>
            <div class="card card-primary card-outline text-sm bottom_height">
                <div class="card-header">
                    <h3 class="card-title">Nội dung SEO</h3>
                    <a class="btn btn-sm bg-gradient-success d-inline-block text-white float-right create-seo" title="Tạo SEO">Tạo SEO</a>
                </div>
                <div class="card-body">
                    <?php
                    $seoDB = $seo->getSeoDB($id, $com, 'man_danhmuc_cap', $type);
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