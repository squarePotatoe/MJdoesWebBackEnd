<?php 

declare(strict_types= 1);

function show_post_errors() {
    if (isset($_SESSION["errors_post"])) {
        $errors = $_SESSION["errors_post"];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="error-message">' . $error .'</p>';
        }

        unset($_SESSION["errors_post"]);
    } 
}