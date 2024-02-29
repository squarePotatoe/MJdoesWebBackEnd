<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['id'];
    $header = $_POST['header'];
    $subtitle = $_POST['subtitle'];
    $content = $_POST['content'];
    try {
        require_once('C:\xampp8.2\htdocs\new-project\includes\dbh.inc.php');

        $query = "UPDATE posts SET header = :header, subtitle = :subtitle, content = :content WHERE id = :id";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":header", $header);
        $stmt->bindParam(":subtitle", $subtitle);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":id", $id);

        $stmt->execute();

        header("Location: ../../public_html/blog");
        die();
    } catch (PDOException $e) {
        die('Query failed: ' . $e->getMessage());
    }
} else {
    header("Location: ../public_html/welcome");
}


// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $id = $_GET['id'];
//     $header = $_POST['header'];
//     $subtitle = $_POST['subtitle'];
//     $content = $_POST['content'];

//     try {
//         require_once ('C:\xampp8.2\htdocs\project\includes\dbh.inc.php');
//         require_once ('post_model.inc.php');
//         require_once ('post_contr.inc.php');

//         // ERROR HANDLER

//         $errors = [];

//         if(is_headline_empty($header)) {
//             $errors["empty_headline"] = 'Invalid Headline!';
//         }

//         if(is_content_empty($content)) {
//             $errors["empty_content"] = 'Invalid Content!';
//         }

//         require_once 'C:\xampp8.2\htdocs\project\includes\config_session.inc.php';

//         if($errors) {
//             $_SESSION["errors_post"] = $errors;

//             header("Location: ../../public_html/compose");
//             die();
//         }
//         $author = $_SESSION["user_username"];

//         $_SESSION["posts_header"] = htmlspecialchars($header);
//         $_SESSION["posts_subtitle"] = htmlspecialchars($subtitle);
//         $_SESSION["posts_content"] = htmlspecialchars($content);
        
//         // $category = ucfirst($category);
//         // $_SESSION["posts_category"] = htmlspecialchars($category);

//         update_posts($pdo, $id, $header, $subtitle, $content);

//         header("Location: ../../public_html/blog?create-post=success");

//         $pdo = null;
//         $stmt = null;

//         die();

//     } catch (PDOException $e) {
//         die("Query failed: " . $e->getMessage());
//     }
// } else {
//     header("Location: ../../public_html/blog");
//     die();
// }