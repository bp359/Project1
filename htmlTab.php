 <?php
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