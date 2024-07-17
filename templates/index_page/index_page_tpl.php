<?php
$locktime = 15 * 60;
$now = time();
$ip = $_SERVER['REMOTE_ADDR'];
if ($_COOKIE['login_user'] == 'member') {
    $vip = $d->rawQueryOne("select count(*) as visitip from #_counter_member where ip='$ip' and (tm+'$locktime')>'$now' limit 0,1");
    $items = $vip['visitip'];
    $user_id = $_COOKIE['id_user'];
    if (empty($items)) $d->rawQuery("insert into #_counter_member (tm, ip, user_id) values ('$now', '$ip','$user_id')");
} else {
    $vip = $d->rawQueryOne("select count(*) as visitip from #_counter_user where ip='$ip' and (tm+'$locktime')>'$now' limit 0,1");
    $items = $vip['visitip'];
    $user_id = $_COOKIE['id_user'];
    if (empty($items)) $d->rawQuery("insert into #_counter_user (tm, ip, user_id) values ('$now', '$ip','$user_id')");
}

?>
<audio id="myAudio">
    <source src="./assets/images/vks_moi.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<button id="playButton" style="display: none;" onclick="playAudio()">Phát âm thanh</button>
<div class="all_index_gioithieu">
    <div class="fixwidth" style="height: 100%;">
        <div class="row align-items-center" style="height: 100%;">
            <div class="col-md-6" style="height: 100%;">
                <div class="img_linhvat">
                    <img src="./assets/images/linhvat.gif" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="name_index_gioithieu">Chào mừng đến với phần mềm</div>
                <div class="mota_index_gioithieu">TRỢ LÝ ẢO VIỆN KIỂM SÁT NHÂN DÂN</div>
                <div class="noidung_index_gioithieu">
                    Tại đây Kiểm sát viên, công chức Viện kiểm sát có thể tra cứu, khai thác văn bản pháp luật, văn bản của ngành, tình huống pháp lý, các tính năng bổ trợ và trao đổi tương tác học tập kinh nghiệm.
                </div>
                <a rel="nofollow" href="index.php" class="viewmore_button_index_gioithieu" title="Xem thêm" data-glyph-after="">Xem thêm</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const background = document.querySelector(".all_index_gioithieu");
        const screenHeight = window.innerHeight;
        if (jQuery(window).width() >= 769 && jQuery(window).width() <= 1024) {
            const screenHeight_ = screenHeight - 105;
            if (background != undefined) {
                background.style.height = screenHeight_ + "px";
                // background_fx.style.minHeight = screenHeight_ + "px";
            }
        }
        if ($(window).width() >= 1024) {
            if (background != undefined) {
                background.style.height = screenHeight + "px";
            }
        }
        if ($(window).width() < 769) {
            const screenHeight_ = screenHeight - 57;
            if (background != undefined) {
                background.style.height = screenHeight_ + "px";
            }
        }
    });

    // window.onload = function() {
    //     var video = document.getElementById('myAudio');
    //     console.log(video);
    //     video.style.display = 'block';
    //     video.play().catch(function(error) {
    //         console.log('Autoplay was prevented:', error);
    //     });
    // };
    document.addEventListener('DOMContentLoaded', function() {
        // Kiểm tra cờ đã đăng nhập trong localStorage
        if (localStorage.getItem('userLoggedIn') === 'true') {
            var audio = document.getElementById('myAudio');
            // Phát âm thanh khi đã đăng nhập
            audio.play().catch(function(error) {
                console.log('Autoplay was prevented:', error);
            });
            // Xóa cờ đã đăng nhập sau khi phát âm thanh
            localStorage.removeItem('userLoggedIn');
        }
    });

    // function speakText(text) {

    //     if ('speechSynthesis' in window) {
    //         const utterance = new SpeechSynthesisUtterance(text);
    //         utterance.lang = 'vi-VN';

    //         utterance.pitch = 2;
    //         utterance.rate = 1.1;
    //         utterance.volume = 1;

    //         window.speechSynthesis.speak(utterance);
    //     } else {
    //         alert('Trình duyệt của bạn không hỗ trợ Web Speech API.');
    //     }
    // }

    // window.onload = function() {
    //     var hasLoaded = localStorage.getItem('hasLoaded');
    //     if (!hasLoaded) {
    //         speakText("Chào mừng đến với phần mềm TRỢ LÝ ẢO VIỆN KIỂM SÁT NHÂN DÂN, Tại đây Kiểm sát viên, công chức Viện kiểm sát có thể tra cứu, khai thác văn bản pháp luật, văn bản của ngành, tình huống pháp lý, các tính năng bổ trợ và trao đổi tương tác học tập kinh nghiệm.");
    //         localStorage.setItem('hasLoaded', true);
    //     }
    // };
</script>