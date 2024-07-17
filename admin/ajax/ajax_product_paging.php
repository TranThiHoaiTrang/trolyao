<?php
global $d;
include __DIR__ . "/ajax_config.php";

	/* Paginations */
	include LIBRARIES_PATH."class/class.PaginationsAjax.php";
	$pagingAjax = new PaginationsAjax();
	$pagingAjax->perpage = (htmlspecialchars($_GET['perpage']) && $_GET['perpage'] > 0) ? htmlspecialchars($_GET['perpage']) : 1;
	$eShow = htmlspecialchars($_GET['eShow']);

 
	//$namelist = $_GET['namelist'];//(isset($_GET['namelist']) && $_GET['namelist'] !='') ? htmlspecialchars($_GET['namelist']) : 0;

	$p = (isset($_GET['p']) && $_GET['p'] > 0) ? htmlspecialchars($_GET['p']) : 1;
	$id = (isset($_GET['id']) && $_GET['id']!='') ? htmlspecialchars($_GET['id']) : '';
	$idl = (isset($_GET['idl']) && $_GET['idl']!='') ? (int)$_GET['id'] : 0;
	$start = ($p-1) * $pagingAjax->perpage;
	$pageLink = "ajax/ajax_product_paging.php?perpage=".$pagingAjax->perpage;
	$tempLink = "";
	$where = "";
	if($idl>0){
		$where = " and id_list=".$idl;
	}
	 
	$tempLink .= "&p=";
	$pageLink .= $tempLink;

	/* Get data */
	$sql = "select * from #_product where type='san-pham' $where and noibat > 0 and hienthi > 0 order by stt,id desc";
	$sqlCache = $sql." limit $start, $pagingAjax->perpage";
    $items = $cache->getCache($sqlCache,'result',7200);

	/* Count all data */
	$countItems = count($cache->getCache($sql,'result',7200));

	/* Get page result */
	$pagingItems = $pagingAjax->getAllPageLinks($countItems, $pageLink, $eShow,$id);
	

	
?>
<?php if($countItems) { ?>
	<div class="row">
            <?php foreach($items as $v) {?>
            <div class="col-md-4 col-6">
                <a href="<?= $v['tenkhongdauvi'] ?>">
                    <div class="cell">
                        <span><img src="<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?= $v['ten'.$lang] ?>" width="300px"
                            height="300px"></span>
							<?php 
                        if(!empty($v['giamoi'])) {
                            $sale = abs(ceil((($v['giamoi']/$v['gia'])*100)-100));    
                        ?>
                        <div class="sale"><?= $sale ?>%</div>
                        <?php } ?>
                        <div class="cover-content cover-sp">
                            <h6 class="text-split">
                                <?= $v['ten'.$lang] ?>
                            </h6>
							<div class="all_gia">
                                <?php if(!empty($v['giamoi'])) {?>
                                    <span><?=$func->format_money($v['giamoi'])?></span>
                                    <del><?=$func->format_money($v['gia'])?></del>
                                <?php }else{ ?>
                                    <span><?=$func->format_money($v['gia'])?></span>
                                <?php } ?>
                            </div>
                            <div class="noprice">
                                <span>Xem chi tiết</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
	<div class="pagination-ajax">
		<div class="pagination">
			<?=$pagingItems?>
		</div>
	</div>
<?php } ?>