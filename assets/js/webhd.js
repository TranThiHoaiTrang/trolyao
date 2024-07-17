$(document).ready(function () {
  $(".catagory-title").on("click", function () {
    if ($(".catagory-list__fix").css("display") == "none") {
      $(".catagory-list__fix").animate(
        {
          height: "show",
        },
        400
      );
    } else {
      $(".catagory-list__fix").animate(
        {
          height: "hide",
        },
        200
      );
    }
  });
  $(".catagory-list__fix li span").on("click", function () {
    let id = $(this).attr("data-id");
    if ($("#cat2__fix_" + id).css("display") == "none") {
      $("#cat2__fix_" + id).animate(
        {
          height: "show",
        },
        400
      );
    } else {
      $("#cat2__fix_" + id).animate(
        {
          height: "hide",
        },
        200
      );
    }
  });
  $(".catagory-list li span").on("click", function () {
    let id = $(this).attr("data-id");
    if ($("#cat2_" + id).css("display") == "none") {
      $("#cat2_" + id).animate(
        {
          height: "show",
        },
        400
      );
    } else {
      $("#cat2_" + id).animate(
        {
          height: "hide",
        },
        200
      );
    }
  });
});
$(document).ready(function () {
  // $('.support-content').hide();

  // $('a.btn-support').click(function(e){
  //   e.stopPropagation();
  //   $('.support-content').slideToggle();
  // });
  // $('.support-content').click(function(e){
  //   e.stopPropagation();
  // });
  // $(document).click(function(){
  //   $('.support-content').slideUp();
  // });

  $(".tailvideo_item_owl").click(function () {
    let id = $(this).attr("data-src");
    let img = $(this).attr("data-image");
    let name = $(this).attr("data-name");
    $(".pic-video").attr("data-src", id);
    $(".pic-video img").attr("src", img);
    $(".name-video").html(name);
  });
});

$(document).on("click", ".menu_mobi .menulicha", function (event) {
  $(".close_menu").trigger("click");
  return false;
});

var menu_mobi = $(".menu_cap_cha").html();
$(".menu_mobi_add").append(
  '<span class="close_menu"><i class="fas fa-times"></i></span><ul class="danhmuc_trolyao">' +
    menu_mobi +
    "</ul>"
);

$(".menu_mobi_add ul li ul").removeClass("menu_cap_con");
$(".menu_mobi_add ul li ul").css({
  display: "none",
});
$(".menu_mobi_add ul li ul li ul").removeClass("menu_cap_2");
$(".menu_mobi_add ul li ul li ul").css({
  display: "none",
});
$(".menu_mobi_add ul li ul li ul li ul").removeClass("menu_cap_3");
$(".menu_mobi_add ul li ul li ul li ul").css({
  display: "none",
});

$(".menu_mobi_add ul li").each(function (index, element) {
  if ($(this).children("ul").children("li").length > 0) {
    $(this).children("a").append('<i class="fas fa-chevron-right"></i>');
  }
});
$(".menu_mobi_add ul li a i").click(function () {
  if ($(this).parent("a").hasClass("active2")) {
    $(this).parent("a").removeClass("active2");
    if (
      $(this).parent("a").parent("li").children("ul").children("li").length > 0
    ) {
      $(this).parent("a").parent("li").children("ul").css({
        display: "none",
      });
      //$(this).parent('a').parent('li').children('ul').hide(300);
      return false;
    }
  } else {
    $(this).parent("a").addClass("active2");
    if ($(this).parents("li").children("ul").children("li").length > 0) {
      //$(".menu_m ul li ul").hide(0);
      $(this).parents("li").children("ul").show(300);
      $(".menu_m ul li ul").css({
        display: "none",
      });
      $(this).parents("li").children("ul").css({
        display: "block",
      });
      return false;
    }
  }
});

$(".icon_menu_mobi,.close_menu,.menu_baophu").click(function () {
  if ($(".menu_mobi_add").hasClass("menu_mobi_active")) {
    $(".menu_mobi_add").removeClass("menu_mobi_active");
    $(".menu_baophu").fadeOut(300);
  } else {
    $(".menu_mobi_add").addClass("menu_mobi_active");
    $(".menu_baophu").fadeIn(300);
  }
  return false;
});



