<!-- Js Config -->
<script type="text/javascript">
    var NN_FRAMEWORK = NN_FRAMEWORK || {};
    var CONFIG_BASE = '<?= $config_base ?>';
    var WEBSITE_NAME = '<?= (isset($setting['ten' . $lang]) && $setting['ten' . $lang] != '') ? $setting['ten' . $lang] : '' ?>';
    var TIMENOW = '<?= date("d/m/Y", time()) ?>';
    var SHIP_CART = <?= (isset($config['order']['ship']) && $config['order']['ship'] == true) ? 'true' : 'false' ?>;
    var GOTOP = 'assets/images/top.png';
    var LANG = {
        'no_keywords': "<?= chuanhaptukhoatimkiem ?>",
        'delete_product_from_cart': "<?= banmuonxoasanphamnay ?>",
        'no_products_in_cart': "<?= khongtontaisanphamtronggiohang ?>",
        'wards': "<?= phuongxa ?>",
        'back_to_home': "<?= vetrangchu ?>",
    };
</script>

<script src="https://cdn.jsdelivr.net/npm/typo-js@latest"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.8/tinymce.min.js"></script>

<script src="./assets/js/lazyload.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/Readmore.js/2.0.2/readmore.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/Readmore.js/2.0.2/readmore.js"></script>

<script src="https://apis.google.com/js/api.js"></script>

<!-- Js Files -->
<?php
$js->setCache("cached");
$js->setJs("./assets/js/jquery.min.js");
$js->setJs("./assets/bootstrap/bootstrap.js");
$js->setJs("./assets/js/wow.min.js");
$js->setJs("./assets/owlcarousel2/owl.carousel.js");
// $js->setJs("./assets/magiczoomplus/magiczoomplus.js");
$js->setJs("./assets/simplyscroll/jquery.simplyscroll.js");
$js->setJs("./assets/slick/slick.js");
$js->setJs("./assets/fancybox3/jquery.fancybox.js");
$js->setJs("./assets/toc/toc.js");
$js->setJs("./assets/js/lazyload.min.js");
$js->setJs("./assets/js/functions.js");
$js->setJs("./assets/js/apps.js");
$js->setJs("./assets/js/webhd.js");
$js->setJs("./assets/js/wysiwyg.js");
echo $js->getJs();
?>

<script>
    var myLazyLoad = new LazyLoad({
        elements_selector: ".lazy"
    });
</script>
<!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> -->
<!-- <script>
    AOS.init();
</script> -->
<!-- </?php if ($template == 'index/index') { ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.slider-nav'
            });
            $('.slider-nav').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                autoPlay: true,
                centerPadding: '0px',
                asNavFor: '.slider-for',
                dots: false,
                centerMode: true,
                focusOnSelect: true
            });
        });
    </script>
</?php } ?> -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const background = document.querySelector(".all_index_gioithieu");
        const background_fx = document.querySelector(".fixwidth");
        const background2 = document.querySelector(".wrap-home");
        const background3 = document.querySelector(".wrap-main");
        const screenHeight = window.innerHeight;
        if ($(window).width() >= 769 && $(window).width() <= 1024) {
            const screenHeight_ = screenHeight - 105;
            if (background2 != undefined) {
                background2.style.minHeight = screenHeight_ + "px";
            }
            if (background != undefined) {
                background.style.height = screenHeight_ + "px";
                // background_fx.style.minHeight = screenHeight_ + "px";
            }
        }
        if ($(window).width() >= 1024) {
            if (background2 != undefined) {
                background2.style.minHeight = screenHeight + "px";
            }
            if (background != undefined) {
                background.style.height = screenHeight + "px";
            }
        }
        if ($(window).width() < 769) {
            const screenHeight_ = screenHeight - 57;
            if (background2 != undefined) {
                console.log(screenHeight);
                background2.style.minHeight = screenHeight_ + "px";
            }
            if (background != undefined) {
                background.style.height = screenHeight_ + "px";
            }
        }
        if (background3) {
            if (background3.clientHeight < screenHeight) {
                if (background3 != undefined) {
                    background3.style.minHeight = screenHeight + "px";
                }
            }
        }
    });
</script>

