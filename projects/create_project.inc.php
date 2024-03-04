<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];

    try {
        require_once ('C:\xampp8.2\htdocs\project\includes\dbh.inc.php');
        require_once ('project_model.inc.php');
        require_once ('project_contr.inc.php');

        // ERROR HANDLER

        $errors = [];

        if(is_tilte_empty($title)) {
            $errors["empty_title"] = "Title can not be empty!";
        }

        require_once 'C:\xampp8.2\htdocs\project\includes\config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_project"] = $errors;

            header("Location: ../../public_html/about?error-creating-project");
            die;
        }

        $author = $_SESSION["user_username"];

        $targetFolder = '../../uploads/';

        $uploadFile = $_FILES['image']['tmp_name'];

        $targetFile = $targetFolder . basename($_FILES['image']['name']);

        if (move_uploaded_file($uploadFile, $targetFile)) {
            echo 'Uploaded';
        } else {
            die();
        }

        $imagePath = '../uploads/' . basename($_FILES['image']['name']);

        $_SESSION["project_title"] = htmlspecialchars($title);
        $_SESSION["project_description"] = htmlspecialchars($description);
        $_SESSION["project_image"] = htmlspecialchars($imagePath);

        create_project($pdo, $title, $description, $imagePath);
            
        header("Location: ../../public_html/about?create-project=success");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../public_html/about");
}