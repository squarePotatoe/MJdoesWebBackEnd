<?php 

declare(strict_types= 1);

function signup_inputs() {

    // USERNAME
    if (isset($_SESSION["signup_data"]["username"]) && 
    !isset($_SESSION["errors_signup"]["username_taken"])) {
        echo '
        <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                <div class="form-outline flex-fill mb-0">
                    <input class="form-control" type="text" name="username" placeholder="Username" value="' . $_SESSION["signup_data"]["username"] . '">
                </div>
        </div>';
    } else {
        echo '
        <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                <div class="form-outline flex-fill mb-0">
                    <input class="form-control" type="text" name="username" placeholder="Username">
                </div>
        </div>';
    }
        // PASSWORD
        echo '
        <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                <div class="form-outline flex-fill mb-0">
                    <input class="form-control" type="password" name="pwd" placeholder="Password">
                </div>
        </div>';      
        echo '
        <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                <div class="form-outline flex-fill mb-0">
                    <input class="form-control" type="password" name="pwdconfirm" placeholder="Confirm Password">
                </div>
        </div>';

    // EMAIL
    if (isset($_SESSION["signup_data"]["email"]) && 
        !isset($_SESSION["errors_signup"]["email_used"]) && 
        !isset($_SESSION["errors_signup"]["invalid_email"])) {
        echo '
        <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                <div class="form-outline flex-fill mb-0">
                    <input class="form-control" type="text" name="email" placeholder="Email" value="' . $_SESSION["signup_data"]["email"] . '" >
                </div>
        </div>';
    } else {
        echo '
        <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                <div class="form-outline flex-fill mb-0">
                    <input class="form-control" type="text" name="email" placeholder="Email">
                </div>
        </div>';
    }
}

function check_signup_errors() {
    if (isset($_SESSION['errors_signup'])){
        $errors = $_SESSION['errors_signup'];

        echo "<br>";

        foreach ($errors as $error) {
            echo "<p class='error-message'>" . $error ."</p>";
        }

        unset($_SESSION['errors_signup']);
    } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo '<br>';
        echo '<p>Signup success</p>';
    }
}