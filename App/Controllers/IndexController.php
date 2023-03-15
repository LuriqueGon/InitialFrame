<?php

namespace App\Controllers;
use IF\Controller\Action;

class IndexController extends Action
{

    public function index()
    {
        $this->render('index');
    }

    public function formIndex()
    {
        echo "FormIndex";
    }

}