<?php

namespace Kleber;


class Container {

    private $container;

    public function __construct(){
        $this->container = [];
    }

    public function addRoute( $route ){

        $this->container[ $route->method() ] = array(
            "Method" => $route->method(),
            "Path"   => $route->path(),
            "Action" => $route->action()
        );

    }

    

    public function dump(){
        var_dump( $this->container );
    }


}