<?php
    // 	
    require_once(APP."libs/Mailer.php");
    require_once(APP."libs/session.php");


class Controller
{
    public $db = null;
    public $model = null;

    function __construct()
    {
        $this->openDatabaseConnection();
        $this->loadModel();
    }

    private function openDatabaseConnection()
    {


        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
        
        // print_r(DB_TYPE);
                            // // generate a database connection, using the PDO connector
        // // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_TYPE . 
                            ':host=' . DB_HOST . 
                            ';dbname=' . DB_NAME . 
                            ';charset=' . DB_CHARSET,
                             DB_USER, DB_PASS, $options);
      
    }
   
    public function loadModel()
    {
        require APP . 'model/model.php';
        $this->model = new Model($this->db);
    }

    
   
}