<?php

    namespace core;

    use Exception;

    final class Router {
        private array $routes = [];

        public function get(string $uri, array $controllerAction): void {
            $this->routes['GET'][trim($uri, '/')] = $controllerAction;
        }

        public function post(string $uri, array $controllerAction): void {
            $this->routes['POST'][trim($uri, '/')] = $controllerAction;
        }

        /**
         * @throws Exception
         */
        public function dispatch(Request $request): void {
            $uri = $request->uri();
            $method = $request->method();

            if (!isset($this->routes[$method][$uri])) {
                $this->handleNotFound();
                return ;
            }

            $controllerAction = $this->routes[$method][$uri];

            [$controller, $action] = $controllerAction;

            $controllerClass = $controller;

            $controllerFile = __DIR__ . '/../' . str_replace('\\', '/', $controllerClass) . '.php';

            if (!file_exists($controllerFile)) {
                throw new Exception("Controller file not found: {$controllerFile}");
            }

            require_once($controllerFile);

            $controllerInstance = new $controllerClass();

            if (method_exists($controllerInstance, $action)) {
                $controllerInstance->$action($request);
            } else {
                throw new Exception("Action {$action} not found in controller {$controllerClass}");
            }
        }

        public static function url(string $segment): string {
            $url =  isset($_SERVER['HTTPS']) && $_SERVER['https']  === 'on ' ? 'https://' : 'http://';
            $url .= $_SERVER['HTTP_HOST'] . '/' . trim($segment, '/');
            return $url;
        }

        public static function redirect(string $segment): void {
            header('Location: ' . $segment);
            exit();
        }

        private function handleNotFound(): void {
            self::redirect('404');
            exit();
        }
    }
