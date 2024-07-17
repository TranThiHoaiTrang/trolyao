$(function () {

    //... elfinder inline
    let elfinder_section = $('#elfinder-section');
    if ( elfinder_section.length > 0 ) {
        let elf = elfinder_section.elfinder({
            title : 'Thư viện ảnh',
            width : '100%',
            height: '88%',
            resizable: false,
            url: ADMIN_URL + 'elFinder/php/elfinder_config.php',
            commandsOptions: {
                getfile: {
                    multiple: true
                }
            },
            // themes: {
            //     'mt-light': 'https://robinn1.github.io/elFinder-Material-Theme/manifests/light.json',
            //     'mt-gray': 'https://robinn1.github.io/elFinder-Material-Theme/manifests/gray.json',
            //     'mt-darkblue': 'https://robinn1.github.io/elFinder-Material-Theme/manifests/darkblue.json',
            // },
            // theme: 'mt-light',
        });
    }

    //...
    let elfinder_gallery = $('.elfinder-gallery');
    elfinder_gallery.each((index, el) => {
        $(el).on('click', function () {

            let $this = $(this);
            let elfNode = $('<div/>');

            elfNode.dialogelfinder({
                title : 'File Manager',
                width : '85%',
                height : '90%',
                url: ADMIN_URL + 'elFinder/php/elfinder_config.php',
                commandsOptions: {
                    getfile: {
                        multiple: true
                    }
                },
                getFileCallback: (files, fm) => {
                    let image_ele = '';
                    let urls = $.map(files, function(f) { return f.url; });
                    if ( urls ) {
                        let gallery_preview = $this.closest('.gallery-zone').find('.gallery-preview .gallery-inner');
                        //image_ele += '<div class="gallery-inner">';

                        let save_fileUrl = '';
                        $.each(urls, function(index, item) {
                            image_ele += '<span><img src="' + item + '" alt></span>';
                            if ( index > 0 ) {
                                save_fileUrl += ',';
                            }

                            //save_fileUrl += item.replace(/(https?:)?\/\/[^\/]+/i, "").replace(/\/upload\//, "");
                            save_fileUrl += item.replace(BASE_URL, "").replace(/upload\//, "");
                        });

                        //image_ele = image_ele + '</div>';
                        gallery_preview.append( image_ele );

                        $this.val(save_fileUrl);
                    }

                    elfNode.dialogelfinder('close');
                },
            });
        });
    });

    //...
    let elfinder_file = $('.elfinder-file');
    elfinder_file.each((index, el) => {
        $(el).on('click', function () {
            let $this = $(this);
            let elfNode = $('<div/>');

            elfNode.dialogelfinder({
                title : 'File Manager',
                width : '85%',
                height : '90%',
                url: ADMIN_URL + 'elFinder/php/elfinder_config.php',
                getFileCallback: (file, fm) => {
                    let fileUrl = file.url;
                    if ( ! fileUrl ) {
                        file = file[0];
                        fileUrl = file.url;
                    }

                    if ( fileUrl ) {
                        let fileUpload_preview = $this.closest('.fileUpload-zone').find('.fileUpload-preview');
                        let file_ele = '<a class="tmp-name" href="' + fileUrl + '" download>' + filename(fileUrl) + '</a>';
                        fileUpload_preview.html( file_ele );

                        let save_fileUrl = fileUrl.replace(BASE_URL, "").replace(/upload\//, "");
                        $this.val(save_fileUrl);
                    }

                    elfNode.dialogelfinder('close');
                },
            });
        });
    });

    //...
    let elfinder_single = $('.elfinder-single');
    elfinder_single.each((index, el) => {
        $(el).on('click', function () {

            let $this = $(this);
            let elfNode = $('<div/>');

            elfNode.dialogelfinder({
                title : 'File Manager',
                width : '85%',
                height : '90%',
                url: ADMIN_URL + 'elFinder/php/elfinder_config.php',
                getFileCallback: (file, fm) => {
                    let fileUrl = file.url;
                    if ( ! fileUrl ) {
                        file = file[0];
                        fileUrl = file.url;
                    }

                    if ( fileUrl ) {
                        let photoUpload_preview = $this.closest('.photoUpload-zone').find('.photoUpload-preview');
                        let image_ele = '<img class="rounded" src="' + fileUrl + '" alt="Preview Image">';
                        photoUpload_preview.html( image_ele );

                        //let save_fileUrl = fileUrl.replace(/(https?:)?\/\/[^\/]+/i, "").replace(/\/upload\//, "");
                        let save_fileUrl = fileUrl.replace(BASE_URL, "").replace(/upload\//, "");
                        $this.val(save_fileUrl);
                    }

                    elfNode.dialogelfinder('close');
                },
            });
        });
    });

    //...
    let gallery_item_remove = $('.gallery-item-remove');
    gallery_item_remove.each(function(index, el) {
        $(el).on('click', function (e) {
            if (confirm('Xác nhận xóa?') === true) {
                let $this = $(this);

                $.ajax({
                    context: this,
                    type: 'POST',
                    url: ADMIN_URL + 'ajax/banners/gallery_item_remove.php',
                    data: {
                        'id': $this.data('id'),
                        'tpl': $this.data('tpl'),
                        'link': $this.data('link'),
                    },
                    success: function (response) {
                        $this.closest('.gallery-item').fadeOut(150);
                    }
                });
            }
        });
    });

    //...
    let photo_remove = $('.photo-remove');
    photo_remove.on('click', function (e) {
        if (confirm('Xác nhận xóa?') === true) {

            let media_zone = $(this).closest('.media-zone');
            let $this = $(this);

            $.ajax({
                context: this,
                type: 'POST',
                url: ADMIN_URL + 'ajax/banners/remove.php',
                data: {
                    'id': $this.data('id'),
                    'tpl': $this.data('tpl'),
                    'key': $this.data('key'),
                },
                success: function (response) {
                    $this.remove();
                    media_zone.find('.media-preview').find('.tmp-name').remove();
                    media_zone.find('.media-preview').find('.rounded').remove();
                    media_zone.find('.media-preview').find('.gallery-inner').remove();
                }
            });
        }
    });

    //...
    let select_change_event = $('.select-change-event');
    select_change_event.on('change', function (e) {

        let event = $(this).data('event');
        let com = $(this).data('com');
        let act = $(this).data('act');

        let url = ADMIN_URL + 'index.php?com=' + com + '&act=' + act;
        let _value = $(this).val();

        if ( _value ) {
            url = url + '&' + event + '=' + _value;
        }

        redirect(url);
    });

    /**
     * @param repo
     * @return {*}
     */
    function templateResult_callback( repo ) {
        if (repo.loading) {
            return repo.text;
        }
        return repo.title;
    }

    /**
     * @param repo
     * @return {*}
     */
    function templateSelection__callback( repo ) {
        return repo.title || repo.text;
    }
});

/**
 * @param url
 */
function on_filter_category(url) {
    url = filter_category(url);
    redirect(url);
}

/**
 *
 * @param path
 * @return {*}
 */
function filename(path) {
    path = path.substring(path.lastIndexOf("/")+ 1);
    return (path.match(/[^.]+(\.[^?#]+)?/) || [])[0];
}
