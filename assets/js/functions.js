function modalNotify(text) {
  $("#popup-notify").find(".modal-body").html(text);
  $("#popup-notify").modal("show");
}

function ValidationFormSelf(ele = "") {
  if (ele) {
    $("." + ele)
      .find("input[type=submit]")
      .removeAttr("disabled");
    var forms = document.getElementsByClassName(ele);
    var validation = Array.prototype.filter.call(forms, function (form) {
      form.addEventListener(
        "submit",
        function (event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add("was-validated");
        },
        false
      );
    });
  }
}

function loadPagingAjax(url = "", eShow = "", id = "", id_post = 0) {
  if ($(eShow).length && url) {
    $.ajax({
      url: url,
      type: "GET",
      data: {
        eShow: eShow,
        id: id,
        id_post: id_post,
      },
      success: function (result) {
        $(eShow).html(result);
        /*if(id!=''){
                    $('html, body').animate({
                        scrollTop: $(id+id_post).offset().top
                    }, 1000);
                }*/
      },
    });
  }
}

function doEnter(event, obj) {
  if (event.keyCode == 13 || event.which == 13) onSearch(obj);
}

function onSearch(obj) {
  var keyword = $("#" + obj).val();
  // if(keyword==''){
  //     modalNotify(LANG['no_keywords']);
  //     return false;
  // }else{
  //     location.href = "tim-kiem?keyword="+encodeURI(keyword);
  //     loadPage(document.location);
  // }
  location.href = "tim-kiem?keyword=" + encodeURI(keyword).replace(/%20/g, '+');
  loadPage(document.location);
}

function onSearch_keyword(keyword) {
  var keyword = keyword;
  location.href = "tim-kiem?keyword=" + encodeURI(keyword).replace(/%20/g, '+');
  loadPage(document.location);
}

function doEnter_vbks(event, obj) {
  if (event.keyCode == 13 || event.which == 13) onSearch_keyword_vbks(obj);
}

function onSearch_keyword_vbks(obj) {
  var keyword = $("#" + obj).val();
  location.href = "tim-kiem-vb-ks?keyword=" + encodeURI(keyword).replace(/%20/g, '+');
  loadPage(document.location);
}

function doEnter_vbdang(event, obj) {
  if (event.keyCode == 13 || event.which == 13) onSearch_keyword_vbdang(obj);
}

function onSearch_keyword_vbdang(obj) {
  var keyword = $("#" + obj).val();
  location.href = "tim-kiem-vb-dang?keyword=" + encodeURI(keyword).replace(/%20/g, '+');
  loadPage(document.location);
}

function doEnter_phkg(event, obj) {
  if (event.keyCode == 13 || event.which == 13) onSearch_keyword_phkg(obj);
}

function onSearch_keyword_phkg(obj) {
  var keyword = $("#" + obj).val();
  location.href = "tim-kiem-phkg?keyword=" + encodeURI(keyword).replace(/%20/g, '+');
  loadPage(document.location);
}

function doEnter_noibo(event, obj) {
  if (event.keyCode == 13 || event.which == 13) onSearch_keyword_noibo(obj);
}

function onSearch_keyword_noibo(obj) {
  var keyword = $("#" + obj).val();
  location.href = "tim-kiem-vb-nb?keyword=" + encodeURI(keyword).replace(/%20/g, '+');
  loadPage(document.location);
}

function doEnter_thpl(event, obj) {
  if (event.keyCode == 13 || event.which == 13) onSearch_keyword_thpl(obj);
}

function onSearch_keyword_thpl(obj) {
  var keyword = $("#" + obj).val();
  location.href = "tim-kiem-thpl?keyword=" + encodeURI(keyword).replace(/%20/g, '+');
  loadPage(document.location);
}

function doEnter_hethongbieumau(event, obj) {
  if (event.keyCode == 13 || event.which == 13)
    onSearch_keyword_hethongbieumau(obj);
}

