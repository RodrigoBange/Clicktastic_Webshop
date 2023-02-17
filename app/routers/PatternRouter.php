<?php

class PatternRouter
{
    private function stripParameters($uri)
    {
        if (str_contains($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        return $uri;
    }

    public function route($uri): void
    {
        $uri = $this->stripParameters($uri);

        $explodedUri = explode('/', $uri);

        if (empty($explodedUri[0])) {
            $explodedUri[0] = 'home';
        }
        $controllerName = $explodedUri[0] . "controller";

        if (empty($explodedUri[1])) {
            $explodedUri[1] = 'index';
        }
        $methodName = $explodedUri[1];

        $filename = __DIR__ . '/../controllers/' . $controllerName . '.php';

        if (file_exists($filename)) {
            require ($filename);
            try {
                $controllerObj = new $controllerName();
                $controllerObj->$methodName();
            } catch (Error $e) {
                //If class / method does not load
                http_response_code(500);
            }
        } else {
            // Controller / method with url is not found
            //http_response_code(404);
            require_once(__DIR__ . '/../views/404.php');
        }
    }
}
