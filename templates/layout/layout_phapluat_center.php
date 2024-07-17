<div class="tab-content all_trolyao_layout_center_center_scroll all_trolyao_layout_center_center_scroll_index" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                    <span>Tất cả</span>
                    <?php
                    $count_sanpham = $d->rawQueryOne("select count(id) as numb from #_product where hienthi>0 and type='van-ban'");
                    ?>
                    <span>(<?= $count_sanpham['numb'] ?>)</span>
                </button>
            </li>
            <?php foreach ($spcatmenu as $spc) {
                $count_sanpham = $d->rawQueryOne("select count(id) as numb from #_product where id_cat = '" . $spc['id'] . "' and hienthi>0 and type='van-ban'");
                if ($count_sanpham['numb'] > 0) {
            ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="<?= $spc['id'] ?>-tab" data-toggle="tab" data-target="#<?= $spc['id'] ?>" type="button" role="tab" aria-controls="<?= $spc['id'] ?>" aria-selected="false">
                            <span><?= $spc['ten' . $lang] ?></span>
                            <span>(<?= $count_sanpham['numb'] ?>)</span>
                        </button>
                    </li>
                    <?php } else {
                    $count_sanpham_dm = $d->rawQueryOne("select count(id) as numb from #_product_danhmuc where id_cat = '" . $spc['id'] . "' and hienthi>0 and type='van-ban'");
                    // var_dump("select count(id) as numb from #_product_danhmuc where id_cat = '" . $spc['id'] . "' and hienthi>0 and type='van-ban'");
                    if ($count_sanpham_dm['numb'] > 0) {
                    ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="<?= $spc['id'] ?>-tab" data-toggle="tab" data-target="#<?= $spc['id'] ?>" type="button" role="tab" aria-controls="<?= $spc['id'] ?>" aria-selected="false">
                                <span><?= $spc['ten' . $lang] ?></span>
                                <span>(<?= $count_sanpham_dm['numb'] ?>)</span>
                            </button>
                        </li>
                <?php }
                } ?>
            <?php } ?>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" style="padding-top: 10px;">
            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <?php
                $all_danhmuc_sanpham = $d->rawQuery("select * from #_product_danhmuc where hienthi>0 and noibat > 0 and type='van-ban' order by stt,id desc");
                foreach ($all_danhmuc_sanpham as $danhmuc_sp) {
                    $all_spthuocdm = $d->rawQuery("select * from #_product where  id_danhmuc = '" . $danhmuc_sp['id'] . "' and hienthi>0 and noibat > 0 and type='van-ban'");
                    // var_dump("select * from #_product where id_danhmuc = '".$danhmuc_sp['id']."' and hienthi>0 and noibat > 0 and type='van-ban'");
                ?>
                    <div class="all_block-view-all">
                        <div class="block-view-all">
                            <a href="<?= $danhmuc_sp['tenkhongdauvi'] ?>">
                                <div class="name_danhmuc"><?= $danhmuc_sp['ten' . $lang] ?></div>
                            </a>
                            <div class="all_dieu">
                                <?php foreach ($all_spthuocdm as $v) { ?>
                                    <a href="<?= $v['tenkhongdauvi'] ?>">
                                        <div class="dieu_danhmuc">
                                            <?= $func->sub_str($v['ten' . $lang], 50) ?>
                                            <span>(Xem thêm)</span>
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <?php foreach ($spcatmenu as $spc) { ?>
                <div class="tab-pane" id="<?= $spc['id'] ?>" role="tabpanel" aria-labelledby="<?= $spc['id'] ?>-tab">
                    <?php
                    $all_danhmuc_sanpham = $d->rawQuery("select * from #_product_danhmuc where id_Cat = '" . $spc['id'] . "' and hienthi>0  and type='van-ban' order by stt,id desc");
                    $all_iddanhmuc_sanpham = $d->rawQuery("select DISTINCT id_danhmuc from #_product WHERE id_cat = '" . $spc['id'] . "'");
                    // var_dump($all_iddanhmuc_sanpham);
                    if ($all_danhmuc_sanpham) {
                        foreach ($all_danhmuc_sanpham as $danhmuc_sp) {
                            // var_dump($danhmuc_sp);
                            $all_spthuocdm = $d->rawQuery("select * from #_product where  id_danhmuc = '" . $danhmuc_sp['id'] . "' and hienthi>0  and type='van-ban'");
                            // var_dump("select * from #_product where id_danhmuc = '".$danhmuc_sp['id']."' and hienthi>0 and noibat > 0 and type='van-ban'");
                    ?>
                            <div class="all_block-view-all">
                                <div class="block-view-all">
                                    <a href="<?= $danhmuc_sp['tenkhongdauvi'] ?>">
                                        <div class="name_danhmuc"><?= $danhmuc_sp['ten' . $lang] ?></div>
                                    </a>
                                    <div class="all_dieu">
                                        <?php foreach ($all_spthuocdm as $v) { ?>
                                            <a href="<?= $v['tenkhongdauvi'] ?>">
                                                <div class="dieu_danhmuc">
                                                    <?= $func->sub_str($v['ten' . $lang], 50) ?>
                                                    <span>(Xem thêm)</span>
                                                </div>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        if ($all_iddanhmuc_sanpham) {
                            foreach ($all_iddanhmuc_sanpham as $dmsp) {
                                $danhmuc_sp = $d->rawQueryOne("select tenkhongdauvi,tenvi,id from #_product_danhmuc where id = '" . $dmsp['id_danhmuc'] . "' and hienthi>0  and type='van-ban'");
                                $all_pro_sanpham = $d->rawQuery("select * from #_product where  id_danhmuc = '" . $dmsp['id_danhmuc'] . "' and id_cat = '" . $spc['id'] . "' and hienthi>0  and type='van-ban'");
                                if ($danhmuc_sp) {
                            ?>
                                    <div class="all_block-view-all">
                                        <div class="block-view-all">
                                            <a href="<?= $danhmuc_sp['tenkhongdauvi'] ?>">
                                                <div class="name_danhmuc"><?= $danhmuc_sp['ten' . $lang] ?></div>
                                            </a>
                                            <div class="all_dieu">
                                                <?php foreach ($all_pro_sanpham as $v) { ?>
                                                    <a href="<?= $v['tenkhongdauvi'] ?>">
                                                        <div class="dieu_danhmuc">
                                                            <?= $func->sub_str($v['ten' . $lang], 50) ?>
                                                            <span>(Xem thêm)</span>
                                                        </div>
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
    <?php foreach ($spcatmenu as $spc) { ?>
        <div class="tab-pane fade" id="pills-<?= $spc['id'] ?>" role="tabpanel" aria-labelledby="pills-<?= $spc['id'] ?>-tab">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                        <span>Tất cả</span>
                        <?php
                        $count_sanpham = $d->rawQueryOne("select count(id) as numb from #_product where id_cat = '" . $spc['id'] . "' and hienthi>0 and type='van-ban'");
                        ?>
                        <span>(<?= $count_sanpham['numb'] ?>)</span>
                    </button>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style="padding-top: 10px;">
                <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <?php
                    $all_danhmuc_sanpham = $d->rawQuery("select * from #_product_danhmuc where id_Cat = '" . $spc['id'] . "' and hienthi>0  and type='van-ban' order by stt,id desc");
                    $all_iddanhmuc_sanpham = $d->rawQuery("select DISTINCT id_danhmuc from #_product WHERE id_cat = '" . $spc['id'] . "'");
                    // var_dump($all_iddanhmuc_sanpham);
                    if ($all_danhmuc_sanpham) {
                        foreach ($all_danhmuc_sanpham as $danhmuc_sp) {
                            // var_dump($danhmuc_sp);
                            $all_spthuocdm = $d->rawQuery("select * from #_product where  id_danhmuc = '" . $danhmuc_sp['id'] . "' and hienthi>0  and type='van-ban'");
                            // var_dump("select * from #_product where id_danhmuc = '".$danhmuc_sp['id']."' and hienthi>0 and noibat > 0 and type='van-ban'");
                    ?>
                            <div class="all_block-view-all">
                                <div class="block-view-all">
                                    <a href="<?= $danhmuc_sp['tenkhongdauvi'] ?>">
                                        <div class="name_danhmuc"><?= $danhmuc_sp['ten' . $lang] ?></div>
                                    </a>
                                    <div class="all_dieu">
                                        <?php foreach ($all_spthuocdm as $v) { ?>
                                            <a href="<?= $v['tenkhongdauvi'] ?>">
                                                <div class="dieu_danhmuc">
                                                    <?= $func->sub_str($v['ten' . $lang], 50) ?>
                                                    <span>(Xem thêm)</span>
                                                </div>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        if ($all_iddanhmuc_sanpham) {
                            foreach ($all_iddanhmuc_sanpham as $dmsp) {
                                $danhmuc_sp = $d->rawQueryOne("select tenkhongdauvi,tenvi,id from #_product_danhmuc where id = '" . $dmsp['id_danhmuc'] . "' and hienthi>0  and type='van-ban'");
                                $all_pro_sanpham = $d->rawQuery("select * from #_product where  id_danhmuc = '" . $dmsp['id_danhmuc'] . "' and id_cat = '" . $spc['id'] . "' and hienthi>0  and type='van-ban'");
                                if ($danhmuc_sp) {
                            ?>
                                    <div class="all_block-view-all">
                                        <div class="block-view-all">
                                            <a href="<?= $danhmuc_sp['tenkhongdauvi'] ?>">
                                                <div class="name_danhmuc"><?= $danhmuc_sp['ten' . $lang] ?></div>
                                            </a>
                                            <div class="all_dieu">
                                                <?php foreach ($all_pro_sanpham as $v) { ?>
                                                    <a href="<?= $v['tenkhongdauvi'] ?>">
                                                        <div class="dieu_danhmuc">
                                                            <?= $func->sub_str($v['ten' . $lang], 50) ?>
                                                            <span>(Xem thêm)</span>
                                                        </div>
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

            </div>
        </div>
    <?php } ?>
</div>