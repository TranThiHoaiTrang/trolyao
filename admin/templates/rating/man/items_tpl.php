<?php
$linkMan = "index.php?com=rating&act=man&type=rating&p=" . $curPage;
$linkEdit = "index.php?com=rating&act=edit&type=rating&p=" . $curPage;
$linkDelete = "index.php?com=rating&act=delete&type=rating&p=" . $curPage;

function get_phantram_rating_people($id = 0)
{
    global $d;
    if ($id) {
        $row = $d->rawQuery("select * from #_rating where id = ?", array($id));

        $rating_tong = 0;
        $tongrating = 0;
        foreach ($row as $v) {
            $tongrating += $v['rating'];
        }
        $rating_tong = round($tongrating / count($row), 1);
        $phantranrating = round($rating_tong * 10);
        return (($phantranrating * 10) / 5);
    } else {
        return false;
    }
}
?>
<style>
    .rating--inner-top {
        display: flex;
        align-items: center;
    }

    .rating {
        margin-right: 5px;
        position: relative;
    }

    .rating--inner-top ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        flex-direction: row-reverse;
        position: relative;
    }

    .rating--inner-top ul li {
        padding-right: 5px;
        display: flex;
        align-items: center;
    }

    .rating--inner-top ul li i {
        color: #ffd500;
        font-weight: 400;
        font-size: 0.84375rem;
        font-family: 'Font Awesome 6 Pro';
    }

    .rating--inner-top .rating>span {
        position: absolute;
        left: 0;
        top: -2px;
        overflow: hidden;
        display: block;
        pointer-events: none;
        transition: 0.1s;
        width: 0;
        height: 100%;
    }

    .rating--inner-top .rating>span::before {
        content: "\f005\f005\f005\f005\f005";
        font-weight: 700;
        letter-spacing: 5px;
        font-size: 0.84375rem;
        line-height: normal;
        font-family: 'Font Awesome 6 Pro';
        color: #ffd500;
        display: block;
    }
</style>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Quản lý liên hệ</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card-footer text-sm sticky-top">
        <a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?= $linkDelete ?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
        <div class="form-inline form-search d-inline-block align-middle ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar text-sm" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="<?= (isset($_GET['keyword'])) ? $_GET['keyword'] : '' ?>" onkeypress="doEnter(event,'keyword','<?= $linkMan ?>')">
                <div class="input-group-append bg-primary rounded-right">
                    <button class="btn btn-navbar text-white" type="button" onclick="onSearch('keyword','<?= $linkMan ?>')">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-primary card-outline text-sm mb-0">
        <div class="card-header">
            <h3 class="card-title">Danh sách liên hệ</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="align-middle" width="5%">
                            <div class="custom-control custom-checkbox my-checkbox">
                                <input type="checkbox" class="custom-control-input" id="selectall-checkbox">
                                <label for="selectall-checkbox" class="custom-control-label"></label>
                            </div>
                        </th>
                        <th class="align-middle text-center" width="10%">STT</th>
                        <th class="align-middle">Họ tên</th>
                        <th class="align-middle">Bài viết</th>
                        <th class="align-middle">Rating</th>
                        <th class="align-middle text-center">Xác nhận</th>
                        <th class="align-middle text-center">Thao tác</th>
                    </tr>
                </thead>
                <?php if (empty($items)) { ?>
                    <tbody>
                        <tr>
                            <td colspan="100" class="text-center">Không có dữ liệu</td>
                        </tr>
                    </tbody>
                <?php } else { ?>
                    <tbody>
                        <?php for ($i = 0; $i < count($items); $i++) { ?>
                            <tr>
                                <td class="align-middle">
                                    <div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input select-checkbox" id="select-checkbox-<?= $items[$i]['id'] ?>" value="<?= $items[$i]['id'] ?>">
                                        <label for="select-checkbox-<?= $items[$i]['id'] ?>" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?= $items[$i]['stt'] ?>" data-id="<?= $items[$i]['id'] ?>" data-table="rating">
                                </td>
                                <td class="align-middle">
                                    <a class="text-dark" href="<?= $linkEdit ?>&id=<?= $items[$i]['id'] ?>" title="<?= $items[$i]['ten'] ?>"><?= $items[$i]['ten'] ?></a>
                                </td>
                                <td class="align-middle">
                                    <?php 
                                    $sp_danhgia = $d->rawQueryOne("select * from #_product where type = 'san-pham' and id = '".$items[$i]['id_product']."' and hienthi > 0 order by stt,id desc");
                                    ?>
                                    <a class="text-dark" href="<?= $linkEdit ?>&id=<?= $items[$i]['id'] ?>" title="<?= $sp_danhgia['tenvi'] ?>"><?= $sp_danhgia['tenvi'] ?></a>
                                </td>
                                <td class="align-middle">
                                    <div class="rating-system_top">
                                        <div class="rating--inner-top ">
                                            <div class="rating">
                                                <ul>
                                                    <li data-star="5"><i class="fal fa-star"></i></li>
                                                    <li data-star="4"><i class="fal fa-star"></i></li>
                                                    <li data-star="3"><i class="fal fa-star"></i></li>
                                                    <li data-star="2"><i class="fal fa-star"></i></li>
                                                    <li data-star="1"><i class="fal fa-star"></i></li>
                                                </ul>
                                                <span style="width:<?= $func->get_phantram_rating_people($items[$i]['id']) ?>%;"></span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-<?= $items[$i]['id'] ?>" data-table="rating" data-id="<?= $items[$i]['id'] ?>" data-loai="hienthi" <?= ($items[$i]['hienthi']) ? 'checked' : '' ?>>
                                        <label for="show-checkbox-<?= $items[$i]['id'] ?>" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-md text-nowrap">
                                    <a class="text-primary mr-2" href="<?= $linkEdit ?>&id=<?= $items[$i]['id'] ?>" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                    <a class="text-danger" id="delete-item" data-url="<?= $linkDelete ?>&id=<?= $items[$i]['id'] ?>" title="Xóa"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
    <?php if ($paging) { ?>
        <div class="card-footer text-sm pb-0">
            <?= $paging ?>
        </div>
    <?php } ?>
    <div class="card-footer text-sm">
        <a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?= $linkDelete ?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
    </div>
</section>