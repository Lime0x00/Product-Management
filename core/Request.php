<?php

    namespace core;

    final class Request {
        public function method(): string {
            return $_SERVER['REQUEST_METHOD'];
        }

        public function uri(): string {
            $uri = $_SERVER['REQUEST_URI'];
            $queryPos = strpos($uri, '?');

            if (!$queryPos) {
                return trim($uri, '/');
            }

            return trim(substr($uri, 0, $queryPos), '/');
        }

        public function query(string $key = null): mixed {
            if ($key === null) {
                return $_GET;
            }
            return $_GET[$key] ?? null;
        }

        public function post(string $key = null): mixed {
            if ($key === null) {
                return $_POST;
            }
            return $_POST[$key] ?? null;
        }

    }