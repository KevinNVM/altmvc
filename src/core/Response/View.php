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
    ) {
    }

    public static function make(string $view, ?array $params = []): static
    {
        return new static($view, $params);
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
            str_replace('%%BODY%%', $viewString, $layoutString) :
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
        ob_start();
        include $viewPath;
        return (string) ob_get_clean();
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
