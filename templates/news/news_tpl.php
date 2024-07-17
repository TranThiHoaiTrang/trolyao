<div class="fixwidth">
    <div class="all_bread d-flex mt-5">
        <div class="breadCrumbs">
            <div><?= $breadcrumbs ?></div>
        </div>
        <div class="bread_title"><?= (@$title_cat != '') ? $title_cat : @$title_crumb ?></div>
    </div>
    <div class="content-main w-clear">
        <?php if (count($news) > 0) { ?>
            <div class="content-main w-clear loadkhung_news">
                <?php foreach ($news as $k => $v) { ?>
                    <a href="<?= $v['tenkhongdauvi'] ?>">
                        <div class="blog">
                            <div class="img_blog">
                                <?=Helper::the_thumbnail($v['photo'], 684, 372, '', $v['ten' . $lang]);?>
                            </div>
                            <div class="content_blog">
                                <div class="time_blog">
                                    <div class="icon_blog"><i class="fas fa-calendar-day"></i></div>
                                    <span><?= date("d M Y", $v['ngaytao']) ?></span>
                                </div>
                                <div class="name_blog "><?= $v['ten' . $lang] ?></div>
                                <div class="mota_blog noidung-split"><?= $v['mota' . $lang] ?></div>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
            <div class="clear"></div>
            <div class="pagination-home"><?= (isset($paging) && $paging != '') ? $paging : '' ?></div>
        <?php } else { ?>
            <div class="alert alert-warning" role="alert">
                <strong><?= khongtimthayketqua ?></strong>
            </div>
        <?php } ?>
    </div>
    <?php if ($noidung_page != '') { ?>
        <div class="noidung_page">
            <div class="meta-toc">
                <div class="box-readmore">
                    <ul class="toc-list" data-toc="article" data-toc-headings="h1, h2, h3"></ul>
                </div>
            </div>
            <div id="toc-content"><?= htmlspecialchars_decode($noidung_page) ?></div>
        </div>
    <?php } ?>
</div>