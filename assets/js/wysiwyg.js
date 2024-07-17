/*jshint esversion: 6 */

// init tinyMCE5
tinymce.init({
  selector: "textarea.tinycke",
  content_css: "./assets/css/tinymce.css",
  setup: function (editor) {
    editor.on("change", function () {
      tinymce.triggerSave();
      // checkSpelling();
    });
    editor.on("init", function () {
      var iframe = editor.getDoc();
      // Bắt sự kiện hover khi con trỏ chuột di chuyển qua các phần tử
      $(iframe).on("mouseenter", ".shortened", function () {
        $(this).find("em").fadeIn(300);
      });

      $(iframe).on("mouseleave", ".shortened", function () {
        $(this).find("em").fadeOut(300);
      });
    });
  },
  plugins: [
    //"codemirror",
    "advlist anchor autolink autoresize autosave image charmap",
    "code codesample directionality emoticons",
    "fullscreen help hr importcss insertdatetime",
    "link lists nonbreaking noneditable pagebreak paste",
    "preview print quickbars save searchreplace tabfocus table",
    "template textpattern visualblocks visualchars wordcount tinymcespellchecker",
  ],
  toolbar: [
    "formatselect bold italic underline strikethrough tinymcespellchecker blockquote bullist numlist alignjustify alignleft aligncenter alignright link unlink fullscreen",
    "removeformat searchreplace charmap table forecolor backcolor hr superscript subscript codesample visualchars code help",
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

  // fontsize_formats: "13px 14px 15px 16px 18px 20px 24px 30px 32px 36px 40px 45px",
  block_formats:
    "Paragraph=p;H1=h1;H2=h2;H3=h3;H4=h4;H5=h5;H6=h6;Preformatted=pre;Div=div;",
  quickbars_insert_toolbar: false,
  quickbars_selection_toolbar:
    "bold italic quicklink unlink removeformat alignjustify alignleft aligncenter alignright forecolor",
  help_tabs: ["shortcuts"],
  browser_spellcheck: true,
  relative_urls: false,
  remove_script_host: false,
  menubar: true,
  min_height: 620,
  //max_height: 800,
  toolbar_sticky: true,
  editor_encoding: "raw",

  visualblocks_default_state: true,
  content_style: ".mce-content-body {font-size: 16px;} img {max-width: 100%;}",
  convert_urls: false,
  forced_root_block: "p",

  // End container block element when pressing enter inside an empty block
  end_container_on_empty_block: true,

  // responsivefilemanager plugin

  external_filemanager_path: "/admin/filemanager/",
  filemanager_title: "Media Manager",
  external_plugins: {
    responsivefilemanager:
      "/admin/js/plugins/responsivefilemanager/plugin.min.js",
    filemanager: "/admin/js/plugins/filemanager/plugin.min.js",
  },
  filemanager_access_key: "adkey_dmsKHpm5624sf",

  // codemirror
});
