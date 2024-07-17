<div class="photoUpload-zone photoUpload-zone-static media-zone">
    <div class="photoUpload-detail photoUpload-preview media-preview">
        <?php
        $tbl = @$table_name ?? '';
        $tbl_key = @$table_key ?? '';
        $id = @$item['id'] ?? 0;
        $title = $title ?? 'Ảnh';
        $photoDetail = $photoDetail ?? '';
        if ( $photoDetail ) :
        ?>
        <img class="rounded" src="<?= Helper::thumbnail_link( $photoDetail, 400, 400);?>" alt />
        <span class="photo-remove" data-id="<?=$id?>" data-tpl="<?=$tbl?>" data-key="<?=$tbl_key?>"><i class="fa-thin fa-xmark"></i>Xóa <?=mb_strtolower( $title )?></span>
        <?php else : ?>
        <img class="rounded" src="<?=ADMIN_ASSETS?>images/noimage.png" alt="No Image"/>
        <?php endif; ?>
    </div>
    <div class="photoUpload-file">
        <?php $input_name = $input_name ?? 'photo'?>
        <input class="elfinder-single media-input" name="single-<?=$input_name?>" type="text" title />
        <div class="photoUpload-group">
            <i class="icon-jfi-cloud-up-o"></i>
            <p class="photoUpload-choose btn btn-sm bg-gradient-success"><?=$title?></p>
        </div>
    </div>
    <?php if ( !empty( @$dimension ) ) : ?>
        <div class="photoUpload-dimension"><?=@$dimension?></div>
    <?php endif?>
</div>

