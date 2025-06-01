<?php
    namespace app\models;

    require_once(__DIR__ . '/Model.php');
    class UserModel extends Model {
        protected string $table = 'users';
        public function __construct() {
            parent::__construct($this->table);
        }
        public function create(string $name, string $emailAddress, string $password): void {
            $this->store([
                "name" => $name,
                "email" => $emailAddress,
                "password" => password_hash($password, PASSWORD_BCRYPT),
            ]);
        }

        public function deleteById(int $id): void {
            $this->delete([
                'id' => $id
            ]);
        }

        public function findByEmail(string $emailAddress): array|false {
            return $this->find($emailAddress, 'email');
        }

        public function findById(string $id): ?array {
            return $this->find($id) ?? null;
        }

    }