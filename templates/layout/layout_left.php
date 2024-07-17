<div class="trolyao_layout_left">
    <div class="all_trolyao_left_khung1">
        <div class="trolyao_left_khung1">
            <a class="header_logo header_logo_mobile" href="index.php" aria-label="logo"><img loading="lazy" onerror="this.src='<?= Helper::noimage() ?>';" src="<?= Helper::thumbnail_link($logo['photo']) ?>" alt="" /></a>
            <ul class="danhmuc_trolyao">
                <li>
                    <div class="danhmuc_trolyao_li" data-danhmuc="danhmuc_tracuu_vb">
                        <div class="icon_danhmuc_trolyao icon_danhmuc_trolyao_tracuu">
                            <img src="./assets/images/tracuu.png" alt="">
                        </div>
                        <div class="name_danhmuc_trolyao">
                            Tra cứu văn bản
                        </div>
                    </div>
                </li>
                <li>
                    <div class="danhmuc_trolyao_li" data-danhmuc="danhmuc_hethong_bm">
                        <div class="icon_danhmuc_trolyao">
                            <img src="./assets/images/hethong_bieumau.png" alt="">
                        </div>
                        <div class="name_danhmuc_trolyao">Hệ thống biểu mẫu</div>
                    </div>
                </li>
                <li>
                    <div class="danhmuc_trolyao_li" data-danhmuc="danhmuc_trungtam_quanly">
                        <div class="icon_danhmuc_trolyao">
                            <img src="./assets/images/hethong_bieumau.png" alt="">
                        </div>
                        <div class="name_danhmuc_trolyao">Trung tâm quản lý, chỉ đạo điều hành</div>
                    </div>
                </li>
                <li>
                    <a href="tinh-huong-phap-ly-dm">
                        <div class="danhmuc_trolyao" style="align-items: center">
                            <div class="icon_danhmuc_trolyao">
                                <img src="./assets/images/phaply.png" alt="">
                            </div>
                            <div class="name_danhmuc_trolyao">Tình huống pháp lý</div>
                        </div>
                    </a>
                </li>
                <li>
                    <div class="danhmuc_trolyao_li" data-danhmuc="phonghop_khonggiay">
                        <div class="icon_danhmuc_trolyao">
                            <img src="./assets/images/tracuu.png" alt="">
                        </div>
                        <div class="name_danhmuc_trolyao">Phòng họp không giấy</div>
                    </div>
                </li>
                <li>
                    <div class="danhmuc_trolyao_li" data-danhmuc="danhmuc_botro">
                        <div class="icon_danhmuc_trolyao">
                            <img src="./assets/images/botro.png" alt="">
                        </div>
                        <div class="name_danhmuc_trolyao">Bổ trợ</div>
                    </div>
                </li>
                
            </ul>

            <ul class="menu_cap_cha d-flex justify-content-center">
                <li class="menulicha">
                    <a>Tra cứu văn bản</a>
                    <ul class="menu_cap_con">
                        <?php foreach ($splistmenu as $spl) {
                            $count_spl = $d->rawQueryOne("select count(id) as numb from #_product_danhmuc where id_list = '" . $spl['id'] . "' and hienthi>0 and type='van-ban'");
                            $sp_danhmuc = $d->rawQuery("select * from #_product_danhmuc where id_list = '" . $spl['id'] . "' and hienthi>0 and type='van-ban' order by stt,id desc");
                        ?>
                            <li>
                                <a><span><?= $spl['ten' . $lang] ?> (<?= $count_spl['numb'] ?>)</span></a>
                                <?php if ($sp_danhmuc) { ?>
                                    <ul class="menu_cap_2 danhmuc_menu_prodanhmuc">
                                        <?php $i = 0;
                                        foreach ($sp_danhmuc as $spdm) {
                                            $i++; ?>
                                            <li>
                                                <a href="<?= $spdm['tenkhongdauvi'] ?>">
                                                    <span><?= $i ?>. <?= $spdm['ten' . $lang] ?></span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="luat-viet-nam">
                                <i class="fas fa-folder"></i>
                                <span>Luật Việt Nam</span>
                            </a>
                        </li>
                        <?php
                        $count_spl = $d->rawQueryOne("select count(id) as numb from #_product where hienthi>0 and type='van-ban-ks'");
                        $sp_danhmuc = $d->rawQuery("select * from #_product where hienthi>0 and type='van-ban-ks' order by stt,id desc");
                        ?>
                        <li>
                            <a href="van-ban-ks">
                                <i class="fas fa-chevron-right"></i>
                                <span>Văn bản của ngành kiểm sát (<?= $count_spl['numb'] ?>)</span>
                            </a>
                            <?php if ($sp_danhmuc) { ?>
                                <ul class="menu_cap_2 danhmuc_menu_prodanhmuc">
                                    <?php $i = 0;
                                    foreach ($sp_danhmuc as $spdm) {
                                        $i++; ?>
                                        <li>
                                            <div class="all_noidung_vanban_kiemsoat" data-id="<?= $spdm['id'] ?>" data-type="<?= $spdm['type'] ?>" style="padding: 0;">
                                                <span><?= $i ?>. <?= $spdm['ten' . $lang] ?></span>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                        <?php
                        $check = false;
                        if ($_COOKIE['login_user'] == 'user' && $_COOKIE['login_cap_user'] == '1') {
                            $check = true;
                        }
                        if ($_COOKIE['login_user'] == 'member') {
                            $check = true;
                        }
                        $id_donvi = $_COOKIE['login_donvi_user'];
                        if ($check == true) {
                            $count_spl = $d->rawQueryOne("select count(id) as numb from #_product where hienthi>0 and type='van-ban-nb' and id_donvi = '$id_donvi'");
                            $sp_danhmuc = $d->rawQuery("select * from #_product where hienthi>0 and type='van-ban-nb' and id_donvi = '$id_donvi' order by stt,id desc");
                        } else {
                            $count_spl = $d->rawQueryOne("select count(id) as numb from #_product where hienthi>0 and type='van-ban-nb' ");
                            $sp_danhmuc = $d->rawQuery("select * from #_product where hienthi>0 and type='van-ban-nb'  order by stt,id desc");
                        }
                        ?>
                        <li>
                            <a href="van-ban-nb">
                                <i class="fas fa-chevron-right"></i>
                                <span>Văn bản nội bộ (<?= $count_spl['numb'] ?>)</span>
                            </a>
                            <?php if ($sp_danhmuc) { ?>
                                <ul class="menu_cap_2 danhmuc_menu_prodanhmuc">
                                    <?php $i = 0;
                                    foreach ($sp_danhmuc as $spdm) {
                                        $i++; ?>
                                        <li>
                                            <div class="all_noidung_vanban_kiemsoat" data-id="<?= $spdm['id'] ?>" data-type="<?= $spdm['type'] ?>" style="padding: 0;">
                                                <span><?= $i ?>. <?= $spdm['ten' . $lang] ?></span>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                        <?php
                        $count_spl = $d->rawQueryOne("select count(id) as numb from #_product where hienthi>0 and type='van-ban-dang'");
                        $sp_danhmuc = $d->rawQuery("select * from #_product where hienthi>0 and type='van-ban-dang' order by stt,id desc");
                        ?>
                        <li>
                            <a href="van-ban-dang">
                                <i class="fas fa-chevron-right"></i>
                                <span>Văn bản của đảng (<?= $count_spl['numb'] ?>)</span>
                            </a>
                            <?php if ($sp_danhmuc) { ?>
                                <ul class="menu_cap_2 danhmuc_menu_prodanhmuc">
                                    <?php $i = 0;
                                    foreach ($sp_danhmuc as $spdm) {
                                        $i++; ?>
                                        <li>
                                            <div class="all_noidung_vanban_kiemsoat" data-id="<?= $spdm['id'] ?>" data-type="<?= $spdm['type'] ?>" style="padding: 0;">
                                                <span><?= $i ?>. <?= $spdm['ten' . $lang] ?></span>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    </ul>
                </li>
                <li class="menulicha">
                    <a>Hệ thống biểu mẫu</a>
                    <ul class="menu_cap_con">
                        <?php
                        $list_hethongbieumau = $d->rawQuery("select * from #_product_list where hienthi>0 and type='he-thong-bieu-mau' order by stt,id desc");
                        foreach ($list_hethongbieumau as $spl) {
                            $count_spl = $d->rawQueryOne("select count(id) as numb from #_product where id_list = '" . $spl['id'] . "' and hienthi>0 and type='he-thong-bieu-mau'");
                            $sp_danhmuc = $d->rawQuery("select * from #_product where id_list = '" . $spl['id'] . "' and hienthi>0 and type='he-thong-bieu-mau' order by stt,id desc");
                        ?>
                            <li>
                                <a href="<?= $spl['tenkhongdauvi'] ?>">
                                    <i class="fas fa-folder"></i>
                                    <span><?= $spl['ten' . $lang] ?> (<?= $count_spl['numb'] ?>)</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="menulicha">
                    <a>Trung tâm quản lý, chỉ đạo điều hành</a>
                    <?php
                    $check = false;
                    if ($_COOKIE['login_user'] == 'user' && $_COOKIE['login_cap_user'] == '1') {
                        $check = true;
                    }
                    if ($_COOKIE['login_user'] == 'member') {
                        $check = true;
                    }

                    $list_trungtamquanly = $d->rawQuery("select * from #_news where hienthi>0 and type='trungtam_quanly' order by stt,id desc");
                    $id_donvi = $_COOKIE['login_donvi_user'];
                    ?>
                    <ul class="menu_cap_con">

                        <?php if ($check == true) { ?>
                            <?php
                            $ct_trungtamquanly = $d->rawQueryOne("select count(id) as numb from #_news where type='trungtam_quanly' and id_donvi = '$id_donvi' and hienthi>0");
                            if ($ct_trungtamquanly > 0) {
                                foreach ($list_trungtamquanly as $spl) {
                                    if ($spl['id_donvi'] == $id_donvi) {
                            ?>
                                        <li>
                                            <a href="<?= $spl['tenkhongdauvi'] ?>">
                                                <i class="fas fa-folder"></i>
                                                <span><?= $spl['ten' . $lang] ?></span>
                                            </a>
                                        </li>
                            <?php }
                                }
                            } ?>
                        <?php } else { ?>
                            <?php
                            foreach ($list_trungtamquanly as $spl) {
                            ?>
                                <li>
                                    <a href="<?= $spl['tenkhongdauvi'] ?>">
                                        <i class="fas fa-folder"></i>
                                        <span><?= $spl['ten' . $lang] ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </li>
                <li class="menulicha">
                    <a href="tinh-huong-phap-ly-dm">Tình huống pháp lý</a>
                </li>
                <li class="menulicha">
                    <a>Phòng họp không giấy</a>
                    <ul class="menu_cap_con">
                        <?php
                        $list_hethongbieumau = $d->rawQuery("select * from #_product_list where hienthi>0 and type='phonghop-khonggiay' order by stt,id desc");
                        foreach ($list_hethongbieumau as $spl) {
                            $count_spl = $d->rawQueryOne("select count(id) as numb from #_product where id_list = '" . $spl['id'] . "' and hienthi>0 and type='phonghop-khonggiay'");
                            $sp_danhmuc = $d->rawQuery("select * from #_product where id_list = '" . $spl['id'] . "' and hienthi>0 and type='phonghop-khonggiay' order by stt,id desc");
                        ?>
                            <li>
                                <a href="<?= $spl['tenkhongdauvi'] ?>">
                                    <i class="fas fa-folder"></i>
                                    <span><?= $spl['ten' . $lang] ?> (<?= $count_spl['numb'] ?>)</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="menulicha">
                    <a>Bổ trợ</a>
                    <ul class="menu_cap_con">
                        <li>
                            <a href="ra-soat-chinh-ta">
                                <i class="fas fa-folder"></i>
                                <span>Rà soát chính tả</span>
                            </a>
                        </li>
                        <li>
                            <a href="ma-hoa-tai-lieu" target="_blank">
                                <i class="fas fa-folder"></i>
                                <span>Mã hóa tài liệu</span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <i class="fas fa-chevron-right"></i>
                                <span>Lấy số văn bản</span>
                            </a>
                            <?php
                            $login_index = $_SESSION['login_index'];
                            $encoded_login_index = base64_encode(json_encode($login_index));
                            ?>
                            <ul class="menu_cap_2 danhmuc_menu_prodanhmuc">
                                <li>
                                    <a href="https://vksquangninh.gov.vn/laysovanban/vkstinh/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                        <span>1. Viện kiểm sát Tỉnh</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://vksquangninh.gov.vn/laysovanban/vksvandon/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                        <span>2. Viện kiểm sát Vân Đồn</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://vksquangninh.gov.vn/laysovanban/vkstienyen/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                        <span>3. Viện kiểm sát Tiên Yên</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://vksquangninh.gov.vn/laysovanban/vksmongcai/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                        <span>4. Viện kiểm sát Móng Cái</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://vksquangninh.gov.vn/laysovanban/vkscampha/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                        <span>5. Viện kiểm sát Cẩm Phả</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://vksquangninh.gov.vn/laysovanban/vkshalong/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                        <span>6. Viện kiểm sát Hạ Long</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://vksquangninh.gov.vn/laysovanban/vkshaiha/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                        <span>7. Viện kiểm sát Hải Hà</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://vksquangninh.gov.vn/laysovanban/vksuongbi/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                        <span>8. Viện kiểm sát Uông Bí</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://vksquangninh.gov.vn/laysovanban/vksdamha/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                        <span>9. Viện kiểm sát Đầm Hà</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://vksquangninh.gov.vn/laysovanban/vksbache/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                        <span>10. Viện kiểm sát Ba Chẽ</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://vksquangninh.gov.vn/laysovanban/vkscoto/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                        <span>11. Viện kiểm sát Cô Tô</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://vksquangninh.gov.vn/laysovanban/vksquangyen/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                        <span>12. Viện kiểm sát Quảng Yên</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://vksquangninh.gov.vn/laysovanban/vksdongtrieu/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                        <span>13. Viện kiểm sát Đông Triều</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://vksquangninh.gov.vn/laysovanban/vksbinhlieu/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                        <span>14. Viện kiểm sát Bình Liêu</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>
                
                <li class="menulicha">
                    <a href="logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="danhmuc_trolyao_con danhmuc_tracuu_vb">
            <ul>
                <?php foreach ($splistmenu as $spl) {
                    $count_spl = $d->rawQueryOne("select count(id) as numb from #_product_danhmuc where id_list = '" . $spl['id'] . "' and hienthi>0 and type='van-ban'");
                    $sp_danhmuc = $d->rawQuery("select * from #_product_danhmuc where id_list = '" . $spl['id'] . "' and hienthi>0 and type='van-ban' order by stt,id desc");
                ?>
                    <li>
                        <div class="grid_danhmucmenu_prolist">
                            <div class="danhmuc_menu_prolist">
                                <i class="fas fa-folder"></i>
                                <span><?= $spl['ten' . $lang] ?> (<?= $count_spl['numb'] ?>)</span>
                            </div>
                            <div class="danhmuc_menu_prolist">
                                <i class="fas fa-sort-down"></i>
                            </div>
                        </div>
                        <?php if ($sp_danhmuc) { ?>
                            <ul class="danhmuc_menu_prodanhmuc">
                                <?php $i = 0;
                                foreach ($sp_danhmuc as $spdm) {
                                    $i++; ?>
                                    <li>
                                        <a href="<?= $spdm['tenkhongdauvi'] ?>">
                                            <span><?= $i ?>. <?= $spdm['ten' . $lang] ?></span>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
                <li>
                    <div class="grid_danhmucmenu_prolist">
                        <a href="luat-viet-nam">
                            <i class="fas fa-folder"></i>
                            <span>Luật Việt Nam</span>
                        </a>
                        <div class="danhmuc_menu_prolist">
                            <i class="fas fa-sort-down"></i>
                        </div>
                    </div>
                </li>

                <?php
                $count_spl = $d->rawQueryOne("select count(id) as numb from #_product where hienthi>0 and type='van-ban-ks'");
                $sp_danhmuc = $d->rawQuery("select * from #_product where hienthi>0 and type='van-ban-ks' order by stt,id desc");
                ?>
                <li>

                    <div class="grid_danhmucmenu_prolist">
                        <!-- <div class="danhmuc_menu_prolist"> -->
                        <a href="van-ban-ks">
                            <i class="fas fa-folder"></i>
                            <span>Văn bản của ngành kiểm sát (<?= $count_spl['numb'] ?>)</span>
                        </a>
                        <div class="danhmuc_menu_prolist">
                            <i class="fas fa-sort-down"></i>
                        </div>
                    </div>

                    <?php if ($sp_danhmuc) { ?>
                        <ul class="danhmuc_menu_prodanhmuc">
                            <?php $i = 0;
                            foreach ($sp_danhmuc as $spdm) {
                                $i++; ?>
                                <li>
                                    <div class="all_noidung_vanban_kiemsoat" data-id="<?= $spdm['id'] ?>" data-type="<?= $spdm['type'] ?>" style="padding: 0;">
                                        <span><?= $i ?>. <?= $spdm['ten' . $lang] ?></span>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </li>
                <?php
                $check = false;
                if ($_COOKIE['login_user'] == 'user' && $_COOKIE['login_cap_user'] == '1') {
                    $check = true;
                }
                if ($_COOKIE['login_user'] == 'member') {
                    $check = true;
                }
                $id_donvi = $_COOKIE['login_donvi_user'];
                // var_dump($check);
                if ($check == true) {
                    $count_spl = $d->rawQueryOne("select count(id) as numb from #_product where hienthi>0 and type='van-ban-nb' and id_donvi = '$id_donvi'");
                    $sp_danhmuc = $d->rawQuery("select * from #_product where hienthi>0 and type='van-ban-nb' and id_donvi = '$id_donvi' order by stt,id desc");
                } else {
                    $count_spl = $d->rawQueryOne("select count(id) as numb from #_product where hienthi>0 and type='van-ban-nb'");
                    $sp_danhmuc = $d->rawQuery("select * from #_product where hienthi>0 and type='van-ban-nb' order by stt,id desc");
                }
                ?>
                <li>
                    <div class="grid_danhmucmenu_prolist">
                        <!-- <div class="danhmuc_menu_prolist"> -->
                        <a href="van-ban-nb">
                            <i class="fas fa-folder"></i>
                            <span>Văn bản nội bộ (<?= $count_spl['numb'] ?>)</span>
                        </a>
                        <div class="danhmuc_menu_prolist">
                            <i class="fas fa-sort-down"></i>
                        </div>
                    </div>

                    <?php if ($sp_danhmuc) { ?>
                        <ul class="danhmuc_menu_prodanhmuc">
                            <?php $i = 0;
                            foreach ($sp_danhmuc as $spdm) {
                                $i++; ?>
                                <li>
                                    <div class="all_noidung_vanban_kiemsoat" data-id="<?= $spdm['id'] ?>" data-type="<?= $spdm['type'] ?>" style="padding: 0;">
                                        <span><?= $i ?>. <?= $spdm['ten' . $lang] ?></span>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </li>
                <?php
                $count_spl = $d->rawQueryOne("select count(id) as numb from #_product where hienthi>0 and type='van-ban-dang'");
                $sp_danhmuc = $d->rawQuery("select * from #_product where hienthi>0 and type='van-ban-dang' order by stt,id desc");
                ?>
                <li>

                    <div class="grid_danhmucmenu_prolist">
                        <!-- <div class="danhmuc_menu_prolist"> -->
                        <a href="van-ban-dang">
                            <i class="fas fa-folder"></i>
                            <span>Văn bản của đảng (<?= $count_spl['numb'] ?>)</span>
                        </a>
                        <div class="danhmuc_menu_prolist">
                            <i class="fas fa-sort-down"></i>
                        </div>
                    </div>

                    <?php if ($sp_danhmuc) { ?>
                        <ul class="danhmuc_menu_prodanhmuc">
                            <?php $i = 0;
                            foreach ($sp_danhmuc as $spdm) {
                                $i++; ?>
                                <li>
                                    <div class="all_noidung_vanban_kiemsoat" data-id="<?= $spdm['id'] ?>" data-type="<?= $spdm['type'] ?>" style="padding: 0;">
                                        <span><?= $i ?>. <?= $spdm['ten' . $lang] ?></span>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </li>
                <img src="./assets/images/left.png" alt="" class="close_danhmuc_menu_prodanhmuc">
            </ul>
        </div>
        <div class="danhmuc_trolyao_con danhmuc_hethong_bm">
            <ul>
                <?php
                $list_hethongbieumau = $d->rawQuery("select * from #_product_list where hienthi>0 and type='he-thong-bieu-mau' order by stt,id desc");
                foreach ($list_hethongbieumau as $spl) {
                    $count_spl = $d->rawQueryOne("select count(id) as numb from #_product where id_list = '" . $spl['id'] . "' and hienthi>0 and type='he-thong-bieu-mau'");
                    $sp_danhmuc = $d->rawQuery("select * from #_product where id_list = '" . $spl['id'] . "' and hienthi>0 and type='he-thong-bieu-mau' order by stt,id desc");
                ?>
                    <li>
                        <div class="grid_danhmucmenu_prolist">
                            <a href="<?= $spl['tenkhongdauvi'] ?>">
                                <i class="fas fa-folder"></i>
                                <span><?= $spl['ten' . $lang] ?> (<?= $count_spl['numb'] ?>)</span>
                            </a>
                            <div class="danhmuc_menu_prolist">
                                <i class="fas fa-sort-down"></i>
                            </div>
                        </div>
                        <?php if ($sp_danhmuc) { ?>
                            <ul class="danhmuc_menu_prodanhmuc">
                                <?php $i = 0;
                                foreach ($sp_danhmuc as $spdm) {
                                    $i++; ?>
                                    <li>
                                        <div class="all_noidung_vanban_kiemsoat" data-id="<?= $spdm['id'] ?>" data-type="<?= $spdm['type'] ?>" style="padding: 0;">
                                            <span><?= $i ?>. <?= $spdm['ten' . $lang] ?></span>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>

                <img src="./assets/images/left.png" alt="" class="close_danhmuc_menu_prodanhmuc">
            </ul>
        </div>
        <div class="danhmuc_trolyao_con phonghop_khonggiay">
            <ul>
                <?php
                $list_hethongbieumau = $d->rawQuery("select * from #_product_list where hienthi>0 and type='phonghop-khonggiay' order by stt,id desc");
                foreach ($list_hethongbieumau as $spl) {
                    $count_spl = $d->rawQueryOne("select count(id) as numb from #_product where id_list = '" . $spl['id'] . "' and hienthi>0 and type='phonghop-khonggiay'");
                    $sp_danhmuc = $d->rawQuery("select * from #_product where id_list = '" . $spl['id'] . "' and hienthi>0 and type='phonghop-khonggiay' order by stt,id desc");
                ?>
                    <li>
                        <div class="grid_danhmucmenu_prolist">
                            <a href="<?= $spl['tenkhongdauvi'] ?>">
                                <i class="fas fa-folder"></i>
                                <span><?= $spl['ten' . $lang] ?> (<?= $count_spl['numb'] ?>)</span>
                            </a>
                            <div class="danhmuc_menu_prolist">
                                <i class="fas fa-sort-down"></i>
                            </div>
                        </div>
                        <?php if ($sp_danhmuc) { ?>
                            <ul class="danhmuc_menu_prodanhmuc">
                                <?php $i = 0;
                                foreach ($sp_danhmuc as $spdm) {
                                    $i++; ?>
                                    <li>
                                        <div class="all_noidung_vanban_kiemsoat" data-id="<?= $spdm['id'] ?>" data-type="<?= $spdm['type'] ?>" style="padding: 0;">
                                            <span><?= $i ?>. <?= $spdm['ten' . $lang] ?></span>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>

                <img src="./assets/images/left.png" alt="" class="close_danhmuc_menu_prodanhmuc">
            </ul>
        </div>
        <div class="danhmuc_trolyao_con danhmuc_trungtam_quanly">
            <ul>
                <?php
                $check = false;
                if ($_COOKIE['login_user'] == 'user' && $_COOKIE['login_cap_user'] == '1') {
                    $check = true;
                }
                if ($_COOKIE['login_user'] == 'member') {
                    $check = true;
                }

                // var_dump("select * from #_news where hienthi>0 and type='trungtam_quanly' and id_donvi = '$id_donvi' order by stt,id desc");
                $id_donvi = $_COOKIE['login_donvi_user'];
                ?>
                <?php if ($check == true) { ?>
                    <?php
                    $list_trungtamquanly = $d->rawQuery("select * from #_news where hienthi>0 and type='trungtam_quanly' and id_donvi = '$id_donvi' order by stt,id desc");
                    $ct_trungtamquanly = $d->rawQueryOne("select count(id) as numb from #_news where type='trungtam_quanly' and id_donvi = '$id_donvi' and hienthi>0");
                    if ($ct_trungtamquanly > 0) {
                        foreach ($list_trungtamquanly as $spl) {
                            // var_dump($id_donvi);
                            // var_dump($spl['id_donvi']);
                    ?>
                            <li>
                                <div class="grid_danhmucmenu_prolist">
                                    <a href="<?= $spl['tenkhongdauvi'] ?>">
                                        <i class="fas fa-folder"></i>
                                        <span><?= $spl['ten' . $lang] ?></span>
                                    </a>
                                </div>
                            </li>
                    <?php
                        }
                    } ?>
                <?php } else { ?>
                    <?php
                    $list_trungtamquanly = $d->rawQuery("select * from #_news where hienthi>0 and type='trungtam_quanly' order by stt,id desc");
                    foreach ($list_trungtamquanly as $spl) {
                    ?>
                        <li>
                            <div class="grid_danhmucmenu_prolist">
                                <a href="<?= $spl['tenkhongdauvi'] ?>">
                                    <i class="fas fa-folder"></i>
                                    <span><?= $spl['ten' . $lang] ?></span>
                                </a>
                            </div>
                        </li>
                    <?php } ?>
                <?php } ?>

                <img src="./assets/images/left.png" alt="" class="close_danhmuc_menu_prodanhmuc">
            </ul>
        </div>
        <div class="danhmuc_trolyao_con danhmuc_tinhhuong_phaply">
            <ul>
                <?php
                $list_hethongbieumau = $d->rawQuery("select * from #_product_list where hienthi>0 and type='tinh-huong-phap-ly' order by stt,id desc");
                foreach ($list_hethongbieumau as $spl) {
                    $count_spl = $d->rawQueryOne("select count(id) as numb from #_product where id_list = '" . $spl['id'] . "' and hienthi>0 and type='tinh-huong-phap-ly'");
                    $sp_danhmuc = $d->rawQuery("select * from #_product where id_list = '" . $spl['id'] . "' and hienthi>0 and type='tinh-huong-phap-ly' order by stt,id desc");
                ?>
                    <li>
                        <div class="grid_danhmucmenu_prolist">
                            <a href="<?= $spl['tenkhongdauvi'] ?>">
                                <i class="fas fa-folder"></i>
                                <span><?= $spl['ten' . $lang] ?> (<?= $count_spl['numb'] ?>)</span>
                            </a>
                            <div class="danhmuc_menu_prolist">
                                <i class="fas fa-sort-down"></i>
                            </div>
                        </div>
                        <?php if ($sp_danhmuc) { ?>
                            <ul class="danhmuc_menu_prodanhmuc">
                                <?php $i = 0;
                                foreach ($sp_danhmuc as $spdm) {
                                    $i++; ?>
                                    <li>
                                        <a href="<?= $spdm['tenkhongdauvi'] ?>">
                                            <span><?= $i ?>. <?= $spdm['ten' . $lang] ?></span>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
                <img src="./assets/images/left.png" alt="" class="close_danhmuc_menu_prodanhmuc">
            </ul>
        </div>
        <div class="danhmuc_trolyao_con danhmuc_botro">
            <ul>
                <li>
                    <div class="grid_danhmucmenu_prolist">
                        <a href="ra-soat-chinh-ta">
                            <i class="fas fa-folder"></i>
                            <span>Rà soát chính tả</span>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="grid_danhmucmenu_prolist">
                        <a href="ma-hoa-tai-lieu" target="_blank">
                            <i class="fas fa-folder"></i>
                            <span>Mã hóa tài liệu</span>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="grid_danhmucmenu_prolist">
                        <div class="danhmuc_menu_prolist">
                            <i class="fas fa-folder"></i>
                            <span>Lấy số văn bản</span>
                        </div>
                        <div class="danhmuc_menu_prolist">
                            <i class="fas fa-sort-down"></i>
                        </div>
                    </div>
                    <?php
                    $login_index = $_SESSION['login_index'];
                    $encoded_login_index = base64_encode(json_encode($login_index));
                    ?>
                    <ul class="danhmuc_menu_prodanhmuc">
                        <li>
                            <a href="https://vksquangninh.gov.vn/laysovanban/vkstinh/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                <span>1. Viện kiểm sát Tỉnh</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://vksquangninh.gov.vn/laysovanban/vksvandon/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                <span>2. Viện kiểm sát Vân Đồn</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://vksquangninh.gov.vn/laysovanban/vkstienyen/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                <span>3. Viện kiểm sát Tiên Yên</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://vksquangninh.gov.vn/laysovanban/vksmongcai/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                <span>4. Viện kiểm sát Móng Cái</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://vksquangninh.gov.vn/laysovanban/vkscampha/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                <span>5. Viện kiểm sát Cẩm Phả</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://vksquangninh.gov.vn/laysovanban/vkshalong/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                <span>6. Viện kiểm sát Hạ Long</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://vksquangninh.gov.vn/laysovanban/vkshaiha/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                <span>7. Viện kiểm sát Hải Hà</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://vksquangninh.gov.vn/laysovanban/vksuongbi/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                <span>8. Viện kiểm sát Uông Bí</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://vksquangninh.gov.vn/laysovanban/vksdamha/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                <span>9. Viện kiểm sát Đầm Hà</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://vksquangninh.gov.vn/laysovanban/vksbache/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                <span>10. Viện kiểm sát Ba Chẽ</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://vksquangninh.gov.vn/laysovanban/vkscoto/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                <span>11. Viện kiểm sát Cô Tô</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://vksquangninh.gov.vn/laysovanban/vksquangyen/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                <span>12. Viện kiểm sát Quảng Yên</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://vksquangninh.gov.vn/laysovanban/vksdongtrieu/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                <span>13. Viện kiểm sát Đông Triều</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://vksquangninh.gov.vn/laysovanban/vksbinhlieu/?login_index=<?= $encoded_login_index ?>" target="_blank">
                                <span>14. Viện kiểm sát Bình Liêu</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <img src="./assets/images/left.png" alt="" class="close_danhmuc_menu_prodanhmuc">
            </ul>
        </div>
    </div>
</div>