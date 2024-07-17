<?php
session_start();
include "ajax_config.php";
include BASE_PATH . 'mang_tiengviet.php';
header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['noteContent'])) {
    $noteContent = $_POST['noteContent'];

    // $noteContent = preg_replace('/\d/', '', $noteContent);

    // Giải mã các thực thể HTML
    $noteContent = html_entity_decode($noteContent, ENT_QUOTES, 'UTF-8');

    function removeTrailing($string) {
        // Các ký tự cần loại bỏ
        $charactersToRemove = ".,!?:;'\"(){}[]“”";
        
        // Loại bỏ các ký tự từ cuối chuỗi
        $cleanedString = rtrim($string, $charactersToRemove);
        
        // Loại bỏ các ký tự từ đầu chuỗi
        $cleanedString = ltrim($cleanedString, $charactersToRemove);
        
        return $cleanedString;
    }

    function kiem_tra_chinh_ta($doan_van, $tu_dung)
    {
        // Chuyển tất cả các từ đúng sang chữ thường
        $tu_dung_lower = array_map('mb_strtolower', $tu_dung);

        // Tách các từ trong văn bản
        $words = preg_split('/\s+/u', $doan_van);

        // Mảng để chứa các từ đã xử lý và các từ sai chính tả
        $processedWords = [];
        $sai_tu = [];
        $wordsCount = count($words);

        for ($index = 0; $index < $wordsCount; $index++) {
            $word = $words[$index];
            // Chuyển từ hiện tại về chữ thường
            $word_lower = mb_strtolower($word);

            if (!preg_match('/^[a-záàảãạâấầẩẫậăắằẳẵặđéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵ\s]+$/iu', $word_lower)) {
                $processedWords[] = htmlspecialchars($word, ENT_QUOTES, 'UTF-8');
                continue; // Bỏ qua từ không phải chữ cái
            }

            $lastChar = '';
            $lastChar_all = mb_substr($words[$index], -1);
            if (preg_match('/[.!?,:;]/', $lastChar_all)) {
                $lastChar = mb_substr($words[$index], -1);
                $word_lower = mb_substr($word_lower, 0, -1);
                $word = mb_substr($word, 0, -1); // Remove last char for comparison
            }

            // $isCorrect = ;
            // $isCorrect = in_array($word_lower, $tu_dung_lower);
            // var_dump(in_array($word_lower, $tu_dung_lower));
            // $word_lower_a = mb_strtolower($word);
            // if(in_array($word_lower_a, $tu_dung_lower)){
            //     // var_dump(in_array($word_lower, $tu_dung_lower));
            //     // var_dump($word);
            //     $isCorrect = true;
            //     $processedWords[] = htmlspecialchars($word . $lastChar, ENT_QUOTES, 'UTF-8');
            //     continue;
            // }
            // else{
            //     $isCorrect = false;
            // }
            $isCorrect = false;

            // Kiểm tra cụm từ hai từ (bigram)
            if ($isCorrect == false) {
                // if (!$isCorrect && $index < $wordsCount - 1) {
                $nextWord = $words[$index + 1];
                $prevWord = $words[$index - 1];
                $bigram = removeTrailing($word) . ' ' . removeTrailing($nextWord);
                $bigram_prev = removeTrailing($prevWord) . ' ' . removeTrailing($word);
                $bigram_lower = mb_strtolower($bigram);
                $bigram_lower_prev = mb_strtolower($bigram_prev);

                // var_dump($bigram_lower);
                if (in_array($bigram_lower, $tu_dung_lower)) {
                    // var_dump(in_array($bigram_lower, $tu_dung_lower));
                    // var_dump($bigram_lower);
                    $isCorrect = true;
                    $processedWords[] = htmlspecialchars($bigram . $lastChar, ENT_QUOTES, 'UTF-8');
                    $index++; // Bỏ qua từ tiếp theo vì đã gộp thành bigram
                    continue;
                }
                elseif (in_array($bigram_lower_prev, $tu_dung_lower)) {
                    // var_dump($bigram_lower_prev);
                    $isCorrect = true;
                    $processedWords[] = htmlspecialchars($word . $lastChar, ENT_QUOTES, 'UTF-8');
                    // $index++; // Bỏ qua từ tiếp theo vì đã gộp thành bigram
                    continue;
                }
                else{
                    $word_lower = mb_strtolower($word);
                    // var_dump($word_lower);
                    if(in_array($word_lower, $tu_dung_lower)){
                        // var_dump(in_array($word_lower, $tu_dung_lower));
                        // var_dump($word);
                        $isCorrect = true;
                        $processedWords[] = htmlspecialchars($word . $lastChar, ENT_QUOTES, 'UTF-8');
                        continue;
                    }
                    else{
                        $isCorrect = false;
                        // var_dump($word);
                        $processedWords[] = '<span class="shortened">' . htmlspecialchars($word . $lastChar, ENT_QUOTES, 'UTF-8') . '</span>';
                        $sai_tu[] = $word . $lastChar;
                        continue;
                    }
                }
            }
            // var_dump(!$isCorrect);
            // Nếu không đúng, đánh dấu từ sai chính tả
            if ($isCorrect == false) {
                // var_dump($word);
                $processedWords[] = '<span class="shortened">' . htmlspecialchars($word . $lastChar, ENT_QUOTES, 'UTF-8') . '</span>';
                // var_dump($word);
                $sai_tu[] = $word . $lastChar;
            } else {
                $processedWords[] = htmlspecialchars($word . $lastChar, ENT_QUOTES, 'UTF-8');
            }
        }

        

        $sai_tu = array_filter($sai_tu);
        // Ghép lại các từ thành văn bản hoàn chỉnh và trả về kèm mảng từ sai
        return [
            'processedText' => implode(' ', $processedWords),
            'sai_tu' => $sai_tu
        ];
    }


    // Hàm xử lý HTML
    function processHTML($html, $array)
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $textNodes = $xpath->query('//text()');
        $sai_tu = [];

        foreach ($textNodes as $textNode) {
            $result = kiem_tra_chinh_ta($textNode->nodeValue, $array);
            $processedText = $result['processedText'];
            $sai_tu = array_merge($sai_tu, $result['sai_tu']);

            $newFragment = $dom->createDocumentFragment();
            $newFragment->appendXML($processedText);
            $textNode->parentNode->replaceChild($newFragment, $textNode);
        }

        // Trả về nội dung HTML mà không bao gồm đoạn <?xml encoding="UTF-8">
        $htmlOutput = $dom->saveHTML();
        return ['html' => $htmlOutput, 'sai_tu' => $sai_tu];
    }

    // Gọi hàm để xử lý nội dung HTML
    $result = processHTML($noteContent, $array);
    $htmlOutput = str_replace('<?xml encoding="UTF-8">', '', $result['html']);
    $result_content = $htmlOutput;
    $sai_tu = $result['sai_tu'];

    $sai_tu_html = '';
    foreach ($sai_tu as $v) {
        $sai_tu_html .= '<div><span>' . htmlspecialchars($v, ENT_QUOTES, 'UTF-8') . '</span><button class="button_suachinhta" data-text="' . htmlspecialchars($v, ENT_QUOTES, 'UTF-8') . '"><i class="far fa-edit"></i></button></div>';
    }
    $sai_tu_html .= '';
    // Trả về kết quả dưới dạng JSON
    echo json_encode([
        'result_content' => $result_content,
        'sai_tu' => $sai_tu_html
    ]);
} else {
    echo "Không có nội dung để kiểm tra.";
}