$(".danhmuc_menu_prolist").click(function () {
  if ($(this).parent("div").parent("li").children("ul").hasClass("active")) {
    $(this).parent("div").parent("li").children("ul").removeClass("active");
    $(this).parent("div").parent("li").children("ul").fadeOut(300);
  } else {
    $(this).parent("div").parent("li").children("ul").addClass("active");
    $(this).parent("div").parent("li").children("ul").fadeIn(300);
  }
  return false;
});

$(".div_rsct").click(function () {
  $(".table_loichinhta").fadeIn(300);
  return false;
});
$(".div_mhtl").click(function () {
  $(".table_loichinhta").fadeOut(300);
  return false;
});

$(".icon_dieuluat,.name_dieuluat").click(function () {
  if (
    $(this)
      .parent(".dieu_luat")
      .parent(".dieu_thuoc_chuong")
      .children(".noidung_dieu_luat")
      .hasClass("active")
  ) {
    $(this)
      .parent(".dieu_luat")
      .parent(".dieu_thuoc_chuong")
      .children(".noidung_dieu_luat")
      .removeClass("active");
    $(this)
      .parent(".dieu_luat")
      .parent(".dieu_thuoc_chuong")
      .children(".noidung_dieu_luat")
      .fadeOut(500);
    $(this)
      .children(".icon_dieuluat")
      .html('<i class="fas fa-caret-right"></i>');
  } else {
    $(this)
      .parent(".dieu_luat")
      .parent(".dieu_thuoc_chuong")
      .children(".noidung_dieu_luat")
      .addClass("active");
    $(this)
      .parent(".dieu_luat")
      .parent(".dieu_thuoc_chuong")
      .children(".noidung_dieu_luat")
      .fadeIn(500);
    $(this)
      .children(".icon_dieuluat")
      .html('<i class="fas fa-caret-down"></i>');
  }
  return false;
});

$(document).ready(function () {
  $(".name_chidan").click(function () {
    if (
      $(this)
        .parent(".all_chidan")
        .children(".noidung_chidan")
        .hasClass("active")
    ) {
      $(this)
        .parent(".all_chidan")
        .children(".noidung_chidan")
        .removeClass("active")
        .css({
          display: "none",
        });
    } else {
      $(".name_chidan")
        .parent(".all_chidan")
        .children(".noidung_chidan")
        .removeClass("active")
        .css({
          display: "none",
        });
      $(this)
        .parent(".all_chidan")
        .children(".noidung_chidan")
        .addClass("active")
        .css({
          display: "flex",
        });
      adjustNotcontentPosition();
    }
    return false;
  });

  document.addEventListener("click", function (event) {
    document.querySelectorAll(".name_chidan").forEach(function (button) {
      var parentNote = button.closest(".all_chidan");
      var notcontent = parentNote.querySelector(".noidung_chidan");
      if (event.target !== button && !button.contains(event.target)) {
        if (notcontent.classList.contains("active")) {
          notcontent.classList.remove("active");
          notcontent.style.display = "none";
          adjustNotcontentPosition();
        }
      }
    });
  });

  function adjustNotcontentPosition() {
    var notcontent = document.querySelector(".noidung_chidan.active");
    if (notcontent) {
      var rect = notcontent.getBoundingClientRect();
      var viewportHeight = window.innerHeight;
      var spaceBelow = viewportHeight - rect.bottom;
      var spaceAbove = rect.top;

      // Set a minimum height
      notcontent.style.minHeight = "auto";

      if (spaceBelow < 100 && spaceAbove >= 100) {
        notcontent.style.bottom = "12px";
        notcontent.style.top = "auto";
      } else {
        notcontent.style.top = "12px";
        notcontent.style.bottom = "auto";
      }
    }
  }

  window.addEventListener("resize", adjustNotcontentPosition);
});


$(".name_vanban_lienquan").click(function () {
  if (
    $(this)
      .parent(".vanban_lienquan")
      .children(".noidung_vanban_lienquan")
      .hasClass("active")
  ) {
    $(this)
      .parent(".vanban_lienquan")
      .children(".noidung_vanban_lienquan")
      .removeClass("active");
    $(this)
      .parent(".vanban_lienquan")
      .children(".noidung_vanban_lienquan")
      .fadeOut(300);
  } else {
    $(this)
      .parent(".vanban_lienquan")
      .children(".noidung_vanban_lienquan")
      .addClass("active");
    $(this)
      .parent(".vanban_lienquan")
      .children(".noidung_vanban_lienquan")
      .fadeIn(500);
  }
  return false;
});

