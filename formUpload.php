<?php
class formUpload extends page
    {
        public function get() {                          
            $form = '<form action="index.php?page=formUpload" method="POST" enctype="multipart/form-data">';
            $form .= '<input type="file" name="fileToUpload" id="fileToUpload">';
            $form .= '<input align="center"> <input type="submit" value="Upload CSV" name="submit" ">';
            $form .= '</form>';
            $this->html .= htmlTag::heading('UPLOAD FORM');
            $this->html .= $form;
        }
        }
 ?>