<?php
$list_thpl = $d->rawQuery("select * FROM table_product_list WHERE hienthi > 0 AND type = 'tinh-huong-phap-ly'  order by stt,id asc");
// var_dump($get_page);
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
                        <div class="all_frm_timkiem">
                            <div class="frm_timkiem">
                                <div class="icon_search"><i class="far fa-search"></i></div>
                                <?php $all_vb_chinh = $d->rawQueryOne("select * from #$table_danhmuc_cacloai where id = '$id_danhmuc_cacloai' and hienthi>0 and type='tinh-huong-phap-ly'"); ?>
                                <input type="text" class="input" id="keyword_thpl" placeholder="Nhập từ khóa ..." onkeypress="doEnter_thpl(event,'keyword_thpl');" value="<?= $all_vb_chinh['ten' . $lang] ?>">
                                <div class="all_button_search">
                                <?php if ($deviceType != 'mobile') { ?>
                                        <button type="submit" value="" class="nut_tim_void" aria-label="Search"><i class="fas fa-microphone"></i></button>
                                    <?php } ?>
                                    <button type="submit" value="" class="nut_tim" aria-label="Search" onclick="onSearch_keyword_thpl('keyword_thpl');"><i class="fas fa-location-arrow"></i></button>
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
                    <div class="tab-content all_trolyao_layout_center_center_scroll all_trolyao_layout_center_scroll_vbks" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                        <span>Tất cả văn bản</span>
                                    </button>
                                </li>
                                <?php if (empty($idl)) {
                                    foreach ($list_thpl as $v) {
                                ?>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="<?= $v['id'] ?>-tab" data-toggle="tab" data-target="#<?= $v['id'] ?>" type="button" role="tab" aria-controls="<?= $v['id'] ?>" aria-selected="true">
                                                <span><?= $v['ten' . $lang] ?></span>
                                            </button>
                                        </li>
                                <?php }
                                } ?>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content" style="padding-top: 10px;">
                                <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <?php
                                    foreach ($product as $v) {
                                        $loaivanban_list = $d->rawQueryOne("select * from #_product_list where id = '" . $v['id_list'] . "' and hienthi>0 and type='$type' order by stt,id asc");
                                    ?>
                                        <div class="all_block-view-all">
                                            <div class="block-view-all">
                                                <a href="<?= $v['tenkhongdauvi'] ?>">
                                                    <span style="color: #4d5156;font-size: 14px;">Giải đáp tình huống pháp lý</span>
                                                    <div class="name_danhmuc"><?= $v['ten' . $lang] ?></div>
                                                    <div class="all_danhmuc_list"><?= $loaivanban_list['ten' . $lang] ?></div>
                                                    <div class="name_danhmuc" style="font-size: 14px;">Trả lời:</div>
                                                    <div class="all_dieu">
                                                        <div class="dieu_danhmuc">
                                                            <?= $func->sub_str($v['noidung' . $lang], 200) ?><span>(Xem thêm)</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="pagination-home"><?= (isset($paging) && $paging != '') ? $paging : '' ?></div>
                                </div>
                                <?php if (empty($idl)) {
                                    foreach ($list_thpl as $v) {
                                ?>
                                        <div class="tab-pane" id="<?= $v['id'] ?>" role="tabpanel" aria-labelledby="<?= $v['id'] ?>-tab">
                                            <?php
                                            $curPage = $get_page;
                                            $per_page = 10;
                                            $startpoint = ($curPage * $per_page) - $per_page;
                                            $limit = " limit " . $startpoint . "," . $per_page;

                                            $loaivanban = $d->rawQuery("select * from #_product where id_list = '" . $v['id'] . "' and hienthi>0 and type='tinh-huong-phap-ly' order by stt,id desc ");

                                            $sqlNum = "select count(*) as 'num' from #_product where id_list = '" . $v['id'] . "' and hienthi>0 and type='tinh-huong-phap-ly' order by stt,id desc";
                                            $count = $d->rawQueryOne($sqlNum, $params);
                                            $total = $count['num'];
                                            $url = $func->getCurrentPageURL();
                                            $paging = $func->pagination($total, $per_page, $curPage, $url);
                                            $i = 0;
                                            foreach ($loaivanban as $v) {
                                                $loaivanban_list = $d->rawQueryOne("select * from #_product_list where id = '" . $v['id_list'] . "' and hienthi>0 and type='$type' order by stt,id asc");
                                            ?>
                                                <div class="all_block-view-all">
                                                    <div class="block-view-all">
                                                        <a href="<?= $v['tenkhongdauvi'] ?>">
                                                            <span style="color: #4d5156;font-size: 14px;">Giải đáp tình huống pháp lý</span>
                                                            <div class="name_danhmuc"><?= $v['ten' . $lang] ?></div>
                                                            <div class="all_danhmuc_list"><?= $loaivanban_list['ten' . $lang] ?></div>
                                                            <div class="name_danhmuc" style="font-size: 14px;">Trả lời:</div>
                                                            <div class="all_dieu">
                                                                <div class="dieu_danhmuc">
                                                                    <?= $func->sub_str($v['noidung' . $lang], 200) ?><span>(Xem thêm)</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <!-- <div class="pagination-home"><?= (isset($paging) && $paging != '') ? $paging : '' ?></div> -->
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include LAYOUT_PATH . "layout_right.php" ?>
        </div>
    </div>
</div>