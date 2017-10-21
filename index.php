<?php
    ini_set('display_errors', 'On');  //debugging message is on                    
    error_reporting(E_ALL);
    class manage{                                             
        public static function autoload($class) {
            include $class . '.php';
        }
    }
    spl_autoload_register(array('manage', 'autoload')); // calling autoload

    $obj = new main(); // instatiation of the object                                          

    class main {
        public function __construct() { //requests page to display
            $pageRequest = 'formUpload';
            if(isset($_REQUEST['page'])) {
                $pageRequest = $_REQUEST['page'];
            }
            $page = new $pageRequest;
            if($_SERVER['REQUEST_METHOD'] == 'GET') {
                $page->get();
            } else {
                $page->post();
            }
        }
    }

abstract class page { 
        protected $html;
        public function  __construct() {
            $this->html .= '<html>';
            $this->html .= '<link rel="stylesheet" href="styles.css">';
            $this->html .= '<body>';
        }
        public function __destruct() {
            $this->html .= '</body></html>';
            string::printThis($this->html); //prints required page
        }
        public function get() {
            echo 'default get message';
        }
        public function post() {
            print_r($_POST);
        }
    }
    
?>