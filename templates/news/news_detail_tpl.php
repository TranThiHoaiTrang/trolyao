<div class="content-main">
    <div class="fixwidth">
        <div class="contact_news contact_news_tintuc">
            <div class="all_bread d-flex mt-5">
                <div class="breadCrumbs">
                    <div><?= $breadcrumbs ?></div>
                </div>
                <div class="name_tintuc_des"><?= $row_detail['ten' . $lang] ?></div>
            </div>
            <div class="mota_tintuc_des"><?= $row_detail['mota' . $lang] ?></div>
            <div class="time-main">
            <?=(new \DateTime(date("Y/m/d", $row_detail['ngaytao'])))->format(DateTimeInterface::ATOM)?>
                <?= date("Y/m/d", $row_detail['ngaytao']) ?></span>
            </div>
            <?php if (isset($row_detail['noidung' . $lang]) && $row_detail['noidung' . $lang] != '') { ?>
                <div class="meta-toc">
                    <div class="box-readmore">
                        <ul class="toc-list" data-toc="article" data-toc-headings="h1, h2, h3"></ul>
                    </div>
                </div>
                <div class="w-clear all_gioithieu_index" id="toc-content">
                    <?= htmlspecialchars_decode($row_detail['noidung' . $lang]) ?>
                </div>

            <?php } else { ?>
                <div class="alert alert-warning" role="alert">
                    <strong><?= noidungdangcapnhat ?></strong>
                </div>
            <?php } ?>

            <?php if ($faqDB) { ?>
                <div class="fixwidth">
                    <div class="all_bancothethich_fw">
                        <div class="title_button_sp">Hỏi đáp liên quan</div>
                        <div class="all_chinhsach_des_ulli">
                            <?php foreach ($faqDB as $v) { ?>
                                <div class="all_chinhsach_des">
                                    <div class="name_chinhsach_des">
                                        <div class="all_name_cs">
                                            <span class="icon_fl_cs_des"><i class="far fa-bookmark"></i></span>
                                            <span><?= $v['ten' . $lang] ?></span>
                                        </div>
                                        <span class="icon_chinhsach_des"><i class="fas fa-angle-down"></i></span>
                                    </div>
                                    <div class="noidung_chinhsach all_gioithieu_index">
                                        <?= htmlspecialchars_decode($v['noidung' . $lang]) ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="article-survey-container">
                <input type="hidden" name="idbaiviet" class="idbaiviet" value="<?= $row_detail['id'] ?>">
                <?php
                $countong_rating = $d->rawQueryOne("select COUNT(*) as count FROM #_rating where id_product = '" . $row_detail['id'] . "' and hienthi > 0");
                ?>
                <div class="as">
                    <div class="title">Nội dung này có hữu ích không?</div>
                    <div id="hrv_blog_reviews_form_fieldset_rate">
                        <div id="dvRating">
                            <div class="all_start">
                                <i data-value="5" class="star-on-png"></i>
                                <i data-value="4" class="star-on-png active"></i>
                                <i data-value="3" class="star-on-png"></i>
                                <i data-value="2" class="star-on-png"></i>
                                <i data-value="1" class="star-off-png"></i>
                            </div>
                            <span>
                                (<em class="luotlike"><?= $countong_rating['count'] ?></em> lượt)
                            </span>
                        </div>
                        <p class="thongbao_darating">Bạn vừa đánh giá bài viết cách đây ít phút</p>
                    </div>
                    <!-- <div class="how-improve">Chúng tôi có thể cải thiện trang này bằng cách nào?</div> -->
                    <div class="button-group button_asbutton">
                        <button class="as-button yes" data-value="5" type="button">Có</button>
                        <button class="as-button no" data-value="1" type="button">Không</button>
                    </div>
                </div>
            </div>
            <div class="hrv-product-reviews-sub">
                <button type="submit" class="btn btn_base buycreaterating">Viết đánh giá</button>
                <div class="hrv-product-reviews-form">
                    <p>Viết bình luận</p>
                    <form class="form-rating-new" novalidate method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="id_product" value="<?= $row_detail['id'] ?>">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-contact">
                                    <input type="text" class="form-control" id="ten" name="ten" placeholder="Tên của bạn (>3 ký tự và < 20 ký tự)" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-contact">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="xinchao@gmail.com" required />
                                </div>
                            </div>
                        </div>
                        <div class="input-contact">
                            <textarea class="form-control" id="noidung" name="noidung" placeholder="Viết nội dung bình luận ở đây (>3 ký tự và < 1000 ký tự)" /></textarea>
                        </div>
                        <div class="button_submit_rating">
                            <input type="submit" name="submit_rating" class="submit_rating" value="Gửi đánh giá" style="width: fit-content;background: #222;color: #fff;border-radius: 5px;">
                        </div>
                    </form>
                </div>
            </div>

            <div class="tacgia">
                <div class="author-description">
                    <blockquote>
                        <?= htmlspecialchars_decode($tac_gia['noidung' . $lang]) ?>
                    </blockquote>
                </div>
                <blockquote>
                    <div class="author-info">
                        <div class="author-img">
                            <?= Helper::the_thumbnail($tac_gia['photo'], 100, 100, '', $tac_gia['ten' . $lang]); ?>
                        </div>
                        <div class="author-name">
                            <a><?= $tac_gia['ten' . $lang] ?></a>
                            <div class="social-author">
                                <div class="social-wrap">
                                    <div class="social-share">
                                        <?php foreach ($mxh_tacgia as $v) { ?>
                                            <a href="<?= $v['link'] ?>" target="_blank" rel="nofollow">
                                                <?= Helper::the_thumbnail($v['photo'], 30, 30, '', $v['ten' . $lang]); ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </blockquote>
            </div>
        </div>
    </div>
</div>