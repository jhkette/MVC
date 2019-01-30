<?php

class Posts extends Controller {

    public function __construct(){
        if(!isLoggedIn()) {
            redirect('users/login');
        }

        $this -> postModel = $this->model('Post');
    }
    public function index(){

        $posts = $this->postModel->getPosts();

        $data =[

            'posts' => $posts,
        ];

        $this->view('posts/index', $data);

    }
    public function add(){

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data=  [

                'title' =>trim($_POST['title']),
                'body' =>trim($_POST['body']),
                'user_id' =>trim($_SESSION['user_id']),
                'title_err' => '',
                'body_err' => ''
            ];


            //validate title

            if(empty($data['title'])){
                $data['title_err'] = 'Please enter title';
            }
            if(empty($data['body'])){
                $data['body_err'] = 'Please enter body text';
            }


            if(empty($data['title_err']) && empty($data['body_err'])) {
                if($this -> postModel->addPost($data)){
                flash('post_added', 'Post added');
                redirect('posts');
                }
                else{
                    die('broken');
                }

            }else{
                $this->view('posts/add', $data);
            }



        }else{
            $data=  [

                'title' =>'',
                'body' =>''
            ];

                $this->view('posts/add', $data);
        }

        }




}



?>
