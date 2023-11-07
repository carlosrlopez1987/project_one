<?php

namespace Kleber\core\interfaces;


interface RouterInterface {
    public function Route( $method, $path, $action );
    public function match( $method, $path );
}