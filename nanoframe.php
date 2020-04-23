<?php
namespace nanoframe\lib;
use nanoframe\lib\Router\Router;
use nanoframe\lib\Database\Database;
use nanoframe\lib\ConfigManager\ConfigManager;

class nanoframe{
    /* Router
    @var nanoframe\lib\Router\Router
    */
    protected $router;
    /**
     * Config Manager
     * @var nanoframe\lib\ConfigManager\ConfigManager
     */
    protected $ConfigManager;
    /**
     * Database
     * @var nanoframe\lib\Database\Database
     */
    protected $db;
    //Boot
    public function boot(){
        $this->RouteHandler();
    }
    /**
     * Config manager
     * * @return ConfigManager| nanoframe\lib\ConfigManager\ConfigManager
     */
    public function getConfigManager(){
        $this->ConfigManager = new ConfigManager();
        return $this->ConfigManager;
    }
    //Get Webaddr 
    public function getSiteUrl(){
        return $this->getConfigManager()->get("webaddr");
    }
    //Get root directory
    public function getRootDir(){
        return $this->getConfigManager()->get("webroot");
    }
    //Router Handler
    protected function RouteHandler(){
        $this->router = new Router($this->getRootDir());
        return $this->router;
    }
    /**
     * Get Database Handler
     * @return Database|nanoframe\lib\Database\Database
     */
    public function getDb(){
        $this->db = new Database("mysql",$this->getConfigManager()->get("mysql_host"),$this->getConfigManager()->get("mysql_db"),$this->getConfigManager()->get("mysql_user"),$this->getConfigManager()->get("mysql_pass"));
        return $this->db;
    }
   

}
