<div class="content-main">
    <div class="fixwidth">
        <div class="contact_news w-clear">
            <div class="all_bread d-flex mt-5">
                <div class="breadCrumbs">
                    <div><?= $breadcrumbs ?></div>
                </div>
                <div class="name_tintuc_des"><?= $static['ten' . $lang] ?></div>
            </div>
            <div class="noidung_gt all_gioithieu_index">
                <?= (isset($static['noidung' . $lang]) && $static['noidung' . $lang] != '') ? htmlspecialchars_decode($static['noidung' . $lang]) : '' ?>
            </div>
        </div>
    </div>
</div>