<?php if ($deviceType != 'mobile') { ?>
    <script>
        $(".danhmuc_trolyao_li").click(function() {
            const background = document.querySelector(".trolyao_layout_left");
            const background2 = document.querySelector(".trolyao_layout_center");
            var class_dm = $(this).data("danhmuc");

            if ($(".danhmuc_trolyao_con." + class_dm).hasClass("active")) {
                $(".danhmuc_trolyao_con." + class_dm).removeClass("active");
                $(this).removeClass("active");
                $(".danhmuc_trolyao_con." + class_dm).css({
                    left: "0",
                    overflow: "hidden",
                    zIndex: "-1",
                });
                background.style.width = "90px";
                background2.style.width = "calc(60% - 90px - 20px)";
            } else {
                $(".danhmuc_trolyao_li").removeClass("active");
                $(".danhmuc_trolyao_con").removeClass("active");
                $(".danhmuc_trolyao_con").css({
                    left: "0",
                    overflow: "hidden",
                    zIndex: "-1",
                });

                $(".danhmuc_trolyao_con." + class_dm).addClass("active");
                $(this).addClass("active");
                $(".danhmuc_trolyao_con." + class_dm).css({
                    left: "90px",
                    zIndex: "0",
                });
                background.style.width = "calc(90px + 260px)";
                background2.style.width = "calc(100% - 20% - calc(90px + 260px) - 20px)";
            }
            return false;
        });

        $(".close_danhmuc_menu_prodanhmuc").click(function() {
            const background = document.querySelector(".trolyao_layout_left");
            const background2 = document.querySelector(".trolyao_layout_center");
            // var class_dm = $(this).data('danhmuc');
            $(".danhmuc_trolyao_li").removeClass("active");
            $(".danhmuc_trolyao_con").removeClass("active");
            $(".danhmuc_trolyao_con").css({
                left: "0",
                overflow: "hidden",
                zIndex: "-1",
            });
            background.style.width = "auto";
            background2.style.width = "calc(70% - 90px - 20px)";
            return false;
        });
    </script>
<?php } ?>

<?php if ($source != 'product_mhtl') { ?>
    <script>
        $('#send').click(function() {
            generateCompletion();
        });

        const apikey = 'sk-proj-4RXfsoVdDLQPwzmwlKFuT3BlbkFJLMrabaHdjT4IBBHDtotT';

        async function generateCompletion() {
            const response = await fetch('https://api.openai.com/v1/chat/completions', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + apikey,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    prompt: $('#question').val(),
                    temperature: 0.5,
                    max_tokens: 20,
                    top_p: 1,
                    frequency_penalty: 0,
                    presence_penalty: 0,
                }),
            });
            console.log(response);
            if (response.ok) {
                const completions = await response.json();
                if (completions.choices && completions.choices.length > 0) {
                    $('#answer').val(completions.choices[0].text.trim());
                } else {
                    $('#answer').val('Không có kết quả.');
                }
            } else {
                $('#answer').val('Đã xảy ra lỗi khi gọi API.');
            }
        }

        function speakText(text) {

            if ('speechSynthesis' in window) {
                const utterance = new SpeechSynthesisUtterance(text);
                utterance.lang = 'vi-VN';

                utterance.pitch = 2;
                utterance.rate = 1.1;
                utterance.volume = 1;

                window.speechSynthesis.speak(utterance);
            } else {
                alert('Trình duyệt của bạn không hỗ trợ Web Speech API.');
            }
        }

        var hasLoaded = false;

        // window.onload = function() {
        //     var hasLoadedBefore = localStorage.getItem('hasLoadedBefore');
        //     if (!hasLoadedBefore) {
        //         speakText("Chào bạn! Tôi là trợ lý ảo Viện Kiểm Sát Nhân dân, Mời bạn đưa ra yêu cầu.");
        //         localStorage.setItem('hasLoadedBefore', true);
        //     }
        // };

        var isScrolledToBottom = true;
        $(document).ready(function() {
            var isScrolledToBottom = true;

            function loadLog() {
                $.ajax({
                    url: "ajax/ajax_loadchat.php",
                    cache: false,
                    success: function(html) {
                        var messages = $("#messages");
                        var prevScrollHeight = messages[0].scrollHeight;

                        messages.html(html);
                        // console.log(isScrolledToBottom);
                        if (isScrolledToBottom) {
                            // console.log("aaa");
                            messages.scrollTop(messages[0].scrollHeight);
                        } else {
                            // console.log("bbb");
                            var newScrollHeight = messages[0].scrollHeight;
                            messages.scrollTop(messages.scrollTop() + (newScrollHeight - prevScrollHeight));
                        }
                    }
                });
            }

            function handleScroll() {
                var messages = $("#messages");
                var scrollTop = messages.scrollTop();
                var scrollHeight = messages[0].scrollHeight;
                var height = messages.height();
                isScrolledToBottom = scrollTop + height >= scrollHeight - 20;
            }

            $("#messages").on("scroll", handleScroll);
            setInterval(loadLog, 2000);

            // Cuộn xuống cuối cùng khi trang được tải
            var messages = $("#messages");
            messages.scrollTop(messages[0].scrollHeight);
        });

        function doEnter_message(event) {
            if (event.keyCode == 13 || event.which == 13) onSearch_message();
        }

        function onSearch_message() {

            var clientmsg = $("#message").val();
            var name_user = $(".name_user").val();
            var id_user = $(".id_user").val();
            var cookie_user = $(".cookie_user").val();
            var fileInput = $("#inputGroupFile01")[0];
            var file = fileInput.files[0];

            var formData = new FormData();
            formData.append("text", clientmsg);
            formData.append("name_user", name_user);
            formData.append("id_user", id_user);
            formData.append("cookie_user", cookie_user);
            if (file) {
                formData.append("file", file);
            }

            var messages = $("#messages");
            var prevScrollHeight = messages[0].scrollHeight;
            var prevScrollTop = messages.scrollTop();

            $.ajax({
                type: "POST",
                url: "./ajax/ajax_chat.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    var messages = $("#messages");
                    var prevScrollHeight = messages[0].scrollHeight;

                    messages.html(result);
                    setTimeout(function() {
                        if (isScrolledToBottom) {
                            messages.scrollTop(messages[0].scrollHeight);
                        } else {
                            var newScrollHeight = messages[0].scrollHeight;
                            messages.scrollTop(
                                messages.scrollTop() + (newScrollHeight - prevScrollHeight)
                            );
                        }
                    }, 100);
                },
            });
            $("#message").val("");
            return false;
        }

        function showFileName() {
            var input = document.getElementById('inputGroupFile01');
            var fileName = input.files[0] ? input.files[0].name : 'Choose file';
            document.getElementById('message').value = fileName;
        }
    </script>

