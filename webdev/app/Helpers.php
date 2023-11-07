<?php


namespace Kleber;


class Helpers {


    public static function log( $msg )
    {
        echo $msg . "<br />";
    }



    public static function assertEquality( $a, $b)
    {
        return ( $a == $b ) ? true : false;
    }


}