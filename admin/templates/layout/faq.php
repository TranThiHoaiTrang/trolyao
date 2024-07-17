<!-- SEO -->
<?php
$slugurlArray = '';
$seo_create = '';
if (($com == "static" || $com == "seopage") && isset($config['website']['comlang'])) {
    foreach ($config['website']['comlang'] as $k => $v) {
        if ($type == $k) {
            $slugurlArray = $v;
            break;
        }
    }
}
?>
<div class="card-seo">
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                <?php foreach ($config['website']['faq'] as $k => $v) {
                    $seo_create .= $k . ","; ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($k == 'vi') ? 'active' : '' ?>" id="tabs-lang" data-toggle="pill" href="#tabs-seolang-<?= $k ?>" role="tab" aria-controls="tabs-seolang-<?= $k ?>" aria-selected="true">FAQ (<?= $v ?>)</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                
                <?php foreach ($config['website']['faq'] as $k => $v) { ?>
                    <div class="tab_pane_faq tab-pane fade show <?= ($k == 'vi') ? 'active' : '' ?>" id="tabs-seolang-<?= $k ?> i" role="tabpanel" aria-labelledby="tabs-lang">
                        <?php if ($faqDB) { ?>
                            <input type="hidden" name="count_faq" class="count_faq" value="<?=count($faqDB)?>">
                            <?php $i = 0; foreach ($faqDB as $v) { ?>
                                <div class="all_faq_content">
                                    <input type="hidden" name="id_faq" class="id_faq" value="<?= $v['id'] ?>">
                                    <div class="form-group">
                                        <div class="label-seo">
                                            <label for="title<?= $k ?>">FAQ title <?= $i ?> (<?= $k ?>):</label>
                                        </div>
                                        <input type="text" class="form-control check-seo title-seo" name="datafaq<?=$i?>[ten<?= $k ?>]" id="ten<?= $k ?>" placeholder="FAQ Title (<?= $k ?>)" value="<?= @$v['ten' . $k] ?>">
                                    </div>
                                    <div class="form-group">
                                        <div class="label-seo">
                                            <label for="noidung<?= $k ?>">FAQ Description <?= $i ?> (<?= $k ?>):</label>
                                        </div>
                                        <textarea class="form-control check-seo description-seo" name="datafaq<?=$i?>[noidung<?= $k ?>]" id="noidung<?= $k ?>" rows="5" placeholder="FAQ noidung (<?= $k ?>)"><?= @$v['noidung' . $k] ?></textarea>
                                    </div>
                                </div>
                            <?php $i += 1;} ?>
                        <?php } else { ?>
                            <input type="hidden" name="count_faq" class="count_faq" value="0">
                            <div class="all_faq_content">
                                <input type="hidden" name="id_faq" class="id_faq" value="0">
                                <div class="form-group">
                                    <div class="label-seo">
                                        <label for="title<?= $k ?>">FAQ title (<?= $k ?>):</label>
                                    </div>
                                    <input type="text" class="form-control check-seo title-seo" name="datafaq0[ten<?= $k ?>]" id="ten<?= $k ?>" placeholder="FAQ Title (<?= $k ?>)" value="">
                                </div>
                                <div class="form-group">
                                    <div class="label-seo">
                                        <label for="noidung<?= $k ?>">FAQ Description (<?= $k ?>):</label>
                                    </div>
                                    <textarea class="form-control check-seo description-seo" name="datafaq0[noidung<?= $k ?>]" id="noidung<?= $k ?>" rows="5" placeholder="FAQ noidung (<?= $k ?>)"></textarea>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
