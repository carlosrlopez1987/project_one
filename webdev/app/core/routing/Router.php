<?php

namespace Kleber\core\routing;

use Kleber\core\interfaces\RouterInterface as RouterInterface;
use Kleber\core\interfaces\ServiceInterface as ServiceInterface;
use Kleber\core\routing\Route as Route;


class Router implements RouterInterface, ServiceInterface 
{
    protected $app;
    protected $routes;

    private const Name = "Router";

    public const GET    = "GET";
    public const PUT    = "PUT";
    public const POST   = "POST";
    public const DELETE = "DELETE";
    public const UPDATE = "UPDATE";
    public const ALL    = "GET|POST|PUT|DELETE|UPDATE";

    public function __construct( $app ){ 
        $this->app = $app;
        $this->routes = $app->routes(); 
    }

    public function name()
    {
        return self::Name;
    }

    public function route( $method, $path, $action )
    {
        if ( class_exists( Route::class ) )
        {
            $route = Route::make( $method, $path, $action );
        }
        else
        {
            $route = [
                "Method"     => $method,
                "Path"       => $path,
                "Action"     => $action,
                "Middleware" => [],
                "Before"     => []
            ];
        }

        array_push( $this->routes, $route );

        return $route;
    }

    // loop through route container to find route that matches 
    // method and path given as parameters
    public function match( $method, $path )
    {
        $found = false;

        foreach( $this->routes as $route )
        {
            if ( !is_array($route) )
            {
                if ( $route->match( $method, $path ) )
                {
                    $found = $route;
                    break;
                }
            }
            else if ( is_array( $route ) )
            {
                $assertMethod = App::assertEquality( $route[ "Method" ], $method );
                $assertPath   = App::assertEquality( $rouye[ "Path"   ], $path   );

                if ( $assertMethod && $assertPath )
                {
                    $found = $route;
                    break;
                }
            }
        }

        return $found;
    }


    public function all( $path, $action )
    {
        $this->route( self::ALL, $path, $action );
    }

    public function get( $path, $action )
    {
        $this->route( self::GET, $path, $action );
    }

    public function post( $path, $action )
    {
        $this->route( self::POST, $path, $action );
    }

    public function put( $path, $action )
    {
        $this->route( self::PUT, $path, $action );
    }

    public function delete( $path, $action )
    {
        $this->route( self::DELETE, $path, $action );
    }

    public function update( $path, $action )
    {
        $this->route( self::UPDATE, $path, $action );
    }

}