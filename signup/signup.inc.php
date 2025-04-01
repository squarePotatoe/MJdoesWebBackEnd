<?php 

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $pwdconfirm = $_POST["pwdconfirm"];
    $email = $_POST["email"];

    try {

        require_once 'C:\xampp8.2\htdocs\MJSD-Lauch\MJdoesCode\includes\dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        // ERROR HANDLERS

        $errors = [];

        if (is_input_empty($username, $pwd, $email)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Invalid email used!";
        }

        if (is_password_not_matching($pwd, $pwdconfirm)) {
            $errors["pwd_not_match"] = "Password not matching!";
        }

        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username already taken!";
        }

        if (is_email_registered($pdo, $email)) {
            $errors["email_used"] = "Email already registered!";
        }

        require_once 'C:\xampp8.2\htdocs\MJSD-Lauch\MJdoesCode\includes\config_session.inc.php';

        if($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                "username"=> $username,
                "email"=> $email
            ];

            $_SESSION["signup_data"] = $signupData;


            header("Location: ../../public_html/signup");
            die();
        }

        create_user($pdo, $username, $pwd, $email);

        header("Location: ../../public_html/welcome?signup=success");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
        
} else {
    header("Location: ../../public_html/welcome");
    die();
}