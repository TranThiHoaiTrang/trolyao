<?php if (count($slider)) { ?>
    <!-- <div class="fixwidth"> -->
    <div class="wrap_slider slideshow_des">
        <div class="slideshow ">
            <p class="control-slideshow prev-slideshow transition"><i class="fas fa-chevron-left"></i></p>
            <div id="slider" class="owl-carousel owl-theme owl-slideshow">
                <?php foreach ($slider as $v) { ?>
                    <div class="item_slider">
                        <a href="<?= $v['link'] ?>" target="_blank" title="<?= $v['ten' . $lang] ?>" aria-label="slide"><img onerror="this.src='<?= Helper::noimage() ?>';" src="<?= Helper::thumbnail_link($v['photo'],1520,580) ?>" alt="<?= $v['ten' . $lang] ?>" title="<?= $v['ten' . $lang] ?>" width="1520" height="580" /></a>
                    </div>
                <?php } ?>
            </div>
            <p class="control-slideshow next-slideshow transition"><i class="fas fa-chevron-right"></i></p>
        </div>
    </div>
    <!-- </div> -->
<?php } ?>

<?php if (count($slide_mobile)) { ?>
    <!-- <div class="fixwidth"> -->
    <div class="wrap_slider slideshow_mobile">
        <div class="slideshow ">
            <p class="control-slideshow prev-slideshow transition"><i class="fas fa-chevron-left"></i></p>
            <div id="slider" class="owl-carousel owl-theme owl-slideshow">
                <?php foreach ($slide_mobile as $v) { ?>
                    <div class="item_slider">
                        <a href="<?= $v['link'] ?>" target="_blank" title="<?= $v['ten' . $lang] ?>" aria-label="slide"><?= Helper::the_thumbnail($v['photo'],423,452) ?></a>
                    </div>
                <?php } ?>
            </div>
            <p class="control-slideshow next-slideshow transition"><i class="fas fa-chevron-right"></i></p>
        </div>
    </div>
    <!-- </div> -->
<?php } ?>