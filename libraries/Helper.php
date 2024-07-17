<?php

use MatthiasMullie\Minify;
use Vectorface\Whip\Whip;

defined('BASE_PATH') || die;

require_once LIBRARIES_PATH . "Image_moo.php";

/**
 * @return void
 */
function regenerate_sid( $uniqid ) {
    if ( !is_scalar( $uniqid ) && ! $uniqid ) {
        $uniqid = uniqid();
    }

    $_SESSION['sid'] = $uniqid;
    $_SESSION['sid_time'] = time();
}

/**
 * Escaping for HTML attributes.
 *
 * @param string|null $text
 * @return string
 */
function esc_attr(?string $text ): ?string {
    return Helper::esc_attr( $text );
}

/**
 * Helper Class
 *
 * @author WEBHD
 */
final class Helper
{
    // --------------------------------------------------

    /**
     * @return string[]
     */
    public static function months(): array
    {
        return [
            'Jan' => 'tháng 1',
            'Feb' => 'tháng 2',
            'Mar' => 'tháng 3',
            'Apr' => 'tháng 4',
            'May' => 'tháng 5',
            'Jun' => 'tháng 6',
            'Jul' => 'tháng 7',
            'Aug' => 'tháng 8',
            'Sep' => 'tháng 9',
            'Oct' => 'tháng 10',
            'Nov' => 'tháng 11',
            'Dec' => 'tháng 12',
        ];
    }

    // --------------------------------------------------

    /**
     * @return string[]
     */
    public static function days(): array
    {
        return [
            'Mon' => 'T2',
            'Tue' => 'T3',
            'Wed' => 'T4',
            'Thu' => 'T5',
            'Fri' => 'T6',
            'Sat' => 'T7',
            'Sun' => 'CN',
        ];
    }

    // --------------------------------------------------

    /**
     * @param string $pattern
     * @param string $locale
     * @param string|int $date
     * @return false|string
     */
    public static function time_pattern(string $pattern = 'd MMMM, yyyy', string $locale = 'vi_VN', $date = '' ) {
        if ( ! $date ) {
            $date = time();
        }

        $formatter = new IntlDateFormatter( $locale, IntlDateFormatter::LONG, IntlDateFormatter::LONG );
        $formatter->setPattern( $pattern );
        return $formatter->format( $date );
    }

    // --------------------------------------------------

    /**
     * @param $tbl
     * @param null $id
     * @param string $key_col
     * @param string $value_col
     * @param array $selected
     * @return string
     */
    public static function select_options($tbl, $id = null, string $key_col = 'id', string $value_col = 'tenvi', array $selected = [] ): string
    {
        global $d;

        $where = 'hienthi = 1';
        if ( $id ) {
            $where .= ' AND id = ' . $id;
        }

        $sql = "SELECT * FROM #_{$tbl} WHERE $where ORDER BY stt, id DESC";
        $items = $d->rawQuery($sql);

        $_options = '';
        foreach ( $items as $item ) {
            $_selected = '';
            if ( in_array( $item['id'], $selected ) ) {
                $_selected = ' selected';
            }

            $_options .= '<option' . $_selected . ' value="' . $item[$key_col] . '">' . $item[$value_col] . '</option>';
        }

        return $_options;
    }

    // --------------------------------------------------

    /**
     * @param int $price
     * @param int $price_discount
     * @return string
     */
    public static function price_format( int $price = 0, int $price_discount = 0 ): string
    {
        $format = '<p class="no-price">' . lienhe . '</p>';
        if ( ! $price_discount && $price ) {
            $format = '<span class="amount"><bdi>' . number_format( $price ) . '<span class="currency-symbol">đ</span></bdi></span>';
        } elseif ( $price_discount && $price ) {

            $format = '<ins><span class="amount"><bdi>' . number_format( $price_discount ) . '<span class="currency-symbol">đ</span></bdi></span></ins>';
            $format .= '<del aria-hidden="true"><span class="amount"><bdi>' . number_format( $price ) . '<span class="currency-symbol">đ</span></bdi></span></del>';
        }

        return $format;
    }

    // --------------------------------------------------

    /**
     * @param $price
     * @param int $price_promotion
     * @param int $x
     * @return float|int
     */
    public static function get_price($price, int $price_promotion = 0, int $x = 1 ) {
        $val = 0;

        if ( is_scalar( $x )) {
            $x = intval( $x );
        }

        if ( ! $x ) {
            $x = 1;
        }

        if ( $price_promotion && $price && $price > $price_promotion ) {
            $val = $price_promotion * $x;
        }
        elseif ( $price ) {
            $val = $price * $x;
        }

        return $val;
    }

    // --------------------------------------------------

    /**
     * @param $price
     * @param $price_promotion
     * @param string $symbol
     * @param int $x
     * @return string
     */
    public static function get_price_text($price, $price_promotion, string $symbol = 'đ', int $x = 1 ): string
    {
        if ( is_scalar( $x )) {
            $x = intval( $x );
        }

        if ( ! $x ) {
            $x = 1;
        }

        if ( $price_promotion && $price && $price > $price_promotion ) {
            return number_format( $price_promotion * $x ) . $symbol;
        }
        elseif ( $price ) {
            return number_format( $price * $x ) . $symbol;
        }

        return 'Liên hệ';
    }

    // --------------------------------------------------

    /**
     * @param string $type
     * @param int $len
     * @return false|int|string|void
     */
    public static function random_string(string $type = 'alnum', int $len = 8)
    {
        switch ($type)
        {
            case 'basic':
                return mt_rand();
            case 'alnum':
            case 'numeric':
            case 'nozero':
            case 'alpha':
                switch ($type)
                {
                    case 'alpha':
                        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'alnum':
                        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric':
                        $pool = '0123456789';
                        break;
                    case 'nozero':
                        $pool = '123456789';
                        break;
                }
                return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
            case 'unique': // todo: remove in 3.1+
            case 'md5':
                return md5(uniqid(mt_rand()));
            case 'encrypt': // todo: remove in 3.1+
            case 'sha1':
                return sha1(uniqid(mt_rand(), TRUE));
        }
    }