$(".name_country_sanpham_search").click(function () {
  var keyword = $(this).data("keyword");
  location.href = "tim-kiem?keyword=" + encodeURI(keyword);
  loadPage(document.location);
});

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

$(document).ready(function () {
  $("#keyword").keyup(function () {
    // console.log($(this).val());
    $.ajax({
      type: "POST",
      url: "ajax/readCountry.php",
      data: "keyword=" + $(this).val(),
      beforeSend: function () {
        // $("#keyword").css(
        //   "background",
        //   "#FFF url(LoaderIcon.gif) no-repeat 165px"
        // );
      },
      success: function (data) {
        $("#suggesstion-box").show();
        $("#suggesstion-box").html(data);
        // $("#keyword2").css("background", "#FFF");
      },
    });
  });

  $("#keyword").click(function () {
    $(this)
      .parent(".frm_timkiem")
      .parent(".all_frm_timkiem")
      .children("#suggesstion-box")
      .fadeIn(300);
  });
});

$(document).ready(function () {
  $("#keyword_vks").keyup(function () {
    // console.log($(this).val());
    $.ajax({
      type: "POST",
      url: "ajax/readCountry_vks.php",
      data: "keyword=" + $(this).val(),
      success: function (data) {
        $("#suggesstion-box").show();
        $("#suggesstion-box").html(data);
        // $("#keyword2").css("background", "#FFF");
      },
    });
  });

  $("#keyword_vks").click(function () {
    $(this)
      .parent(".frm_timkiem")
      .parent(".all_frm_timkiem")
      .children("#suggesstion-box")
      .fadeIn(300);
  });
});

$(document).ready(function () {
  $("#keyword_dang").keyup(function () {
    // console.log($(this).val());
    $.ajax({
      type: "POST",
      url: "ajax/readCountry_dang.php",
      data: "keyword=" + $(this).val(),
      success: function (data) {
        $("#suggesstion-box").show();
        $("#suggesstion-box").html(data);
        // $("#keyword2").css("background", "#FFF");
      },
    });
  });

  $("#keyword_dang").click(function () {
    $(this)
      .parent(".frm_timkiem")
      .parent(".all_frm_timkiem")
      .children("#suggesstion-box")
      .fadeIn(300);
  });
});

$(document).ready(function () {
  $("#keyword_noibo").keyup(function () {
    // console.log($(this).val());
    $.ajax({
      type: "POST",
      url: "ajax/readCountry_noibo.php",
      data: "keyword=" + $(this).val(),
      success: function (data) {
        $("#suggesstion-box").show();
        $("#suggesstion-box").html(data);
        // $("#keyword2").css("background", "#FFF");
      },
    });
  });

  $("#keyword_noibo").click(function () {
    $(this)
      .parent(".frm_timkiem")
      .parent(".all_frm_timkiem")
      .children("#suggesstion-box")
      .fadeIn(300);
  });
});

$(document).ready(function () {
  $("#keyword_thpl").keyup(function () {
    // console.log($(this).val());
    $.ajax({
      type: "POST",
      url: "ajax/readCountry_thpl.php",
      data: "keyword=" + $(this).val(),
      success: function (data) {
        $("#suggesstion-box").show();
        $("#suggesstion-box").html(data);
        
        // $("#keyword2").css("background", "#FFF");
      },
    });
  });

  $("#keyword_thpl").click(function () {
    $(this)
      .parent(".frm_timkiem")
      .parent(".all_frm_timkiem")
      .children("#suggesstion-box")
      .fadeIn(300);
  });

});

$(document).ready(function () {
  $("#keyword_hethongbieumau").keyup(function () {
    // console.log($(this).val());
    $.ajax({
      type: "POST",
      url: "ajax/readCountry_hethongbieumau.php",
      data: "keyword=" + $(this).val(),
      success: function (data) {
        $("#suggesstion-box").show();
        $("#suggesstion-box").html(data);
        // $("#keyword2").css("background", "#FFF");
      },
    });
  });

  $("#keyword_hethongbieumau").click(function () {
    $(this)
      .parent(".frm_timkiem")
      .parent(".all_frm_timkiem")
      .children("#suggesstion-box")
      .fadeIn(300);
  });
});

$(document).click(function (event) {
  if (!$(event.target).closest(".all_frm_timkiem").length) {
    $("#suggesstion-box").fadeOut(300);
  }
});

