<?php
    namespace App\Services;

    use SessionHandlerInterface;
    use PDO;

    class MySQLSessionHandler implements SessionHandlerInterface {
        private $pdo;

        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }

        public function open(string $savePath, string $sessionName): bool{
            return true;
        }

        public function close(): bool {
            return true;
        }

        public function read(string $id): string {
            $stmt = $this->pdo->prepare("SELECT data FROM php_sessions WHERE id = :id");
            $stmt->execute(["id" => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? $row["data"] : "";
        }

        public function write(string $id, string $data): bool
        {
            $stmt = $this->pdo->prepare("REPLACE INTO php_sessions (id, data, last_access) VALUES (:id, :data, :last_access)");
            return $stmt->execute([
                "id" => $id,
                "data" => $data,
                "last_access" => time(),
            ]);
        }

        public function destroy(String $id): bool {
            $stmt = $this->pdo->prepare("DELETE FROM php_sessions WHERE id = :id");
            return $stmt->execute(["id" => $id]);
        }
        
        public function gc(int $maxlifetime): int|false {
            $stmt = $this->pdo->prepare("DELETE FROM php_sessions WHERE last_access < :time");
            return $stmt->execute(["time" => time() -$maxlifetime]) ? 1 : 0;
        }

    }