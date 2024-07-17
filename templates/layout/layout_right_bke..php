<?php
$messages_gpt_all = $d->rawQuery("select * from #_messages_gpt where cookie_user = '" . $_COOKIE['login_session'] . "' order by id asc");
if ($deviceType == 'computer') {
?>
    <div class="trolyao_layout_right">
        <div class="all_trolyao_layout_right">
            <div class="all_trolyao_layout_center_bottom">
                <div class="trolyao_layout_center_banner_gpt">
                    <img src="./assets/images/gpt.png" alt="">
                    <span>KIỂM SÁT VIÊN AI (GPT)</span>
                    <!-- <img src="./assets/images/gpt.png" alt=""> -->
                </div>
                <div class="trolyao_layout_center_boloc">
                    <div class="all_frm_timkiem_gpt">
                        <div class="all_tinnhan_gpt">
                            <div class="all_tinnhan_gpt_data">
                                <div class="all_box_trolyao_text">
                                    <img src="./assets/images/ic-bot.png" alt="" width="48" height="48">
                                    <div class="box_trolyao_text_moi">
                                        <div class="box_trolyao_text">
                                            <div class="chat_mes_moi">
                                                <span>Trợ lý ảo VKS</span>
                                                <span>
                                                    Chào bạn
                                                    <img src="./assets/images/wave-hand.png" alt="" width="20" height="20">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="box_trolyao_text">
                                            <span>Tôi là trợ lý ảo Viện Kiểm sát nhân dân. Tôi có thể giúp gì cho bạn?</span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if ($messages_gpt_all) {
                                    foreach ($messages_gpt_all as $v) {
                                        if ($v['name_user'] == 'ai') {
                                ?>
                                            <div class="all_box_trolyao_text ">
                                                <img src="./assets/images/ic-bot.png" alt="" width="40" height="40">
                                                <div class="box_trolyao_text">
                                                    <?= $v['noidung'] ?>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="all_box_trolyao_text_user">
                                                <span><?= $v['noidung'] ?></span>
                                            </div>
                                        <?php } ?>
                                <?php }
                                } ?>
                            </div>
                            <div class="all_box_trolyao_text all_box_trolyao_text_load">
                                <img src="./assets/images/ic-bot.png" alt="" width="48" height="48">
                                <div class="box_trolyao_text">
                                    <span class="typing-indicator">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="frm_timkiem_gpt">
                            <input type="hidden" name="name_user" class="name_user" value="<?= $_SESSION[$login_member]['username'] ?>">
                            <input type="hidden" name="id_user" class="id_user" value="<?= $_SESSION[$login_member]['id'] ?>">
                            <input type="hidden" name="cookie_user" class="cookie_user" value="<?= $_COOKIE['login_session'] ?>">
                            <input type="text" class="input" id="keyword_gpt" name="keyword_gpt" placeholder="Message ChatGPT...">
                            <div class="all_button_search_gpt">
                                <?php if ($deviceType != 'mobile') { ?>
                                    <button type="submit" value="" name="submit_gpt" class="nut_tim_void_gpt" aria-label="Search"><i class="fas fa-microphone"></i></button>
                                <?php } ?>
                                <button type="submit" value="" name="submit_gpt" class="nut_tim_gpt" aria-label="Search" onclick="onSearch_gpt()"><i class="fas fa-arrow-up"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="trolyao_layout_right_bottom">
                <div class="banner_chiasetructuyen">
                    <img src="./assets/images/chiase.png" alt="">
                    <span>CHIA SẺ TRỰC TUYẾN</span>
                </div>

                <?php if ($_SESSION[$login_member]['active'] || isset($_COOKIE['login_session_name'])) { ?>
                    <div class="chiasetructuyen">
                        <div class="all_tinnhan" id="messages">
                            <?php
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
                            <?php } ?>
                        </div>
                        <div class="input_submit_message">
                            <input type="hidden" name="name_user" class="name_user" value="<?= $_SESSION[$login_member]['username'] ?>">
                            <input type="hidden" name="id_user" class="id_user" value="<?= $_SESSION[$login_member]['id'] ?>">
                            <input type="hidden" name="cookie_user" class="cookie_user" value="<?= $_COOKIE['login_session'] ?>">
                            <input type="text" class="form-control message" id="message" name="message" placeholder="Message..." onkeypress="doEnter_message(event);" />
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="showFileName()">
                                <label class="custom-file-label" for="inputGroupFile01"><i class="fas fa-paperclip"></i></label>
                            </div>
                            <button type="button" id="send" class="button_submit_message" onclick="onSearch_message();">
                                <i class="fas fa-arrow-up"></i>
                            </button>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="chiasetructuyen chiasetructuyen_height">
                        <div id="messages">
                            <a href="account/dang-nhap">
                                <div class="giohang">
                                    <i class="fas fa-user"></i>
                                    <span>Đăng nhập tài khoản</span>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($deviceType == 'mobile') { ?>

    <button type="button" class="btn btn-chiasetructuyen" data-toggle="modal" data-target="#popup_chiasetructuyen">
        <img src="./assets/images/chiase3.jpg" alt="" style="border-radius: 50%;">
    </button>
    <button type="button" class="btn btn-trolyao" data-toggle="modal" data-target="#popup_trolyao">
        <img src="./assets/images/ic-bot.png" alt="">
    </button>

    <div class="modal fade" id="popup_chiasetructuyen" tabindex="-1" role="dialog" aria-labelledby="popup_chiasetructuyen-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="border-radius: 18px;">
                <!-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-weight: 300;">&times;</span>
                    </button>
                </div> -->
                <div class="modal-body" style="padding: 0;">
                    <div class="all_trolyao_layout_right">
                        <div class="trolyao_layout_right_bottom">
                            <div class="banner_chiasetructuyen">
                                <img src="./assets/images/chiase.png" alt="">
                                <span>CHIA SẺ TRỰC TUYẾN</span>
                            </div>

                            <?php if ($_SESSION[$login_member]['active'] || isset($_COOKIE['login_session_name'])) { ?>
                                <div class="chiasetructuyen">
                                    <div class="all_tinnhan" id="messages">
                                        <?php
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
                                        <?php } ?>
                                    </div>
                                    <div class="input_submit_message">
                                        <input type="hidden" name="name_user" class="name_user" value="<?= $_SESSION[$login_member]['username'] ?>">
                                        <input type="hidden" name="id_user" class="id_user" value="<?= $_SESSION[$login_member]['id'] ?>">
                                        <input type="hidden" name="cookie_user" class="cookie_user" value="<?= $_COOKIE['login_session'] ?>">
                                        <input type="text" class="form-control message" id="message" name="message" placeholder="Message..." onkeypress="doEnter_message(event);" />
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="showFileName()">
                                            <label class="custom-file-label" for="inputGroupFile01"><i class="fas fa-paperclip"></i></label>
                                        </div>
                                        <button type="button" id="send" class="button_submit_message" onclick="onSearch_message();">
                                            <i class="fas fa-arrow-up"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="chiasetructuyen chiasetructuyen_height">
                                    <div id="messages">
                                        <a href="account/dang-nhap">
                                            <div class="giohang">
                                                <i class="fas fa-user"></i>
                                                <span>Đăng nhập tài khoản</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="popup_trolyao" tabindex="-1" role="dialog" aria-labelledby="popup_trolyao-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="border-radius: 18px;">
                <!-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-weight: 300;">&times;</span>
                    </button>
                </div> -->
                <div class="modal-body" style="padding: 0;">
                    <div class="all_trolyao_layout_right">
                        <div class="all_trolyao_layout_center_bottom">
                            <div class="trolyao_layout_center_banner_gpt">
                                <img src="./assets/images/gpt.png" alt="">
                                <span>KIỂM SÁT VIÊN AI (GPT)</span>
                                <!-- <img src="./assets/images/gpt.png" alt=""> -->
                            </div>
                            <div class="trolyao_layout_center_boloc">
                                <div class="all_frm_timkiem_gpt">
                                    <div class="all_tinnhan_gpt">
                                        <div class="all_tinnhan_gpt_data">
                                            <div class="all_box_trolyao_text">
                                                <img src="./assets/images/ic-bot.png" alt="" width="48" height="48">
                                                <div class="box_trolyao_text_moi">
                                                    <div class="box_trolyao_text">
                                                        <div class="chat_mes_moi">
                                                            <span>Trợ lý ảo VKS</span>
                                                            <span>
                                                                Chào bạn
                                                                <img src="./assets/images/wave-hand.png" alt="" width="20" height="20">
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="box_trolyao_text">
                                                        <span>Tôi là trợ lý ảo Viện Kiểm sát nhân dân. Tôi có thể giúp gì cho bạn?</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if ($messages_gpt_all) {
                                                foreach ($messages_gpt_all as $v) {
                                                    if ($v['name_user'] == 'ai') {
                                            ?>
                                                        <div class="all_box_trolyao_text ">
                                                            <img src="./assets/images/ic-bot.png" alt="" width="40" height="40">
                                                            <div class="box_trolyao_text">
                                                                <?= $v['noidung'] ?>
                                                            </div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="all_box_trolyao_text_user">
                                                            <span><?= $v['noidung'] ?></span>
                                                        </div>
                                                    <?php } ?>
                                            <?php }
                                            } ?>
                                        </div>
                                        <div class="all_box_trolyao_text all_box_trolyao_text_load">
                                            <img src="./assets/images/ic-bot.png" alt="" width="48" height="48">
                                            <div class="box_trolyao_text">
                                                <span class="typing-indicator">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="frm_timkiem_gpt">
                                        <input type="hidden" name="name_user" class="name_user" value="<?= $_SESSION[$login_member]['username'] ?>">
                                        <input type="hidden" name="id_user" class="id_user" value="<?= $_SESSION[$login_member]['id'] ?>">
                                        <input type="hidden" name="cookie_user" class="cookie_user" value="<?= $_COOKIE['login_session'] ?>">
                                        <input type="text" class="input" id="keyword_gpt" name="keyword_gpt" placeholder="Message ChatGPT...">
                                        <div class="all_button_search_gpt">
                                            <button type="submit" value="" name="submit_gpt" class="nut_tim_void_gpt" aria-label="Search"><i class="fas fa-microphone"></i></button>
                                            <button type="submit" value="" name="submit_gpt" class="nut_tim_gpt" aria-label="Search" onclick="onSearch_gpt()"><i class="fas fa-arrow-up"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>