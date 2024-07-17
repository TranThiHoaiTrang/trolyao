<?php
$list_vb_ks = $d->rawQuery("select * FROM table_product_list WHERE hienthi > 0 AND type = 'van-ban-nb'  order by stt,id asc");
?>
<div class="fixwidth">
    <div class="wrap_bottom">
        <div class="all_trolyao_layout">
            <?php include LAYOUT_PATH . "layout_left.php" ?>
            <div class="trolyao_layout_center">
                <div class="iframe-container">
                    <iframe id="embeddedFrame" src="https://luatvietnam.vn/trolyaovks-tim-van-ban.html" allowfullscreen></iframe>
                </div>
            </div>
            <?php include LAYOUT_PATH . "layout_right.php" ?>
        </div>
    </div>
</div>

<script>
    // window.addEventListener('message', function(event) {
    //     // Kiểm tra nguồn gốc của thông điệp
    //     if (event.origin === 'https://luatvietnam.vn') {
    //         var iframe = document.getElementById('embeddedFrame');
    //         console.log(iframe);
    //         // Cập nhật chiều cao của iframe
    //         iframe.style.height = event.data + 'px';
    //     }
    // });
</script>