<?php

namespace Kleber\core\routing;

class Route implements \ArrayAccess {

    protected $data = [];
    

    public const GET = "GET";
    public const POST = "POST";
    public const PUT = "put";
    public const DELETE = "DELETE";
    public const UPDATE = "UPDATE";  


    private function __construct( $method, $path, $action ){
        $this->data[ "Method" ] = $method;
        $this->data[ "Path"   ] = $path;
        $this->data[ "Action" ] = $action;
        $this->data[ "Middleware" ] = [];
        $this->data[ "Before" ] = [];
    }

    public function method(){ return $this->data[ "Method" ]; }
    public function path(){ return $this->data[   "Path"   ]; }
    public function action(){ return $this->data[ "Action" ]; }

    public function match( $method, $path )
    {
        $isMatch = false;

        if ( $this->method() === $method && $this->path() === $path )
        {
            $isMatch = true;
        }

        return $isMatch;
    }

    public function respond()
    {
        $method     = $this->data[ "Action" ][ "Method"     ];

        $controller = new $this->data[ "Action" ][ "Controller" ]();

        $controller->$method();
    }


    public function setName( $name ){ $this->data[ "Name" ] = $name; }

    public function offsetExists( $id )
    {
        return isset( $this->data[ $id ] );
    }

    public function offsetGet( $id )
    {
        return $this->data[ $id ];
    }

    public function offsetSet( $id, $value )
    {
        $this->data[ $id ] = $value;
    }

    public function offsetUnset( $id )
    {
        unset( $this->data[ $id ] );
    }

    public static function make( $method, $path, $action )
    {
        return new Route( $method, $path, $action );
    }

    // $app->registerRoute( Route::get( $path, $action ) );
    public static function get( $path, $action )
    {
        return static::make( self::GET, $path, $action );
    }

}