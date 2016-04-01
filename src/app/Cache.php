<?php


namespace naspersclassifieds\olxeu\app;


class Cache
{
    const DELIMITER = ';;;';
    private $path;
    private $data;

    public function __construct($path = '../runtime/application.cache')
    {
        $this->path = $path;
        $this->load();
    }

    private function load()
    {
        $this->data = [];
        if (!file_exists($this->path)) {
            return;
        }
        foreach (file($this->path) as $line) {
            $parts = explode(self::DELIMITER, $line, 2);
            $this->data[$parts[0]] = $parts[1];
        }
    }

    public function __destruct()
    {
        $this->save();
    }

    private function save()
    {
        $data = [];
        foreach ($this->data as $name => $value) {
            $data[] = $name . self::DELIMITER . $value;
        }
        file_put_contents($this->path, implode("\n", $data));
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function get($key)
    {
        return !empty($this->data[$key]) ? $this->data[$key] : null;
    }

    public function clear()
    {
        $this->data = [];
    }
}
