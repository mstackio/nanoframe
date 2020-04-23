<?php
namespace nanoframe\lib\ConfigManager;
class ConfigManager{
    protected static $settings = array();

    //Get Config Values
    public function get($key){
        return isset(self::$settings[$key]) ? self::$settings[$key]: null;
    }
    //Set Config Values
    public function set($key,$value){
        self::$settings[$key] = $value;
    }
}