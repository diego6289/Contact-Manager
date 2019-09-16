<?php
    class Post
    {
        private $conn;
        private $table = 'posts';

        public $id;
        public $categoryId;
        public $categoryName;
        public $title;
        public $body;
        public $author;
        public $createdAt;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function read()
        {
            $query = 'SELECT
                      c.name as categoryName,
                      p.id, 
                      p.categoryId, 
                      p.title,
                      p.body,
                      p.author,
                      p.createAt
                    FROM 
                    '. $this->table .' p
                    LEFT JOIN
                        categories c ON p.categoryId = c.id
                    ORDER BY
                        p.createdAt DESC';

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
    }
?>