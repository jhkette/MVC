<?php

/* App core clase -
-creates url
-loads core controller
-URL FORMAT - /controller/method/params  (these are each get/set from here) */

class Core {
  protected $currentController = 'Pages';
  protected $currentMethod = 'index';
  protected $params = [];

 // This function constructs URL see notes on OOP php.
 // it will construct URL, which then GETS from getURL or load the default
  public function  __construct() {
      $url = $this->getUrl();
       // Look in controllers for first Index
        // This concatenates url to see if it exists in controller
        if(file_exists('../app/controllers/'. ucwords(($url[0].'.php')))) {
         /* if exists set as controller. ITS going to overwrite pages which is default */
        $this ->currentController = ucwords($url[0]);
         // unset 0 index;
        unset($url[0]);
    }
    //require controller
    require_once '../app/controllers/' . $this -> currentController . '.php';

    // instantiate controller
    $this->currentController = new $this->currentController;

    //check for 2nd part of url
    //isset check if variable is set or not (ie isn't null). // method exists checks method on class exists

    if(isset($url[1])){
        if(method_exists($this->currentController, $url[1])){
            $this->currentMethod = $url[1];
             unset($url[1]);
         }
     }
     // Get params
      $this->params = $url ? array_values($url) : [];

      // Call a callback with array of params
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
 }
 // This function GETS the URL and returns it.
 public function getUrl(){
     if(isset($_GET['url'])){
         $url = rtrim($_GET['url'], '/');
         $url = filter_var($url, FILTER_SANITIZE_URL); # filter var , with sanitize url. Only chars for URLS.
         // explodes URL and turns it into an array
         $url = explode('/', $url);
         return $url;
     }
  }
}

 ?>
