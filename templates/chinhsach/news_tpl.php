<div class="content-main">
    <div class="fixwidth">
        <div class="contact_news">
            <div class="all_bread d-flex mt-5">
                <div class="breadCrumbs">
                    <div><?= $breadcrumbs ?></div>
                </div>
            </div>
            <?php if (!empty($idl)) { ?>
                <div class="all_chinhsach_des_ulli w-clear">
                    <?php foreach ($news as $v) { ?>
                        <div class="all_chinhsach_des active">
                            <div class="name_chinhsach_des">
                                <div class="all_name_cs">
                                    <span class="icon_fl_cs_des"><i class="far fa-bookmark"></i></span>
                                    <span><?= $v['ten' . $lang] ?></span>
                                </div>
                                <span class="icon_chinhsach_des"><i class="fas fa-angle-down"></i></span>
                            </div>
                            <div class="noidung_chinhsach all_gioithieu_index">
                                <?= htmlspecialchars_decode($v['noidung' . $lang]) ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="all_chinhsach_des_ulli">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <?php foreach ($chinhsach_list as $l) { ?>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-<?= $l['id'] ?>-tab" data-toggle="pill" href="#pills-<?= $l['id'] ?>" role="tab" aria-controls="pills-<?= $l['id'] ?>" aria-selected="false"><?= $l['ten' . $lang] ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <?php foreach ($chinhsach_list as $l) { ?>
                            <div class="tab-pane fade" id="pills-<?= $l['id'] ?>" role="tabpanel" aria-labelledby="pills-<?= $l['id'] ?>-tab">
                                <?php
                                $chinhsach_news = $d->rawQuery("select * from #_news where type = ? and id_list = ? and hienthi > 0 order by stt,id desc", array('chinh-sach', $l['id']));
                                foreach ($chinhsach_news as $v) { ?>
                                    <div class="all_chinhsach_des active">
                                        <div class="name_chinhsach_des">
                                            <div class="all_name_cs">
                                                <span class="icon_fl_cs_des"><i class="far fa-bookmark"></i></span>
                                                <span><?= $v['ten' . $lang] ?></span>
                                            </div>
                                            <span class="icon_chinhsach_des"><i class="fas fa-angle-down"></i></span>
                                        </div>
                                        <div class="noidung_chinhsach all_gioithieu_index">
                                            <?= htmlspecialchars_decode($v['noidung' . $lang]) ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</div>