    // --------------------------------------------------

    /**
     * Adds _1 to a string or increment the ending number to allow _2, _3, etc
     *
     * @param $str
     * @param $separator
     * @param $first
     * @return string
     */
    public static function increment_string($str, $separator = '_', $first = 1): string
    {
        preg_match('/(.+)'.preg_quote($separator, '/').'([0-9]+)$/', $str, $match);
        return isset($match[2]) ? $match[1].$separator.($match[2] + 1) : $str.$separator.$first;
    }

    // --------------------------------------------------

    public static function loop_price( $tour ) {

    }

    // --------------------------------------------------

    /**
     * @param string|null $text
     * @return string|null
     */
    public static function esc_attr( ?string $text ): ?string
    {
        if ( !$text ) {
            return $text;
        }

        $safe_text = self::check_invalid_utf8( $text );
        return self::specialchars( htmlspecialchars_decode( $safe_text ), ENT_QUOTES );
    }

    // --------------------------------------------------

    /**
     * @param $options_key
     * @param string $default_value
     * @return string
     */
    public static function get_options( $options_key, string $default_value = '' ): string
    {
        global $optsetting;

        $_value = $default_value;
        if ( !empty( $optsetting[$options_key] ) ) {
            $_value = htmlspecialchars_decode( $optsetting[$options_key] );
        }

        return $_value;
    }

    // --------------------------------------------------

    /**
     * @param $setting_key
     * @param string $default_value
     * @return string
     */
    public static function get_setting( $setting_key, string $default_value = '' ): string
    {
        global $setting;

        $_value = $default_value;
        if ( !empty( $setting[$setting_key] ) ) {
            $_value = htmlspecialchars_decode( $setting[$setting_key] );
        }

        return $_value;
    }

    // --------------------------------------------------

