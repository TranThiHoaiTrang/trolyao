<?php
include "ajax_config.php";

$one_week_ago = time() - (365 * 24 * 3600);
$keyword_tatca = $d->rawQuery("delete from #_messages WHERE ngaytao <= '$one_week_ago'");

$messages = $d->rawQuery("select * from #_messages order by id asc");
foreach ($messages as $v) {
    $user = $d->rawQueryOne("select * from #_member where id = '" . $v['id_user'] . "'");
?>
    <?php if (isset($_SESSION[$login_member]['id'])) { ?>
        <div class="<?= $_SESSION[$login_member]['id'] == $v['id_user'] ? 'user' : '' ?>">
            <span><?= $v['name_user'] ?></span>
            <?php if ($v['file']) { ?>
                <a href="./upload/file/<?= $v['file'] ?>">
                    <span><?= htmlspecialchars_decode($v['noidung']) ?></span>
                    <i class="fas fa-cloud-download-alt"></i>
                </a>
            <?php } else { ?>
                <span><?= htmlspecialchars_decode($v['noidung']) ?></span>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="<?= $_COOKIE['login_session'] == $v['cookie_user'] ? 'user' : '' ?>">
            <span><?= $v['name_user'] ?></span>
            <?php if ($v['file']) { ?>
                <a href="./upload/file/<?= $v['file'] ?>">
                    <span><?= htmlspecialchars_decode($v['noidung']) ?></span>
                    <i class="fas fa-cloud-download-alt"></i>
                </a>
            <?php } else { ?>
                <span><?= htmlspecialchars_decode($v['noidung']) ?></span>
            <?php } ?>
        </div>
    <?php } ?>
<?php }
