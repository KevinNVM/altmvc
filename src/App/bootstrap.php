<?php

class App
{
    const VERSION = '2.1.0';

    protected $uri;
    protected $method;

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function run(): void
    {
        $this->loadEnvVariables();

        require_once dirname(__DIR__) . '/Core/Errors/handler.php';
        require_once dirname(__DIR__) . '/Core/Helpers.php';
        require_once dirname(__DIR__) . '/Core/Variables.php';

        $this->detectPublicOnUrlString();

        $this->loadRouter();
    }

    private function loadRouter(): void
    {
        $routerPath = 'Routes.php'; # Select router to use

        require_once dirname(__DIR__) . '/Routes/' . $routerPath;

        // use router on running app
        $router->useRouter(
            path: $this->uri,
            method: $this->method
        );
    }

    private function loadEnvVariables(): void
    {
        $dotenv = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
        $dotenv->load();
    }

    private function detectPublicOnUrlString(): void
    {
        $path = rtrim(parse_url($this->uri, PHP_URL_PATH), '/');
        $usingAltServe = !strpos($path, "/public") && !strpos($path, "public");

        if (!$usingAltServe && $_ENV['PREVENT_PUBLIC_URL_STRING'] && $_ENV['ENVIRONMENT'] !== 'production') {
            echo "<script>
                    console.warn(\"Warning: AltMVC detect that your urls contains /public! If you are not running AltMVC using serve command, certain functionality might not work. This warning will not appear on production mode. You can disable this message in the .env file.\");
                  </script>";
        }
        return;
    }
}

return new App();
