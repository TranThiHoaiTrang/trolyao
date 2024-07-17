<?php

class FileCache
{
    private $d;
    private string $path;

    function __construct($d)
    {
        $this->d = $d;
        $this->path = BASE_PATH . 'caches' . DIRECTORY_SEPARATOR;
    }

    /**
     * @throws Exception
     */
    public function store($key, $data, $ttl)
    {
        $h = fopen($this->getFileName($key), 'w');

        if (!$h) throw new Exception('Could not write to cache');

        $data = serialize([time() + $ttl, $data]);

        if (fwrite($h, $data) === false) {
            throw new Exception('Could not write to cache');
        }

        fclose($h);
    }

    public function getFileName($key): string
    {
        if (!file_exists($this->path)) {
            Helper::create_directory($this->path);
        }
        if (!file_exists($this->path . ".htaccess") && file_exists(UPLOADS . ".htaccess")) {
            copy(UPLOADS_PATH . ".htaccess", $this->path . ".htaccess");
        }

        return $this->path . 'cache_' . md5($key);
    }

    public function fetch($key)
    {
        $filename = $this->getFileName($key);

        if (!file_exists($filename) || !is_readable($filename)) return false;

        $data = file_get_contents($filename);
        $data = @unserialize($data);

        if (!$data) {
            unlink($filename);
            return false;
        }

        if (time() > $data[0]) {
            unlink($filename);
            return false;
        }

        return $data[1];
    }

    /**
     * @throws Exception
     */
    public function getCache($sql, $type = 'fetch', $time = 600)
    {
        if (!$data = $this->fetch($sql)) {
            if ($type == 'result') $data = $this->d->rawQuery($sql);
            else if ($type == 'fetch') $data = $this->d->rawQueryOne($sql);
            $this->store($sql, $data, $time);
        }
        return $data;
    }

    public function DeleteCache(): bool
    {
        if (!is_dir($this->path)) return false;
        if ($handle = opendir($this->path)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && $file != ".htaccess" && $file != "thumb.db" && $file != "index.html") {
                    if (!file_exists($this->path . $file) || !is_readable($this->path . $file)) return false;
                    unlink($this->path . $file);
                }
            }
            return true;
        } else return false;
    }
}
