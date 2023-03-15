<?php 

    namespace IF\Model;
    use App\Connection;

    class Container{
        public static function getModel($model)
        {
            $class = '\\App\\Models\\'. ucfirst($model);
            return new $class();
        }

        public static function getDAO($dao)
        {
            $class = '\\App\\DAO\\'. ucfirst($dao);
            $conn = Connection::getDB();
            return new $class($conn);
        }

        
    }

?>