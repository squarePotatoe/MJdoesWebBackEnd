<?php 

declare(strict_types= 1);

function show_project_errors() {
    if (isset($_SESSION["errors_project"])) {
        $errors = $_SESSION["errors_project"];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="error-message">' . $error .'</p>';
        }

        unset($_SESSION["errors_project"]);
    } 
}