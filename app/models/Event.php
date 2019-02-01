<?php
  class Event {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getEvents(){
      $this->db->query('SELECT * FROM events
                        -- we join users in the tabel here.

                        ');

      $results = $this->db->resultSet();
      print_r($results);
      return $results;
    }
}
