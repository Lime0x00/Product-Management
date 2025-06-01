<?php
    namespace app\models;

    use PDO;
    use Exception;

    use Config\Database;

    require_once(__DIR__ . './../../config/Database.php');

    abstract class Model {
        protected string $table;
        protected PDO $connection;

        public function __construct(string $table) {
            $this->table = $table;
            $this->connection = Database::getConnection();
        }

        public function all(): ?array {
            $stmt = $this->connection->prepare("SELECT * FROM {$this->table}");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function store(array $data): bool {
            $columns = implode(',', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
            $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";

            $stmt = $this->connection->prepare($sql);
            foreach ($data as $column => $value) {
                $stmt->bindValue(":$column", $value);
            }
            return $stmt->execute();
        }

        public function find(mixed $id, string $column = 'id'): array|false {
            $stmt = $this->connection->prepare("SELECT * FROM {$this->table} WHERE {$column} = :value LIMIT 1");
            $stmt->bindParam(':value', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function delete(array $identifiers): bool {
            $conditions = [];
            foreach ($identifiers as $column => $value) {
                $conditions[] = "{$column} = :{$column}";
            }
            $whereClause = implode(' AND ', $conditions);

            $sql = "DELETE FROM {$this->table} WHERE {$whereClause}";
            $stmt = $this->connection->prepare($sql);

            foreach ($identifiers as $column => $value) {
                $stmt->bindValue(":$column", $value);
            }
            return $stmt->execute();
        }


        public function update(array $fields, array $where): bool
        {
            if (empty($fields) || empty($where)) {
                return false;
            }

            $setParts = [];
            $params = [];

            foreach ($fields as $column => $value) {
                $setParts[] = "`$column` = :set_$column";
                $params["set_$column"] = $value;
            }

            $whereParts = [];
            foreach ($where as $column => $value) {
                $whereParts[] = "`$column` = :where_$column";
                $params["where_$column"] = $value;
            }

            $setClause = implode(', ', $setParts);
            $whereClause = implode(' AND ', $whereParts);

            $sql = "UPDATE {$this->table} SET {$setClause} WHERE {$whereClause}";

            $stmt = $this->connection->prepare($sql);

            return $stmt->execute($params);
        }


        /**
         * @throws Exception on not finding this path
         */
        protected function view(string $path): void {
            $fullPath = dirname(__DIR__, 2) . '/resources/views/' . $path;
            if (!file_exists($fullPath)) {
                throw new Exception('Error: Cannot find this view path: ' . $path);
            }
            require($fullPath);
        }
    }