function onSearch_keyword_hethongbieumau(obj) {
  var keyword = $("#" + obj).val();
  location.href = "tim-kiem-ht-bm?keyword=" + encodeURI(keyword).replace(/%20/g, '+');
  loadPage(document.location);
}

function doEnter_noidung(event, obj) {
  if (event.keyCode == 13 || event.which == 13) onSearch_noidung(obj);
}

function onSearch_noidung(obj) {
  var id_vb_chinh = $("input[name=id_vb_chinh]").val();
  var keyword = $("#" + obj).val();
  console.log(keyword);
  $.ajax({
    url: "./ajax/ajax_search_ndpro.php",
    type: "POST",
    dataType: "html",
    data: {
      id_vb_chinh: id_vb_chinh,
      keyword: keyword,
    },
    success: function (result) {
      if (result != "") {
        $(".noidung_vanbanchinh").html(result);
      }
    },
  });
}

function vanbanweb(obj) {
  var id = $("." + obj).data("id");
  // location.href = "noi-dung?id="+id;
  window.open("noi-dung?id=" + id, "_blank");
  loadPage(document.location);
}

function goToByScroll(id) {
  var offsetMenu = 0;
  id = id.replace("#", "");
  if ($(".menu").length) offsetMenu = $(".menu").height();
  $("html,body").animate(
    {
      scrollTop: $("#" + id).offset().top - offsetMenu * 2,
    },
    "slow"
  );
}

function update_cart(id = 0, code = "", quantity = 1) {
  if (id) {
    var ship = $(".price-ship").val();

    $.ajax({
      type: "POST",
      url: "ajax/ajax_cart.php",
      dataType: "json",
      data: {
        cmd: "update-cart",
        id: id,
        code: code,
        quantity: quantity,
        ship: ship,
      },
      success: function (result) {
        if (result) {
          $(".load-price-" + code).html(result.gia);
          $(".load-price-new-" + code).html(result.giamoi);
          $(".price-temp").val(result.temp);
          $(".load-price-temp").html(result.tempText);
          $(".price-total").val(result.total);
          $(".load-price-total").html(result.totalText);
        }
      },
    });
  }
}

function load_district(id = 0) {
  $.ajax({
    type: "post",
    url: "ajax/ajax_district.php",
    data: { id_city: id },
    success: function (result) {
      $(".select-district").html(result);
      $(".select-wards").html(
        '<option value="">' + LANG["wards"] + "</option>"
      );
    },
  });
}

function load_wards(id = 0) {
  $.ajax({
    type: "post",
    url: "ajax/ajax_wards.php",
    data: { id_district: id },
    success: function (result) {
      $(".select-wards").html(result);
    },
  });
}

function load_ship(id = 0) {
  if (SHIP_CART) {
    $.ajax({
      type: "POST",
      url: "ajax/ajax_cart.php",
      dataType: "json",
      data: { cmd: "ship-cart", id: id },
      success: function (result) {
        if (result) {
          $(".load-price-ship").html(result.shipText);
          $(".load-price-total").html(result.totalText);
          $(".price-ship").val(result.ship);
          $(".price-total").val(result.total);
        }
      },
    });
  }
}

