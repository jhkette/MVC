<?php
  class Post {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getPosts(){
      $this->db->query('SELECT *,
                       -- create an alias asthey are called the same thing
                        posts.id as postId,
                        users.id as userId,
                        -- create an alias as they are called the same thing
                        posts.created_at as postCreated,
                        users.created_at as userCreated
                        FROM posts
                        -- we join users in the tabel here.
                        INNER JOIN users
                        ON posts.user_id = users.id
                        ORDER BY posts.created_at DESC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }
  }
