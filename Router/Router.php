<?php
namespace nanoframe\lib\Router;
use nanoframe\lib\nanoframe;

class Router extends nanoframe{
    var $controller;
    var $_controllerPath;
    var $webroot;
    function __construct($path)
    {
        $this->webroot = $path."/";
        $this->_controllerPath = "Controller/";
        $this->_getUrl();
        if(empty($this->_url[0])){

        }
        if(empty($this->_url[0])){
            $this->_loadDefaultController();
            return false;
        }
        $this->_loadExstingController();
        $this->_callControllerMethod();
    }
    private function _getUrl(){
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = str_replace("-","_",$url);
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode("/",$url);
        $this->_url = $url;
    }
    private  function _loadDefaultController(){
        include $this->webroot.$this->_controllerPath."index.php";
        $this->_controller = new \index();
        return $this->_controller->index();
    }
    function error404(){
        include $this->webroot.$this->_controllerPath."error.php";
        $this->_controller = new \_error();
    }
    /**
     * Load existing controller
     */
    private function _loadExstingController(){
        $file = $this->webroot.$this->_controllerPath.$this->_url[0].'.php';
        if(file_exists($file)){
            include $file;
            $this->_controller = new $this->_url[0]();
            $this->_controller->loadModel($this->_url[0]);
        }else {
            $this->error404();
            return false;
        }
    }

    protected function _callControllerMethod()
    {
        $lenght = count($this->_url);
        //Routing
        switch ($lenght){
            case '7':
                $this->_controller->{$this->_url[1]}($this->_url[2],$this->_url[3],$this->_url[4],$this->_url[5],$this->_url[6]);
                break;
            case '6':
                $this->_controller->{$this->_url[1]}($this->_url[2],$this->_url[3],$this->_url[4],$this->_url[5]);
                break;
            case '5':
                $this->_controller->{$this->_url[1]}($this->_url[2],$this->_url[3],$this->_url[4]);
                break;
            case '4':
                $this->_controller->{$this->_url[1]}($this->_url[2],$this->_url[3]);
                break;
            case '3':
                $this->_controller->{$this->_url[1]}($this->_url[2]);
                break;
            case '2':
                $this->_controller->{$this->_url[1]}();
                break;
            default:
                $this->_controller->index();
                break;
        }
    }
}