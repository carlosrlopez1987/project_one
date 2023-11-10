<?php
namespace Kleber\views;

class BaseView {


    protected $data = [];


    public function __construct( $data )
    {
        //
        $this->data = $data;
    }

    public function render()
    {
        extract( $this->data );
        
        require_once $this->data[ 'Page' ];

        // This two lines of code bellow were the main problem why nothing was showing up on my page!!!
        //$output = ob_get_clean();

        // Return the generated output
        //return $output;
    }
}