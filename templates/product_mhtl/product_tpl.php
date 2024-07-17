<div class="fixwidth">
    <div class="wrap_bottom">
        <div class="all_trolyao_layout">
            <?php include LAYOUT_PATH . "layout_left.php" ?>
            <div class="trolyao_layout_center" style="gap: 0;">
                <form class="form-contact validation-contact" novalidate method="post" action="" enctype="multipart/form-data">
                    <div class="all_mahoatailieu">
                        <div class="div_rsct" onclick="check_chinhta()">Rà soát chính tả</div>
                        <div class="div_mhtl" onclick="checkSpelling()">Mã hóa tài liệu</div>
                        <!-- <a href="dowloadword" class="dowload_file"></a> -->
                        <input type="submit" name="submit_dowload" class="submit_dowload" value="Dowload">
                    </div>
                    <div class="all_check_tailieu">
                        <div class="textarea">
                            <textarea id="noteContent" name="noteContent" class="tinycke" rows="35" style="width: 100%;height: 100%;padding: 10px;"></textarea>
                        </div>
                        <div class="table_loichinhta table_loichinhta_mhtl">
                            <div class="sidebar-title-lct">
                                Lỗi chính tả
                                <span class="refresh_lct" onclick="check_chinhta()"><i class="fas fa-redo-alt"></i></span>
                            </div>
                            <div class="sidebar-content-lct"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>