function onSearch_gpt() {

  localStorage.setItem("userGptIn", "true");

  var clientmsg = $("#keyword_gpt").val();
  var name_user = $(".name_user").val();
  var id_user = $(".id_user").val();
  var cookie_user = $(".cookie_user").val();

  var keyword = clientmsg;

  // Tạo URL với từ khóa trong query string
  var searchUrl = "tim-kiem-gpt?keyword=" + encodeURI(keyword);

  // Tạo một phần tử form
  var form = document.createElement("form");
  form.setAttribute("method", "post");
  form.setAttribute("action", searchUrl);

  // Tạo các phần tử input cho mỗi trường dữ liệu
  var inputNameUser = document.createElement("input");
  inputNameUser.setAttribute("type", "hidden");
  inputNameUser.setAttribute("name", "name_user");
  inputNameUser.setAttribute("value", name_user);

  var inputIdUser = document.createElement("input");
  inputIdUser.setAttribute("type", "hidden");
  inputIdUser.setAttribute("name", "id_user");
  inputIdUser.setAttribute("value", id_user);

  var inputCookieUser = document.createElement("input");
  inputCookieUser.setAttribute("type", "hidden");
  inputCookieUser.setAttribute("name", "cookie_user");
  inputCookieUser.setAttribute("value", cookie_user);

  // Thêm các phần tử input vào form
  form.appendChild(inputNameUser);
  form.appendChild(inputIdUser);
  form.appendChild(inputCookieUser);

  $(".all_box_trolyao_text_load").css({
    display: "flex",
  });
  // Thêm form vào body và gửi nó
  document.body.appendChild(form);
  form.submit();

  // Xóa nội dung của ô nhập liệu
  $("#keyword_gpt").val("");
}

function speakText(text) {
  if ("speechSynthesis" in window) {
    const utterance = new SpeechSynthesisUtterance(text);
    utterance.lang = "vi-VN";
    window.speechSynthesis.speak(utterance);
  } else {
    alert("Trình duyệt của bạn không hỗ trợ Web Speech API.");
  }
}

function checkSpelling() {
  var noteContent = tinymce.get("noteContent").getContent();

  $.ajax({
    type: "POST",
    url: "ajax/mahoatailieu.php",
    data: { noteContent: noteContent },
    success: function (result) {
      // $("#spellCheckResult").html(result);
      tinymce.get("noteContent").setContent(result);
    },
    // error: function (xhr, status, error) {
    //     console.error("Lỗi khi gửi yêu cầu: " + status + " - " + error);
    //     $("#spellCheckResult").html("Đã xảy ra lỗi khi kiểm tra chính tả.");
    // }
  });
}

function check_chinhta() {
  var noteContent = tinymce.get("noteContent").getContent();
  $.ajax({
    type: "POST",
    url: "ajax/kiemtrachinhta.php",
    data: { noteContent: noteContent },
    dataType: "json",
    success: function (result) {
      if (result.error) {
        console.error(result.error);
      } else {
        // tinymce.get("noteContent").setContent(result.result_content);
        tinymce.get("noteContent").setContent(result.result_content);
        $('.sidebar-content-lct').html(result.sai_tu);
        sua_chinhta();
      }
    },
  });
}

function sua_chinhta() {
  $(".button_suachinhta").click(function () {
    event.preventDefault();
    var $this = $(this);
    var noteContent = tinymce.get("noteContent").getContent();
    var text = $(this).data('text');
    // console.log(noteContent);
    // console.log(text);
    $.ajax({
      type: "POST",
      url: "ajax/sualoichinhta.php",
      data: { noteContent: noteContent,text:text },
      dataType: "json",
      success: function (result) {
        if (result.error) {
          console.error(result.error);
        } else {
          tinymce.get("noteContent").setContent(result.result_content);
          $('.sidebar-content-lct').html(result.sai_tu);
          $this.parent("div").remove();
        }
      },
    });
  })
}

function click_coutry_sp() {
  $(".name_country_sanpham_search").click(function () {
    var keyword = $(this).data("keyword");
    location.href = "tim-kiem?keyword=" + encodeURI(keyword);
    loadPage(document.location);
  });
}

function close_kq_thpl() {
  $(".close_keyword").click(function () {
    $.ajax({
      type: "POST",
      url: "ajax/close_readCountry.php",
      data: "keyword=" + $(this).data('keyword'),
      success: function (data) {
        $("#suggesstion-box").show();
        $("#suggesstion-box").html(data);
        close_kq_thpl();
        click_coutry_sp();
        // $("#keyword2").css("background", "#FFF");
      },
    });
  })
}
