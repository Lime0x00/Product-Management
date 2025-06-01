<?php
    namespace app\controllers;

    use Controller;
    use core\Request;
    use app\models\UserModel;
    use core\Session;
    use core\Router;

    require_once(__DIR__ . './../../core/Session.php');
    require_once('Controller.php');
    require_once(__DIR__ . './../models/UserModel.php');

    class UserController extends Controller
    {
        protected UserModel $userModel;

        public function __construct() {
            $this->userModel = new UserModel();
        }

        public function loginPage(): void {
            $session = new Session();
            $user = $session->get('user');

            if (empty($user)) {
                $this->view('login');
                return ;
            }

            Router::redirect('dashboard');
        }

        public function login(Request $request): void {
            $session = new Session();
            $user = $session->get('user') ?? null;

            if (!empty($user)) {
                Router::redirect('dashboard');
                return;
            }

            $emailAddress = trim($request->post('emailAddress'));
            $password = trim($request->post('password'));

            if (empty($emailAddress) || empty($password)) {
                $this->view('login', [
                    'statusCode' => 400,
                    'msg'   => 'Email and Password are required.',
                ]);
                return;
            }

            $user = $this->userModel->findByEmail($emailAddress);

            if ($user && password_verify($password, $user['password'])) {
                $session->set('user', [
                    'id' => $user['userId'],
                    'name' => $user['name'],
                    'email' => $user['emailAddress'],
                ]);

                $this->view('login', [
                    'statusCode'  => 200,
                    'msg'         => 'Successfully Logged in.',
                    'redirectUrl' => Router::url('dashboard'),
                    'waitTime'    => 5,
                ]);
                return;
            } else {
                $this->view('login', [
                    'statusCode' => 400,
                    'msg'    => 'Invalid email or password.',
                ]);
            }
        }



        public function registerPage(): void {
           $session = new Session();
           $user = $session->get('user');

           if (empty($user)) {
               $this->view('register', [
                   'title' => 'Register | Page'
               ]);
                return ;
           }
           Router::redirect('dashboard');
        }

        public function register(Request $request): void {
            $session = new Session();

            if (!$session->has('id')) {
                $name = htmlspecialchars(trim($request->post('name')));
                $emailAddress = trim($request->post('emailAddress'));
                $password = trim($request->post('password'));

                if (empty($name) || empty($emailAddress) || empty($password)) {
                    $this->view('register', [
                        'statusCode' => 400,
                        'msg' => 'Fill All Fields'
                    ]);
                    return ;
                }

                $user = $this->userModel->findByEmail($emailAddress);


                if ($user) {
                    $this->view('register', [
                        'statusCode' => 400,
                        'msg' => 'User already registered',
                        'redirectUrl' => Router::url('login'),
                        'waitTime' => 5
                    ]);
                    return ;
                }

                $this->userModel->create($name, $emailAddress, $password);

                 $this->view('register', [
                    'statusCode' => 200,
                    'msg' => 'User Registered Successfully',
                    'redirectUrl' => Router::url('login'),
                    'waitTime' => 5,
                ]);
                return ;
            }

            Router::redirect('dashboard');
        }

        public function dashboard(): void {
            $session = new Session();

            $user = $session->get('user');

            if (!empty($user)) {
                $this->view('dashboard', [
                    'title' => 'Dashboard | Page',
                    'name' => $user['name']
                ]);
            } else {
                Router::redirect('login');
            }
        }

        public function logout(): void {
            $session = new Session();
            $session->destroy();
            Router::redirect('login');
        }
    }
