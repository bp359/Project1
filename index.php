<?php
    ini_set('display_errors', 'On');                          
    error_reporting(E_ALL);
    class manage{                                             
        public static function autoload($class) {
            include $class . '.php';
        }
    }
    spl_autoload_register(array('manage', 'autoload'));

    $obj = new main();                                            

    class main {
        public function __construct() {
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
            string::printThis($this->html);
        }
        public function get() {
            echo 'default get message';
        }
        public function post() {
            print_r($_POST);
        }
    }
    class string {             
        static public function printThis($inputText) {
            return print($inputText);
        }
    }
    class formUpload extends page
    {
        public function get() {                          
            $form = '<form action="index.php?page=formUpload" method="POST" enctype="multipart/form-data">';
            $form .= '<input type="file" name="fileToUpload" id="fileToUpload">';
            $form .= '<input align="center"> <input type="submit" value="Upload CSV" name="submit">';
            $form .= '</form>';
            $this->html .= htmlTag::heading('UPLOAD FORM');
            $this->html .= $form;
        }
        public function post() {                         
            $target_dir = "uploads/";
            $target_file = $target_dir . $_FILES["fileToUpload"]["name"];
            $filename = $_FILES["fileToUpload"]["name"];
        
            if (file_exists($target_file)) {
                unlink($target_file);
            }
    
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                header("Location:index.php?page=htmlTab&filename=$filename");
            }
    
    }
    }
    class htmlTag {            
        static public function heading($text) {
            return '<h1><center><u>' . $text . '</u></center></h1>';
        }
        static public function table() {
            echo "<table cellpadding='15px' border='3px' style='border-collapse:collapse' text-align :'left' width ='100%'white-space : nowrap'font-''weight:bold'>";
        }
        static public function tableheading($text) {
            echo '<th style="font-size: 80%", background-color: #4CAF50, color: white>'.$text.'</th>';
            

        }
        static public function content($text) {
            echo '<td>'.$text.'</td>';
        }
        static public function tablerow() {
            echo '</tr>';
        }
    }
    class htmlTab extends page {                          
        public function get() {
            $csv = $_GET['filename'];
            chdir('uploads');                                    
            $file = fopen($csv,"r");
            htmlTag::table();               
            $row = 1;
            while (($data=fgetcsv($file))!== FALSE){    
                foreach($data as $value) {
                    if ($row == 1) {
                        htmlTag::tableheading($value);
                    }else{
                        htmlTag::content($value);
                    }
                }
                $row++;
                htmlTag::tablerow();
            }
            fclose($file); 
        }
    }
?>