<?php
  class Events extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->postModel = $this->model('Event');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get posts
      $events = $this->postModel->getEvents();

      $data = [
        'events' => $events
      ];
       print_r($data);
      $this->view('events/index', $data);
    }
}
