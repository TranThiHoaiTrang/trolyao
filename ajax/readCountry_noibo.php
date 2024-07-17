<?php
include "ajax_config.php";

if (!empty($_POST["keyword"])) {
    $tukhoa = htmlspecialchars($_POST['keyword']);
    // $tukhoa = $func->url_title($tukhoa, ' ');

    // $where = ' and ( 1=1';
    // $tukhoa_sp = preg_split("/[\s,-]+/", $tukhoa);
    // foreach($tukhoa_sp as $k){
    //     $tk_m = str_split($k, 5);
    //     foreach($tk_m as $tk){
    //         $where .= " and (slugvi LIKE CONCAT('%', '" . $tk . "', '%'))";
    //     }

    // }
    // $where .= ')';
    $where = " and tenvi LIKE('%" . $tukhoa . "%')";

    $check = false;
    if ($_COOKIE['login_user'] == 'user' && $_COOKIE['login_cap_user'] == '1') {
        $check = true;
    }
    if ($_COOKIE['login_user'] == 'member') {
        $check = true;
    }
    $id_donvi = $_COOKIE['login_donvi_user'];

    if($check == true){
        $where .= ' and id_donvi = '.$id_donvi.'';
    }

    // var_dump($where);
    $data = $d->rawQuery("select * from #_product where type = 'van-ban-nb' $where ");
    $data_dm = $d->rawQuery("select * from #_product_danhmuc where type = 'van-ban-nb' $where ");
    // var_dump("select * from #_product_danhmuc where type = 'van-ban' $where ");
    if (!empty($data) || !empty($data_dm)) { ?>
        <ul id="country-list">
            <?php
            foreach ($data as $v) {
            ?>
                <li class="country_sanpham">
                    <a href="<?= $v['tenkhongdauvi'] ?>">
                        <div class="name_country_sanpham">
                            <span><?= $v['ten' . $lang] ?></span>
                        </div>
                    </a>
                </li>
            <?php
            }
            ?>
            <?php
            foreach ($data_dm as $v) {
            ?>
                <li class="country_sanpham">
                    <a href="<?= $v['tenkhongdauvi'] ?>">
                        <div class="name_country_sanpham">
                            <span><?= $v['ten' . $lang] ?></span>
                        </div>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
<?php
    }
}
?>