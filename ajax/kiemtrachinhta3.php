<?php
include "ajax_config.php";
include BASE_PATH . 'mang_tiengviet.php';
header('Content-Type: text/html; charset=utf-8');

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

require BASE_PATH. '/vendor/autoload.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['noteContent'])) {
    $noteContent = $_POST['noteContent'];

    function checkSpelling($text)
    {
        $process = new Process(['hunspell', '-d', 'vi_VN', '-l']);
        $process->setInput($text);
        $process->run();

        // Kiểm tra lỗi trong quá trình thực thi
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Lấy kết quả từ Hunspell
        $output = $process->getOutput();
        return array_filter(explode("\n", $output));
    }

    try {
        $misspelledWords = checkSpelling($noteContent);

        if (empty($misspelledWords)) {
            $response = [
                'error' => false,
                'result_content' => $noteContent,
                'sai_tu' => 'Không có lỗi chính tả.'
            ];
        } else {
            $response = [
                'error' => false,
                'result_content' => $noteContent,
                'sai_tu' => 'Các từ sai chính tả: ' . implode(", ", $misspelledWords)
            ];
        }
        echo json_encode($response);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Không có nội dung để kiểm tra.']);
}