<?php } ?>


<?php if ($template == 'product_ks/product' || $source == 'search-vbks') { ?>
    <script>
        $(document).ready(function() {
            var message = document.querySelector("#keyword_vks");
            var popup = document.querySelector(".content_search_void");

            var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
            var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;

            var grammar = "#JSGF V1.0;";

            var recognition = new SpeechRecognition();
            var speechRecognitionList = new SpeechGrammarList();
            speechRecognitionList.addFromString(grammar, 1);
            recognition.grammars = speechRecognitionList;
            recognition.lang = "vi-VN";
            recognition.interimResults = true;

            recognition.onresult = function(event) {
                var interimTranscript = "";
                var finalTranscript = "";
                for (var i = event.resultIndex; i < event.results.length; ++i) {
                    var transcript = event.results[i][0].transcript;
                    if (event.results[i].isFinal) {
                        finalTranscript += transcript;
                    } else {
                        interimTranscript += transcript;
                    }
                }
                message.value = finalTranscript + interimTranscript;
                popup.textContent = interimTranscript || finalTranscript;
                onSearch_keyword_vbks(finalTranscript + interimTranscript);
            };

            recognition.onspeechend = function() {
                recognition.stop();
            };

            recognition.onerror = function(event) {
                message.value = event.error;
            };
            if (document.querySelector(".nut_tim_void")) {
                document.querySelector(".nut_tim_void").addEventListener("click", function() {
                    recognition.start();
                    $("#popup-search").modal("show");
                });
            }
        });
    </script>
<?php } elseif ($template == 'product_nb/product' || $source == 'search-noibo') { ?>
    <script>
        $(document).ready(function() {
            var message = document.querySelector("#keyword_noibo");
            var popup = document.querySelector(".content_search_void");

            var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
            var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;

            var grammar = "#JSGF V1.0;";

            var recognition = new SpeechRecognition();
            var speechRecognitionList = new SpeechGrammarList();
            speechRecognitionList.addFromString(grammar, 1);
            recognition.grammars = speechRecognitionList;
            recognition.lang = "vi-VN";
            recognition.interimResults = true;

            recognition.onresult = function(event) {
                var interimTranscript = "";
                var finalTranscript = "";
                for (var i = event.resultIndex; i < event.results.length; ++i) {
                    var transcript = event.results[i][0].transcript;
                    if (event.results[i].isFinal) {
                        finalTranscript += transcript;
                    } else {
                        interimTranscript += transcript;
                    }
                }
                message.value = finalTranscript + interimTranscript;
                popup.textContent = interimTranscript || finalTranscript;
                onSearch_keyword_noibo(finalTranscript + interimTranscript);
            };

            recognition.onspeechend = function() {
                recognition.stop();
            };

            recognition.onerror = function(event) {
                message.value = event.error;
            };
            if (document.querySelector(".nut_tim_void")) {
                document.querySelector(".nut_tim_void").addEventListener("click", function() {
                    recognition.start();
                    $("#popup-search").modal("show");
                });
            }
        });
    </script>
<?php } elseif ($template == 'product_thpl/product' || $source == 'search-thpl') { ?>
    <script>
        $(document).ready(function() {
            var message = document.querySelector("#keyword_thpl");
            var popup = document.querySelector(".content_search_void");

            var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
            var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;

            var grammar = "#JSGF V1.0;";

            var recognition = new SpeechRecognition();
            var speechRecognitionList = new SpeechGrammarList();
            speechRecognitionList.addFromString(grammar, 1);
            recognition.grammars = speechRecognitionList;
            recognition.lang = "vi-VN";
            recognition.interimResults = true;

            recognition.onresult = function(event) {
                var interimTranscript = "";
                var finalTranscript = "";
                for (var i = event.resultIndex; i < event.results.length; ++i) {
                    var transcript = event.results[i][0].transcript;
                    if (event.results[i].isFinal) {
                        finalTranscript += transcript;
                    } else {
                        interimTranscript += transcript;
                    }
                }
                message.value = finalTranscript + interimTranscript;
                popup.textContent = interimTranscript || finalTranscript;
                onSearch_keyword_thpl(finalTranscript + interimTranscript);
            };

            recognition.onspeechend = function() {
                recognition.stop();
            };

            recognition.onerror = function(event) {
                message.value = event.error;
            };
            if (document.querySelector(".nut_tim_void")) {
                document.querySelector(".nut_tim_void").addEventListener("click", function() {
                    recognition.start();
                    $("#popup-search").modal("show");
                });
            }
        });
    </script>
<?php } else { ?>
    <script>
        $(document).ready(function() {
            var message = document.querySelector("#keyword");
            var popup = document.querySelector(".content_search_void");

            var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
            var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;

            var grammar = "#JSGF V1.0;";

            var recognition = new SpeechRecognition();
            var speechRecognitionList = new SpeechGrammarList();
            speechRecognitionList.addFromString(grammar, 1);
            recognition.grammars = speechRecognitionList;
            recognition.lang = "vi-VN";
            recognition.interimResults = true;

            recognition.onresult = function(event) {
                var interimTranscript = "";
                var finalTranscript = "";
                for (var i = event.resultIndex; i < event.results.length; ++i) {
                    var transcript = event.results[i][0].transcript;
                    if (event.results[i].isFinal) {
                        finalTranscript += transcript;
                    } else {
                        interimTranscript += transcript;
                    }
                }
                message.value = finalTranscript + interimTranscript;
                popup.textContent = interimTranscript || finalTranscript;
                onSearch_keyword(finalTranscript + interimTranscript);
            };

            recognition.onspeechend = function() {
                recognition.stop();
            };

            recognition.onerror = function(event) {
                message.value = event.error;
            };
            if (document.querySelector(".nut_tim_void")) {
                document.querySelector(".nut_tim_void").addEventListener("click", function() {
                    recognition.start();
                    $("#popup-search").modal("show");
                });
            }
        });
    </script>
<?php } ?>



