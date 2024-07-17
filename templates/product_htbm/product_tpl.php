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
                                <?php $all_vb_chinh = $d->rawQueryOne("select * from #$table_danhmuc_cacloai where id = '$id_danhmuc_cacloai' and hienthi>0 and type='van-ban-ks'"); ?>
                                <input type="text" class="input" id="keyword_hethongbieumau" placeholder="Nhập từ khóa ..." onkeypress="doEnter_hethongbieumau(event,'keyword_hethongbieumau');" value="<?= $all_vb_chinh['ten' . $lang] ?>">
                                <div class="all_button_search">
                                    <?php if ($deviceType != 'mobile') { ?>
                                        <button type="submit" value="" class="nut_tim_void" aria-label="Search"><i class="fas fa-microphone"></i></button>
                                    <?php } ?>
                                    <button type="submit" value="" class="nut_tim" aria-label="Search" onclick="onSearch_keyword_hethongbieumau('keyword_hethongbieumau');"><i class="fas fa-location-arrow"></i></button>
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
                    <div class="tab-content all_trolyao_layout_center_center_scroll all_trolyao_layout_center_scroll_vbks" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="all_vanban_kiemsoat">
                                <div class="all_noidung_vanban_kiemsoat">
                                    <div class="stt_vanban_kiemsoat" style="font-weight: 600;">STT</div>
                                    <div class="noidung_vanban_kiemsoat" style="font-weight: 600;">Tên tài liệu</div>
                                    <div class="loai_vanban_kiemsoat" style="font-weight: 600;">Xem file, Dowload</div>
                                </div>
                                <?php
                                $i = 0;
                                foreach ($product as $v) {
                                    $i++;
                                ?>
                                    <!-- <div class="all_block-view-all hide-shadow hide-border"> -->
                                    <div class="all_noidung_vanban_kiemsoat" data-id="<?= $v['id'] ?>" data-type="<?= $v['type'] ?>">
                                        <div class="stt_vanban_kiemsoat"><?= $i ?></div>
                                        <div class="noidung_vanban_kiemsoat"><?= $v['ten' . $lang] ?></div>
                                        <div class="loai_vanban_kiemsoat">
                                            <div class="xem_vb_ks">
                                                <div class="read_htbm" style="text-align: center;">
                                                    <i class="fas fa-book-reader"></i>
                                                    <!-- <span>Xem file</span> -->
                                                </div>
                                                <a href="<?= $config_base ?>admin/upload/file/<?= $v['taptin'] ?>" target="_blank">
                                                    <i class="fas fa-cloud-download-alt"></i>
                                                    <!-- <span>Dowload</span> -->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                <?php } ?>
                                <div class="pagination-home"><?= (isset($paging) && $paging != '') ? $paging : '' ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include LAYOUT_PATH . "layout_right.php" ?>
        </div>
    </div>
</div>
</div>