window.addEventListener("load", function () {
  var loaderWrapper = document.getElementById("loader-wrapper");

  setTimeout(function () {
    loaderWrapper.style.display = "none";
    setTimeout(function () {
      loaderWrapper.style.display = "none";
      document.body.classList.add("loaded");
    }, 500);
  }, 1000);
});

// document.addEventListener("DOMContentLoaded", function () {

// });

document.addEventListener("DOMContentLoaded", function () {
  function adjustNotcontentPosition(notcontent) {
    var rect = notcontent.getBoundingClientRect();
    var viewportHeight = window.innerHeight;
    var spaceBelow = viewportHeight - rect.bottom;
    var spaceAbove = rect.top;

    if ($(window).width() < 769) {
      if (spaceBelow < 100 && spaceAbove >= 100) {
        notcontent.style.bottom = "10%";
        notcontent.style.top = "auto";
      } else {
        notcontent.style.top = "auto";
        notcontent.style.bottom = "10%";
      }
      
    }else{
      if (spaceBelow < 100 && spaceAbove >= 100) {
        notcontent.style.bottom = "12px";
        notcontent.style.top = "auto";
      } else {
        notcontent.style.top = "12px";
        notcontent.style.bottom = "auto";
      }
    }
  }

  document.querySelectorAll(".note").forEach(function (parentNote) {
    var nestedNotes = parentNote.querySelectorAll(".note .note");
    nestedNotes.forEach(function (nestedNote) {
      while (nestedNote.firstChild) {
        parentNote.insertBefore(nestedNote.firstChild, nestedNote);
      }
      nestedNote.remove();
    });
  });

  var notes = document.querySelectorAll(".note");

  notes.forEach(function (note) {
    var noteContent = note.querySelector(".note_content");
    if (noteContent) {
      var icon = document.createElement("span");
      icon.className = "icon_note";
      icon.id = "toggleNotcontentButton";
      icon.innerHTML = '<i class="far fa-comment-alt"></i>';
      note.insertBefore(icon, noteContent);

      var links = noteContent.querySelectorAll("a");
      links.forEach(function (link) {
        link.setAttribute("target", "_blank");
      });
    }
  });

  document.querySelectorAll(".icon_note").forEach(function (button) {
    button.addEventListener("click", function () {
      console.log("aaa");
      var parentNote = button.closest(".note");
      var notcontent = parentNote.querySelector(".note_content");
      if (notcontent) {
        notcontent.classList.toggle("show");
        adjustNotcontentPosition(notcontent);
      }
    });
  });

  window.addEventListener("resize", function () {
    document.querySelectorAll(".note_content").forEach(function (notcontent) {
      adjustNotcontentPosition(notcontent);
    });
  });

  document.addEventListener("click", function (event) {
    document.querySelectorAll(".icon_note").forEach(function (button) {
      var parentNote = button.closest(".note");
      var notcontent = parentNote.querySelector(".note_content");
      if (event.target !== button && !button.contains(event.target)) {
        if (notcontent.classList.contains("show")) {
          notcontent.classList.remove("show");
          adjustNotcontentPosition(notcontent);
        }
      }
    });
  });
});

$(document).ready(function () {
  $(".all_noidung_vanban_kiemsoat").click(function () {
    var id = $(this).data("id");
    var type = $(this).data("type");
    $.ajax({
      type: "POST",
      url: "ajax/noidung_vbks.php",
      data: { id: id, type: type },
      success: function (result) {
        $("#popup_noidung_vbks .modal-body").html(result);
        $("#popup_noidung_vbks").modal("show");
      },
    });
  });
});

if (document.getElementById("sheetsIframe")) {
  function createDownloadLink() {
    const iframeContainer = document.getElementById("link_excel");
    if (iframeContainer) {
      // Lấy thuộc tính src của iframe
      const iframeSrc = iframeContainer.value;
      // Tìm ID xuất bản trong src
      const regex = /\/d\/([a-zA-Z0-9_-]+)\//;
      const match = iframeSrc.match(regex);
      if (match && match[1]) {
        const publishedId = match[1];
        // Tạo URL tải xuống
        const downloadUrl = `https://docs.google.com/spreadsheets/d/${publishedId}/export?format=xlsx`;
        // Cập nhật href của liên kết tải xuống
        const downloadLink = document.getElementById("downloadLink");
        downloadLink.href = downloadUrl;
      } else {
        console.error("Published ID not found");
      }
    } else {
      console.error("Div container for iframe not found");
    }
  }
  $(document).ready(function () {
    createDownloadLink();
  });
}

