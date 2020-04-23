<?php
namespace nanoframe\lib\Controller;
use nanoframe\lib\nanoframe;
use nanoframe\lib\Form\Form;
class Controller extends nanoframe{
    //Construct
    function __construct(){

    }
    function loadModel($name){
        $modelName = $name . '_model';
        include $this->getRootDir()."/Model/$modelName.php";
        $this->model = new $modelName();
    }
    function form(){
        $this->form = new Form();
        return $this->form;
    }
    function render($file,$arg = null){
        $dst = $this->getRootDir()."/views/$file";
        include $dst;
    }
}