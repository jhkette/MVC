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

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'title' => trim($_POST['title']),
          'body' => trim($_POST['body']),
          'user_id' => $_SESSION['user_id'],
          'title_err' => '',
          'body_err' => ''
        ];

        // Validate data
        if(empty($data['title'])){
          $data['title_err'] = 'Please enter title';
        }
        if(empty($data['body'])){
          $data['body_err'] = 'Please enter body text';
        }

        // Make sure no errors
        if(empty($data['title_err']) && empty($data['body_err'])){
          // Validated
          if($this->eventModel->addEvent($data)){
            flash('post_message', 'Event Added');
            redirect('events');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('events/add', $data);
        }

      } else {
        $data = [
          'title' => '',
          'body' => ''
        ];

        $this->view('events/add', $data);
      }
    }

    
}
