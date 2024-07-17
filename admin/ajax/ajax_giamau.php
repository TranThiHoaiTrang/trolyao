<?php
global $d;
include __DIR__ . "/ajax_config.php";
	
	$idpro = (isset($_POST['idpro']) && $_POST['idpro'] > 0) ? htmlspecialchars($_POST['idpro']) : 0;
    $id_mau = (isset($_POST['id_mau']) && $_POST['id_mau'] > 0) ? htmlspecialchars($_POST['id_mau']) : 0;
	$id_size = (isset($_POST['id_size']) && $_POST['id_size'] > 0) ? htmlspecialchars($_POST['id_size']) : 0;
    
	$row_detail = $d->rawQueryOne("select * from #_product where id = ? and hienthi>0 and type='san-pham'",array($idpro));
	$size = $d->rawQuery("select id, ten$lang from #_product_size where type='san-pham' and find_in_set(id,'".$row_detail['id_size']."') and hienthi > 0 order by stt,id desc");
	$mau = $d->rawQuery("select loaihienthi, photo, mau, id from #_product_mau where type='san-pham' and find_in_set(id,'".$row_detail['id_mau']."') and hienthi > 0 order by stt,id desc");
	$giasize = explode("/", $row_detail['giasize']);


	if($id_size != 0){
        foreach($giasize as $g){
            $giasize_one = explode("_", $g);
            $id_mau_all[] = $giasize_one[0].'_'.$giasize_one[1];
        }
        // var_dump($id_mau_all);
        foreach($id_mau_all as $idmau){
            $id_mau_ex = explode("_", $idmau);
                if($id_mau_ex[0] == $id_size){
                    // var_dump($id_mau_ex[0]);
                    // $_SESSION['giasize'] = $id_mau_ex[2];
                ?>
                    <span class="price-new-pro-detail">
                                    <?=(!empty($id_mau_ex[1])) ? $func->format_money($id_mau_ex[1]) : $func->format_money($row_detail['gia'])?>
                                </span>
                <?php 
                }
        }
    }else{ ?>
        <span class="price-new-pro-detail"><?=$func->format_money($row_detail['gia'])?></span>
    <?php } ?>
