<div class="gallery-zone media-zone">
    <div class="gallery-detail gallery-preview media-preview">
        <div class="gallery-inner">
            <?php
            $tbl = @$table_name ?? '';
            $tbl_key = @$table_key ?? '';
            $id = @$item['id'] ?? 0;
            $title = $title ?? 'Gallery';

            if ( !empty( $single_gallery ) ) :
                $gallery = explode( ',', $single_gallery );

                //echo '<div class="gallery-inner">';
                foreach ( $gallery as $gal ) :
                    if ( $gal ) :
            ?>
            <span class="gallery-item">
                <img src="<?= Helper::thumbnail_link( $gal, 180, 180);?>" alt="" />
                <span class="gallery-item-remove" data-id="<?=$id?>" data-tpl="<?=$tbl?>" data-link="<?=$gal?>" title="Xóa ảnh"><i class="fas fa-times"></i></span>
            </span>
            <?php endif; endforeach; endif; ?>
        </div>

        <?php if ( !empty( $single_gallery ) ) echo '<span class="photo-remove" data-id="' . $id . '" data-tpl="' . $tbl . '" data-key="' . $tbl_key . '" title="Xóa tất cả"><i class="fas fa-times"></i>Xóa ' . mb_strtolower( $title ) . '</span>'; ?>
    </div>
    <div class="gallery-file">
        <?php $textarea_name = $textarea_name ?? 'gallery'?>
        <textarea class="elfinder-gallery media-textarea" name="single-<?=$textarea_name?>" title></textarea>
        <div class="gallery-group">
            <i class="icon-jfi-cloud-up-o"></i>
            <p class="gallery-choose btn"><?=$title?></p>
        </div>
    </div>
    <?php if ( !empty( $dimension ) ) : ?>
        <div class="gallery-dimension hidden"><?=$dimension?></div>
    <?php endif?>
</div>
