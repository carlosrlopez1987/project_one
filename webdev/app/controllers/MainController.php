<?php

namespace Kleber\controllers;
use Kleber\views\BaseView as View;
use Kleber\views\UserControlView as LoginView;

class MainController extends BaseController {

    private $app;

    public function __construct()
    {
    
    }

    public function index() 
    {
        echo "index<br />";
        $data = [
            "Page" => realpath( __DIR__ . "/../html/main.php" ),
            "Name" => "Kleber"
        ];

        $view = new View( $data ); 
        $view->render();
    }


    public function profile()
    {
        $view = new View( [ "Message" => "Welcome to Kudious.com you are in the profile page!" ] );
        $view->render();
    }

    public function showLogin() 
    {

        $data = [
            "Page" => __DIR__ . "/../html/main.php",
            "Name" => "Kleber"
        ];

        $view = new LoginView( $data );
        $view->render();
    }

    public function login()
    {
        var_dump( $_POST );

        // user controller
        //$user = UserModel();

        echo "You are logged in!";
    }

    public function notFound(){
        echo "<b>The page you requested could not be found! </b>";
    }


}