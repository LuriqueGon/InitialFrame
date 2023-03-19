<?php

namespace IF\Controller;

use App\Models\Message;
use IF\Backup\GetBackup;
use IF\Backup\SetBackup;

abstract class Action
{
    protected $view;

    public function __construct()
    {
        $this->view = new \stdClass();
        session_start();
        $this->backup('GET','false');
    }
    protected  function render($view, $layout = "layout")
    {
        $this->view->page = $view;

        if(file_exists("../App/Views/Layouts/$layout.phtml"))
        {
            require "../App/Views/Layouts/$layout.phtml";
        }else
        {
            require "../Config/Error/404/layouts.php";
        }
    }

    protected function content()
    {
        $class = get_class($this);
        $class = str_replace('App\\Controllers\\', '', $class);
        $class = str_replace('Controller', '', $class);
        $class = ucfirst($class);

        if(file_exists("../App/Views/Pages/$class/".$this->view->page.".phtml"))
        {
            require "../App/Views/Pages/$class/".$this->view->page.".phtml";
        }else{
            require "../Config/Error/404/pages.php";
        }
    }

    protected function loadComponent($component)
    {
        $atualClass =  strtolower(str_replace('Controller', '',str_replace('App\\Controllers\\', '', get_class($this)))); 
        $thisClass['component'] = "../app/View/components/";
        $thisClass['extension'] = ".phtml";

        if(file_exists($thisClass['component']."$atualClass/$component".$thisClass['extension'])){
            require_once $thisClass['component']."$atualClass/$component".$thisClass['extension'];
        }
        else if (file_exists($thisClass['component'] . "app/$component" . $thisClass['extension'])) {
            require_once $thisClass['component'] . "app/$component" . $thisClass['extension'];
        }
        else{
            require "../Config/Error/404/component.php";
        }
    }

    protected function restrict($redirect = ''){
        if(!isset($_SESSION['User']['auth']) || !$_SESSION['User']['auth']){
            Message::setMessage(
                'Você precisa está logado para ter acesso a página restrita','danger','/login?redirect='.$redirect
            );
            exit;
        }
    }

    protected function dontRestrict(){
        if(isset($_SESSION['User']['auth']) && $_SESSION['User']['auth']){
            Message::setMessage('Você já está logado, caso queira trocar de conta. Clique em sair','danger','/');
            exit;
        }
    }

    protected function setValueObject(Object $object, Array $values):Object{

        foreach ($values as $key => $value) {
            $object->__set($key, $value);
        }

        return $object;
    }

    protected function setValueArray(Array $array, Array $values, Array $excepitions = array()):Array
    {
        foreach ($values as $key => $value) {
            $array[$key] = $value;

            foreach ($excepitions as $excepition) {
                if($key == $excepition) unset($array[$key]); 
                
            }
        }

        return $array;
    }

    protected function unsetValueArray(Array $array):array
    {   
        foreach ($array as $key => $value) {
            unset($array[$key]);
        }
        return $array;
    }

    private function backup($type, $bool)
    {
        if($type == "GET") $backup = new GetBackup;
        else $backup = new SetBackup;
        if($bool) $backup->startBackup();
    }
}