<?php
namespace Kleber\views;

class UserControlView {
    protected $data;
    public function __construct( $data )
    {
        $this->data = $data;
    }

    public function render()
    {
        extract( $this->data );
        require_once __DIR__ . "/../html/login.php";
    }
}