 <?php
 class htmlTab extends page {  // function reads files and  send data to html tag class                        
        public function get() {
            $form = $_GET['filename'];
            chdir('uploads');                                    
            $file = fopen($form,"r"); //reads file
            htmlTag::table();               
            $row = 1;
            while (($data=fgetcsv($file))!== FALSE){  //calling HTML tags  
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