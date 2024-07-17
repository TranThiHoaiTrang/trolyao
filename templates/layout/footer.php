<div class="footer_mobile">
    <div class="boxfooter_container ">
        <div class="fixwidth">
            <div class="row">
                <div class="col-md-5 top_footer_noidung">
                    <div class="all_content_footer">
                        <!-- <a loading="lazy" class="footer_logo" href="" aria-label="logo footer"><img loading="lazy" onerror="this.src='<?= Helper::noimage() ?>';" src="<?= Helper::thumbnail_link($logo['photo']) ?>" width="420" height="135" alt=""/></a> -->
                        <div class="all_footer_text">
                            <?= htmlspecialchars_decode($footer['noidung' . $lang]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex flex-column justify-content-center">
                    <div class="title_footer">Về chúng tôi</div>
                    <div class="all_menu_footer">
                        <p><a href=""> Trang chủ</a></p>
                        <p><a href="san-pham"> Danh mục vải</a></p>
                        <p><a href="chinh-sach"> Chính sách</a></p>
                        <p><a href="blog"> Blog</a></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="title_footer"><?= $setting['ten' . $lang] ?></div>
                    <div class="title_chinhanh">Chi nhánh Thành phố Hà Nội</div>
                    <div class="all_chinhanh">
                        <div class="chinhanh">
                            <div class="chinhanh_left">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>CS1: </span>
                            </div>
                            <div class="chinhanh_right"><?= $optsetting['diachi'] ?></div>
                        </div>
                        <div class="chinhanh">
                            <div class="chinhanh_left">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>CS2: </span>
                            </div>
                            <div class="chinhanh_right"><?= $optsetting['diachi2'] ?></div>
                        </div>
                    </div>
                    <div class="title_chinhanh">Chi nhánh Thành phố Hồ Chí Minh</div>
                    <div class="all_chinhanh">
                        <div class="chinhanh">
                            <div class="chinhanh_left">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>CS3: </span>
                            </div>
                            <div class="chinhanh_right"><?= $optsetting['diachi3'] ?></div>
                        </div>
                    </div>
                    <div class="chinhanh">
                        <div class="chinhanh_left">
                            <i class="fas fa-envelope"></i>
                            <span>Email: </span>
                        </div>
                        <div class="chinhanh_right"><?= $optsetting['email'] ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hotline_footer text-align-center">
            <div class="fixwidth">
                <div class="title_hotline_footer">Hotline</div>
                <div class="all_hotline_footer">
                    <span><?= $optsetting['hotline'] ?></span>
                    <span><i class="fas fa-phone-alt"></i></span>
                    <span><?= $optsetting['dienthoai'] ?></span>
                </div>
            </div>
        </div>
        <div class="boxfooter_bottom">
            <div class="fixwidth d-flex justify-content-between">
                <div class="left ">
                    <span>Cookies</span>
                    <span>Terms and Contitions</span>
                </div>
                <div class="right">©2023. All rights reserved.</div>
            </div>
        </div>
    </div>
</div>