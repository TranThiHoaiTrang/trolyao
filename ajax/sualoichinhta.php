<?php
session_start();
include "ajax_config.php";
include BASE_PATH . 'mang_tiengviet.php';
header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['noteContent']) && isset($_POST['text'])) {
    $noteContent = $_POST['noteContent'];
    $text_content = $_POST['text'];

    // Giải mã các thực thể HTML
    $noteContent = html_entity_decode($noteContent, ENT_QUOTES, 'UTF-8');

    function findClosestBigram($word1, $word2, $dictionary) {
        $closestBigram = "";
        $shortestDistance = -1;
    
        $bigram = $word1 . ' ' . $word2;
        foreach ($dictionary as $dictWord) {
            // Tính khoảng cách Levenshtein cho cụm từ
            $distance = levenshtein($bigram, $dictWord);
    
            // Nếu khoảng cách là 0, tìm thấy cụm từ đúng
            if ($distance == 0) {
                return $dictWord;
            }
    
            // Cập nhật cụm từ gần nhất và khoảng cách ngắn nhất
            if ($shortestDistance < 0 || $distance < $shortestDistance) {
                $closestBigram = $dictWord;
                $shortestDistance = $distance;
            }
        }
    
        return $closestBigram;
    }

    function findClosestWord($word, $dictionary) {
        $closestWord = "";
        $shortestDistance = -1;
    
        foreach ($dictionary as $dictWord) {
            // Loại bỏ dấu cách và chuyển về chữ thường để so sánh
            $normalizedWord = strtolower(str_replace(' ', '', $word));
            $normalizedDictWord = strtolower(str_replace(' ', '', $dictWord));
    
            // Tính khoảng cách Levenshtein
            $levDistance = levenshtein($normalizedWord, $normalizedDictWord);
    
            // Nếu khoảng cách là 0, tìm thấy từ đúng
            if ($levDistance == 0) {
                return $dictWord;
            }
    
            // Cập nhật từ gần nhất và khoảng cách ngắn nhất
            if ($shortestDistance < 0 || $levDistance < $shortestDistance) {
                $closestWord = $dictWord;
                $shortestDistance = $levDistance;
            }
        }
    
        return $closestWord;
    }  

    function processHTML($html, $array, $text_content) {
        $dom = new DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
    
        $xpath = new DOMXPath($dom);
        $textNodes = $xpath->query('//text()');
        $result_text_content = '';
    
        // Hàm phụ để tìm bigram hoặc từ gần nhất
        function getResultTextContent($words, $index, $text_content, $array) {
            if ($index >= 0 && $index < count($words)) {
                if ($index > 0) {
                    return findClosestBigram($words[$index - 1], $text_content, $array);
                } elseif ($index < count($words) - 1) {
                    return findClosestBigram($text_content, $words[$index + 1], $array);
                } else {
                    return findClosestWord($text_content, $array);
                }
            } else {
                return findClosestWord($text_content, $array);
            }
        }
    
        // Duyệt qua tất cả các text node để tìm từ trong văn bản
        foreach ($textNodes as $textNode) {
            $nodeValue = $textNode->nodeValue;
            if ($nodeValue === null) {
                continue; // Bỏ qua nếu nodeValue là null
            }
            $words = explode(' ', $nodeValue);
            $index = array_search($text_content, $words);
            // var_dump($words);
            // var_dump($text_content);
            // var_dump(array_search($text_content, $words));
            if ($index !== false) {
                // var_dump($index);
                $result_text_content = getResultTextContent($words, $index, $text_content, $array);
                break;
            }
        }
    
        // Nếu không tìm thấy trong bất kỳ text node nào, sử dụng phương pháp tìm từ gần nhất
        if (!$result_text_content) {
            $result_text_content = findClosestWord($text_content, $array);
        }
    
        foreach ($textNodes as $textNode) {
            $nodeValue = $textNode->nodeValue;
            if ($nodeValue === null) {
                continue; // Bỏ qua nếu nodeValue là null
            }
    
            // Kiểm tra và thay thế từ sai chính tả
            $processedText = $nodeValue;
    
            // Thay thế `text_content` bằng `result_text_content`
            if (strpos($nodeValue, $text_content) !== false) {
                $processedText = str_replace($text_content, $result_text_content, $nodeValue);
    
                // Tìm các phần tử span có class 'shortened' và kiểm tra nội dung để thay đổi class
                $spanNodes = $xpath->query("//span[@class='shortened']");
                foreach ($spanNodes as $spanNode) {
                    if ($spanNode->nodeValue === $text_content) {
                        $spanNode->setAttribute('class', 'shortened_chinh');
                    }
                }
            }
    
            // Thay thế nội dung của text node
            $newFragment = $dom->createDocumentFragment();
            $newFragment->appendXML($processedText);
            $textNode->parentNode->replaceChild($newFragment, $textNode);
        }
    
        // Trả về nội dung HTML mà không bao gồm đoạn <?xml encoding="UTF-8">
        $htmlOutput = $dom->saveHTML();
        return ['html' => $htmlOutput];
    }

    // Gọi hàm để xử lý nội dung HTML
    $result = processHTML($noteContent, $array, $text_content);
    $htmlOutput = str_replace('<?xml encoding="UTF-8">', '', $result['html']);
    $result_content = $htmlOutput;

    $sai_tu_html = '';
    $sai_tu_html .= '';
    // Trả về kết quả dưới dạng JSON
    echo json_encode([
        'result_content' => $result_content,
    ]);
} else {
    echo "Không có nội dung để kiểm tra.";
}
