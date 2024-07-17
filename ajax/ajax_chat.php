<?php
include "ajax_config.php";

$text = $_POST['text'];
if($_POST['name_user']){
    $name_user = $_POST['name_user'];
}
elseif($_COOKIE['login_session_name'])
{
    $name_user = $_COOKIE['login_session_name'];
}

$id_user = $_POST['id_user'];
$cookie_user = $_POST['cookie_user'];

if (isset($_FILES['file'])) {
    $file_name = $func->uploadName($_FILES['file']["name"]);
    // var_dump($func->uploadImage_clien("file", 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS', '/upload/file/', $file_name));
    if ($taptin = $func->uploadImage_clien("file", 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS', '/upload/file/', $file_name)) {
        $data['file'] = $taptin;
    }
}

$noidung = stripslashes(htmlspecialchars($text));

$data['ngaytao'] = time();
$data['name_user'] = $name_user;
$data['id_user'] = $id_user;
$data['cookie_user'] = $cookie_user;
$data['noidung'] = $noidung;
// var_dump($data);
$id_insert = $d->insert('messages', $data);

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
<?php
}

// var_dump($logData);
// $logFilePath = '../messages.php';

// $fp = fopen($logFilePath, 'a');
// if ($fp) {
//     fwrite($fp, "<div class='msgln'>".stripslashes(htmlspecialchars($text))."</div>");

//     $handle = fopen("../messages.php", "r");
//     $contents = fread($handle, filesize("../messages.php"));
//     fclose($handle);

//     echo $contents;

//     http_response_code(200);
// } else {
//     http_response_code(500);
// }
