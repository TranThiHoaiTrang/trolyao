$(function () {
  const mceElf = new tinymceElfinder({
    url: ADMIN_URL + "elFinder/php/elfinder_config.php",
    uploadTargetHash: "l1_Lw", // Hash value on elFinder of writable folder
    nodeId: "elfinder", // Any ID you decide
  });

  // init tinyMCE 5
  tinymce.init({
    selector: "textarea.ckeditor",
    referrer_policy: "origin",
    content_css_cors: true,
    entity_encoding: "raw",
    setup: function (editor) {
      editor.on("change", function () {
        tinymce.triggerSave();
      });

      editor.ui.registry.addButton("note", {
        text: "Note",
        icon: "comment",
        onAction: function () {
          openNoteDialog(editor, "");
        },
      });

      editor.on("init", function () {
        editor.getDoc().addEventListener("click", function (event) {
          if (event.target.classList.contains("note")) {
            var noteContentElement =
              event.target.querySelector(".note_content");
            if (noteContentElement) {
              var noteContent = noteContentElement.innerHTML;
              openNoteDialog(editor, noteContent, event.target);
            }
          }
        });
      });

      editor.ui.registry.addButton("elfinder_images", {
        icon: "gallery",
        tooltip: "elFinder gallery",
        disabled: false,
        onAction: function (_) {
          let elfNode = $("<div/>");
          elfNode.dialogelfinder({
            title: "File Manager",
            width: "85%",
            height: "90%",
            url: ADMIN_URL + "elFinder/php/elfinder_config.php",
            commandsOptions: {
              getfile: { multiple: true },
            },
            getFileCallback: (files, fm) => {
              let gallery = "";
              let urls = $.map(files, function (f) {
                return f.url;
              });
              if (urls) {
                let _rand = btoa(Math.random().toString()).substring(10, 14);
                gallery +=
                  '<div class="alfinder-gallery gallery" id="gallery-' +
                  _rand +
                  '">';
                $.each(urls, function (index, item) {
                  gallery +=
                    '<figure class="gallery-item"><img src="' +
                    item +
                    '" alt></figure>';
                });
                gallery += "</div>";
                editor.insertContent(gallery);
              }
              elfNode.dialogelfinder("close");
            },
          });
        },
      });
      
      editor.on("init", function () {
        var style = document.createElement("style");
        style.innerHTML = `
        .note { background-color: yellow; cursor: pointer; position: relative; }
        .note_content { display:none; }
        .note .note_content { position: absolute; top: 100%; left: 0; background-color: #fff; border: 1px solid #000; padding: 5px; z-index: 100; white-space: pre-wrap; }
    `;
        editor.getDoc().head.appendChild(style);

        // Thêm sự kiện click cho box note
        editor.on("click", function (event) {
          if (event.target.classList.contains("note_content")) {
            // Lấy nội dung ghi chú
            var noteContentElement = event.target.closest(".note_content");
            if (noteContentElement) {
              var noteContent = noteContentElement.innerHTML;
              openNoteDialog(editor, noteContent, event.target);
            }
          }
        });
      });
    },

    plugins: [
      "advlist anchor autolink autoresize autosave image link media charmap",
      "code codesample directionality emoticons",
      "fullscreen help hr importcss insertdatetime",
      "link lists nonbreaking noneditable pagebreak paste",
      "preview media print quickbars save searchreplace tabfocus table",
      "template textpattern visualblocks visualchars wordcount",
    ],

    toolbar: [
      "formatselect bold italic underline strikethrough blockquote bullist numlist | align lineheight indent outdent | link unlink fullscreen",
      "removeformat searchreplace emoticons charmap | forecolor backcolor hr superscript subscript table | media image elfinder_images visualchars code codesample help",
      "note",
    ],

    codesample_languages: [
      { text: "HTML/XML", value: "markup" },
      { text: "JavaScript", value: "javascript" },
      { text: "CSS", value: "css" },
      { text: "PHP", value: "php" },
      { text: "Ruby", value: "ruby" },
      { text: "Python", value: "python" },
      { text: "Java", value: "java" },
      { text: "C", value: "c" },
      { text: "C#", value: "csharp" },
      { text: "C++", value: "cpp" },
    ],

    fontsize_formats:
      "13px 14px 15px 16px 18px 20px 24px 30px 32px 36px 40px 45px",
    block_formats:
      "Paragraph=p;H1=h1;H2=h2;H3=h3;H4=h4;H5=h5;H6=h6;Preformatted=pre;Div=div;",
    quickbars_insert_toolbar: false,
    quickbars_selection_toolbar:
      "bold italic quicklink unlink removeformat align forecolor table media image quickimage",
    help_tabs: ["shortcuts"],
    browser_spellcheck: true,
    relative_urls: false,
    remove_script_host: false,
    menubar: false,
    min_height: 200,
    toolbar_sticky: true,
    image_advtab: true,
    image_caption: true,
    convert_urls: false,
    forced_root_block: "p",

    end_container_on_empty_block: true,

    formats: {
      aligncenter: {
        selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img",
        classes: "aligncenter",
        styles: {
          marginLeft: "auto",
          marginRight: "auto",
          display: "block",
        },
      },
    },

    file_picker_callback: mceElf.browser,
    images_upload_handler: mceElf.uploadHandler,

    content_style: `
			.mce-content-body { font-size: 16px; }
			.mce-content-body h1 { font-size: 38px; }
			.mce-content-body h2 { font-size: 31px; }
			.mce-content-body h3 { font-size: 25px; }
			.mce-content-body h4 { font-size: 21px; }
			.mce-content-body h5 { font-size: 18px; }
			.mce-content-body h6 { font-size: 16px; }
			img { max-width: 100%; }
			.alfinder-gallery { margin: -10px; }
			.alfinder-gallery .gallery-item { padding: 5px; display: inline-block; }
			.alfinder-gallery .gallery-item img { display: block; max-width: 800px; object-position: center; object-fit: cover; }
		`,
  });

  // Thêm công cụ chèn link vào toolbar
  function openNoteDialog(editor, noteContent, targetElement) {
    // Kiểm tra xem noteContent có giá trị hay không
    if (!noteContent) {
      noteContent = ""; // Nếu không, thiết lập là chuỗi rỗng
    }

    var noteEditorHTML =
      '<div id="noteTinyMCEEditor" style="width:100%; height: 450px;">' +
      noteContent +
      "</div>";

    var dialog = editor.windowManager.open({
      title: "Edit Note",
      body: {
        type: "panel",
        items: [
          {
            type: "htmlpanel",
            html: noteEditorHTML,
          },
        ],
      },
      buttons: [
        {
          type: "submit",
          text: "Save",
          primary: true,
        },
        {
          type: "cancel",
          text: "Cancel",
        },
      ],
      onSubmit: function (api) {
        var updatedNoteContent = tinymce.get("noteTinyMCEEditor").getContent();
        var mainContent = editor.selection.getContent({ format: "html" });
        
        if (targetElement) {
          // Kiểm tra xem targetElement đã có nội dung "note" hay chưa
          var existingNote = targetElement.querySelector(".note_content");
          // console.log(targetElement);
          if (existingNote) {
            // Nếu đã có nội dung "note", cập nhật nội dung của nó
            existingNote.innerHTML = mainContent; // Chỉ cập nhật phần nội dung chính
            var existingNoteContent = targetElement.querySelector(".note_content");
            // console.log(existingNoteContent);
            if (existingNoteContent) {
              existingNoteContent.innerHTML = updatedNoteContent; // Cập nhật nội dung của .note_content
            } else {
              // Thêm nội dung .note_content nếu không tồn tại
              existingNote.innerHTML +=
                '<div id="notcontent" class="note_content">' +
                updatedNoteContent +
                "</div>";
            }
          } else {
            // Nếu chưa có, thêm nội dung mới vào cuối nội dung chính của targetElement
            // targetElement.innerHTML += noteHTML; // Thay vì +=, chỉ cập nhật toàn bộ nội dung
          }
        } else {
          var noteHTML =
          '<div class="note">' +
          mainContent +
          '<div id="notcontent" class="note_content">' +
          updatedNoteContent +
          "</div></div>";
          // Nếu không có targetElement, chèn nội dung vào trình soạn thảo
          editor.insertContent(noteHTML);
        }

        api.close();
      },
    });
    var existingEditor = tinymce.get("noteTinyMCEEditor");
    if (existingEditor) {
      existingEditor.destroy(); // Destroy existing editor if it exists
    }

    tinymce.init({
      selector: "#noteTinyMCEEditor",
      height: 450,
      menubar: false,
      plugins: "link",
      toolbar: "bold italic underline link",
    });
  }

  // Function to escape HTML entities
  function escapeHtml(text) {
    var map = {
      "&": "&amp;",
      "<": "&lt;",
      ">": "&gt;",
      '"': "&quot;",
      "'": "&#39;",
      "/": "&#x2F;",
    };
    return text.replace(/[&<>"'\/]/g, function (m) {
      return map[m];
    });
  }

  // init tinyMCE 5 minimal
  tinymce.init({
    selector: "textarea.mce-minimal",
    referrer_policy: "origin",
    content_css_cors: true,
    entity_encoding: "raw",
    setup: function (editor) {
      editor.on("change", function () {
        tinymce.triggerSave();
      });
    },

    plugins: [
      "advlist anchor autolink autoresize autosave image charmap",
      "code codesample directionality emoticons",
      "fullscreen help hr importcss insertdatetime",
      "link lists nonbreaking noneditable pagebreak paste",
      "preview media print quickbars save searchreplace tabfocus table",
      "template textpattern visualblocks visualchars wordcount",
    ],

    toolbar: [
      "formatselect bold italic underline strikethrough bullist numlist align | link unlink | table image forecolor backcolor fullscreen",
    ],

    block_formats:
      "Paragraph=p;H1=h1;H2=h2;H3=h3;H4=h4;H5=h5;H6=h6;Preformatted=pre;Div=div;",
    quickbars_insert_toolbar: false,
    quickbars_selection_toolbar:
      "bold italic quicklink unlink removeformat align forecolor table media image",
    help_tabs: ["shortcuts"],
    browser_spellcheck: true,
    relative_urls: false,
    remove_script_host: false,
    menubar: false,
    min_height: 150,
    toolbar_sticky: true,

    // visual blocks_default_state: true,
    content_style:
      ".mce-content-body {font-size: 16px;} .mce-content-body h1 {font-size: 38px;} .mce-content-body h2 {font-size: 31px;} .mce-content-body h3 {font-size: 25px;} .mce-content-body h4 {font-size: 21px;} .mce-content-body h5 {font-size: 18px;} .mce-content-body h6 {font-size: 16px;} img {max-width: 100%;}",
    convert_urls: false,
    forced_root_block: "p",

    // End container block element when pressing enter inside an empty block
    end_container_on_empty_block: true,

    formats: {
      aligncenter: {
        selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img",
        classes: "aligncenter",
        styles: { marginLeft: "auto", marginRight: "auto", display: "block" },
      },
    },

    // elFinder
    file_picker_callback: mceElf.browser,
    images_upload_handler: mceElf.uploadHandler,
  });
});
