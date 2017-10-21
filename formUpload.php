<?php
class formUpload extends page //Using get and post function to load file into directory                   
    {
        public function get() {                          
            $form = '<form action="index.php?page=formUpload" method="POST" enctype="multipart/form-data">';
            $form .= '<input type="file" name="fileToUpload" id="fileToUpload">';
            $form .= '<input align="center"> <input type="submit" value="Upload CSV" name="submit" ">';
            $form .= '</form>';
            $this->html .= htmlTag::heading('UPLOAD FORM');
            $this->html .= $form;
        }
        public function post() {                         
            $target_dir = "uploads/";           //specifying target directory.
            $target_file = $target_dir . $_FILES["fileToUpload"]["name"];
            $filename = $_FILES["fileToUpload"]["name"];

            //If the uploaded file already exists, it will be unlinked from directory
            if (file_exists($target_file)) {
                unlink($target_file);
            }

            //If file is saved in the 'uploads' directory , the user is redirected to another page.
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                header("Location: index.php?page=htmlTab&filename=$filename");
            }
        }
    }
 ?>