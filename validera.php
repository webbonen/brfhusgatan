<?php
    function validera($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input; // Returnerar en trimmad, strippad och specialchar-fixad input
    }
    // Från https://www.w3schools.com/php/php_form_validation.asp

?>