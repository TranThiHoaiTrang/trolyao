<!DOCTYPE html>
<html lang="<?= $lang ?>">

<head>
    <?php include LAYOUT_PATH . "head.php"; ?>
    <?php include LAYOUT_PATH . "css.php"; ?>
</head>

<body>

    <div id="wrapper">
        <?php if ($template != 'index_page/index_page') { ?>
            <!-- <div id="loader-wrapper">
                <div class="loader-wrapper">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
            </div> -->
        <?php } ?>
        <?php
        if ($template != 'index_page/index_page') {
            include LAYOUT_PATH . "seo.php";
            include LAYOUT_PATH . "menu.php";
        }
        // include LAYOUT_PATH."slide.php";
        // if($source!='index') include TEMPLATE.LAYOUT."breadcrumb.php";
        ?>
        <div class="<?= ($source == 'index') ? 'wrap-home' : 'wrap-main' ?> w-clear"><?php include TEMPLATE_PATH . $template . "_tpl.php"; ?></div>
        <?php
        // include LAYOUT_PATH."footer.php";
        //include TEMPLATE.LAYOUT."mmenu.php";
        // include LAYOUT_PATH."phone3.php";
        if ($template != 'index_page/index_page' || $source == 'user') {
            include LAYOUT_PATH . "modal.php";
            include LAYOUT_PATH . "js.php";
        }

        // if($deviceType=='mobile') include TEMPLATE.LAYOUT."phone.php";
        ?>
    </div>
</body>

</html>