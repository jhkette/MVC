<?php
  class Event {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getEvents(){
      $this->db->query('SELECT *,
                       -- create an alias asthey are called the same thing
                        events.id as eventsId,
                        users.id as userId,
                        -- create an alias as they are called the same thing
                        events.date_created as dateCreated,
                        users.created_at as userCreated
                        FROM events
                        -- we join users in the tabel here.
                        INNER JOIN users
                        ON events.user_id = users.id
                        ORDER BY events.date_created DESC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }


    public function addPost($data){
        $this->db->query('INSERT INTO posts (title, user_id, body ) VALUES(:title, :user_id, :body)');
        // Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':body', $data['body']);

        // Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }

    }


        public function updatePost($data){
            $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id =:id');
            // Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':title', $data['title']);

            $this->db->bind(':body', $data['body']);

            // Execute
            if($this->db->execute()){
              return true;
            } else {
              return false;
            }

        }



    public function getPostById($id){
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;

    }

    public function deletePost($id){
        $this->db->query('DELETE from posts WHERE id =:id');
        // Bind values
        $this->db->bind(':id', $id);

        // Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }

    }


  }
