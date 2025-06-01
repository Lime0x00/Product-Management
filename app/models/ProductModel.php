<?php

    namespace app\models;

    use app\models\Model;

    require_once('Model.php');

    final class ProductModel extends Model {
        protected string $table = 'products';

        public function __construct() {
            parent::__construct($this->table);
        }

        public function add(string $name, float $price, string $description): int {
            $this->store([
                'name' => $name,
                'price' => $price,
                'description' => $description,
            ]);

            return $this->connection->lastInsertId();
        }

        public function findById(int $id): array|false {
            return $this->find($id);
        }

        public function updateProduct(int $id, string $name, float $price, string $description) {
            $this->update(
                [
                    'name' => $name,
                    'price' => $price,
                    'description' => $description,
                ],
                [
                    'id' => $id
                ]
            );
        }
    }
