<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Kiểm tra cờ đã đăng nhập trong localStorage
        if (localStorage.getItem('userGptIn') === 'true') {
            var audio = document.getElementById('myAudiogpt');
            // Phát âm thanh khi đã đăng nhập
            audio.play().catch(function(error) {
                console.log('Autoplay was prevented:', error);
            });
            // Xóa cờ đã đăng nhập sau khi phát âm thanh
            localStorage.removeItem('userGptIn');
        }
    });
</script>

<audio id="myAudiogpt">
    <source src="./assets/images/tktk.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
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
                            </?php foreach ($spcatmenu as $spc) { ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-<?= $spc['id'] ?>-tab" data-toggle="pill" data-target="#pills-<?= $spc['id'] ?>" type="button" role="tab" aria-controls="pills-<?= $spc['id'] ?>" aria-selected="true"><?= $spc['ten' . $lang] ?></button>
                                </li>
                            </?php } ?>
                        </ul> -->
                        <div class="all_frm_timkiem">
                            <div class="frm_timkiem">
                                <div class="icon_search"><i class="far fa-search"></i></div>
                                <input type="text" class="input" id="keyword" placeholder="Nhập từ khóa ..." onkeypress="doEnter(event,'keyword');" value="<?= $tukhoa2 ?>">
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
                    <?php
                    // var_dump($count_tong);
                    if ($count_sanpham_all > 0 || $count_sanpham_danhmuc_all['numb'] > 0) {
                    ?>
                        <div class="tab-content all_trolyao_layout_center_center_scroll" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                            <span>Văn bản pháp luật</span>
                                            <?php if ($count_sanpham_vanban['numb'] > 0) { ?>
                                                <span>(<?= $count_sanpham_vanban['numb'] ?>)</span>
                                            <?php } else { ?>
                                                <span>(<?= $count_sanpham_danhmuc_all['numb'] ?>)</span>
                                            <?php } ?>
                                        </button>
                                    </li>
                                    <?php if ($count_sanpham_vanbanks['numb'] > 0) { ?>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="vbks-tab" data-toggle="tab" data-target="#vbks" type="button" role="tab" aria-controls="vbks" aria-selected="false">
                                                <span>Văn bản kiểm sát</span>
                                                <span>(<?= $count_sanpham_vanbanks['numb'] ?>)</span>
                                            </button>
                                        </li>
                                    <?php } ?>
                                    <?php if ($count_sanpham_vanbandang['numb'] > 0) { ?>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="vbdang-tab" data-toggle="tab" data-target="#vbdang" type="button" role="tab" aria-controls="vbdang" aria-selected="false">
                                                <span>Văn bản của đảng</span>
                                                <span>(<?= $count_sanpham_vanbandang['numb'] ?>)</span>
                                            </button>
                                        </li>
                                    <?php } ?>
                                    <?php if ($count_sanpham_hethongbieumau['numb'] > 0) { ?>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="hethongbieumau-tab" data-toggle="tab" data-target="#hethongbieumau" type="button" role="tab" aria-controls="hethongbieumau" aria-selected="false">
                                                <span>Hệ thống biểu mẫu</span>
                                                <span>(<?= $count_sanpham_hethongbieumau['numb'] ?>)</span>
                                            </button>
                                        </li>
                                    <?php } ?>
                                    <?php if ($count_sanpham_tinhhuongphaply['numb'] > 0) { ?>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="tinhhuongphaply-tab" data-toggle="tab" data-target="#tinhhuongphaply" type="button" role="tab" aria-controls="tinhhuongphaply" aria-selected="false">
                                                <span>Tình huống pháp lý</span>
                                                <span>(<?= $count_sanpham_tinhhuongphaply['numb'] ?>)</span>
                                            </button>
                                        </li>
                                    <?php } ?>
                                    <?php foreach ($spcatmenu as $spc) {
                                        $count_sanpham = $d->rawQueryOne("select count(id) as numb from #_product where id_cat = '" . $spc['id'] . "' $where and hienthi>0 and type='van-ban'");
                                        if ($count_sanpham['numb'] > 0) {
                                    ?>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="<?= $spc['id'] ?>-tab" data-toggle="tab" data-target="#<?= $spc['id'] ?>" type="button" role="tab" aria-controls="<?= $spc['id'] ?>" aria-selected="false">
                                                    <span><?= $spc['ten' . $lang] ?></span>
                                                    <span>(<?= $count_sanpham['numb'] ?>)</span>
                                                </button>
                                            </li>
                                    <?php }
                                    } ?>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" href="https://congbobanan.toaan.gov.vn/" target="_blank" style="color: #000;">
                                            <span>Bản án</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content" style="padding-top: 10px;">
                                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <?php
                                        $all_danhmuc_sanpham = $d->rawQuery("select * from #_product_danhmuc where hienthi>0 and type='van-ban' order by stt,id desc");

                                        $mang_dm_sp = [];
                                        foreach ($all_danhmuc_sanpham as $danhmuc_sp) {
                                            $all_spthuocdm = $d->rawQuery("select * from #_product where  id_danhmuc = '" . $danhmuc_sp['id'] . "' $where and hienthi>0 and type='van-ban'");
                                            if ($all_spthuocdm) {
                                                $mang_dm_sp[] = $all_spthuocdm;
                                            }
                                        }
                                        if (count($mang_dm_sp) > 0) {

                                            foreach ($all_danhmuc_sanpham as $danhmuc_sp) {
                                                $all_spthuocdm = $d->rawQuery("select * from #_product where  id_danhmuc = '" . $danhmuc_sp['id'] . "' $where and hienthi>0 and type='van-ban'");
                                                if (!empty($all_spthuocdm)) {
                                        ?>
                                                    <div class="all_block-view-all">
                                                        <div class="block-view-all">
                                                            <a href="<?= $danhmuc_sp['tenkhongdauvi'] ?>">
                                                                <div class="name_danhmuc"><?= $func->highlightKeyword($danhmuc_sp['ten' . $lang], $tukhoa2) ?></div>
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
                                            <?php
                                            }
                                        } else { ?>
                                            <?php
                                            $all_danhmuc_sanpham = $d->rawQuery("select * from #_product_danhmuc where hienthi>0 and type='van-ban' $where order by stt,id desc");
                                            foreach ($all_danhmuc_sanpham as $danhmuc_sp) {
                                            ?>
                                                <div class="all_block-view-all">
                                                    <div class="block-view-all">
                                                        <a href="<?= $danhmuc_sp['tenkhongdauvi'] ?>">
                                                            <div class="name_danhmuc"><?= $func->highlightKeyword($danhmuc_sp['ten' . $lang], $tukhoa2) ?></div>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        <?php } ?>

                                    </div>
                                    <div class="tab-pane" id="vbks" role="tabpanel" aria-labelledby="vbks-tab">
                                        <div class="paging-vks" data-keyword="<?= $tukhoa2 ?>"></div>
                                    </div>
                                    <div class="tab-pane" id="vbdang" role="tabpanel" aria-labelledby="vbdang-tab">
                                        <div class="paging-vbdang" data-keyword="<?= $tukhoa2 ?>"></div>
                                    </div>
                                    <div class="tab-pane" id="hethongbieumau" role="tabpanel" aria-labelledby="hethongbieumau-tab">
                                        <div class="paging-htbm" data-keyword="<?= $tukhoa2 ?>"></div>
                                    </div>
                                    <div class="tab-pane" id="tinhhuongphaply" role="tabpanel" aria-labelledby="tinhhuongphaply-tab">
                                        <div class="paging-thpl" data-keyword="<?= $tukhoa2 ?>"></div>
                                    </div>
                                    <?php foreach ($spcatmenu as $spc) { ?>
                                        <div class="tab-pane" id="<?= $spc['id'] ?>" role="tabpanel" aria-labelledby="<?= $spc['id'] ?>-tab">
                                            <?php
                                            $all_danhmuc_sanpham = $d->rawQuery("select * from #_product_danhmuc where id_cat = '" . $spc['id'] . "' and hienthi>0 and type='van-ban'");
                                            $all_iddanhmuc_sanpham = $d->rawQuery("select DISTINCT id_danhmuc from #_product WHERE id_cat = '" . $spc['id'] . "'");
                                            // var_dump("select * from #_product_danhmuc where id = '".$spc['id']."' and hienthi>0 and type='van-ban'");
                                            if ($all_danhmuc_sanpham) {
                                                foreach ($all_danhmuc_sanpham as $danhmuc_sp) {
                                                    // var_dump($danhmuc_sp);
                                                    $all_spthuocdm = $d->rawQuery("select * from #_product where  id_danhmuc = '" . $danhmuc_sp['id'] . "' $where and hienthi>0  and type='van-ban'");
                                                    if ($all_spthuocdm) {
                                            ?>
                                                        <div class="all_block-view-all">
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
                                                        <?php
                                                    }
                                                }
                                            } else {
                                                if ($all_iddanhmuc_sanpham) {
                                                    foreach ($all_iddanhmuc_sanpham as $dmsp) {
                                                        $danhmuc_sp = $d->rawQueryOne("select tenkhongdauvi,tenvi,id from #_product_danhmuc where id = '" . $dmsp['id_danhmuc'] . "' and hienthi>0  and type='van-ban'");
                                                        $all_pro_sanpham = $d->rawQuery("select * from #_product where  id_danhmuc = '" . $dmsp['id_danhmuc'] . "' and id_cat = '" . $spc['id'] . "' $where and hienthi>0  and type='van-ban'");
                                                        if ($all_pro_sanpham) {
                                                        ?>
                                                            <div class="all_block-view-all">
                                                                <div class="block-view-all">
                                                                    <a href="<?= $danhmuc_sp['tenkhongdauvi'] ?>">
                                                                        <div class="name_danhmuc"><?= $danhmuc_sp['ten' . $lang] ?></div>
                                                                    </a>
                                                                    <div class="all_dieu">
                                                                        <?php foreach ($all_pro_sanpham as $v) { ?>
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
                                            <?php }
                                                    }
                                                }
                                            } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>
                    <?php } else { ?>
                        <div class="all_block-view-rong">
                            <div class="ketqua_danhmuc">
                                <span>Tổng số 0 kết quả</span>
                            </div>
                            <div class="ketqua_danhmuc">
                                <span>Bạn có thể tra cứu <a href="https://www.google.com/search?q=<?= $tukhoa2 ?>" target="_blank"><?= $tukhoa2 ?></a> với Google</span>
                                <br>
                                <span>Bạn có thể tra cứu <a href="https://luatvietnam.vn/tim-van-ban.html?Keywords=<?= $tukhoa2 ?>" target="_blank"><?= $tukhoa2 ?></a> với <span style="color: #005DCB ;font-weight: 600;">LUATVIETNAM.VN</span></span>
                                <br>
                                <span>Bạn có thể tra cứu <a href="https://thuvienphapluat.vn/page/tim-van-ban.aspx?keyword=<?= $tukhoa2 ?>" target="_blank"><?= $tukhoa2 ?></a> với <span style="color: #f00 ;font-weight: 600;">THUVIENPHAPLUAT.VN</span></span>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php include LAYOUT_PATH . "layout_right.php" ?>
        </div>
    </div>
</div>