<?php
$one_week_ago = time() - (7 * 24 * 3600);
$keyword_tatca = $d->rawQuery("delete from #_keyword WHERE ngaytao <= '$one_week_ago'");
$messages_gpt_tatca = $d->rawQuery("delete from #_messages_gpt WHERE ngaytao <= '$one_week_ago'");
?>
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
                        <ul class="nav nav-pills trolyao_layout_center_boloc_nav" id="pills-tab" role="tablist">
                            <?php foreach ($spcatmenu as $spc) { ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-<?= $spc['id'] ?>-tab" data-toggle="pill" data-target="#pills-<?= $spc['id'] ?>" type="button" role="tab" aria-controls="pills-<?= $spc['id'] ?>" aria-selected="true"><?= $spc['ten' . $lang] ?></button>
                                </li>
                            <?php } ?>
                        </ul>
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
                                            <div class="close_keyword" data-keyword="<?= $v['keyword'] ?>"><i class="fas fa-times"></i></div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="all_trolyao_layout_center_center">
                    <div class="tab-content all_trolyao_layout_center_center_scroll all_trolyao_layout_center_center_scroll_index" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                        <span>Văn bản mới</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tatca-tab" data-toggle="tab" data-target="#tatca" type="button" role="tab" aria-controls="tatca" aria-selected="true">
                                        <span>Tất cả</span>
                                        <?php
                                        $count_sanpham = $d->rawQueryOne("select count(id) as numb from #_product where hienthi>0 and type='van-ban'");
                                        ?>
                                        <span>(<?= $count_sanpham['numb'] ?>)</span>
                                    </button>
                                </li>
                                <?php foreach ($spcatmenu as $spc) {
                                    $count_sanpham = $d->rawQueryOne("select count(id) as numb from #_product where id_cat = '" . $spc['id'] . "' and hienthi>0 and type='van-ban'");
                                    if ($count_sanpham['numb'] > 0) {
                                ?>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="<?= $spc['id'] ?>-tab" data-toggle="tab" data-target="#<?= $spc['id'] ?>" type="button" role="tab" aria-controls="<?= $spc['id'] ?>" aria-selected="false">
                                                <span><?= $spc['ten' . $lang] ?></span>
                                                <span>(<?= $count_sanpham['numb'] ?>)</span>
                                            </button>
                                        </li>
                                        <?php } else {
                                        $count_sanpham_dm = $d->rawQueryOne("select count(id) as numb from #_product_danhmuc where id_cat = '" . $spc['id'] . "' and hienthi>0 and type='van-ban'");
                                        // var_dump("select count(id) as numb from #_product_danhmuc where id_cat = '" . $spc['id'] . "' and hienthi>0 and type='van-ban'");
                                        if ($count_sanpham_dm['numb'] > 0) {
                                        ?>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="<?= $spc['id'] ?>-tab" data-toggle="tab" data-target="#<?= $spc['id'] ?>" type="button" role="tab" aria-controls="<?= $spc['id'] ?>" aria-selected="false">
                                                    <span><?= $spc['ten' . $lang] ?></span>
                                                    <span>(<?= $count_sanpham_dm['numb'] ?>)</span>
                                                </button>
                                            </li>
                                    <?php }
                                    } ?>
                                <?php } ?>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content" style="padding-top: 10px;">
                                <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="all_vanban_kiemsoat">
                                        <div class="all_noidung_vanban_kiemsoat">
                                            <div class="stt_vanban_kiemsoat" style="font-weight: 600;">STT</div>
                                            <div class="noidung_vanban_kiemsoat" style="font-weight: 600;">Tên tài liệu</div>
                                            <div class="loai_vanban_kiemsoat" style="font-weight: 600;">Loại văn bản</div>
                                            <?php if ($deviceType != 'mobile') { ?>
                                                <div class="loai_vanban_kiemsoat" style="font-weight: 600;">Ngày tạo</div>
                                            <?php } ?>
                                        </div>
                                        <?php
                                        $loaivanban = $d->rawQuery("select * from #_product where type='van-ban-ks' and hienthi>0 order by stt,id desc limit 5");
                                        $vanbandang = $d->rawQuery("select * from #_product where type='van-ban-dang' and hienthi>0 order by stt,id desc limit 5");
                                        $hethongbieumau = $d->rawQuery("select * from #_product where type='he-thong-bieu-mau' and hienthi>0 order by stt,id desc limit 5");
                                        $i = 0;
                                        foreach ($loaivanban as $v) {
                                            $loaivanban_list = $d->rawQueryOne("select * from #_product_list where type='van-ban-ks' and id = '" . $v['id_list'] . "' and hienthi>0 order by stt,id asc");
                                            $i++;
                                        ?>
                                            <!-- <div class="all_block-view-all hide-shadow hide-border"> -->
                                            <div class="all_noidung_vanban_kiemsoat" data-id="<?= $v['id'] ?>" data-type="<?= $v['type'] ?>">
                                                <div class="stt_vanban_kiemsoat"><?= $i ?></div>
                                                <div class="noidung_vanban_kiemsoat">
                                                    <span class="vb_moi">Mới</span>
                                                    <?= $v['ten' . $lang] ?>
                                                </div>
                                                <div class="loai_vanban_kiemsoat"><?= $loaivanban_list['ten' . $lang] ?></div>
                                                <?php if ($deviceType != 'mobile') { ?>
                                                    <?php if ($v['ngaysua']) { ?>
                                                        <div class="loai_vanban_kiemsoat"><?= date("d/m/Y", $v['ngaysua']) ?></div>
                                                    <?php } else { ?>
                                                        <div class="loai_vanban_kiemsoat"><?= date("d/m/Y", $v['ngaytao']) ?></div>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <!-- </div> -->
                                        <?php } ?>
                                        <?php
                                        foreach ($vanbandang as $v) {
                                            $i++;
                                        ?>
                                            <!-- <div class="all_block-view-all hide-shadow hide-border"> -->
                                            <div class="all_noidung_vanban_kiemsoat" data-id="<?= $v['id'] ?>" data-type="<?= $v['type'] ?>">
                                                <div class="stt_vanban_kiemsoat"><?= $i ?></div>
                                                <div class="noidung_vanban_kiemsoat">
                                                    <span class="vb_moi">Mới</span>
                                                    <?= $v['ten' . $lang] ?>
                                                </div>
                                                <div class="loai_vanban_kiemsoat">Văn bản đảng</div>
                                                <?php if ($deviceType != 'mobile') { ?>
                                                    <?php if ($v['ngaysua']) { ?>
                                                        <div class="loai_vanban_kiemsoat"><?= date("d/m/Y", $v['ngaysua']) ?></div>
                                                    <?php } else { ?>
                                                        <div class="loai_vanban_kiemsoat"><?= date("d/m/Y", $v['ngaytao']) ?></div>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <!-- </div> -->
                                        <?php } ?>
                                        <?php
                                        foreach ($hethongbieumau as $v) {
                                            $loaivanban_list = $d->rawQueryOne("select * from #_product_list where type='he-thong-bieu-mau' and id = '" . $v['id_list'] . "' and hienthi>0 order by stt,id asc");
                                            $i++;
                                        ?>
                                            <!-- <div class="all_block-view-all hide-shadow hide-border"> -->
                                            <div class="all_noidung_vanban_kiemsoat" data-id="<?= $v['id'] ?>" data-type="<?= $v['type'] ?>">
                                                <div class="stt_vanban_kiemsoat"><?= $i ?></div>
                                                <div class="noidung_vanban_kiemsoat">
                                                    <span class="vb_moi">Mới</span>
                                                    <?= $v['ten' . $lang] ?>
                                                </div>
                                                <div class="loai_vanban_kiemsoat"><?= $loaivanban_list['ten' . $lang] ?></div>
                                                <?php if ($deviceType != 'mobile') { ?>
                                                    <?php if ($v['ngaysua']) { ?>
                                                        <div class="loai_vanban_kiemsoat"><?= date("d/m/Y", $v['ngaysua']) ?></div>
                                                    <?php } else { ?>
                                                        <div class="loai_vanban_kiemsoat"><?= date("d/m/Y", $v['ngaytao']) ?></div>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <!-- </div> -->
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tatca" role="tabpanel" aria-labelledby="tatca-tab">
                                    <?php
                                    $all_danhmuc_sanpham = $d->rawQuery("select * from #_product_danhmuc where hienthi>0 and noibat > 0 and type='van-ban' order by stt,id asc");
                                    foreach ($all_danhmuc_sanpham as $danhmuc_sp) {
                                        $all_spthuocdm_cap = $d->rawQuery("select * from #_product_danhmuc_cap where  id_danhmuc = '" . $danhmuc_sp['id'] . "' and hienthi>0 and type='van-ban'");
                                        // var_dump("select * from #_product where id_danhmuc = '".$danhmuc_sp['id']."' and hienthi>0 and noibat > 0 and type='van-ban'");
                                    ?>
                                        <div class="all_block-view-all">
                                            <div class="block-view-all">
                                                <a href="<?= $danhmuc_sp['tenkhongdauvi'] ?>">
                                                    <div class="name_danhmuc"><?= $danhmuc_sp['ten' . $lang] ?></div>
                                                </a>
                                                <div class="all_dieu">
                                                    <?php foreach ($all_spthuocdm_cap as $dmc) {
                                                        $all_spthuocdm = $d->rawQuery("select * from #_product where  id_danhmuc = '" . $danhmuc_sp['id'] . "' and id_danhmuc_cap = '" . $dmc['id'] . "' and hienthi>0 and noibat > 0  and type='van-ban' order by stt,id asc");
                                                        foreach ($all_spthuocdm as $v) {
                                                    ?>
                                                            <a href="<?= $v['tenkhongdauvi'] ?>">
                                                                <div class="dieu_danhmuc">
                                                                    <?= $func->sub_str($v['ten' . $lang], 50) ?>
                                                                    <span>(Xem thêm)</span>
                                                                </div>
                                                            </a>
                                                    <?php }
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <?php foreach ($spcatmenu as $spc) { ?>
                                    <div class="tab-pane" id="<?= $spc['id'] ?>" role="tabpanel" aria-labelledby="<?= $spc['id'] ?>-tab">
                                        <?php
                                        $all_danhmuc_sanpham = $d->rawQuery("select * from #_product_danhmuc where id_Cat = '" . $spc['id'] . "' and hienthi>0  and type='van-ban' order by stt,id asc");
                                        $all_iddanhmuc_sanpham = $d->rawQuery("select DISTINCT id_danhmuc from #_product WHERE id_cat = '" . $spc['id'] . "' and hienthi > 0");
                                        // var_dump($all_iddanhmuc_sanpham);
                                        if ($all_danhmuc_sanpham) {
                                            foreach ($all_danhmuc_sanpham as $danhmuc_sp) {
                                                // var_dump($danhmuc_sp);
                                                $all_spthuocdm_cap = $d->rawQuery("select * from #_product_danhmuc_cap where  id_danhmuc = '" . $danhmuc_sp['id'] . "' and hienthi>0  and type='van-ban' order by stt,id asc");

                                                // var_dump("select * from #_product where id_danhmuc = '".$danhmuc_sp['id']."' and hienthi>0 and noibat > 0 and type='van-ban'");
                                        ?>
                                                <div class="all_block-view-all">
                                                    <div class="block-view-all">
                                                        <a href="<?= $danhmuc_sp['tenkhongdauvi'] ?>">
                                                            <div class="name_danhmuc"><?= $danhmuc_sp['ten' . $lang] ?></div>
                                                        </a>
                                                        <div class="all_dieu">
                                                            <?php foreach ($all_spthuocdm_cap as $dmc) {
                                                                $all_spthuocdm = $d->rawQuery("select * from #_product where  id_danhmuc = '" . $danhmuc_sp['id'] . "' and id_danhmuc_cap = '" . $dmc['id'] . "' and hienthi>0  and type='van-ban' order by stt,id asc");
                                                                foreach ($all_spthuocdm as $v) {
                                                            ?>
                                                                    <a href="<?= $v['tenkhongdauvi'] ?>">
                                                                        <div class="dieu_danhmuc">
                                                                            <?= $func->sub_str($v['ten' . $lang], 50) ?>
                                                                            <span>(Xem thêm)</span>
                                                                        </div>
                                                                    </a>
                                                            <?php }
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            if ($all_iddanhmuc_sanpham) {
                                                foreach ($all_iddanhmuc_sanpham as $dmsp) {
                                                    $danhmuc_sp = $d->rawQueryOne("select tenkhongdauvi,tenvi,id from #_product_danhmuc where id = '" . $dmsp['id_danhmuc'] . "' and hienthi>0  and type='van-ban' order by stt,id asc");
                                                    $all_pro_sanpham = $d->rawQuery("select * from #_product where  id_danhmuc = '" . $dmsp['id_danhmuc'] . "' and id_cat = '" . $spc['id'] . "' and hienthi>0  and type='van-ban' order by stt,id asc");
                                                    if ($danhmuc_sp) {
                                                ?>
                                                        <div class="all_block-view-all">
                                                            <div class="block-view-all">
                                                                <a href="<?= $danhmuc_sp['tenkhongdauvi'] ?>">
                                                                    <div class="name_danhmuc"><?= $danhmuc_sp['ten' . $lang] ?></div>
                                                                </a>
                                                                <div class="all_dieu">
                                                                    <?php
                                                                    foreach ($all_pro_sanpham as $v) {
                                                                    ?>
                                                                        <a href="<?= $v['tenkhongdauvi'] ?>">
                                                                            <div class="dieu_danhmuc">
                                                                                <?= $func->sub_str($v['ten' . $lang], 50) ?>
                                                                                <span>(Xem thêm)</span>
                                                                            </div>
                                                                        </a>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                        <?php }
                                                }
                                            }
                                        } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php foreach ($spcatmenu as $spc) { ?>
                            <div class="tab-pane fade" id="pills-<?= $spc['id'] ?>" role="tabpanel" aria-labelledby="pills-<?= $spc['id'] ?>-tab">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                            <span>Tất cả</span>
                                            <?php
                                            $count_sanpham = $d->rawQueryOne("select count(id) as numb from #_product where id_cat = '" . $spc['id'] . "' and hienthi>0 and type='van-ban'");
                                            ?>
                                            <span>(<?= $count_sanpham['numb'] ?>)</span>
                                        </button>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content" style="padding-top: 10px;">
                                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <?php
                                        $all_danhmuc_sanpham = $d->rawQuery("select * from #_product_danhmuc where id_Cat = '" . $spc['id'] . "' and hienthi>0  and type='van-ban' order by stt,id asc");
                                        $all_iddanhmuc_sanpham = $d->rawQuery("select DISTINCT id_danhmuc from #_product WHERE id_cat = '" . $spc['id'] . "' and hienthi > 0 order by stt,id asc");
                                        // var_dump($all_iddanhmuc_sanpham);
                                        if ($all_danhmuc_sanpham) {
                                            foreach ($all_danhmuc_sanpham as $danhmuc_sp) {
                                                // var_dump($danhmuc_sp);
                                                $all_spthuocdm = $d->rawQuery("select * from #_product where  id_danhmuc = '" . $danhmuc_sp['id'] . "' and hienthi>0  and type='van-ban' order by stt,id asc");
                                                // var_dump("select * from #_product where id_danhmuc = '".$danhmuc_sp['id']."' and hienthi>0 and noibat > 0 and type='van-ban'");
                                        ?>
                                                <div class="all_block-view-all">
                                                    <div class="block-view-all">
                                                        <a href="<?= $danhmuc_sp['tenkhongdauvi'] ?>">
                                                            <div class="name_danhmuc"><?= $danhmuc_sp['ten' . $lang] ?></div>
                                                        </a>
                                                        <div class="all_dieu">
                                                            <?php foreach ($all_spthuocdm as $v) { ?>
                                                                <a href="<?= $v['tenkhongdauvi'] ?>">
                                                                    <div class="dieu_danhmuc">
                                                                        <?= $func->sub_str($v['ten' . $lang], 50) ?>
                                                                        <span>(Xem thêm)</span>
                                                                    </div>
                                                                </a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            if ($all_iddanhmuc_sanpham) {
                                                foreach ($all_iddanhmuc_sanpham as $dmsp) {
                                                    $danhmuc_sp = $d->rawQueryOne("select tenkhongdauvi,tenvi,id from #_product_danhmuc where id = '" . $dmsp['id_danhmuc'] . "' and hienthi>0  and type='van-ban' order by stt,id asc");
                                                    $all_pro_sanpham = $d->rawQuery("select * from #_product where  id_danhmuc = '" . $dmsp['id_danhmuc'] . "' and id_cat = '" . $spc['id'] . "' and hienthi>0  and type='van-ban' order by stt,id asc");
                                                    if ($danhmuc_sp) {
                                                ?>
                                                        <div class="all_block-view-all">
                                                            <div class="block-view-all">
                                                                <a href="<?= $danhmuc_sp['tenkhongdauvi'] ?>">
                                                                    <div class="name_danhmuc"><?= $danhmuc_sp['ten' . $lang] ?></div>
                                                                </a>
                                                                <div class="all_dieu">
                                                                    <?php foreach ($all_pro_sanpham as $v) { ?>
                                                                        <a href="<?= $v['tenkhongdauvi'] ?>">
                                                                            <div class="dieu_danhmuc">
                                                                                <?= $func->sub_str($v['ten' . $lang], 50) ?>
                                                                                <span>(Xem thêm)</span>
                                                                            </div>
                                                                        </a>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                        <?php }
                                                }
                                            }
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
            <?php include LAYOUT_PATH . "layout_right.php" ?>
        </div>
    </div>
</div>