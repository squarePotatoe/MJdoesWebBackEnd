<?php 

declare(strict_types= 1);

function output_username() {
    if (isset($_SESSION["user_id"])) {
        echo $_SESSION["user_username"];
    } 
}

function check_login_errors() {
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

        echo "<br>";

        foreach ($errors as $error) {
            
            echo '<p style="color: #c83e3e;" class="error-message mx-auto text-decoration-underline justify-content-center">' . $error .'</p>';
        }

        unset($_SESSION["errors_login"]);
    } else if (isset($_GET["login"]) && $_GET["login"] == "success") {

    }
}
