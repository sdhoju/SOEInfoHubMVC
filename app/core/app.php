<?php

class App
{
    private $url_controller = null;
    private $url_action = null;
    private $url_params = [];
    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct()
    {

        // create array with URL parts in $url
        $this->splitUrl();

        if (!$this->url_controller) {
            require APP . 'controller/announcement.php';
            $page = new Announcement();
            $page->index();
            
        } elseif (file_exists(APP . 'controller/' . $this->url_controller . '.php')) {            

            // does such a controller exist ?
            // if so, then load this file and create this controller
            // example: if controller would be "announcement", then this line would translate into: $this->announcement = new Announcement();
            require APP . 'controller/' . $this->url_controller . '.php';
            $this->url_controller = new $this->url_controller();
           
            // check for method: does such a method exist in the controller ?
            if (method_exists($this->url_controller, $this->url_action)) {
                if (!empty($this->url_params)) {
                    // Call the method and pass arguments to it
                    call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
                } else {
                    // If no parameters are given, just call the method without parameters, like $this->home->method();
                    $this->url_controller->{$this->url_action}();
                }
            }
             else {
                if (strlen($this->url_action) == 0) {
                    // no action defined: call the default index() method of a selected controller
                    $this->url_controller->index();
                }
                else {
                    echo URL . 'problem'.$url;
                    header('location: ' . URL . 'problem');
                }
            }
        } else {
            echo URL . ' problem';
            header('location: ' . URL . 'problem');
        }
    }
    /**
     * Get and split the URL
     */
    private function splitUrl()
    {
        if (isset($_GET['url'])) {
            // split URL
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            
            // Put URL parts into according properties
            // By the way, the syntax here is just a short form of if/else, called "Ternary Operators"
            // @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators

            $this->url_controller = isset($url[0]) ? $url[0] : null;
            $this->url_action = isset($url[1]) ? $url[1] : null;
            
            // Remove controller and action from the split URL
            unset($url[0], $url[1]);

            // Rebase array keys and store the URL params
            $this->url_params = array_values($url);
            
            // for debugging. uncomment this if you have problems with the URL
            // echo 'Controller: ' . $this->url_controller . '<br>';
            // echo 'Action: ' . $this->url_action . '<br>';
            // echo 'Parameters: ' . print_r($this->url_params, true) . '<br>';
        }
    }


     /**
     * Get and split the URL
     */
    private function getUrlWithoutModRewrite()
    {
        
        $url= trim($_SERVER['REQUEST_URI'], '/~sdhoju/MVCPractice/public/');
        // TODO the "" is weird
        // get URL ($_SERVER['REQUEST_URI'] gets everything after domain and domain ending), something like
        // array(6) { [0]=> string(0) "" [1]=> string(9) "index.php" [2]=> string(10) "controller" [3]=> string(6) "action" [4]=> string(6) "param1" [5]=> string(6) "param2" }
        // split on "/"
        $url = explode('/', $url);
        // also remove everything that's empty or "index.php", so the result is a cleaned array of URL parts, like
        // array(4) { [2]=> string(10) "controller" [3]=> string(6) "action" [4]=> string(6) "param1" [5]=> string(6) "param2" }
        $url = array_diff($url, array('', 'index.php'));
        // to keep things clean we reset the array keys, so we get something like
        // array(4) { [0]=> string(10) "controller" [1]=> string(6) "action" [2]=> string(6) "param1" [3]=> string(6) "param2" }
        $url = array_values($url);
        // if first element of our URL is the sub-folder (defined in config/config.php), then remove it from URL
        if (defined('URL_SUB_FOLDER') && !empty($url[0]) && $url[0] === URL_SUB_FOLDER) {
            // remove first element (that's obviously the sub-folder)
            unset($url[0]);
            // reset keys again
            $url = array_values($url);
        }
        // Put URL parts into according properties
        // By the way, the syntax here is just a short form of if/else, called "Ternary Operators"
        // @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators
        $this->url_controller = isset($url[0]) ? $url[0] : null;
        $this->url_action = isset($url[1]) ? $url[1] : null;
        // Remove controller and action from the split URL
        unset($url[0], $url[1]);
        // Rebase array keys and store the URL params
        $this->url_params = array_values($url);
        // for debugging. uncomment this if you have problems with the URL
        echo 'Controller: ' . $this->url_controller . '<br>';
        echo 'Action: ' . $this->url_action . '<br>';
        echo 'Parameters: ' . print_r($this->url_params, true) . '<br>';
    }
}