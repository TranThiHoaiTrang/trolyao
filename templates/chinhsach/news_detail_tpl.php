<div class="content-main">
    <div class="fixwidth">
        <div class="contact_news">
            <div class="all_bread d-flex mt-5">
                <div class="breadCrumbs">
                    <div><?= $breadcrumbs ?></div>
                </div>
                <div class="name_tintuc_des"><?= $row_detail['ten' . $lang] ?></div>
            </div>
            <div class="mota_tintuc_des"><?= $row_detail['mota' . $lang] ?></div>
            <div class="time-main">
                <?= date("D m Y", $row_detail['ngaytao']) ?></span>
            </div>
            <?php if (isset($row_detail['noidung' . $lang]) && $row_detail['noidung' . $lang] != '') { ?>
                <div class="meta-toc">
                    <div class="box-readmore">
                        <ul class="toc-list" data-toc="article" data-toc-headings="h1, h2, h3"></ul>
                    </div>
                </div>
                <div class="w-clear" id="toc-content">
                    <?= htmlspecialchars_decode($row_detail['noidung' . $lang]) ?></div>
                <div class="share">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="#454545" d="M352 320c-25.6 0-48.9 10-66.1 26.4l-98.3-61.5c5.9-18.8 5.9-39.1 0-57.8l98.3-61.5C303.1 182 326.4 192 352 192c53 0 96-43 96-96S405 0 352 0s-96 43-96 96c0 9.8 1.5 19.6 4.4 28.9l-98.3 61.5C144.9 170 121.6 160 96 160c-53 0-96 43-96 96s43 96 96 96c25.6 0 48.9-10 66.1-26.4l98.3 61.5c-2.9 9.4-4.4 19.1-4.4 28.9 0 53 43 96 96 96s96-43 96-96-43-96-96-96zm0-272c26.5 0 48 21.5 48 48s-21.5 48-48 48-48-21.5-48-48 21.5-48 48-48zM96 304c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm256 160c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48z" />
                        </svg>
                        <?= chiase ?>:
                    </span>
                    <div class="social-plugin w-clear">
                        <div class="addthis_inline_share_toolbox_qj48"></div>
                        <div class="zalo-share-button" data-href="<?= $func->getCurrentPageURL() ?>" data-oaid="<?= ($optsetting['oaidzalo'] != '') ? $optsetting['oaidzalo'] : '579745863508352884' ?>" data-layout="1" data-color="blue" data-customize=false></div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="alert alert-warning" role="alert">
                    <strong><?= noidungdangcapnhat ?></strong>
                </div>
            <?php } ?>
        </div>
    </div>
</div>