<?php if (isset($config['googleAPI']['recaptcha']['active']) && $config['googleAPI']['recaptcha']['active'] == true) { ?>
    <!-- Js Google Recaptcha V3 -->
    <?php if ($source == 'contact' || $source == 'product' || $source == 'index') { ?>
        <script src="https://www.google.com/recaptcha/api.js?render=<?= $config['googleAPI']['recaptcha']['sitekey'] ?>"></script>
        <script type="text/javascript">
            grecaptcha.ready(function() {


                grecaptcha.execute('<?= $config['googleAPI']['recaptcha']['sitekey'] ?>', {
                    action: 'contact'
                }).then(function(token) {
                    var recaptchaResponseContact = document.getElementById('recaptchaResponseContact');
                    recaptchaResponseContact.value = token;
                });


            });
        </script>
    <?php } ?>
<?php } ?>

<?php if (isset($config['oneSignal']['active']) && $config['oneSignal']['active'] == true) { ?>
    <!-- Js OneSignal -->
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script type="text/javascript">
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "<?= $config['oneSignal']['id'] ?>"
            });
        });
    </script>
<?php } ?>

<!-- Js Structdata -->
<?php include LAYOUT_PATH . "strucdata.php"; ?>

<!-- Js Addons -->
<!-- <?= $addons->setAddons('script-main', 'script-main', 0.5); ?>
<?= $addons->getAddons(); ?> -->

<!-- Js Body -->
<?= htmlspecialchars_decode($setting['bodyjs']) ?>