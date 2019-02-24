<?php
  class Events extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->eventModel = $this->model('Event');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get posts
      $events = $this->eventModel->getEvents();

      $data = [
        'events' => $events
      ];
      print_r($data);
      $this->view('events/index', $data);
    }




    public function show($id){
      $event = $this->eventModel->getEventsById($id);
      $user = $this->userModel->getUserById($event->user_id);

      $data = [
        'event' => $event,
        'user' => $user
      ];

      $this->view('events/show', $data);
    }

    
}
