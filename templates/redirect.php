<?php
$redirect = $d->rawQuery("select * from #_redirections where hienthi > 0 order by stt,id desc");
// var_dump($redirect);
// Đường dẫn cũ bạn muốn thực hiện redirect
foreach($redirect as $v){
    $old_url = $v['old_url'];

    // Đường dẫn mới bạn muốn hướng dẫn đến
    $new_url = $v['new_url'];
    
    // Thực hiện 301 redirect nếu URL hiện tại trùng khớp với old-url
    if ($_SERVER['REQUEST_URI'] == parse_url($old_url, PHP_URL_PATH)) {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: $new_url");
        exit();
    }
}
