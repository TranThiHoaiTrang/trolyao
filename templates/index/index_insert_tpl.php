<?php

date_default_timezone_set('Asia/Ho_Chi_Minh');
$filePath = 'combined_data.json';

$jsonString = file_get_contents($filePath);

$jsonArray = json_decode($jsonString, true);
foreach ($jsonArray as &$article) {
    /* Gán dữ liệu */
    $data = array();
    $data['stt'] = '1';
    $data['type'] = 'van-ban';
    $data['hienthi'] = '1';
    $data['noibat'] = '1';
    $data['id_list'] = '199';
    if($article['loaivanban'] == 'Công điện'){
        $data['id_cat'] = '98';
    }
    elseif($article['loaivanban'] == 'Chương trình'){
        $data['id_cat'] = '99';
    }
    elseif($article['loaivanban'] == 'Nghị quyết'){
        $data['id_cat'] = '100';
    }
    elseif($article['loaivanban'] == 'Văn bản hợp nhất'){
        $data['id_cat'] = '101';
    }
    elseif($article['loaivanban'] == 'Thông báo'){
        $data['id_cat'] = '102';
    }
    elseif($article['loaivanban'] == 'Chỉ thị'){
        $data['id_cat'] = '103';
    }
    elseif($article['loaivanban'] == 'Nghị định'){
        $data['id_cat'] = '104';
    }
    elseif($article['loaivanban'] == 'Thông tư'){
        $data['id_cat'] = '105';
    }
    elseif($article['loaivanban'] == 'Hướng dẫn'){
        $data['id_cat'] = '106';
    }
    elseif($article['loaivanban'] == 'Công văn'){
        $data['id_cat'] = '107';
    }
    elseif($article['loaivanban'] == 'Quyết định'){
        $data['id_cat'] = '108';
    }
    elseif($article['loaivanban'] == 'Kế hoạch'){
        $data['id_cat'] = '109';
    }
    else{
        $data['id_cat'] = '';
    }

    $data['tenvi'] = $article['tieude'];
    $data['tenkhongdauvi'] = $article['file_name'];
    $data['slugvi'] = str_replace('-', '', $data['tenkhongdauvi']);

    $date = DateTime::createFromFormat('d/m/Y', $article['ngaybanhanh'], new DateTimeZone('Asia/Ho_Chi_Minh'));
    $timestamp = $date->getTimestamp();
    $data['ngaybanhanh'] = $timestamp;

    $data['taptin'] = $article['file'];
    $data['taptin_word'] = $article['file_word'];
    $data['coquanbanhanh'] = $article['coquanbanhanh'];
    $data['sohieu'] = $article['sohieu'];

    $linhvuc = $article['linhvuc'];
    $result = implode(', ', $linhvuc) . ', ';
    $result = rtrim($result, ', ');
    $data['linhvuc'] = $result;

    var_dump($data);
    if($d->insert('product_danhmuc',$data)){
        var_dump("insert thành công");
    }
    else{
        var_dump("insert không thành công");
    }
}
?>