    /**
     * Is AJAX request?
     *
     * Test to see if a request contains the HTTP_X_REQUESTED_WITH header.
     *
     * @return 	bool
     */
    public static function is_ajax_request(): bool
    {
        return ( ! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
    }

    // --------------------------------------------------

    /**
     * @param $table
     * @param $post
     * @param string $lang
     * @param array $request
     * @return string
     */
    public static function get_link ($table, $post, string $lang = 'vi', array $request = [] ): string
    {
        return self::get_term_link( $table, $post, $lang, $request );
    }

    // --------------------------------------------------

    /**
     * @param $table
     * @param $term
     * @param string $lang
     * @param array $request
     * @return string
     */
    public static function get_term_link($table, $term, string $lang = 'vi', array $request = [] ): string
    {
        global $d;
        $url = BASE_URL;

        if ( is_scalar( $term ) ) {
            $term = $d->get_by_id( $table, $term );
        }

        if ( !empty( $term['tenkhongdau' . $lang] ) ) {
            $url = BASE_URL . $term['tenkhongdau' . $lang];
        }

        if ( $request ) {
            $url .= '?' . http_build_query( $request );
        }

        return $url;
    }

    // --------------------------------------------------

    /**
     * @param $thumb
     * @param int|bool $w
     * @param int|bool $h
     * @param string $class
     * @param string $alt
     * @param bool $return
     * @return string|void
     */
    public static function the_thumbnail(
        $thumb,
        $w = false,
        $h = false,
        string $class = '',
        string $alt = '',
        $crop = false,
        bool $return = false
    ) {
        $src = '';
        $width = 0;
        $height = 0;

        if ( $thumb ) {
            $img_path = UPLOADS_PATH . $thumb;
            $src = UPLOADS_URL . $thumb;

            if ( file_exists( $img_path ) ) {
                [$width, $height] = getimagesize($img_path);

                if ( $w && $h && is_int( $w ) && is_int( $h ) && ( $width > $w || $height > $h ) ) {
                    $src = self::thumbnail_link( $thumb, $w, $h, $crop );
                    $width = $w;
                    $height = $h;
                }
            }
        }

        if ( $src ) {
            $src = '<img loading="lazy" width="' . $width . '" height="' . $height . '" src="' . $src . '" class="' . esc_attr( $class ) . '" alt="' . esc_attr( $alt ) . '" decoding="async">';
        }

        if ( !$return ) {
            echo $src;
        } else {
            return $src;
        }
    }

    // --------------------------------------------------

    /**
     * @return string
     */
    public static function noimage() {
        return BASE_URL . 'assets/img/noimage.png';
    }

    // --------------------------------------------------

    /**
     * @param string $anhdaidien
     * @param int|bool $w
     * @param int|bool $h
     * @return string
     */
    public static function thumbnail_link(string $anhdaidien = '', $w = false, $h = false, $crop = false): string {
        $anhdaidien_url = BASE_URL . 'assets/img/noimage.png';
        if ($anhdaidien) {

            $w = $w ? (int)$w : false;
            $h = $h ? (int)$h : false;

            $anhdaidien_url = UPLOADS_URL . $anhdaidien;
            $path_img = UPLOADS_PATH . $anhdaidien;

            if ( file_exists( $path_img ) && $w && $h ) {

                [$width, $height] = getimagesize($path_img);
                if ($width > $w || $height > $h) {

                    $_info = pathinfo($anhdaidien);
                    $ratio = $w . 'x' . $h;

                    if (isset($_info['dirname']) && isset($_info['filename']) && $_info['extension']) {

                        if ($_info['dirname'] == '.') {
                            $_info['dirname'] = '';
                        } else {
                            $_info['dirname'] = $_info['dirname'] . '/';
                        }

                        $copy_path = THUMBS_PATH . $ratio . '/' . $_info['dirname'];
                        $copy_path_img = $copy_path . $_info['filename'] . '.' . $_info['extension'];

                        if (!file_exists($copy_path_img)) {
                            Helper::create_directory($copy_path);

                            $image_moo = new Image_moo();
                            if(!$crop){
                                $image_moo->load($path_img)
                                ->resize($w, $h)
                                ->save($copy_path_img);
                            }
                            else{
                                $image_moo->load($path_img)
                                ->resize_crop($w, $h)
                                ->save($copy_path_img);
                            }
                        }

                        $anhdaidien_url = THUMBS_URL . $ratio . '/' . $anhdaidien;
                    }
                }
            }
        }

        return $anhdaidien_url;
    }

    // --------------------------------------------------

    /**
     * recursively create a long directory path
     *
     * @param $path
     *
     * @return bool
     */
    public static function create_directory($path): bool
    {
        if (is_dir($path)) {
            return true;
        }

        return mkdir($path, 0777, true);
    }

    // --------------------------------------------------

    /**
     * @param $domain
     * @return array|string|string[]|null
     */
    public static function session_domain($domain = null)
    {
        if (!$domain) {
            $domain = self::get_domain();
        }

        $domain = preg_replace('/\s+/', '', $domain);
        return preg_replace('/[^A-Za-z0-9_-]/', '_', $domain);
    }

    // --------------------------------------------------

    /**
     * @return string
     */
    public static function get_domain(): string
    {
        $base_url = BASE_URL;
        if ($base_url) {
            return preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/", "$1", $base_url);
        } else {
            $url_parts = parse_url(BASE_URL);
            return str_replace('www.', '', $url_parts['host']);
        }
    }

    // --------------------------------------------------

    /**
     * @param $css
     * @param bool $debug_check
     *
     * @return string
     */
    public static function CSS_Minify($css, bool $debug_check = true): string
    {
        if (empty($css)) {
            return $css;
        }

        if (true === $debug_check or 'development' === ENVIRONMENT) {
            return $css;
        }

        $minifier = new Minify\CSS();
        $minifier->add($css);

        return $minifier->minify();
    }

    // --------------------------------------------------

    /**
     * Find an attribute and add the data as a HTML string.
     *
     * @param string $str The HTML string.
     * @param string $attr The attribute to find.
     * @param string $content_extra The content that needs to be appended.
     * @param bool $unique Do we need to filter for unique values?
     *
     * @return string
     */
    public static function appendToAttribute(string $str, string $attr, string $content_extra, bool $unique = false): string
    {
        // Check if attribute has single or double quotes.
        // @codingStandardsIgnoreLine
        if ($start = stripos($str, $attr . '="')) {
            $quote = '"';

        } elseif ($start = stripos($str, $attr . "='")) {
            $quote = "'";

        } else {
            return $str;
        }

        // Add quote (for filtering purposes).
        $attr .= '=' . $quote;
        $content_extra = trim($content_extra);

        if ($unique) {

            $start += strlen($attr);
            $end = strpos($str, $quote, $start);

            $content = explode(' ', substr($str, $start, $end - $start));

            $content_extra = explode(' ', $content_extra);
            foreach ($content_extra as $class) {
                if (!empty($class) && !in_array($class, $content, true)) {
                    $content[] = $class;
                }
            }

            // Remove duplicates and empty values.
            $content = array_filter(array_unique($content));
            $content = implode(' ', $content);

            $before_content = substr($str, 0, $start);
            $after_content = substr($str, $end);

            // Combine the string again.
            $str = $before_content . $content . $after_content;

        } else {
            $str = preg_replace(
                '/' . preg_quote($attr, '/') . '/',
                $attr . $content_extra . ' ',
                $str,
                1
            );
        } // End if().

        // Return full HTML string.
        return $str;
    }

    // --------------------------------------------------

    /**
     * @param ?string $path - full-path dir
     * @param bool $required_path
     * @param bool $required_new
     * @param string $FQN
     *
     * @return void
     */
    public static function FQN_Load(?string $path, bool $required_path = false, bool $required_new = false, string $FQN = '\\')
    {
        if ($path) {
            $iterator = new DirectoryIterator($path);
            foreach ($iterator as $fileInfo) {
                if ($fileInfo->isDot()) {
                    continue;
                }

                $filename = self::fileName($fileInfo, false);
                $filenameFQN = $FQN . $filename;

                if ($required_path) {
                    require $path . DIRECTORY_SEPARATOR . $filename . self::fileExtension($fileInfo, true);
                }

                if ($required_new) {
                    class_exists($filenameFQN) && (new $filenameFQN());
                }
            }
        }
    }

    // --------------------------------------------------

    /**
     * Lock file and write something in it.
     *
     * @param string $content Content to add.
     *
     * @return bool    True on success, false otherwise.
     */
    public static function doLockWrite($path, string $content = ''): bool
    {
        $fp = fopen($path, 'w+');

        if (flock($fp, LOCK_EX)) {
            fwrite($fp, $content);
            flock($fp, LOCK_UN);
            fclose($fp);

            return true;
        }

        fclose($fp);

        return false;
    }

    // --------------------------------------------------

    /**
     * @param      $filename
     * @param bool $include_dot
     *
     * @return string
     */
    public static function fileExtension($filename, bool $include_dot = false): string
    {
        $dot = '';
        if ($include_dot === true) {
            $dot = '.';
        }

        return $dot . strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    }

    // --------------------------------------------------

    /**
     * @param      $filename
     * @param bool $include_ext
     *
     * @return string
     */
    public static function fileName($filename, bool $include_ext = false): string
    {
        return $include_ext
            ? pathinfo($filename, PATHINFO_FILENAME) . self::fileExtension($filename, true)
            : pathinfo($filename, PATHINFO_FILENAME);
    }

    // -------------------------------------------------------------

    /**
     * @param       $url
     * @param array $resolution
     *
     * @return string
     */
    public static function youtubeImage($url, array $resolution = []): string
    {
        if (!$url) {
            return '';
        }

        if (!is_array($resolution) || empty($resolution)) {
            $resolution = [
                'sddefault',
                'hqdefault',
                'mqdefault',
                'default',
                'maxresdefault',
            ];
        }

        $url_img = self::pixelImg();
        parse_str(parse_url($url, PHP_URL_QUERY), $vars);
        if (isset($vars['v'])) {
            $id = $vars['v'];
            $url_img = 'https://img.youtube.com/vi/' . $id . '/' . $resolution[0] . '.jpg';
        }

        return $url_img;
    }

    // -------------------------------------------------------------

    /**
     * @param      $url
     * @param int $autoplay
     * @param bool $lazyload
     * @param bool $control
     *
     * @return string|null
     */
    public static function youtubeIframe($url, int $autoplay = 0, bool $lazyload = true, bool $control = true): ?string
    {
        $autoplay = (int)$autoplay;
        parse_str(parse_url($url, PHP_URL_QUERY), $vars);
        $home = BASE_URL;

        if (isset($vars['v'])) {
            $idurl = $vars['v'];
            $_size = ' width="800px" height="450px"';
            $_autoplay = 'autoplay=' . $autoplay;
            $_auto = ' allow="accelerometer; encrypted-media; gyroscope; picture-in-picture"';
            if ($autoplay) {
                $_auto = ' allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"';
            }
            $_src = 'https://www.youtube.com/embed/' . $idurl . '?wmode=transparent&origin=' . $home . '&' . $_autoplay;
            $_control = '';
            if (!$control) {
                $_control = '&modestbranding=1&controls=0&rel=0&version=3&loop=1&enablejsapi=1&iv_load_policy=3&playlist=' . $idurl . '&playerapiid=ytb_iframe_' . $idurl;
            }
            $_src .= $_control . '&html5=1';
            $_src = ' src="' . $_src . '"';
            $_lazy = '';
            if ($lazyload) {
                $_lazy = ' loading="lazy"';
            }

            return '<iframe id="ytb_iframe_' . $idurl . '" title="YouTube Video Player"' . $_lazy . $_auto . $_size . $_src . ' style="border:0"></iframe>';
        }

        return null;
    }

    // -------------------------------------------------------------

    /**
     * @param string $img
     *
     * @return string
     */
    public static function pixelImg(string $img = ''): string
    {
        if (file_exists($img)) {
            return $img;
        }

        return "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==";
    }

    // --------------------------------------------------

    /**
     * @param string $version
     *
     * @return  bool
     */
    public static function isPhp(string $version = '5.0.0'): bool
    {
        static $phpVer;
        if (!isset($phpVer[$version])) {
            $phpVer[$version] = !((version_compare(PHP_VERSION, $version) < 0));
        }

        return $phpVer[$version];
    }

    // --------------------------------------------------

    /**
     * @param mixed $value
     * @param string|int $min
     * @param string|int $max
     *
     * @return bool
     */
    public static function inRange($value, $min, $max): bool
    {
        $inRange = filter_var($value, FILTER_VALIDATE_INT, [
            'options' => [
                'min_range' => intval($min),
                'max_range' => intval($max),
            ],
        ]);

        return false !== $inRange;
    }

    // --------------------------------------------------

    /**
     * @return string
     */
    public static function getIpAddress(): string
    {
        $whip = new Whip(Whip::CLOUDFLARE_HEADERS | Whip::REMOTE_ADDR | Whip::PROXY_HEADERS | Whip::INCAPSULA_HEADERS);
        $clientAddress = $whip->getValidIpAddress();

        if (false !== $clientAddress) {
            return preg_replace('/^::1$/', '127.0.0.1', $clientAddress);
        }

        // Fallback local ip.
        return '127.0.0.1';
    }

    // --------------------------------------------------

    /**
     * @param $string
     * @param bool $strip_tags
     * @param string $replace
     *
     * @return array|string|string[]|null
     */
    public static function stripSpace($string, bool $strip_tags = true, string $replace = '')
    {
        if (true === $strip_tags) {
            $string = strip_tags($string);
        }

        $string = preg_replace(
            '/(\v|\s){1,}/u',
            $replace,
            $string
        );

        $string = preg_replace('~\x{00a0}~', $replace, $string);

        return preg_replace('/\s+/', $replace, $string);
    }

    // --------------------------------------------------

    /**
     * @param $str
     * @param string $separator
     * @param bool $lowercase
     * @return string
     */
    public static function url_title($str, string $separator = '-', bool $lowercase = true): string
    {
        if ($separator === 'dash') {
            $separator = '-';
        } elseif ($separator === 'underscore') {
            $separator = '_';
        } elseif (empty($separator)) {
            $separator = ' ';
        }

        $q_separator = preg_quote($separator, '#');
        $trans = [
            //$separator => ' ',
            '&.+?;' => '',
            '[^\w\d _-]' => '',
            '\s+' => $separator,
            '(' . $q_separator . ')+' => $separator,
            $separator . '$' => '',
            '^' . $separator => '',
        ];

        $str = self::remove_accents($str);
        $str = strip_tags($str);
        foreach ($trans as $key => $val) {
            $str = preg_replace('#' . $key . '#i', $val, $str);
        }

        if ($lowercase === true) {
            if (function_exists('mb_convert_case')) {
                $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
            } else {
                $str = strtolower($str);
            }
        }

        return trim(stripslashes($str));
    }

    // --------------------------------------------------

    /**
     * @param $string
     * @param null $locale
     *
     * @return array|mixed|string|string[]
     */
    public static function remove_accents($string, $locale = null)
    {
        if (!preg_match('/[\x80-\xff]/', $string)) {
            return $string;
        }

        if (self::seems_utf8($string)) {
            $chars = [
                // Decompositions for Latin-1 Supplement.
                'ª' => 'a',
                'º' => 'o',
                'À' => 'A',
                'Á' => 'A',
                'Â' => 'A',
                'Ã' => 'A',
                'Ä' => 'A',
                'Å' => 'A',
                'Æ' => 'AE',
                'Ç' => 'C',
                'È' => 'E',
                'É' => 'E',
                'Ê' => 'E',
                'Ë' => 'E',
                'Ì' => 'I',
                'Í' => 'I',
                'Î' => 'I',
                'Ï' => 'I',
                'Ð' => 'D',
                'Ñ' => 'N',
                'Ò' => 'O',
                'Ó' => 'O',
                'Ô' => 'O',
                'Õ' => 'O',
                'Ö' => 'O',
                'Ù' => 'U',
                'Ú' => 'U',
                'Û' => 'U',
                'Ü' => 'U',
                'Ý' => 'Y',
                'Þ' => 'TH',
                'ß' => 's',
                'à' => 'a',
                'á' => 'a',
                'â' => 'a',
                'ã' => 'a',
                'ä' => 'a',
                'å' => 'a',
                'æ' => 'ae',
                'ç' => 'c',
                'è' => 'e',
                'é' => 'e',
                'ê' => 'e',
                'ë' => 'e',
                'ì' => 'i',
                'í' => 'i',
                'î' => 'i',
                'ï' => 'i',
                'ð' => 'd',
                'ñ' => 'n',
                'ò' => 'o',
                'ó' => 'o',
                'ô' => 'o',
                'õ' => 'o',
                'ö' => 'o',
                'ø' => 'o',
                'ù' => 'u',
                'ú' => 'u',
                'û' => 'u',
                'ü' => 'u',
                'ý' => 'y',
                'þ' => 'th',
                'ÿ' => 'y',
                'Ø' => 'O',
                // Decompositions for Latin Extended-A.
                'Ā' => 'A',
                'ā' => 'a',
                'Ă' => 'A',
                'ă' => 'a',
                'Ą' => 'A',
                'ą' => 'a',
                'Ć' => 'C',
                'ć' => 'c',
                'Ĉ' => 'C',
                'ĉ' => 'c',
                'Ċ' => 'C',
                'ċ' => 'c',
                'Č' => 'C',
                'č' => 'c',
                'Ď' => 'D',
                'ď' => 'd',
                'Đ' => 'D',
                'đ' => 'd',
                'Ē' => 'E',
                'ē' => 'e',
                'Ĕ' => 'E',
                'ĕ' => 'e',
                'Ė' => 'E',
                'ė' => 'e',
                'Ę' => 'E',
                'ę' => 'e',
                'Ě' => 'E',
                'ě' => 'e',
                'Ĝ' => 'G',
                'ĝ' => 'g',
                'Ğ' => 'G',
                'ğ' => 'g',
                'Ġ' => 'G',
                'ġ' => 'g',
                'Ģ' => 'G',
                'ģ' => 'g',
                'Ĥ' => 'H',
                'ĥ' => 'h',
                'Ħ' => 'H',
                'ħ' => 'h',
                'Ĩ' => 'I',
                'ĩ' => 'i',
                'Ī' => 'I',
                'ī' => 'i',
                'Ĭ' => 'I',
                'ĭ' => 'i',
                'Į' => 'I',
                'į' => 'i',
                'İ' => 'I',
                'ı' => 'i',
                'Ĳ' => 'IJ',
                'ĳ' => 'ij',
                'Ĵ' => 'J',
                'ĵ' => 'j',
                'Ķ' => 'K',
                'ķ' => 'k',
                'ĸ' => 'k',
                'Ĺ' => 'L',
                'ĺ' => 'l',
                'Ļ' => 'L',
                'ļ' => 'l',
                'Ľ' => 'L',
                'ľ' => 'l',
                'Ŀ' => 'L',
                'ŀ' => 'l',
                'Ł' => 'L',
                'ł' => 'l',
                'Ń' => 'N',
                'ń' => 'n',
                'Ņ' => 'N',
                'ņ' => 'n',
                'Ň' => 'N',
                'ň' => 'n',
                'ŉ' => 'n',
                'Ŋ' => 'N',
                'ŋ' => 'n',
                'Ō' => 'O',
                'ō' => 'o',
                'Ŏ' => 'O',
                'ŏ' => 'o',
                'Ő' => 'O',
                'ő' => 'o',
                'Œ' => 'OE',
                'œ' => 'oe',
                'Ŕ' => 'R',
                'ŕ' => 'r',
                'Ŗ' => 'R',
                'ŗ' => 'r',
                'Ř' => 'R',
                'ř' => 'r',
                'Ś' => 'S',
                'ś' => 's',
                'Ŝ' => 'S',
                'ŝ' => 's',
                'Ş' => 'S',
                'ş' => 's',
                'Š' => 'S',
                'š' => 's',
                'Ţ' => 'T',
                'ţ' => 't',
                'Ť' => 'T',
                'ť' => 't',
                'Ŧ' => 'T',
                'ŧ' => 't',
                'Ũ' => 'U',
                'ũ' => 'u',
                'Ū' => 'U',
                'ū' => 'u',
                'Ŭ' => 'U',
                'ŭ' => 'u',
                'Ů' => 'U',
                'ů' => 'u',
                'Ű' => 'U',
                'ű' => 'u',
                'Ų' => 'U',
                'ų' => 'u',
                'Ŵ' => 'W',
                'ŵ' => 'w',
                'Ŷ' => 'Y',
                'ŷ' => 'y',
                'Ÿ' => 'Y',
                'Ź' => 'Z',
                'ź' => 'z',
                'Ż' => 'Z',
                'ż' => 'z',
                'Ž' => 'Z',
                'ž' => 'z',
                'ſ' => 's',
                // Decompositions for Latin Extended-B.
                'Ș' => 'S',
                'ș' => 's',
                'Ț' => 'T',
                'ț' => 't',
                // Euro sign.
                '€' => 'E',
                // GBP (Pound) sign.
                '£' => '',
                // Vowels with diacritic (Vietnamese).
                // Unmarked.
                'Ơ' => 'O',
                'ơ' => 'o',
                'Ư' => 'U',
                'ư' => 'u',
                // Grave accent.
                'Ầ' => 'A',
                'ầ' => 'a',
                'Ằ' => 'A',
                'ằ' => 'a',
                'Ề' => 'E',
                'ề' => 'e',
                'Ồ' => 'O',
                'ồ' => 'o',
                'Ờ' => 'O',
                'ờ' => 'o',
                'Ừ' => 'U',
                'ừ' => 'u',
                'Ỳ' => 'Y',
                'ỳ' => 'y',
                // Hook.
                'Ả' => 'A',
                'ả' => 'a',
                'Ẩ' => 'A',
                'ẩ' => 'a',
                'Ẳ' => 'A',
                'ẳ' => 'a',
                'Ẻ' => 'E',
                'ẻ' => 'e',
                'Ể' => 'E',
                'ể' => 'e',
                'Ỉ' => 'I',
                'ỉ' => 'i',
                'Ỏ' => 'O',
                'ỏ' => 'o',
                'Ổ' => 'O',
                'ổ' => 'o',
                'Ở' => 'O',
                'ở' => 'o',
                'Ủ' => 'U',
                'ủ' => 'u',
                'Ử' => 'U',
                'ử' => 'u',
                'Ỷ' => 'Y',
                'ỷ' => 'y',
                // Tilde.
                'Ẫ' => 'A',
                'ẫ' => 'a',
                'Ẵ' => 'A',
                'ẵ' => 'a',
                'Ẽ' => 'E',
                'ẽ' => 'e',
                'Ễ' => 'E',
                'ễ' => 'e',
                'Ỗ' => 'O',
                'ỗ' => 'o',
                'Ỡ' => 'O',
                'ỡ' => 'o',
                'Ữ' => 'U',
                'ữ' => 'u',
                'Ỹ' => 'Y',
                'ỹ' => 'y',
                // Acute accent.
                'Ấ' => 'A',
                'ấ' => 'a',
                'Ắ' => 'A',
                'ắ' => 'a',
                'Ế' => 'E',
                'ế' => 'e',
                'Ố' => 'O',
                'ố' => 'o',
                'Ớ' => 'O',
                'ớ' => 'o',
                'Ứ' => 'U',
                'ứ' => 'u',
                // Dot below.
                'Ạ' => 'A',
                'ạ' => 'a',
                'Ậ' => 'A',
                'ậ' => 'a',
                'Ặ' => 'A',
                'ặ' => 'a',
                'Ẹ' => 'E',
                'ẹ' => 'e',
                'Ệ' => 'E',
                'ệ' => 'e',
                'Ị' => 'I',
                'ị' => 'i',
                'Ọ' => 'O',
                'ọ' => 'o',
                'Ộ' => 'O',
                'ộ' => 'o',
                'Ợ' => 'O',
                'ợ' => 'o',
                'Ụ' => 'U',
                'ụ' => 'u',
                'Ự' => 'U',
                'ự' => 'u',
                'Ỵ' => 'Y',
                'ỵ' => 'y',
                // Vowels with diacritic (Chinese, Hanyu Pinyin).
                'ɑ' => 'a',
                // Macron.
                'Ǖ' => 'U',
                'ǖ' => 'u',
                // Acute accent.
                'Ǘ' => 'U',
                'ǘ' => 'u',
                // Caron.
                'Ǎ' => 'A',
                'ǎ' => 'a',
                'Ǐ' => 'I',
                'ǐ' => 'i',
                'Ǒ' => 'O',
                'ǒ' => 'o',
                'Ǔ' => 'U',
                'ǔ' => 'u',
                'Ǚ' => 'U',
                'ǚ' => 'u',
                // Grave accent.
                'Ǜ' => 'U',
                'ǜ' => 'u',
            ];
            if (in_array($locale, ['de_DE', 'de_DE_formal', 'de_CH', 'de_CH_informal', 'de_AT'], true)) {
                $chars['Ä'] = 'Ae';
                $chars['ä'] = 'ae';
                $chars['Ö'] = 'Oe';
                $chars['ö'] = 'oe';
                $chars['Ü'] = 'Ue';
                $chars['ü'] = 'ue';
                $chars['ß'] = 'ss';
            } elseif ('da_DK' === $locale) {
                $chars['Æ'] = 'Ae';
                $chars['æ'] = 'ae';
                $chars['Ø'] = 'Oe';
                $chars['ø'] = 'oe';
                $chars['Å'] = 'Aa';
                $chars['å'] = 'aa';
            } elseif ('ca' === $locale) {
                $chars['l·l'] = 'll';
            } elseif ('sr_RS' === $locale || 'bs_BA' === $locale) {
                $chars['Đ'] = 'DJ';
                $chars['đ'] = 'dj';
            }
            $string = strtr($string, $chars);
        } else {
            $chars = [];
            // Assume ISO-8859-1 if not UTF-8.
            $chars['in'] = "\x80\x83\x8a\x8e\x9a\x9e"
                . "\x9f\xa2\xa5\xb5\xc0\xc1\xc2"
                . "\xc3\xc4\xc5\xc7\xc8\xc9\xca"
                . "\xcb\xcc\xcd\xce\xcf\xd1\xd2"
                . "\xd3\xd4\xd5\xd6\xd8\xd9\xda"
                . "\xdb\xdc\xdd\xe0\xe1\xe2\xe3"
                . "\xe4\xe5\xe7\xe8\xe9\xea\xeb"
                . "\xec\xed\xee\xef\xf1\xf2\xf3"
                . "\xf4\xf5\xf6\xf8\xf9\xfa\xfb"
                . "\xfc\xfd\xff";
            $chars['out'] = 'EfSZszYcYuAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy';
            $string = strtr($string, $chars['in'], $chars['out']);
            $double_chars = [];
            $double_chars['in'] = ["\x8c", "\x9c", "\xc6", "\xd0", "\xde", "\xdf", "\xe6", "\xf0", "\xfe"];
            $double_chars['out'] = ['OE', 'oe', 'AE', 'DH', 'TH', 'ss', 'ae', 'dh', 'th'];
            $string = str_replace($double_chars['in'], $double_chars['out'], $string);
        }
        return $string;
    }

    // --------------------------------------------------

    /**
     * @param $str
     * @return bool
     */
    public static function seems_utf8($str): bool
    {
        self::mbstring_binary_safe_encoding();
        $length = strlen($str);
        self::mbstring_binary_safe_encoding(true);
        for ($i = 0; $i < $length; $i++) {
            $c = ord($str[$i]);
            if ($c < 0x80) {
                $n = 0; // 0bbbbbbb
            } elseif (($c & 0xE0) == 0xC0) {
                $n = 1; // 110bbbbb
            } elseif (($c & 0xF0) == 0xE0) {
                $n = 2; // 1110bbbb
            } elseif (($c & 0xF8) == 0xF0) {
                $n = 3; // 11110bbb
            } elseif (($c & 0xFC) == 0xF8) {
                $n = 4; // 111110bb
            } elseif (($c & 0xFE) == 0xFC) {
                $n = 5; // 1111110b
            } else {
                return false; // Does not match any model.
            }
            for ($j = 0; $j < $n; $j++) { // n bytes matching 10bbbbbb follow ?
                if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80)) {
                    return false;
                }
            }
        }
        return true;
    }

    // --------------------------------------------------

    /**
     * @param bool $reset
     * @return void
     */
    public static function mbstring_binary_safe_encoding(bool $reset = false)
    {
        static $encodings = [];
        static $overloaded = null;
        if (is_null($overloaded)) {
            $overloaded = function_exists('mb_internal_encoding') && (ini_get('mbstring.func_overload') & 2); // phpcs:ignore PHPCompatibility.IniDirectives.RemovedIniDirectives.mbstring_func_overloadDeprecated
        }
        if (false === $overloaded) {
            return;
        }
        if (!$reset) {
            $encoding = mb_internal_encoding();
            $encodings[] = $encoding;
            mb_internal_encoding('ISO-8859-1');
        }
        if ($reset && $encodings) {
            $encoding = array_pop($encodings);
            mb_internal_encoding($encoding);
        }
    }

    // --------------------------------------------------

    /**
     * https://developer.wordpress.org/reference/functions/normalize_whitespace/
     *
     * @param $str
     * @return string|string[]|null
     */
    public static function normalize_whitespace($str)
    {
        $str = trim($str);
        $str = str_replace("\r", "\n", $str);

        return preg_replace(['/\n+/', '/[ \t]+/'], ["\n", ' '], $str);
    }

    // --------------------------------------------------

    /**
     * @param string $key
     * @param array $array
     * @param array $insert_array
     *
     * @return array
     */
    public static function insertAfter(string $key, array $array, array $insert_array): array
    {
        return self::insert($array, $insert_array, $key, 'after');
    }

    // --------------------------------------------------

    /**
     * @param mixed $key
     * @param array $array
     * @param array $insert_array
     *
     * @return array
     */
    public static function insertBefore($key, array $array, array $insert_array): array
    {
        return self::insert($array, $insert_array, $key, 'before');
    }

    // --------------------------------------------------

    /**
     * @param array $array
     * @param array $insert_array
     * @param string $key
     * @param string $position
     *
     * @return array
     */
    public static function insert(array $array, array $insert_array, string $key, string $position = 'before'): array
    {
        $keyPosition = array_search($key, array_keys($array));
        if ($keyPosition === false) {
            return array_merge($array, $insert_array);
        }

        $keyPosition = (int)$keyPosition;
        if ('after' == $position) {
            ++$keyPosition;
        }
        $result = array_slice($array, 0, $keyPosition);
        $result = array_merge($result, $insert_array);

        return array_merge($result, array_slice($array, $keyPosition));
    }

    // --------------------------------------------------

    /**
     * @param array $array
     * @param mixed $value
     * @param mixed|null $key
     *
     * @return array
     */
    public static function prepend(array &$array, $value, $key = null): array
    {
        if (!is_null($key)) {
            return $array = [$key => $value] + $array;
        }

        array_unshift($array, $value);

        return $array;
    }

    // --------------------------------------------------

    /**
     * Normalize the given path. On Windows servers backslash will be replaced
     * with slash. Removes unnecessary double slashes and double dots. Removes
     * last slash if it exists.
     *
     * Examples:
     * path::normalize("C:\\any\\path\\") returns "C:/any/path"
     * path::normalize("/your/path/..//home/") returns "/your/home"
     *
     * @param string $path
     *
     * @return string
     */
    public static function normalize_path(string $path): string
    {
        // Backslash to slash convert
        if (strtoupper(substr(PHP_OS, 0, 3)) == "WIN") {
            $path = preg_replace('/([^\\\])\\\+([^\\\])/s', "$1/$2", $path);
            if (substr($path, -1) == "\\") {
                $path = substr($path, 0, -1);
            }
            if (substr($path, 0, 1) == "\\") {
                $path = "/" . substr($path, 1);
            }
        }
        $path = preg_replace('/\/+/s', "/", $path);
        $path = "/$path";
        if (substr($path, -1) != "/") {
            $path .= "/";
        }
        $expr = '/\/([^\/]{1}|[^\.\/]{2}|[^\/]{3,})\/\.\.\//s';
        while (preg_match($expr, $path)) {
            $path = preg_replace($expr, "/", $path);
        }
        $path = substr($path, 0, -1);
        return substr($path, 1);
    }

    // --------------------------------------------------

    /**
     * Encoded Mailto Link
     *
     * Create a spam-protected mailto link written in Javascript
     *
     * @param string $email the email address
     * @param string $title the link title
     * @param string|null|array $attributes any attributes
     *
     * @return string
     */
    public static function safeMailTo(string $email, string $title = '', $attributes = ''): ?string
    {
        if (!$email) {
            return null;
        }

        if (trim($title) === '') {
            $title = $email;
        }

        $x = str_split('<a href="mailto:', 1);

        for ($i = 0, $l = strlen($email); $i < $l; $i++) {
            $x[] = '|' . ord($email[$i]);
        }

        $x[] = '"';

        if ($attributes !== '') {
            if (is_array($attributes)) {
                foreach ($attributes as $key => $val) {
                    $x[] = ' ' . $key . '="';
                    for ($i = 0, $l = strlen($val); $i < $l; $i++) {
                        $x[] = '|' . ord($val[$i]);
                    }
                    $x[] = '"';
                }
            } else {
                for ($i = 0, $l = mb_strlen($attributes); $i < $l; $i++) {
                    $x[] = mb_substr($attributes, $i, 1);
                }
            }
        }

        $x[] = '>';

        $temp = [];
        for ($i = 0, $l = strlen($title); $i < $l; $i++) {
            $ordinal = ord($title[$i]);

            if ($ordinal < 128) {
                $x[] = '|' . $ordinal;
            } else {
                if (empty($temp)) {
                    $count = ($ordinal < 224) ? 2 : 3;
                }

                $temp[] = $ordinal;
                if (count($temp) === $count) // @phpstan-ignore-line
                {
                    $number = ($count === 3) ? (($temp[0] % 16) * 4096) + (($temp[1] % 64) * 64) + ($temp[2] % 64) : (($temp[0] % 32) * 64) + ($temp[1] % 64);
                    $x[] = '|' . $number;
                    $count = 1;
                    $temp = [];
                }
            }
        }

        $x[] = '<';
        $x[] = '/';
        $x[] = 'a';
        $x[] = '>';

        $x = array_reverse($x);

        // improve obfuscation by eliminating newlines & whitespace
        $output = '<script type="text/javascript">'
            . 'var l=new Array();';

        foreach ($x as $i => $value) {
            $output .= 'l[' . $i . "] = '" . $value . "';";
        }

        return $output . ('for (var i = l.length-1; i >= 0; i=i-1) {'
                . "if (l[i].substring(0, 1) === '|') document.write(\"&#\"+unescape(l[i].substring(1))+\";\");"
                . 'else document.write(unescape(l[i]));'
                . '}'
                . '</script>');
    }

    /**
     * Checks for invalid UTF8 in a string.
     *
     * @param string $text   The text which is to be checked.
     * @param bool $strip  Optional. Whether to attempt to strip out invalid UTF8. Default false.
     * @return string The checked text.
     */
    public static function check_invalid_utf8(string $text, bool $strip = false ): string
    {
        $text = (string) $text;

        if ( 0 === strlen( $text ) ) {
            return '';
        }

        // Check for support for utf8 in the installed PCRE library once and store the result in a static.
        static $utf8_pcre = null;
        if ( ! isset( $utf8_pcre ) ) {
            // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged
            $utf8_pcre = @preg_match( '/^./u', 'a' );
        }
        // We can't demand utf8 in the PCRE installation, so just return the string in those cases.
        if ( ! $utf8_pcre ) {
            return $text;
        }

        // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged -- preg_match fails when it encounters invalid UTF8 in $text.
        if ( 1 === @preg_match( '/^./us', $text ) ) {
            return $text;
        }

        // Attempt to strip the bad chars if requested (not recommended).
        if ( $strip && function_exists( 'iconv' ) ) {
            return iconv( 'utf-8', 'utf-8', $text );
        }

        return '';
    }

    /**
     * Converts a number of special characters into their HTML entities.
     *
     * Specifically deals with: `&`, `<`, `>`, `"`, and `'`.
     *
     * `$quote_style` can be set to ENT_COMPAT to encode `"` to
     * `&quot;`, or ENT_QUOTES to do both. Default is ENT_NOQUOTES where no quotes are encoded.
     */
    public static function specialchars( $text, $quote_style = ENT_NOQUOTES, $charset = false, $double_encode = false ) {
        $text = (string) $text;

        if ( 0 === strlen( $text ) ) {
            return '';
        }

        // Don't bother if there are no special chars - saves some processing.
        if ( ! preg_match( '/[&<>"\']/', $text ) ) {
            return $text;
        }

        // Account for the previous behavior of the function when the $quote_style is not an accepted value.
        if ( empty( $quote_style ) ) {
            $quote_style = ENT_NOQUOTES;
        } elseif ( ENT_XML1 === $quote_style ) {
            $quote_style = ENT_QUOTES | ENT_XML1;
        } elseif ( ! in_array( $quote_style, array( ENT_NOQUOTES, ENT_COMPAT, ENT_QUOTES, 'single', 'double' ), true ) ) {
            $quote_style = ENT_QUOTES;
        }

        // Store the site charset.
        if ( ! $charset || in_array( $charset, array( 'utf8', 'utf-8', 'UTF8' ), true ) ) {
            $charset = 'UTF-8';
        }

        $_quote_style = $quote_style;

        if ( 'double' === $quote_style ) {
            $quote_style  = ENT_COMPAT;
            $_quote_style = ENT_COMPAT;
        } elseif ( 'single' === $quote_style ) {
            $quote_style = ENT_NOQUOTES;
        }

        if ( ! $double_encode ) {
            $text = str_replace( '&', '&amp;', $text );
        }

        $text = htmlspecialchars( $text, $quote_style, $charset, $double_encode );

        // Back-compat.
        if ( 'single' === $_quote_style ) {
            $text = str_replace( "'", '&#039;', $text );
        }

        return $text;
    }

    //--------------------------------------------------------------------

    /**
     * @param $table
     * @param $db_col_name
     * @param $target_value
     * @return int
     */
    public static function total_post_number ( $table, $db_col_name, $target_value ): int
    {
        global $d;

        $where = "";

        if ( $target_value ) {
            $target_value = mb_strtolower( $target_value );
            $where .= " AND LOWER($db_col_name) REGEXP $target_value";
        }

        $sqlNum = "SELECT count(*) as 'num' FROM #_{$table} WHERE 1 = 1 {$where}";
        $count = $d->rawQueryOne($sqlNum);

        return $count['num'] ? number_format( $count['num'] ) : 0;
    }
}
