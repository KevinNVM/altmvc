<?php

namespace App\Core\Http;

use App\Core\Response\View;

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

    public static function view(string $view, ?array $params = [], string $withLayout = ''): View
    {
        return View::make($view, $params)->withLayout($withLayout);
    }

    public static function json($data, $status = 200, $headers = [])
    {
        $content = json_encode($data);
        $headers['Content-Type'] = 'application/json';
        return new static($content, $status, $headers);
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
}
