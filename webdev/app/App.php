<?php

namespace Kleber;

use Kleber\controllers\MainController;
use Kleber\core\interfaces\ServiceInterface as ServiceInterface;
use Kleber\core\routing\Route as Route;
use Kleber\core\routing\Http as Http;
use Kleber\Helpers as Helpers;


class App {

    private $container = null;
    protected $routes = null;
    private static $app = null;

    public const Router   = "Router";
    public const NotFound = "notFound";
    public const Default  = "DEFAULt";

    private function __construct(){
        $this->container = array();
        $this->routes    = array();
    }


    public function routes()
    {
        return $this->routes;
    }


    public function registerService( ServiceInterface $serv )
    {
        $this->container[ $serv->name() ] = $serv;
    }


    public function addDependency( $class )
    {
        $obj = new $class();
        $name = $obj->getName();
        $this->{$name} = $obj;
        return $this;
    }



    public function service( $name )
    {
        return $this->container[ $name ] ?: false;
    }

    public function getRequestMethod()
    {
        $method = ltrim($_SERVER[ "REQUEST_METHOD" ], '/');
        return $method;
    }


    public function getPath()
    {
        $reqPath = $_SERVER[ "REQUEST_URI" ];
        
        if ( $reqPath === "/" )
        {
            $reqPath = "index";
        }
       
        return $this->sanitizeUri( $reqPath );
    }

    public function sanitizeUri( $uri )
    {
        return explode( '/', rtrim( ltrim($uri, "/"), "/" ) );
    }


    public function parseRequest(){
      
        $reqMethod = $this->getRequestMethod();
        $reqPath   = $this->getPath();

        $route  = $this->find( $reqMethod, $reqPath[0] );

        if ( isset($route) && !is_bool($route) )
        {
            if ( is_object( $route ) )
            {
                $route->respond();
            }
            else if ( is_array( $route ) )
            {
                $this->respond( $route );
            }
            else
            {
                Helpers::log("parse last else!");
            }
        }
        else
        {
            Helpers::log( "Something is wrong");
        }
        
    }


    public function respond( $route )
    {
        $action = $route[ "Action" ][ "Method"     ];
        $class  = $route[ "Action" ][ "Controller" ];

        if ( !class_exists( $class ) )
        {
            //Helpers::log( "Controller class: $class does not exits!" );
            return;
        }
        
        $class = new $class();

        if ( method_exists( $action ) )
        {
            $class->$action();
            //call_user_method( $action, $class, $this );
        }
        
    }

   




    public static function get_instance()
    {
        if ( is_null( static::$app ) )
        {
            static::$app = new Self();
        }

        return static::$app;
    }
 




    public function start()
    {
        //$this->get( self::NotFound, [ "Method" => "notFound", "Controller" => MainController::class ] );
        //echo "Starting!";
        $this->parseRequest();
        
    }





    public function relocateTo( $loc ){ header( 'Location: ' . $loc ); }

    public static function assertEquality( $a, $b ){ return $a === $b; }





    public function find( $method, $path )
    {
        $found = false; // $this->service( self::Router )->match( $method, $path );

        foreach ( $this->routes as $route )
        {
            if ( is_array( $route ) )
            {
                $isMethod = $route[ "Method" ] == $method;
                $isPath   = $route[ "Path" ] == $path;

                if ( $isMethod && $isPath )
                {
                    Helpers::log( "Route was found!" );
                    $found = $route;
                    break;
                }
            }
            else
            {
                if ( $route->match($method, $path) )
                {
                    $found = $route;
                    break;
                }
            }
        }

        // if the route was not found, return the pageNotfound route
        if ( !$found )
        {
            $found = $this->notFound();
        }
        
        return $found;
    }


    public function notFound()
    { 
        if ( isset( $this->routes[ self::NotFound ] ) )
        {
            return $this->routes[ self::NotFound ];
        }
    }



    public function makeCustomDefaultRoute( $name, $action )
    {
        $route = false;

        if ( class_exists( Route::class ) )
        {
            $route = Route::make( self::Default, $name, $action );
            $this->routes[ $name ] = $route;
        }

        return $route;
    }


    public function route( $method, $path, $action )
    {
        if ( class_exists(Route::class) )
        {
            //Helpers::log( "ROute class exists!");
            $route = Route::make( $method, $path, $action );
        }
        else
        {
            Helpers::log( "No route class to make routes!" );
        }
        array_push( $this->routes, $route );

        return $route;
    }

    public function get( $path, $action )
    {
        //$this->service("router")->makeRoute( Http::GET, $path, $action );
        $this->route( Http::GET, $path, $action );
    }

    public function post( $path, $action )
    {
        $this->route( Http::POST, $path, $action );
    }
}