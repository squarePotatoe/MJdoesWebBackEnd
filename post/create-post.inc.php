<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $headline = $_POST['headline'];
    $subtitle = $_POST['subtitle'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    try {
        require_once 'C:\xampp8.2\htdocs\MJSD-Lauch\MJdoesCode\includes\dbh.inc.php';
        require_once ('post_model.inc.php');
        require_once ('post_contr.inc.php');

        // ERROR HANDLER

        $errors = [];

        if(is_headline_empty($headline)) {
            $errors["empty_headline"] = 'Invalid Headline!';
        }
        
        if(is_content_empty($content)) {
            $errors["empty_content"] = 'Invalid Content!';
        }

        require_once 'C:\xampp8.2\htdocs\MJSD-Lauch\MJdoesCode\includes\config_session.inc.php';

        if($errors) {
            $_SESSION["errors_post"] = $errors;

            header("Location: ../../public_html/compose");
            die();
        }
        $author = $_SESSION["user_username"];

        $_SESSION["posts_header"] = htmlspecialchars($headline);
        $_SESSION["posts_subtitle"] = htmlspecialchars($subtitle);
        $_SESSION["posts_content"] = htmlspecialchars($content);
        $_SESSION["posts_author"] = htmlspecialchars($author);
        
        $category = ucfirst($category);
        $_SESSION["posts_category"] = htmlspecialchars($category);

        create_post($pdo, $headline, $subtitle, $content, $category, $author);

        header("Location: ../../public_html/blog?create-post=success");

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