<?php

namespace App\Controllers;

use App\DAO\MessageDAO;
use IF\Controller\Action;
use IF\Model\Container;

class IndexController extends Action
{

    public function index()
    {
        $this->view->messages = MessageDAO::getAll();
        $this->view->title = "Home";
        $this->render('index');
    }

    public function formIndex()
    {
        if(MessageDAO::setMessage($_POST['text'])) header('location: /');
        
    }

}