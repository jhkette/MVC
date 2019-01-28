<?php
  class Pages extends Controller {


    public function index(){

      $data = [
        'title' => 'Shareposts',
        'description' => 'Simple shareposts app'


      ];

      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Us',
        'description' => 'App to share posts'
      ];

      $this->view('pages/about', $data);
    }
  }
