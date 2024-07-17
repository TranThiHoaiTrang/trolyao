<?php
    $linkMan = "index.php?com=rating&act=man&type=rating&p=".$curPage;
    $linkSave = "index.php?com=rating&act=save&type=rating&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="<?=$linkMan?>" title="Quản lý đánh giá">Quản lý đánh giá</a></li>
                <li class="breadcrumb-item active">Chi tiết đánh giá</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <!-- <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button> -->
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Thông tin đánh giá</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="ten">Họ tên:</label>
                        <input type="text" class="form-control" name="data[ten]" id="ten" placeholder="Họ tên" value="<?=@$item['ten']?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="noidung">Nội dung:</label>
                    <textarea class="form-control" name="data[noidung]" id="noidung" rows="5" placeholder="Nội dung" readonly><?=@$item['noidung']?></textarea>
                </div>
                <!-- <div class="form-group">
                    <label for="noidung">Hình ảnh đánh giá:</label>
                    <?php if(!empty(@$item['photo'])) {?>
                    <div class="all_hinhanh_danhgia">
                        <?php 
                        $hinhanh_danhgia  = explode(',',@$item['photo']);
                        ?>
                        <div class="row">
                            <?php
                            foreach($hinhanh_danhgia as $v) {?>
                            <div class="col-md-2 mb-3">
                                <div class="img_dg">
                                    <img style="width: 100%;object-fit: cover;" src="<?=  UPLOAD_PHOTO . $v?>" alt="" width="200" height="200">
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div> -->
                <div class="form-group">
                    <label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                    <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt']) ? $item['stt'] : 1?>">
                </div>
            </div>
        </div>
        <div class="card-footer text-sm">
            <!-- <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button> -->
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=@$item['id']?>">
        </div>
    </form>
</section>