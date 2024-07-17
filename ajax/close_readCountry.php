<?php
include "ajax_config.php";

if (!empty($_POST["keyword"])) {
    $tukhoa = htmlspecialchars($_POST['keyword']);

    // $where = " and tenvi LIKE('%" . $tukhoa . "%')";

    $d->rawQuery("delete from #_keyword where keyword = ?",array($tukhoa));
    // var_dump("delete from #_keyword where keyword = ?",array($tukhoa));
    $data = $d->rawQuery("select * from #_keyword order by id desc");
?>
    <ul id="country-list">
        <?php foreach ($data as $v) { ?>
            <li class="country_sanpham">
                <div class="name_country_sanpham name_country_sanpham_search" data-keyword="<?= $v['keyword'] ?>">
                    <img src="./assets/images/time.svg" alt="" width="16" height="16">
                    <span><?= $v['keyword'] ?></span>
                </div>
                <div class="close_keyword" data-keyword="<?= $v['keyword'] ?>"><i class="fas fa-times"></i></div>
            </li>
        <?php } ?>
    </ul>

<?php } ?>