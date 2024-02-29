<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try {
        
        require_once('C:\xampp8.2\htdocs\new-project\includes\dbh.inc.php');
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        // ERROR HANDLERS

        $errors = [];

        if (is_input_empty($username, $pwd)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($pdo, $username);

        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        if (!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        require_once 'C:\xampp8.2\htdocs\project\includes\config_session.inc.php';

        if($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../../public_html/login");
            die();
        }
        
        // Creating new session ID with Users ID attached to it
        // Then need to check if the user is logged-in in the
        // Config file, so it uses user ID on refresh
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        // Sanitizing the username in case it gets outputed into the website
        // for security reasons. Otherwise it can stay unsanitized.
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        
        $_SESSION["user_role"] = $result["role"];

        $_SESSION["last_regeneration"] = time();

        
        header("Location: ../../public_html/blog?welcome");

        $pdo = null;
        $stmt = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../public_html/blog");
    die();
}