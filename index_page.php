<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trợ lý ảo viện kiểm sát</title>
    <link href="https://trang.hdweb24h.com/trolyao/upload/photo/image-2.png" rel="shortcut icon" type="image/x-icon" />
    <meta name="robots" content="noindex,nofollow" />
    <link href="./assets/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="./assets/css/webhd.css" rel="stylesheet" type="text/css" media="all" />
    <link href='https://fonts.googleapis.com/css?family=Petit+Formal+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Alegreya+Sans:300,400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300' rel='stylesheet' type='text/css'>
    <link href='./assets/css/font-awesome.css' rel='stylesheet' type='text/css'>
    <link href='./assets/bootstrap/bootstrap.css' rel='stylesheet' type='text/css'>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
</head>

<body>
    <div id="wrapper">
        <audio id="myAudio">
            <source src="./assets/images/vks_moi.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>

        <button id="playButton" style="display: none;" onclick="playAudio()">Phát âm thanh</button>
        <div class="all_index_gioithieu all_index_gioithieu_dn">
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

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const background = document.querySelector(".all_index_gioithieu");
                const screenHeight = window.innerHeight;
                if (window.innerWidth >= 769 && window.innerWidth <= 1024) {
                    const screenHeight_ = screenHeight - 105;
                    if (background) {
                        background.style.height = screenHeight_ + "px";
                    }
                }
                if (window.innerWidth >= 1024) {
                    if (background) {
                        background.style.height = screenHeight + "px";
                    }
                }
                if (window.innerWidth < 769) {
                    const screenHeight_ = screenHeight - 57;
                    if (background) {
                        background.style.height = screenHeight + "px";
                    }
                }

                if (localStorage.getItem('userInteracted') === 'true') {
                    var audio = document.getElementById('myAudio');
                    console.log(audio);
                    audio.style.display = 'block';
                    audio.play().catch(function(error) {
                        console.log('Autoplay was prevented:', error);
                    });
                }
            });
        </script>
    </div>
</body>

</html>
