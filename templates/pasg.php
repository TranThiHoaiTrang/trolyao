<!DOCTYPE html>
<html lang="<?= $lang ?>">

<head>
    <?php include LAYOUT_PATH . "head.php"; ?>
    <?php include LAYOUT_PATH . "css2.php"; ?>
</head>

<body>
    <div id="wrapper">
        <?php
        include LAYOUT_PATH."seo.php";
        include LAYOUT_PATH."menu.php";
        include LAYOUT_PATH."slide.php";
        ?>
        <div class="<?= ($source == 'index') ? 'wrap-home' : 'wrap-main' ?> w-clear">
            <?php include TEMPLATE . $template . "_tpl.php"; ?></div>
        <?php
        include LAYOUT_PATH . "footer.php";
        include LAYOUT_PATH . "js2.php";
        ?>
    </div>
</body>

</html>