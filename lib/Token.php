<?php
/**
 * Created by Anycodes on 9/29/2022 3:56 PM.
 */
namespace Lib;

class Token {
    
    private static $token_name = "7WAydNOFjcdP6KM";
    public static function generate($name = null) {
        $tokenVal = md5(uniqid());
        if($name) {
            Session()::set(self::$token_name.'_'.$name, $tokenVal);
        }
        Session()::set(self::$token_name, $tokenVal);
        return $tokenVal;
    }

    public static function get($name = null){
        if($results = Session()::get($name)) {
            return $results;
        }
        return false;
    }

    public static function check($token, $name = null) {
        $tokenName = self::$token_name;

        if($name) {
            $tokenName = self::$token_name.'_'.$name;
        }

        if(Session()::get($tokenName) && $token === Session()::get($tokenName)) {
            Session()::delete($tokenName);
            return true;
        }

        return false;
    }
}