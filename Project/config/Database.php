<?php
    class Database
    {
        private $host = "localhost";
        private $dbName = "GarbageData";
        private $username = "root";
        private $password = "123456";
        private $conn;

        public function Connect()
        {
            $this->conn = null;

            try
            {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname= ' . $this->dbName,
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                echo 'Connection Error: ' . $e->getMessage();
            }
            return $this->conn;
        }
    }
?>