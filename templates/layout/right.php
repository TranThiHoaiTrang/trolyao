<div class="right_tt_noibat mb-3">
    <div class="head">Tin tức nổi bật</div>
    <div class="con">
        <ul class="tread">
            <?php foreach($tintuc as $v) {?>
            <li>
                <h3><a href="<?= $v['tenkhongdauvi'] ?>"><?=$v['ten'.$lang]?></a></h3>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>