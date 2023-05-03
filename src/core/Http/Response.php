<?php

namespace App\Core\Http;

class Response
{
    protected $content;
    protected $status;
    protected $headers;

    public function __construct($content = '', $status = 200, $headers = [])
    {
        $this->content = $content;
        $this->status = $status;
        $this->headers = $headers;
    }

    public static function view($view, $data = [])
    {
        return new static(static::renderView($view, $data));
    }

    public static function json($data, $status = 200, $headers = [])
    {
        $content = json_encode($data);
        $headers['Content-Type'] = 'application/json';
        return new static($content, $status, $headers);
    }

    public function status($status)
    {
        $this->status = $status;
        return $this;
    }

    public function header($name, $value)
    {
        $this->headers[$name] = $value;
        return $this;
    }

    public function send()
    {
        foreach ($this->headers as $name => $value) {
            header("{$name}: {$value}");
        }

        http_response_code($this->status);

        echo $this->content;
    }

    public function __toString()
    {
        return $this->content;
    }

    protected static function renderView($view, $data = [])
    {
        $viewFile = concat(VIEWS_PATH, $view);
        if (!file_exists($viewFile)) {
            throw new \Exception("View file not found: {$viewFile}");
        }
        extract($data);
        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        return $content;
    }
}
