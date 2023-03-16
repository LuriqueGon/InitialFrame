<?php

    namespace App\Models;
    use IF\Model\Model;

    Class Teste extends Model
    {
        protected $message;

        public function show()
        {
            return "A mensagem é: ". $this->__get('message');
        }
       
    }


?>