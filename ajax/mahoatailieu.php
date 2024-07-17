<?php
include "ajax_config.php";

header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['noteContent'])) {
    $noteContent = $_POST['noteContent'];

    // Giải mã các thực thể HTML
    $noteContent = html_entity_decode($noteContent, ENT_QUOTES, 'UTF-8');

    // Danh sách các từ muốn loại bỏ
    $excludeWords = array("điều", "bộ", "luật", "hình", "Sự", "Khoản", "hội","khi", "đồng","chấp", "phán" ,"Xét", "Xử", "kiểm", "sát", "thành","blttds", "Phố","cưỡng","hồi","uống","cầu","giám","bệnh","do","vụ","một","nếu","giữa","trong","năng","trường","hôn","mọi","cá","việc","tập","ngược","bởi","cách","vậy","bên","tthc","mật","vì","tham","tự","ví dụ","mặt khác","vậy nên","tài sản","hiến pháp","pháp lệnh","thủ tướng","khiếu kiện","khiếu nại","kháng cáo","yêu cầu","thẩm phán","chánh án","tính hợp","cqđt","nam-thụy","trong khi","trong phạm","giao dịch","chủ thể","nghị định","hợp đồng","mặt dù","danh sách","xử lý","chính phủ","văn phòng","chủ tịch" ,"thụy điển","bảo vệ","danh mục","mục đích","tuyệt mật","thông tư","ngoại giao", "tòa", "án", "dự", "bảng", "Kết", "thấy", "sau", "Phòng", "viện", "lời", "adn", "and","kết","chiếm","sử","bị","như vậy", "nhân dân","phiên tòa","nguyên đơn", "việt nam", "bà", "nhân danh", "tòa án", "quyết định","công văn", "trại", "công an", "vụ án", "trung tâm", "lúc", "tự do", "hạnh phúc","trách nhiệm", "thành phần", "chủ tọa", "hội đồng", "hội thẩm", "thư ký", "tòa", "viện", "kiểm sát", "kinh", "toà án","thẩm phán","phán", "bị hại", "người làm", "người bào", "công ty", "thu của", "cơ quan", "tại vị", "kết luận", "bản kết", "sở y", "sẹo lỗ", "mẻ", "các", "hướng", "phòng", "trên", "về", "chiến thắng", "người","tối","khẩu súng","ngoài ra","trung ương","trước","theo","tại","bị cáo","tổng hợp","tuy nhiên","trình bày","cảnh sát","tố tụng","quy trình","do đó","xét thấy","ngày","giết","có","hành vi","nhà nước","thời điểm","tình tiết","quan điểm","căn cứ","dân sự","vật chứng","quá trình","thời hạn","thi hành","thực hiện","thời hiệu","nghị quyết","ủy ban","uỷ ban","thường vụ","quốc hội","vksnd","sơ thẩm","tm","tư pháp","thads","vp","lưu","cáo trạng");

    // Danh sách tên các thành phố
    $cityNames = array("Hà Nội", "Vĩnh Phúc", "Bắc Ninh", "Quảng Ninh", "Hải Dương", "Hải Phòng", "Hưng Yên", "Thái Bình", "Hà Nam", "Nam Định", "Ninh Bình", "Hà Giang", "Cao Bằng", "Bắc Kạn", "Tuyên Quang", "Lào Cai", "Yên Bái", "Thái Nguyên", "Lạng Sơn", "Bắc Giang", "Phú Thọ", "Điện Biên", "Lai Châu", "Sơn La", "Hoà Bình", "Thanh Hoá", "Nghệ An", "Hà Tĩnh", "Quảng Bình", "Quảng Trị", "Thừa Thiên Huế", "Đà Nẵng", "Quảng Nam", "Quảng Ngãi", "Bình Định", "Phú Yên", "Khánh Hoà", "Ninh Thuận", "Bình Thuận", "Kon Tum", "Gia Lai", "Đắk Lắk", "Đắk Nông", "Lâm Đồng", "Bình Phước", "Tây Ninh", "Bình Dương", "Đồng Nai", "Bà Rịa - Vũng Tàu", "Hồ Chí Minh", "Long An", "Tiền Giang", "Bến Tre", "Trà Vinh", "Vĩnh Long", "Đồng Tháp", "An Giang", "Kiên Giang", "Cần Thơ", "Hậu Giang", "Sóc Trăng", "Bạc Liêu", "Cà Mau");

    function removeTrailing($string) {
        // Các ký tự cần loại bỏ
        $charactersToRemove = ".,!?:;'\"(){}[]“”";
        
        // Loại bỏ các ký tự từ cuối chuỗi
        $cleanedString = rtrim($string, $charactersToRemove);
        
        // Loại bỏ các ký tự từ đầu chuỗi
        $cleanedString = ltrim($cleanedString, $charactersToRemove);
        
        return $cleanedString;
    }

    // Hàm để xác định và rút gọn tên riêng
    function shortenProperNames($text, $excludeWords, $cityNames)
    {
        // Tách các từ trong văn bản
        $words = preg_split('/\s+/u', $text);

        // Mảng để chứa các từ đã xử lý
        $processedWords = [];
        $skipWords = 0;

        foreach ($words as $index => $word) {
            // Nếu có các từ cần bỏ qua do khớp với tên thành phố
            if ($skipWords > 0) {
                $skipWords--;
                continue;
            }

            // Kiểm tra tên thành phố
            $isCityName = false;
            foreach ($cityNames as $city) {
                $cityParts = explode(' ', $city);
                $cityMatch = true;

                // Kiểm tra từng phần của tên thành phố
                for ($i = 0; $i < count($cityParts); $i++) {
                    // Chuyển đổi cả từ và phần của tên thành phố về dạng chữ thường để so sánh
                    $wordLower = mb_strtolower($words[$index + $i], 'UTF-8');
                    $cityPartLower = mb_strtolower($cityParts[$i], 'UTF-8');

                    if (!isset($words[$index + $i]) || $wordLower != $cityPartLower) {
                        $cityMatch = false;
                        break;
                    }
                }

                // Nếu khớp với tên thành phố, thêm vào mảng kết quả và bỏ qua các từ tiếp theo
                if ($cityMatch) {
                    $processedWords[] = $city;
                    $skipWords = count($cityParts) - 1;
                    $isCityName = true;
                    break;
                }
            }

            // Nếu là tên thành phố thì tiếp tục với từ tiếp theo
            if ($isCityName) {
                continue;
            }

            // Kiểm tra từ bắt đầu bằng chữ hoa
            if (ctype_upper(mb_substr($word, 0, 1))) {
                // Kiểm tra xem từ hiện tại có phải là từ đầu câu hay không
                $isStartOfSentence = false;
                if ($index === 0) {
                    $isStartOfSentence = true; // Nếu là từ đầu tiên của văn bản
                } else {
                    $prevWord = $words[$index - 1];
                    $lastCharPrev = mb_substr($prevWord, -1);
                    if (preg_match('/[.!?,:;]/', $lastCharPrev) || strlen($prevWord) === 1) {
                        // $isStartOfSentence = true; // Nếu từ trước là dấu câu hoặc từ đơn
                    }
                }

                // Kiểm tra xem từ tiếp theo là từ riêng biệt hay không
                if (isset($words[$index + 1]) && ctype_upper(mb_substr($words[$index + 1], 0, 1))) {
                    // Kiểm tra xem từ hiện tại có phải là tên riêng và đứng ngay sau dấu câu kết thúc câu không
                    $nextWord = isset($words[$index]) ? $words[$index] : '';
                    $isNextWordEndOfSentence = preg_match('/[.!?,:;]$/', mb_substr($nextWord, 1));

                    $lastChar_all = mb_substr($words[$index], -1);
                    if (preg_match('/[.!?,:;]/', $lastChar_all)) {
                        $lastChar = mb_substr($words[$index], -1);
                    }

                    if ($isNextWordEndOfSentence) {
                        if (preg_match('/[.!?,:;]/', $word)) {
                            $lastChar = mb_substr($word, -1);
                            $w_repl_one = str_replace($lastChar, '', $word);
                        } else {
                            $w_repl_one = $word;
                        }
                        // var_dump(mb_strtolower($word));
                        if (!in_array(mb_strtolower(removeTrailing($w_repl_one)), $excludeWords)) {

                            if (preg_match('/[.!?,:;]/', $word)) {
                                $lastChar = mb_substr($word, -1);
                                $w_repl_w = str_replace($lastChar, '', $word);
                            } else {
                                $w_repl_w = $word;
                            }

                            // var_dump(mb_strtolower($words[$index - 1] . ' ' . $w_repl_w));
                            if (!in_array(mb_strtolower(removeTrailing($words[$index - 1]) . ' ' . removeTrailing($w_repl_w)), $excludeWords)) {

                                if (preg_match('/[.!?,:;]/', $words[$index + 1])) {
                                    $lastChar = mb_substr($words[$index + 1], -1);
                                    $w_repl = str_replace($lastChar, '', $words[$index + 1]);
                                } else {
                                    $w_repl = $words[$index + 1];
                                }

                                // var_dump(mb_strtolower($word . ' ' . $w_repl));
                                if (!in_array(mb_strtolower(removeTrailing($word) . ' ' . removeTrailing($w_repl)), $excludeWords)) {
                                    $processedWords[] = '<span class="shortened">' .
                                        mb_strtoupper(mb_substr($word, 0, 1), 'UTF-8') .
                                        ' <em>Từ MH: ' .
                                        $word .
                                        '</em></span>';
                                } else {
                                    $processedWords[] = $word;
                                }
                            } else {
                                $processedWords[] = $word;
                            }
                            // $processedWords[] = '<span class="shortened">' . mb_strtoupper(mb_substr($word, 0, 1), 'UTF-8') . ' <span> Từ mã hóa: ' . mb_strtoupper($word) . '</span> ' . '</span>';
                        } else {
                            $processedWords[] = $word;
                        }
                    } else {
                        $processedWords[] = $word;
                    }
                } else {
                    // Nếu từ tiếp theo không phải là từ riêng biệt, rút gọn thành chỉ một chữ cái đầu viết hoa
                    $lastChar = mb_substr($word, -1);
                    $isEndOfSentence = preg_match('/[.!?,:;]/', $lastChar);

                    // Kiểm tra xem từ hiện tại có phải là tên riêng và đứng ngay trước dấu câu kết thúc câu không
                    $nextWord = isset($words[$index + 1]) ? $words[$index + 1] : '';
                    $isNextWordEndOfSentence = preg_match('/[.!?,:;]$/', mb_substr($nextWord, 1));

                    // Nếu từ là đầu câu hoặc kết thúc câu, giữ nguyên từ
                    if ($isStartOfSentence) {
                        $processedWords[] = $word;
                    } else {
                        // Nếu không, rút gọn thành chỉ một chữ cái đầu viết hoa
                        if (preg_match('/[.!?,:;]/', $word)) {
                            $lastChar = mb_substr($word, -1);
                            $w_repl_one = str_replace($lastChar, '', $word);
                        } else {
                            $w_repl_one = $word;
                        }
                        // var_dump(mb_strtolower($w_repl_one));
                        if (!in_array(mb_strtolower(removeTrailing($w_repl_one)), $excludeWords)) {

                            if (preg_match('/[.!?,:;]/', $word)) {
                                $lastChar = mb_substr($word, -1);
                                $w_repl_w = str_replace($lastChar, '', $word);
                            } else {
                                $w_repl_w = $word;
                            }

                            // var_dump(mb_strtolower($words[$index - 1] . ' ' . $w_repl_w));
                            if (!in_array(mb_strtolower(removeTrailing($words[$index - 1]) . ' ' . removeTrailing($w_repl_w)), $excludeWords)) {

                                if (preg_match('/[.!?,:;]/', $words[$index + 1])) {
                                    $lastChar = mb_substr($words[$index + 1], -1);
                                    $w_repl = str_replace($lastChar, '', $words[$index + 1]);
                                } else {
                                    $w_repl = $words[$index + 1];
                                }

                                // var_dump(mb_strtolower($word . ' ' . $w_repl));
                                if (!in_array(mb_strtolower(removeTrailing($word) . ' ' . removeTrailing($w_repl)), $excludeWords)) {
                                    $processedWords[] = '<span class="shortened">' .
                                        mb_strtoupper(mb_substr($word, 0, 1), 'UTF-8') .
                                        ' <em>Từ MH: ' .
                                        $word .
                                        '</em></span>';
                                } else {
                                    $processedWords[] = $word;
                                }
                            } else {
                                $processedWords[] = $word;
                            }
                            // $processedWords[] = '<span class="shortened">' . mb_strtoupper(mb_substr($word, 0, 1), 'UTF-8') . ' <span> Từ mã hóa: ' . mb_strtoupper($word) . '</span> ' . '</span>';
                        } else {
                            $processedWords[] = $word;
                        }
                    }
                }
            } else {
                // Giữ nguyên từ thường
                $processedWords[] = $word;
            }
        }
        // Ghép lại các từ thành văn bản hoàn chỉnh
        return implode(' ', $processedWords);
    }

    // Hàm xử lý HTML
    function processHTML($html, $excludeWords, $cityNames)
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $textNodes = $xpath->query('//text()');

        foreach ($textNodes as $textNode) {
            $processedText = shortenProperNames($textNode->nodeValue, $excludeWords, $cityNames);
            $newFragment = $dom->createDocumentFragment();
            $newFragment->appendXML($processedText);
            $textNode->parentNode->replaceChild($newFragment, $textNode);
        }

        // Trả về nội dung HTML mà không bao gồm đoạn <?xml encoding="UTF-8">
        $htmlOutput = $dom->saveHTML();
        return $htmlOutput;
    }
    $result = processHTML($noteContent, $excludeWords, $cityNames);
    // Gọi hàm để xử lý nội dung HTML
    $result = str_replace('<?xml encoding="UTF-8">', '', $result);

    // Trả về kết quả
    echo $result;
} else {
    echo "Không có nội dung để kiểm tra.";
}
