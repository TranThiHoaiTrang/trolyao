<HTML>

<HEAD>
    <TITLE>:: Thông Báo ::</TITLE>
    <base href="<?= $basehref ?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- <meta http-equiv="REFRESH" content="4.5; url=<?= $page_transfer ?>"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.css">
    <style>
        @font-face {
            font-display: swap;
            font-family: 'Gilroy';
            font-style: normal;
            font-weight: 300;
            src: url(./assets/fonts/Gilroy/SVN-Gilroy-Light.otf) format("woff2")
        }

        @font-face {
            font-display: swap;
            font-family: 'Gilroy';
            font-style: italic;
            font-weight: 300;
            src: url(./assets/fonts/Gilroy/SVN-Gilroy-Light-Italic.otf) format("woff2")
        }

        @font-face {
            font-display: swap;
            font-family: 'Gilroy';
            font-style: normal;
            font-weight: 400;
            src: url(./assets/fonts/Gilroy/SVN-Gilroy-Regular.otf) format("woff2")
        }

        @font-face {
            font-display: swap;
            font-family: 'Gilroy';
            font-style: normal;
            font-weight: 500;
            src: url(./assets/fonts/Gilroy/SVN-Gilroy-Medium.otf) format("woff2")
        }

        @font-face {
            font-display: swap;
            font-family: 'Gilroy';
            font-style: italic;
            font-weight: 500;
            src: url(./assets/fonts/Gilroy/SVN-Gilroy-Medium-Italic.otf) format("woff2")
        }

        @font-face {
            font-display: swap;
            font-family: 'Gilroy';
            font-style: normal;
            font-weight: 600;
            src: url(./assets/fonts/Gilroy/SVN-Gilroy-SemiBold.otf) format("woff2")
        }

        @font-face {
            font-display: swap;
            font-family: 'Gilroy';
            font-style: italic;
            font-weight: 600;
            src: url(./assets/fonts/Gilroy/SVN-Gilroy-SemiBold-Italic.otf) format("woff2")
        }

        @font-face {
            font-display: swap;
            font-family: 'Gilroy';
            font-style: normal;
            font-weight: 600;
            src: url(./assets/fonts/Gilroy/SVN-Gilroy-Bold.otf) format("woff2")
        }

        @font-face {
            font-display: swap;
            font-family: 'Gilroy';
            font-style: italic;
            font-weight: 600;
            src: url(./assets/fonts/Gilroy/SVN-Gilroy-Bold-Italic.otf) format("woff2")
        }

        body {
            background: linear-gradient(180deg, rgba(21, 24, 26, 0.00) 0%, rgba(21, 24, 26, 0.80) 100%);
            font-family: "Gilroy", Arial, Helvetica, sans-serif;
        }

        div#alert_dktc {
            max-width: 400px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0px 4px 8px 0px rgba(78, 81, 83, 0.10);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 40px;
        }

        .title_success {
            color: #3153CE;
            font-weight: 600;
            font-size: 20px;
            text-align: center;
            line-height: 1.5;
            margin: 20px 0 8px 0;
        }

        .mota_success {
            color: #61676B;
            font-weight: 300;
            margin-bottom: 20px;
            text-align: center;
            font-size: 16px;
        }

        .all_button_thongbao a {
            border: 1px solid #3153CE;
            border-radius: 6px;
            padding: 5px 15px;
        }

        .btn_trangchu {
            background: #3153CE;
            color: #fff;
        }

        .all_button_thongbao {
            display: flex;
            gap: 10px;
        }

        .btn_trangchu:hover {
            color: #fff;
        }

        a:hover {
            text-decoration: none;
        }

        @media(max-width:769px) {
            div#alert_dktc {
                width: 100%;
            }
        }
    </style>

</HEAD>

<BODY>
    <div id="alert_dktc">
        <div class="img_success">
            <img src="./assets/images/Success.png" alt="">
        </div>
        <div class="title_success">Cảm ơn bạn đã đăng ký tư vấn tại Thanh Tùng Textile</div>
        <div class="mota_success">Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất!</div>
        <div class="all_button_thongbao">
            <a href="<?= $page_transfer ?>" class="btn_close">Đóng</a>
            <a href="" class="btn_trangchu">Trang chủ</a>
        </div>
    </div>
</BODY>

</HTML>