<?php

namespace App\Core\Response;

use App\Core\Errors\Exceptions\LayoutNotFoundException;
use App\Core\Errors\Exceptions\ViewNotFoundException;

class View
{

    public function __construct(
        protected string $view,
        protected ?array $params = [],
        protected string $layout = '',
        protected string $title = ''
    ) {
        $this->title = empty($this->title) ?
            (string) $_ENV["APP_NAME"] :
            $this->title;
    }

    public static function make(string $view, ?array $params = [], string $title = ''): static
    {
        return new static($view, $params, $title);
    }

    public function title(string $title)
    {
        return new static($this->view, $this->params, $this->layout, $title);
    }

    public function render(): string
    {
        $viewPath = concat(VIEWS_PATH, $this->view, '.php');
        $layoutPath = concat(VIEWS_LAYOUT_PATH, $this->layout, '.php');

        $viewString = '';
        $layoutString = '';

        if (!file_exists($viewPath)) throw new ViewNotFoundException();
        if (!empty($this->layout))
            if (!file_exists($layoutPath))
                throw new LayoutNotFoundException();
            else
                $layoutString = $this->getLayout($layoutPath);

        $viewString = $this->getView($viewPath);

        $output = !empty($this->layout) ?
            str_replace(
                search: [
                    '%%BODY%%', '%%TITLE%%'
                ],
                replace: [
                    $viewString,
                    $this->title
                ],
                subject: $layoutString
            ) :
            $viewString;


        return (string) $output;
    }

    public function withLayout(string $layout = DEFAULT_LAYOUT_PATH): static
    {
        $this->layout = $layout;

        return new static($this->view, $this->params, $this->layout);
    }

    private function getLayout(
        string $layoutPath
    ): string {
        return (string) file_get_contents($layoutPath);
    }

    private function getView(string $viewPath): string
    {
        // Extract variables from $this->params
        extract(
            $this->params
        );
        ob_start();
        include $viewPath;
        return (string) ob_get_clean();
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
