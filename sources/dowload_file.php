<?php
define('LIBRARIES', './libraries/');
include "ajax_config.php";
require_once LIBRARIES . 'vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\IOFactory;

require_once LIBRARIES . "config.php";
require_once LIBRARIES . 'autoload.php';
new AutoLoad();
$injection = new AntiSQLInjection();
$d = new PDODb($config['database']);
$func = new Functions($d);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['noteContent'])) {
    $noteContent = $_POST['noteContent'];

    /* Gán giá trị đơn hàng */
    $time = time();


    $phpWord = new PhpWord();
    $section = $phpWord->addSection();

    // Thêm nội dung HTML vào section
    Html::addHtml($section, $noteContent, false, false);

    /* Xuất file */
    $filename = "order_" . $time . "_" . date('d_m_Y') . ".docx";
    $filepath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $filename;
    $phpWord->save($filepath, 'Word2007');

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush();
        readfile($filepath);
        unlink($filepath); // Xóa tệp sau khi gửi
        // exit;
    } else {
        echo "Failed to create the file.";
    }
} else {
    echo "No content received.";
}
