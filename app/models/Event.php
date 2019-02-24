<?php
  class Event {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getEvents(){
      $this->db->query('SELECT *,
                       -- create an alias asthey are called the same thing
                        events.id as eventId,
                        users.id as userId,
                        -- create an alias as they are called the same thing
                        events.created_at as eventCreated,
                        users.created_at as userCreated
                        FROM events
                        -- we join users in the tabel here.
                        INNER JOIN users
                        ON events.user_id = users.id
                        ORDER BY events.created_at DESC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }



    public function getEventsById($id){
      $this->db->query('SELECT * FROM events WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
  }

  public function addEvent($data){
    $this->db->query('INSERT INTO events (title, user_id, body ) VALUES(:title, :user_id, :body)');
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

public function updateEvent($data){
  $this->db->query('UPDATE events SET title = :title, body = :body WHERE id =:id');
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



}

// events.id as eventsId,
// users.id as userId,
// -- create an alias as they are called the same thing
// events.created_at as eventCreated,
// users.created_at as userCreated
// FROM events
// -- we join users in the tabel here.
// INNER JOIN users
// ON events.user_id = users.id
// ORDER BY events.created_at DESC