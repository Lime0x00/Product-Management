<?php
    namespace config;

    use PDO;

    class Database {
        private static string $serverName = '';
        private static string $database = '';
        private static string $userName = '';
        private static string $password = '';
        private static string $driver = 'mysql';

        public static function getConnection(array $flags = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]): PDO {
            $dsn = self::$driver . ':host=' . self::$serverName . ';dbname=' . self::$database;
            return new PDO($dsn, self::$userName, self::$password, $flags);
        }
    }
