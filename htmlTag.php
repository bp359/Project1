<?php
class htmlTag {            // HTML tags for display of table
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
?>