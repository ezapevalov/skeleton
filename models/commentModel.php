<?php

class commentModel {
    public function __construct() {

    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';


        for ( $i = 0; $i < $length; $i++ ) {
            $key = rand(0, $charactersLength) - 1;

            if ( !isset($characters[$key]) ) {
                $key = 0;
            }
            $randomString .= $characters[$key];
        }
        return $randomString;
    }
}