<?php

namespace App\Core\Http;

class Response
{
    protected $view;
    protected $data;
    protected $layout;
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

    public function layout($layout)
    {
        $this->layout = $layout;
        $this->content = static::renderLayout($layout, $this->content);
        return $this;
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

        return $this;
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

    protected static function renderLayout($layout, $content)
    {
        $layoutFile = concat(VIEWS_LAYOUT_PATH, $layout);
        if (!file_exists($layoutFile)) {
            throw new \Exception("Layout file not found: {$layoutFile}");
        }
        ob_start();
        require $layoutFile;
        $result = ob_get_clean();

        return $result;
    }
}
