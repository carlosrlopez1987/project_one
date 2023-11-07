<?php
namespace Kleber\views;

class BaseView {


    protected $data = [];


    public function __construct( $data )
    {
        //
        $this->data = $data;
        var_dump($data);
    }

    public function render()
    {
        echo "Rendering page<br />";
        
        extract( $this->data );
        
        require_once $this->data[ 'Page' ];

        $output = ob_get_clean();

        // Return the generated output
        return $output;
    }
}