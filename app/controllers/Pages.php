<?php
class Pages extends Controller {
    public function __construct(){

    }

    public function index(){
        $data = ['title' => 'Welcome there'];
       $this->view('pages/index', $data);
    }

    public function about(){
    $data = ['title' => 'This is about'];
    $this->view('pages/about', $data);

    }
}
 ?>
