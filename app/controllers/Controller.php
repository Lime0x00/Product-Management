<?php

    class Controller {
        public function view($viewFile, $data = []): void{
            extract($data);

            include (__DIR__ . '/../resources/layout/layout.php');
        }
    }
