<?php

    namespace core;

    class Session {
        public function __construct() {
            if (session_status() == PHP_SESSION_NONE) {
                session_save_path(__DIR__ . '/../storage/sessions/');
                if (!is_dir(session_save_path())) {
                    mkdir(session_save_path(), 0777, true);
                }
                session_start();
            }
        }


        public function set(string $key, mixed $value): void {
            $_SESSION[$key] = $value;
        }

        public function get(string $key): mixed {
            return $_SESSION[$key] ?? null;
        }

        public function has(string $key): bool {
            return isset($_SESSION[$key]);
        }

        public function remove(string $key): void {
            unset($_SESSION[$key]);
        }

        public function destroy(): void {
            session_unset();
            session_destroy();
        }
    }