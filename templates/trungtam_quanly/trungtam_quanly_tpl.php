<div class="fixwidth">
    <div class="wrap_bottom">
        <div class="all_trolyao_layout layout_trungtam_quanly">
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
                </div>
                <div class="all_trolyao_layout_center_center" style="padding: 10px;">
                    <input type="hidden" name="link_excel" id="link_excel" value="<?= $row_detail['excel'] ?>">
                    <a id="downloadLink" href="#" download>
                        <span>Download Excel</span>
                        <i class="fas fa-cloud-download-alt"></i>
                    </a>
                    <div class="iframe_trungtam_quanly" id="sheetsIframe">
                        <?= $row_detail['iframe_excel'] ?>
                    </div>
                </div>
            </div>
            <?php include LAYOUT_PATH . "layout_right.php" ?>
        </div>
    </div>
</div>