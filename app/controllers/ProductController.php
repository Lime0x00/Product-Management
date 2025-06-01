<?php
    namespace app\controllers;


    use Controller;
    use core\Router;
    use core\Request;
    use app\models\ProductModel;
    use core\Session;

    require_once(__DIR__ . './../../core/Session.php');


    require_once('Controller.php');

    require_once(__DIR__ . './../models/ProductModel.php');
    class ProductController extends Controller {
        private ProductModel $productModel;
        public function __construct() {
            $this->productModel = new ProductModel();
        }


        public function addProductForm() :void {
            $session = new Session();
            $user = $session->get('user');

            if (!empty($user)) {
                $this->view('add-product');
            }

            Router::redirect('login');
        }
        public function addProduct(Request $request): void {
            $session = new Session();

            $user = $session->get('user');

            if (!empty($user)) {
                $name = trim(htmlspecialchars($request->post('name')));
                $price = is_numeric((int) $request->post('price')) ? $request->post('price') : null;
                $description = trim(htmlspecialchars($request->post('description')));

                if (!empty($name) && !empty($price) && !empty($description)) {
                    $productId = $this->productModel->add($name, $price, $description);

                    $this->view('add-product', [
                        'statusCode' => 200,
                        'msg'   => "Product Added Successfully By Id {$productId}",
                    ]);
                }
            }

            Router::redirect('login');
        }

        public function showProducts(): void {
            $session = new Session();

            $user = $session->get('user');

            if (!empty($user)) {
                $products = $this->productModel->all();
                $this->view('show-products', [
                    'products' => $products
                ]);
                return ;
            }

            Router::redirect('login');
        }


        public function deleteProduct(Request $request): void
        {
            $session = new Session();
            $user = $session->get('user');

            if (!empty($user)) {
                $productId = $request->post('product-id');

                if (!empty($productId)) {
                    $product = $this->productModel->findById($productId);

                    if ($product) {
                        $this->productModel->delete([
                            'id' => $productId
                        ]);

                        $session->set('flash', [
                            'statusCode' => 200,
                            'msg' => "Product with ID {$productId} deleted successfully."
                        ]);
                    } else {
                        $session->set('flash', [
                            'statusCode' => 400,
                            'msg' => "Product not found."
                        ]);
                    }

                    Router::redirect('show-products');
                    return ;
                }
            }
            Router::redirect('login');
        }



        public function editProductForm(Request $request): void {
            $session = new Session();
            $user = $session->get('user');
            $productId = $request->query('id');

            if (!empty($user) && !empty($productId)) {
                $this->view('edit-product', [
                    'id' => $productId,
                ]);
                return ;
            }

            Router::redirect('login');
        }
        public function editProduct(Request $request): void {
            $session = new Session();
            $user = $session->get('user');

            if (!empty($user)) {
                $productId = (int) $request->post('id');
                $productName = trim($request->post('name'));
                $productPrice = $request->post('price');
                $productDescription = trim($request->post('description'));

                if (
                    $productId > 0 &&
                    !empty($productName) &&
                    is_numeric($productPrice) && $productPrice > 0 &&
                    !empty($productDescription)
                ) {
                    $product = $this->productModel->findById($productId);
                    if ($product) {
                        $this->productModel->updateProduct(
                            $productId,
                            htmlspecialchars($productName),
                            (float)$productPrice,
                            htmlspecialchars($productDescription)
                        );

                        var_dump($product);

                        Router::redirect('show-products');
                        return;
                    }
                }

                $session->set('flash', [
                    'statusCode' => 400,
                    'msg' => 'Invalid product data or product not found.'
                ]);

                Router::redirect('show-products');
                return ;
            }

            Router::redirect('login');
        }

    }