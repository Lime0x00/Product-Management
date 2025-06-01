<?php

namespace app\controllers;


    use Controller;


    require_once('Controller.php');

    class ErrorController extends Controller {
        public function notFound(): void {
            $this->view('404', ['title' => 'Not Found | Page']);
        }
    }