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
                                <input type="text" class="input" id="keyword" placeholder="Nhập từ khóa ..." onkeypress="doEnter(event,'keyword');">
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
                            <div class="all_block-view-all hide-shadow hide-border">
                                <div class="block-view-all">
                                    <?php
                                    $all_vb_chinh = $d->rawQueryOne("select * from #_product_danhmuc where id = '" . $row_detail['id_danhmuc'] . "' and hienthi>0 and type='van-ban'");
                                    $all_chuongthuoc_vb_chinh = $d->rawQueryOne("select * from #_product_danhmuc_cap where id = '" . $row_detail['id_danhmuc_cap'] . "' and hienthi>0 and type='van-ban'");
                                    ?>
                                    <div class="name_danhmuc"><?= $all_vb_chinh['ten' . $lang] ?>, Số <?= $all_vb_chinh['sohieu'] ?></div>
                                    <div class="name_danhmuc"><?= $row_detail['ten' . $lang] ?></div>
                                    <div class="all_thongtin_vb_chinh">
                                        <div class="all_noidung_vanbanchinh">
                                            <div class="all_mucluc_search_vb_chinh">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span class="muclucvanban">Vị trí:</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="noidung_vanbanchinh all_gioithieu_index">
                                                <?= $all_vb_chinh['mota' . $lang] ?>
                                                <?= $all_chuongthuoc_vb_chinh['ten' . $lang] ?>
                                                <?= $all_chuongthuoc_vb_chinh['noidung' . $lang] ?>
                                                <div class="noidung_dieu_luat"><?= $row_detail['noidung' . $lang] ?></div>
                                            </div>
                                        </div>
                                    </div>
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