<div class="fixwidth">
    <div class="wrap_bottom">
        <div class="all_trolyao_layout">
            <?php include LAYOUT_PATH . "layout_left.php" ?>
            <div class="trolyao_layout_center">
                <div class="all_trolyao_layout_center_top">
                <div class="trolyao_layout_center_banner">
                        <div class="all_banner_trolyao_center_top">
                            <img src="./assets/images/start.png" alt="">
                            <span>TRỢ LÝ ẢO VIỆN KIỂM SÁT</span>
                            <img src="./assets/images/start.png" alt="">
                        </div>
                        <div class="all_dx_trolyao_center_top">
                            <a href="logout">
                                <div class="dx_trolyao_center_top" style="align-items: center">
                                    <div class="icon_dx_trolyao_center_top">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </div>
                                    <div class="name_dx_trolyao_center_top">Đăng xuất</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="trolyao_layout_center_boloc">
                        <!-- <ul class="nav nav-pills trolyao_layout_center_boloc_nav" id="pills-tab" role="tablist">
                            <?php foreach ($spcatmenu as $spc) { ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-<?= $spc['id'] ?>-tab" data-toggle="pill" data-target="#pills-<?= $spc['id'] ?>" type="button" role="tab" aria-controls="pills-<?= $spc['id'] ?>" aria-selected="true"><?= $spc['ten' . $lang] ?></button>
                                </li>
                            <?php } ?>
                        </ul> -->
                        <div class="all_frm_timkiem">
                            <div class="frm_timkiem">
                                <div class="icon_search"><i class="far fa-search"></i></div>
                                <?php $all_vb_chinh = $d->rawQueryOne("select * from #$table_danhmuc_cacloai where id = '$id_danhmuc_cacloai' and hienthi>0 and type='van-ban'"); ?>
                                <input type="text" class="input" id="keyword" placeholder="Nhập từ khóa ..." onkeypress="doEnter(event,'keyword');" value="<?= $all_vb_chinh['ten' . $lang] ?>">
                                <div class="all_button_search">
                                    <?php if ($deviceType != 'mobile') { ?>
                                        <button type="submit" value="" class="nut_tim_void" aria-label="Search"><i class="fas fa-microphone"></i></button>
                                    <?php } ?>
                                    <button type="submit" value="" class="nut_tim" aria-label="Search" onclick="onSearch('keyword');"><i class="fas fa-location-arrow"></i></button>
                                </div>
                            </div>
                            <div id="suggesstion-box">
                                <?php
                                $data = $d->rawQuery("select * from #_keyword order by id desc");
                                ?>
                                <ul id="country-list">
                                    <?php foreach ($data as $v) { ?>
                                        <li class="country_sanpham">
                                            <div class="name_country_sanpham name_country_sanpham_search" data-keyword="<?= $v['keyword'] ?>">
                                                <img src="./assets/images/time.svg" alt="" width="16" height="16">
                                                <span><?= $v['keyword'] ?></span>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="all_trolyao_layout_center_center">
                    <div class="tab-content all_trolyao_layout_center_center_scroll" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                        <span>Văn bản chính</span>
                                    </button>
                                </li>
                                <?php
                                $all_vb_chinh = $d->rawQueryOne("select * from #$table_danhmuc_cacloai where id = '$id_danhmuc_cacloai' and hienthi>0 and type='van-ban'");
                                $all_sp_thuoc_chinh = $d->rawQuery("SELECT DISTINCT id_chidan FROM table_product WHERE id_danhmuc = '" . $all_vb_chinh['id'] . "' AND id_chidan IS NOT NULL AND hienthi > 0 AND type = 'van-ban'");

                                $id_chidan_unique = [];
                                foreach ($all_sp_thuoc_chinh as $item) {
                                    if ($item['id_chidan']) {
                                        $ids = explode(',', $item['id_chidan']);
                                        foreach ($ids as $id) {
                                            if (!in_array($id, $id_chidan_unique)) {
                                                $id_chidan_unique[] = $id;
                                            }
                                        }
                                    }
                                }
                                if ($id_chidan_unique) {
                                ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="vb-lienquan-tab" data-toggle="tab" data-target="#vb-lienquan" type="button" role="tab" aria-controls="vb-lienquan" aria-selected="false">
                                            <span>Văn bản liên quan</span>
                                        </button>
                                    </li>
                                <?php } ?>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content" style="padding-top: 10px;">
                                <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <?php
                                    if ($table_danhmuc_cacloai == '_product_danhmuc') {
                                        $all_vb_chinh = $d->rawQueryOne("select * from #$table_danhmuc_cacloai where id = '$id_danhmuc_cacloai' and hienthi>0 and type='van-ban' order by stt,id asc");
                                        $all_chuongthuoc_vb_chinh = $d->rawQuery("select * from #_product_danhmuc_cap where id_danhmuc = '$id_danhmuc_cacloai' and hienthi>0 and type='van-ban' order by stt,id asc");
                                        $loaivanban = $d->rawQueryOne("select * from #_product_cat where id = '" . $all_vb_chinh['id_cat'] . "' and  hienthi>0 and type='van-ban' order by stt,id asc");

                                    ?>
                                        <div class="all_block-view-all hide-shadow hide-border">
                                            <div class="block-view-all">
                                                <div class="name_danhmuc"><?= $all_vb_chinh['ten' . $lang] ?>, Số <?= $all_vb_chinh['sohieu'] ?></div>
                                                <div class="all_thongtin_vb_chinh">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="all_col-vb_chinh">
                                                                <?php if ($all_vb_chinh['sohieu']) { ?>
                                                                    <div class="thongtin_vb_chinh">
                                                                        <span>Số hiệu văn bản: </span>
                                                                        <span><?= !empty($all_vb_chinh['sohieu']) ? $all_vb_chinh['sohieu'] : 'Đang cập nhật' ?></span>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if ($all_vb_chinh['coquanbanhanh']) { ?>
                                                                    <div class="thongtin_vb_chinh">
                                                                        <span>Cơ quan ban hành: </span>
                                                                        <span><?= !empty($all_vb_chinh['coquanbanhanh']) ? $all_vb_chinh['coquanbanhanh'] : 'Đang cập nhật' ?></span>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if ($all_vb_chinh['ngaybanhanh']) { ?>
                                                                    <div class="thongtin_vb_chinh">
                                                                        <span>Ngày ban hành: </span>
                                                                        <span><?= !empty($all_vb_chinh['ngaybanhanh']) ? date('Y-m-d', $all_vb_chinh['ngaybanhanh']) : 'Đang cập nhật' ?></span>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if ($all_vb_chinh['ngayhethieuluc']) { ?>
                                                                    <div class="thongtin_vb_chinh">
                                                                        <span>Ngày hết hiệu lực: </span>
                                                                        <span><?= !empty($all_vb_chinh['ngayhethieuluc']) ? date('Y-m-d', $all_vb_chinh['ngayhethieuluc']) : 'Đang cập nhật' ?></span>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if ($all_vb_chinh['sochidanmucdieu']) { ?>
                                                                    <div class="thongtin_vb_chinh">
                                                                        <span>Số chỉ dẫn mức Điều: </span>
                                                                        <span><?= !empty($all_vb_chinh['sochidanmucdieu']) ? $all_vb_chinh['sochidanmucdieu'] : 0 ?></span>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if ($all_vb_chinh['sodieumuckhoan']) { ?>
                                                                    <div class="thongtin_vb_chinh">
                                                                        <span>Số điều có chỉ dẫn mức Khoản/Điểm: </span>
                                                                        <span><?= !empty($all_vb_chinh['sodieumuckhoan']) ? $all_vb_chinh['sodieumuckhoan'] : 0 ?></span>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="all_col-vb_chinh">
                                                                <?php if ($all_vb_chinh['tinhtranghieuluc']) { ?>
                                                                    <div class="thongtin_vb_chinh">
                                                                        <span>Tình trạng hiệu lực: </span>
                                                                        <span><?= !empty($all_vb_chinh['tinhtranghieuluc']) ? $all_vb_chinh['tinhtranghieuluc'] : 'Đang cập nhật' ?></span>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if ($loaivanban['ten' . $lang]) { ?>
                                                                    <div class="thongtin_vb_chinh">
                                                                        <span>Loại văn bản: </span>
                                                                        <span><?= !empty($loaivanban['ten' . $lang]) ? $loaivanban['ten' . $lang] : 'Đang cập nhật' ?></span>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if ($all_vb_chinh['nguoiki']) { ?>
                                                                    <div class="thongtin_vb_chinh">
                                                                        <span>Người kí: </span>
                                                                        <span><?= !empty($all_vb_chinh['nguoiki']) ? $all_vb_chinh['nguoiki'] : 'Đang cập nhật' ?></span>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if ($all_vb_chinh['linhvuc']) { ?>
                                                                    <div class="thongtin_vb_chinh">
                                                                        <span>Lĩnh vực: </span>
                                                                        <span><?= !empty($all_vb_chinh['linhvuc']) ? $all_vb_chinh['linhvuc'] : 'Đang cập nhật' ?></span>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if ($all_vb_chinh['tongsodieu']) { ?>
                                                                    <div class="thongtin_vb_chinh">
                                                                        <span>Tổng số điều: </span>
                                                                        <span><?= !empty($all_vb_chinh['tongsodieu']) ? $all_vb_chinh['tongsodieu'] : 0 ?></span>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if ($all_vb_chinh['sochidanmuckhoan']) { ?>
                                                                    <div class="thongtin_vb_chinh">
                                                                        <span>Số chỉ dẫn mức Khoản/Điểm: </span>
                                                                        <span><?= !empty($all_vb_chinh['sochidanmuckhoan']) ? $all_vb_chinh['sochidanmuckhoan'] : 0 ?></span>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if ($all_vb_chinh['taptin']) { ?>
                                                        <a href="./admin/upload/file/<?= $all_vb_chinh['taptin'] ?>" target="_blank">
                                                            <div class="vb_web"><span>Xem văn bản web (pdf)</span></div>
                                                        </a>
                                                    <?php }
                                                    if ($all_vb_chinh['taptin_word']) { ?>
                                                        <a href="./admin/upload/file/<?= $all_vb_chinh['taptin_word'] ?>" target="_blank">
                                                            <div class="vb_web"><span>Xem văn bản web (word)</span></div>
                                                        </a>
                                                    <?php }
                                                    if ($all_vb_chinh['noidung' . $lang]) { ?>
                                                        <div class="vb_web" data-id="<?= $all_vb_chinh['id'] ?>" onclick="vanbanweb('vb_web');"><span>Xem văn bản web</span></div>
                                                    <?php } ?>

                                                    <div class="all_noidung_vanbanchinh">
                                                        <div class="all_mucluc_search_vb_chinh">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <span class="muclucvanban">Mục lục văn bản:</span>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="all_search_noidung">
                                                                        <input type="hidden" name="id_vb_chinh" class="id_vb_chinh" value="<?= $all_vb_chinh['id'] ?>">
                                                                        <input type="text" class="input" id="keyword_noidung" placeholder="Nội dung văn bản" onkeypress="doEnter_noidung(event,'keyword_noidung');">
                                                                        <button type="submit" value="" class="nut_tim" onclick="onSearch_noidung('keyword_noidung');" aria-label="Search"><i class="fal fa-search"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="noidung_vanbanchinh all_gioithieu_index">
                                                            <?= $all_vb_chinh['mota' . $lang] ?>
                                                            <?php if ($all_chuongthuoc_vb_chinh) { ?>
                                                                <?php foreach ($all_chuongthuoc_vb_chinh as $chuong) {
                                                                    $all_vb_thuocchuong = $d->rawQuery("select * from #_product where id_danhmuc = '$id_danhmuc_cacloai' and id_danhmuc_cap = '" . $chuong['id'] . "' and hienthi>0 and type='van-ban' order by stt,id asc");
                                                                ?>
                                                                    <?= $chuong['ten' . $lang] ?>
                                                                    <?= $chuong['noidung' . $lang] ?>
                                                                    <div class="all_danhsach_dieu_thuoc_chuong">
                                                                        <?php foreach ($all_vb_thuocchuong as $dieu) { ?>
                                                                            <div class="dieu_thuoc_chuong">
                                                                                <div class="dieu_luat">
                                                                                    <div class="icon_dieuluat"><i class="fas fa-caret-right"></i></div>
                                                                                    <span class="name_dieuluat"><?= $dieu['ten' . $lang] ?></span>
                                                                                    <?php if ($dieu['id_chidan']) {
                                                                                        $id_chidan = explode(',', $dieu['id_chidan']);
                                                                                    ?>
                                                                                        <div class="all_chidan">
                                                                                            <div class="name_chidan">Chỉ dẫn</div>
                                                                                            <div class="noidung_chidan">
                                                                                                <?php for ($i = 0; $i < count($id_chidan); $i++) {
                                                                                                    $danhmuc_chidan = $d->rawQueryOne("select * from #_product_danhmuc where slugvi = '" . $id_chidan[$i] . "' and hienthi>0 and type='van-ban'");
                                                                                                    $chidan_pro = $d->rawQueryOne("select * from #_product where slugvi = '" . $id_chidan[$i] . "' and hienthi>0 and type='van-ban'");
                                                                                                    // var_dump("select * from #_product where slugvi = '" . $id_chidan[$i] . "' and hienthi>0 and type='van-ban'");
                                                                                                ?>
                                                                                                    <?php if ($danhmuc_chidan) { ?>
                                                                                                        <a href="<?= $danhmuc_chidan['tenkhongdauvi'] ?>" target="_blank"><?= $danhmuc_chidan['ten' . $lang] ?></a>
                                                                                                    <?php } ?>
                                                                                                    <?php if ($chidan_pro) { ?>
                                                                                                        <a href="<?= $chidan_pro['tenkhongdauvi'] ?>" target="_blank"><?= $chidan_pro['ten' . $lang] ?></a>
                                                                                                    <?php } ?>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                                <div class="noidung_dieu_luat noidung_dieu_luat_pro"><?= $dieu['noidung' . $lang] ?></div>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } else {
                                                                $all_vb_thuocchuong = $d->rawQuery("select * from #_product where id_danhmuc = '$id_danhmuc_cacloai' and hienthi>0 and type='van-ban'");
                                                            ?>
                                                                <div class="all_danhsach_dieu_thuoc_chuong">
                                                                    <?php foreach ($all_vb_thuocchuong as $dieu) { ?>
                                                                        <div class="dieu_thuoc_chuong">
                                                                            <div class="dieu_luat">
                                                                                <div class="icon_dieuluat"><i class="fas fa-caret-right"></i></div>
                                                                                <span class="name_dieuluat"><?= $dieu['ten' . $lang] ?></span>
                                                                            </div>
                                                                            <div class="noidung_dieu_luat noidung_dieu_luat_pro"><?= $dieu['noidung' . $lang] ?></div>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else {
                                        $danhmuc_sp = $d->rawQueryOne("select * from #$table_danhmuc_cacloai where id = '$id_danhmuc_cacloai' and hienthi>0 and type='van-ban'");
                                        $all_spthuocdm = $d->rawQuery("select * from #_product where id_list = '" . $danhmuc_sp['id'] . "' and hienthi>0 and type='van-ban'");
                                    ?>
                                        <div class="all_block-view-all hide-shadow hide-border">
                                            <div class="block-view-all">
                                                <a href="<?= $danhmuc_sp['tenkhongdauvi'] ?>">
                                                    <div class="name_danhmuc"><?= $danhmuc_sp['ten' . $lang] ?></div>
                                                </a>
                                                <div class="all_dieu">
                                                    <?php foreach ($all_spthuocdm as $v) { ?>
                                                        <div class="all_dieu_danhmuc">
                                                            <a href="<?= $v['tenkhongdauvi'] ?>">
                                                                <div class="dieu_danhmuc dieu_danhmuc_search">
                                                                    <span><?= $func->highlightKeyword($v['ten' . $lang], $tukhoa2) ?></span>
                                                                </div>
                                                            </a>
                                                            <?php if ($v['id_chidan']) {
                                                                $id_chidan = explode(',', $v['id_chidan']);
                                                            ?>
                                                                <div class="all_chidan">
                                                                    <div class="name_chidan">Chỉ dẫn</div>
                                                                    <div class="noidung_chidan">
                                                                        <?php for ($i = 0; $i < count($id_chidan); $i++) {
                                                                            $danhmuc_chidan = $d->rawQueryOne("select * from #_product_danhmuc where slugvi = '" . $id_chidan[$i] . "' and hienthi>0 and type='van-ban'");
                                                                            $chidan_pro = $d->rawQueryOne("select * from #_product where slugvi = '" . $id_chidan[$i] . "' and hienthi>0 and type='van-ban'");
                                                                        ?>
                                                                            <?php if ($danhmuc_chidan) { ?>
                                                                                <a href="<?= $danhmuc_chidan['tenkhongdauvi'] ?>" target="_blank"><?= $danhmuc_chidan['ten' . $lang] ?></a>
                                                                            <?php } ?>
                                                                            <?php if ($chidan_pro) { ?>
                                                                                <a href="<?= $chidan_pro['tenkhongdauvi'] ?>" target="_blank"><?= $chidan_pro['ten' . $lang] ?></a>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <a href="<?= $v['tenkhongdauvi'] ?>">
                                                            <div class="noidung_dieu_danhmuc"><?= $func->highlightKeyword($func->sub_str($v['noidung' . $lang], 100), $tukhoa2) ?><span>(Xem thêm)</span></div>
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="tab-pane" id="vb-lienquan" role="tabpanel" aria-labelledby="vb-lienquan-tab">
                                    <?php
                                    $all_vb_chinh = $d->rawQueryOne("select * from #$table_danhmuc_cacloai where id = '$id_danhmuc_cacloai' and hienthi>0 and type='van-ban'");
                                    $all_sp_thuoc_chinh = $d->rawQuery("SELECT DISTINCT id_chidan FROM table_product WHERE id_danhmuc = '" . $all_vb_chinh['id'] . "' AND id_chidan IS NOT NULL AND hienthi > 0 AND type = 'van-ban'");
                                    // var_dump($all_sp_thuoc_chinh);
                                    $id_chidan_unique = [];
                                    foreach ($all_sp_thuoc_chinh as $item) {
                                        if ($item['id_chidan']) {
                                            $ids = explode(',', $item['id_chidan']);
                                            foreach ($ids as $id) {
                                                if (!in_array($id, $id_chidan_unique)) {
                                                    $id_chidan_unique[] = $id;
                                                }
                                            }
                                        }
                                    }
                                    if ($id_chidan_unique) {
                                        foreach ($id_chidan_unique as $chidan) {
                                            $product_dm = $d->rawQueryOne("SELECT * FROM table_product_danhmuc WHERE slugvi = '$chidan' AND hienthi > 0 AND type = 'van-ban'");
                                            $product_pro = $d->rawQueryOne("SELECT * FROM table_product WHERE slugvi = '$chidan' AND hienthi > 0 AND type = 'van-ban'");
                                            if ($product_dm) {
                                                $products = $product_dm;
                                            }
                                            if ($product_pro) {
                                                $products = $product_pro;
                                            }
                                            if ($product_dm && $product_pro) {
                                                $products = array_merge($product_dm, $product_pro);
                                            }
                                            $id_cat = $products['id_cat'];

                                            if (!isset($products_by_cat[$id_cat])) {
                                                $products_by_cat[$id_cat] = [
                                                    'id_cat' => $id_cat,
                                                    'products' => []
                                                ];
                                            }
                                            $products_by_cat[$id_cat]['products'][] = $products['id'];
                                        }
                                    }
                                    ?>
                                    <?php if ($products_by_cat) { ?>
                                        <div class="all_vanban_lienquan">
                                            <?php foreach ($products_by_cat as $catvblienquan) {
                                                $all_vbcat_chinh = $d->rawQueryOne("select tenvi from #_product_cat where id = '" . $catvblienquan['id_cat'] . "' and hienthi>0 and type='van-ban'");
                                            ?>
                                                <div class="vanban_lienquan">
                                                    <div class="name_vanban_lienquan">
                                                        <span><?= $all_vbcat_chinh['ten' . $lang] ?> (<?= count($catvblienquan['products']) ?>)</span>
                                                        <div class="icon_vanban_lienquan"><i class="fas fa-angle-right"></i></div>
                                                    </div>
                                                    <div class="noidung_vanban_lienquan">
                                                        <?php foreach ($catvblienquan['products'] as $pro) {
                                                            $products_lq_dm = $d->rawQueryOne("SELECT tenvi, tenkhongdauvi FROM table_product_danhmuc WHERE id = '$pro' AND hienthi > 0 AND type = 'van-ban'");
                                                            $products_lq_pro = $d->rawQueryOne("SELECT tenvi, tenkhongdauvi FROM table_product WHERE id = '$pro' AND hienthi > 0 AND type = 'van-ban'");
                                                            if ($products_lq_dm) {
                                                                $products_lq = $products_lq_dm;
                                                            }
                                                            if ($products_lq_pro) {
                                                                $products_lq = $products_lq_pro;
                                                            }
                                                        ?>
                                                            <a href="<?= $products_lq['tenkhongdauvi'] ?>">
                                                                <div class="name_pro_lienquan"><?= $products_lq['ten' . $lang] ?></div>
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>
                        <?php foreach ($spcatmenu as $spc) { ?>
                            <div class="tab-pane fade" id="pills-<?= $spc['id'] ?>" role="tabpanel" aria-labelledby="pills-<?= $spc['id'] ?>-tab"><?= $spc['ten' . $lang] ?></div>
                        <?php } ?>
                    </div>
                </div>

            </div>
            <?php include LAYOUT_PATH . "layout_right.php" ?>
        </div>
    </div>
</div>